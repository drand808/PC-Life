#ifndef PC_LIFE_PASSMARK_MEMORY_H
#define PC_LIFE_PASSMARK_MEMORY_H

#include "../../http.h"
#include "../passmark.h"

struct http_info passmark_open_memory();
char passmark_get_memory(struct http_info *http_info, int id);
char passmark_handle_memory(char *message);

#endif