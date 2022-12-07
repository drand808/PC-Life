#include <math.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "../../http.h"
#include "../passmark.h"
#include "cpu.h"

struct http_info passmark_open_cpu() {
	return passmark_open("www.cpubenchmark.net");
}

char passmark_get_cpu(struct http_info *http_info, int id) {
	if (id > 0) {
		short len = 1 + log10(id);
		char *buffer = malloc(12 + len);
		if (buffer) {
			strcpy(buffer, "cpu.php?id=");
			for (short i = 0; i < len; ++i) {
				int character = id / pow(10, len - i - 1);
				buffer[11 + i] = character % 10 + 48;
			}
			buffer[11 + len] = 0;
			char res = http_get(http_info, buffer, &passmark_handle_cpu);
			free(buffer);
			return res;
		}
		fputs("Error: malloc failed\r\n", stderr);
		return 1;
	}
	return 1;
}

char passmark_handle_cpu(char *message) {
	return passmark_handle(message, "cpuname");
}