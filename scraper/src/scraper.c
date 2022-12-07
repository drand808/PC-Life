#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

#include "web/http.h"
#include "web/passmark/passmark.h"
#include "web/passmark/sub/cpu.h"
#include "web/passmark/sub/memory.h"

//void help();

int main(int argc, char** argv) {\
fputc('\n', stdout);
	struct http_info passmark;
	if (argc == 3) {
		if (!strcmp(argv[1], "memory")) {
			passmark = passmark_open_memory();
			passmark_get_memory(&passmark, atoi(argv[2]));
			http_close(&passmark);
		} else if (!strcmp(argv[1], "cpu")) {
			passmark = passmark_open_cpu();
			passmark_get_cpu(&passmark, atoi(argv[2]));
			http_close(&passmark);
		}
	} else if (argc == 1) {
		passmark = passmark_open_cpu();
		passmark_get_cpu(&passmark, 4609);
		http_close(&passmark);
	}
	fputc('\n', stdout);
	/*long long seconds = (long long)time(NULL);
	if (seconds < 0) {
		perror("Error: time() failed");
		return EXIT_FAILURE;
	}
	short length = log10(seconds + 1);
	char *name = malloc(sizeof(char) * (length + 2));
	name[length + 1] = '\0';
	for (short i = 0; i < length; i++) {
		name[i] = (char)(seconds / pow(10, i)) % 10 + 48;
	}
	if (length > 10) {
		length += 54;
		if (length > 90) {
			length += 6;
		}
	} else {
		length += 47;
	}
	name[0] = length;
	FILE *file = fopen(name, "a");
	printf("The web scraper is now online.\nInstructions: ALL\nLog File: logs/log.dat\n> ");*/
//	passmark_open("www.cpubenchmark.com");
//	passmark_parse_cpu(1234);
	/*if (init("www.cpubenchmark.net", "GET /cpu.php?id=1234 HTTP/1.0\r\n\r\n")) {
	}*/
	return EXIT_SUCCESS;
}

/*void help() {
	puts("Optional Command Line Arguments:");
	puts("-i | --instructions : Specifies the web scraper's instructions, expects an Instruction ID (see below).");
	puts("Instruction IDs:");
	puts("ALL     : Scrapes the web for everything");
	puts("PARTCPU : Scrapes the web for CPU information");
}*/