#ifndef PC_LIFE_PASSMARK_H
#define PC_LIFE_PASSMARK_H

#include "../http.h"

struct http_info passmark_open(char *fqdn);
char passmark_handle(char *message, char *name);

#endif