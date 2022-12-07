#include <errno.h>
#include <netdb.h>
#include <pthread.h>
#include <semaphore.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <unistd.h>

#include "http.h"

void *http_open_sync(void *arg) {
	struct http_info *http_info = arg;
	struct addrinfo *hints = (struct addrinfo *)calloc(1, sizeof(struct addrinfo));
	if (!hints) {
		fputs("Error: calloc failed\r\n", stderr);
		http_info->fqdn = NULL;
		return NULL;
	}
	struct addrinfo *res = (struct addrinfo *)calloc(1, sizeof(struct addrinfo));
	if (!res) {
		fputs("Error: calloc failed\r\n", stderr);
		freeaddrinfo(hints);
		http_info->fqdn = NULL;
		return NULL;
	}
	hints->ai_family = AF_INET;
	hints->ai_socktype = SOCK_STREAM;
	int err = getaddrinfo(http_info->fqdn, NULL, hints, &res);
	if (err) {
		fprintf(stderr, "Error: getaddrinfo failed: %s\r\n", gai_strerror(err));
		freeaddrinfo(hints);
		freeaddrinfo(res);
		http_info->fqdn = NULL;
		return NULL;
	}
	freeaddrinfo(hints);
	((struct sockaddr_in *)res->ai_addr)->sin_port = htons(80);
	http_info->socket = socket(AF_INET, SOCK_STREAM, 0);
	if (http_info->socket == -1) {
		perror("Error: socket failed");
		freeaddrinfo(res);
		http_info->fqdn = NULL;
		return NULL;
	}
	if (connect(http_info->socket, (struct sockaddr *)res->ai_addr, sizeof(struct sockaddr)) == -1) {
		perror("Error: connect failed");
		if (close(http_info->socket)) {
			perror("Error: close failed");
		}
		freeaddrinfo(res);
		http_info->fqdn = NULL;
		return NULL;
	}
	freeaddrinfo(res);
	if (http_info->threaded) {
		while (1) {
			err = pthread_mutex_unlock(&http_info->mutex);
			if (err) {
				fprintf(stderr, "Error: pthread_cond_wait failed: %s\r\n", strerror(err));
				http_close(http_info);
				return NULL;
			}
			err = pthread_cond_wait(&http_info->condition, &http_info->mutex);
			if (err) {
				fprintf(stderr, "Error: pthread_cond_wait failed: %s\r\n", strerror(err));
				http_close(http_info);
				return NULL;
			}
		}
	}
	return arg;
}

char http_open_async(struct http_info *http_info) {
	http_info->threaded = 1;
	http_info->path = NULL;
	int err = pthread_mutex_init(&http_info->mutex, NULL);
	if (err) {
		fprintf(stderr, "Error: pthread_mutex_init failed: %s\r\n", strerror(err));
		http_info->fqdn = NULL;
		return 1;
	}
	err = pthread_mutex_lock(&http_info->mutex);
	if (err) {
		fprintf(stderr, "Error: pthread_mutex_lock failed: %s\r\n", strerror(err));
		err = pthread_mutex_destroy(&http_info->mutex);
		if (err) {
			fprintf(stderr, "Error: pthread_mutex_destroy failed: %s\r\n", strerror(err));
		}
		http_info->fqdn = NULL;
		return 1;
	}
	err = pthread_cond_init(&http_info->condition, NULL);
	if (err) {
		fprintf(stderr, "Error: pthread_cond_init failed: %s\r\n", strerror(err));
		err = pthread_mutex_destroy(&http_info->mutex);
		if (err) {
			fprintf(stderr, "Error: pthread_mutex_destroy failed: %s\r\n", strerror(err));
		}
		http_info->fqdn = NULL;
		return 1;
	}
	if (sem_init(&http_info->semaphore, 0, 0)) {
		perror("Error: sem_init failed");
		err = pthread_mutex_destroy(&http_info->mutex);
		if (err) {
			fprintf(stderr, "Error: pthread_mutex_destroy failed: %s\r\n", strerror(err));
		}
		err = pthread_cond_destroy(&http_info->condition);
		if (err) {
			fprintf(stderr, "Error: pthread_cond_destroy failed: %s\r\n", strerror(err));
		}
		http_info->fqdn = NULL;
		return 1;
	}
	printf("AFTER: %s\r\n", http_info->fqdn);
	err = pthread_create(&http_info->thread, NULL, &http_open_sync, &http_info);
	if (err) {
		fprintf(stderr, "Error: pthread_create failed: %s\r\n", strerror(err));
		err = pthread_mutex_destroy(&http_info->mutex);
		if (err) {
			fprintf(stderr, "Error: pthread_mutex_destroy failed: %s\r\n", strerror(err));
		}
		err = pthread_cond_destroy(&http_info->condition);
		if (err) {
			fprintf(stderr, "Error: pthread_cond_destroy failed: %s\r\n", strerror(err));
		}
		if (sem_destroy(&http_info->semaphore)) {
			perror("Error: sem_destroy failed");
		}
		http_info->fqdn = NULL;
		return 1;
	}
	return 0;
}

