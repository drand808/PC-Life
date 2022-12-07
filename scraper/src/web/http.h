#ifndef PC_LIFE_HTTP_H
#define PC_LIFE_HTTP_H

#include <pthread.h>
#include <semaphore.h>

struct http_info {
	char *fqdn;
	unsigned block;
	char threaded;
	int socket;
	char *path;
	pthread_cond_t condition;
	pthread_mutex_t mutex;
	pthread_t thread;
	sem_t semaphore;
};

void *http_open_sync(void *arg);
char http_open_async(struct http_info *http_info);
char http_get(struct http_info *http_info, char *path, char (*handler)(char *message));
char http_close(struct http_info *http_info);

#endif