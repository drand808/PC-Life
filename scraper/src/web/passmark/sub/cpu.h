#ifndef PC_LIFE_PASSMARK_CPU_H
#define PC_LIFE_PASSMARK_CPU_H

#include "../../http.h"
#include "../passmark.h"

struct http_info passmark_open_cpu();
char passmark_get_cpu(struct http_info *http_info, int id);
char passmark_handle_cpu(char *message);

#endif