char http_get(struct http_info *http_info, char *path, char (*handler)(char *message)) {
	if (http_info->threaded && http_info->thread != pthread_self()) {
		int err = pthread_mutex_lock(&http_info->mutex);
		if (err) {
			fprintf(stderr, "Error: pthread_mutex_lock failed: %s\r\n", strerror(err));
			return 1;
		}
		char *path_copy = (char *)malloc(strlen(path) + 1);
		strcpy(path_copy, path);
		http_info->path = path_copy;
		err = pthread_cond_signal(&http_info->condition);
		if (err) {
			fprintf(stderr, "Error: pthread_cond_signal failed: %s\r\n", strerror(err));
			free(path_copy);
			http_info->path = NULL;
			return 1;
		}
		return 0;
	}
	char result = 1;
	if (http_info->fqdn) {
		size_t len = strlen(path) + 19;
		char *buffer = (char *)malloc(len);
		if (!buffer) {
			fputs("Error: malloc failed\r\n", stderr);
			return 1;
		}
		if (sprintf(buffer, "GET /%s HTTP/1.0\r\n\r\n", path) < 0) {
			fputs("Error: sprintf failed\r\n", stderr);
			free(buffer);
			return 1;
		}
		buffer[len - 1] = 0;
		ssize_t total = 0;
		ssize_t partial;
		while (total < len) {
			partial = write(http_info->socket, buffer + total, len - total);
			if (partial > 0) {
				total += partial;
			} else if (partial) {
				perror("Error: write failed");
				free(buffer);
				return 1;
			}
		}
		free(buffer);
		len = http_info->block;
		buffer = (char *)malloc(len);
		if (!buffer) {
			fputs("Error: malloc failed\r\n", stderr);
			return 1;
		}
		total = 0;
		while (total == 0 || buffer[total - 1]) {
			if (len == total) {
				char *rebuffer = realloc(buffer, len += http_info->block);
				if (!rebuffer) {
					fputs("Error: realloc failed\r\n", stderr);
					free(buffer);
					return 1;
				}
				buffer = rebuffer;
			}
			partial = read(http_info->socket, buffer + total, len - total);
			if (partial > 0) {
				total += partial;
			} else if (partial) {
				perror("Error: read failed");
				free(buffer);
				return 1;
			} else {
				break;
			}
		}
		if (buffer[total - 1]) {
			if (len - 1 != total) {
				char *rebuffer = realloc(buffer, total + 1);
				if (!rebuffer) {
					fputs("Error: realloc failed\r\n", stderr);
					free(buffer);
					return 1;
				}
				buffer = rebuffer;
			}
			buffer[total] = 0;
		}
		result = handler(buffer);
		free(buffer);
	}
	return result;
}

char http_close(struct http_info *http_info) {
	char result = 0;
	if (http_info->fqdn) {
		if (http_info->threaded) {
			if (http_info->thread != pthread_self()) {
				int err = pthread_mutex_lock(&http_info->mutex);
				if (err) {
					fprintf(stderr, "Error: pthread_mutex_lock failed: %s\r\n", strerror(err));
					result = 1;
				}
				err = pthread_cancel(http_info->thread);
				if (err) {
					fprintf(stderr, "Error: pthread_cancel failed: %s\r\n", strerror(err));
					result = 1;
				}
			}
			int err = pthread_mutex_destroy(&http_info->mutex);
			if (err) {
				fprintf(stderr, "Error: pthread_mutex_destroy failed: %s\r\n", strerror(err));
				result = 1;
			}
			err = pthread_cond_destroy(&http_info->condition);
			if (err) {
				fprintf(stderr, "Error: pthread_cond_destroy failed: %s\r\n", strerror(err));
				result = 1;
			}
			if (sem_destroy(&http_info->semaphore)) {
				perror("Error: sem_destroy failed");
				result = 1;
			}
			if (http_info->path) {
				free(http_info->path);
				http_info->path = NULL;
			}
		}
		if (close(http_info->socket) == -1) {
			perror("Error: close failed");
			result = 1;
		}
		http_info->fqdn = NULL;
	}
	return result;
}