#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "../http.h"
#include "passmark.h"

struct http_info passmark_open(char *fqdn) {
	struct http_info http_info = {fqdn, 4096, 0};
	http_open_sync(&http_info);
	return http_info;
}

char passmark_handle(char *message, char *name) {
	FILE *json = fopen("../dat/output.json", "w"); // DOES NOT DOUBLE CHECK EXISTING DATA YET
	if (!json) {
		perror("Error: fopen failed");
		return 1;
	}
	fputs("{\n\t\"", json);
	char *parse_begin = message;
	char *parse_end;
	for (char i = 0; i < 2; ++i) {
		fputs(i ? "Score\": \"" : "Name\": \"", json);
		parse_begin = strstr(parse_begin, i ? "<span style=\"font-family: Arial, Helvetica, sans-serif;font-size: 44px;	font-weight: bold; color: #F48A18;\">" : "<span class=\"cpuname\">");
		if (!parse_begin) {
			fputs("Error: strstr failed\r\n", stderr);
			fclose(json);
			return 1;
		}
		parse_begin += i ? 108 : 22;
		parse_end = strstr(parse_begin, "</span>");
		if (!parse_end) {
			fputs("Error: strstr failed\r\n", stderr);
			fclose(json);
			return 1;
		}
		fputs(i ? "Score: " : "Name: ", stdout);
		while (parse_begin != parse_end) {
			if (*parse_begin == 34 || *parse_begin == 39 || *parse_begin == 92) {
				fputc('\\', json);
			}
			if (*parse_begin > 31) {
				fputc(*parse_begin, stdout); // TEMPORARY FOR DEBUGGING
				fputc(*(parse_begin++), json);
			}
		}
		fputs("\r\n", stdout); // TEMPORARY FOR DEBUGGING
		fputs("\",\n\t\"", json);
	}
	fputs("Suite\": {", json);
	short data = 0;
	parse_begin = strstr(parse_begin, "<table id=\"test-suite-results\" class=\"table\" >");
	if (parse_begin) {
		parse_end = strstr(parse_begin, "</table>");
		if (parse_end) {
			char *row_begin = strstr(parse_begin, "<tr>");
			char *row_end;
			char *column_begin;
			char *column_end;
			row_begin += 4;
			while (row_begin) {
				row_end = strstr(row_begin, "</tr>");
				if (!row_end || row_end > parse_end) {
					break;
				}
				for (char i = 0; i < 2; ++i) {
					if (i) {
						fputs(": ", stdout); // TEMPORARY FOR DEBUGGING
						fputs("\": \"", json);
					} else {
						if (data) {
							fputc(',', json);
						}
						fputs("\n\t\t\"", json);
					}
					column_begin = strstr(row_begin, i ? "<td>" : "<th>");
					if (!column_begin) {
						fputs("Error: strstr failed\r\n", stderr);
						fclose(json);
						break;
					}
					column_begin += 4;
					column_end = strstr(column_begin, i ? "</td>" : "</th>");
					if (!column_end || column_end > row_end) {
						fputs("Error: strstr failed\r\n", stderr);
						fclose(json);
						break;
					}
					while (column_begin != column_end) {
						if (*column_begin == 34 || *column_begin == 39 || *column_begin == 92) {
							fputc('\\', json);
						}
						if (*parse_begin > 31) {
							fputc(*column_begin, stdout); // TEMPORARY FOR DEBUGGING
							fputc(*(column_begin++), json);
						}
					}
				}
				fputs("\r\n", stdout); // TEMPORARY FOR DEBUGGING
				fputc('"', json);
				row_begin = strstr(row_begin, ++data % 2 ? "<tr class=\"bg-table-row\">" : "<tr>");
				if (row_begin && row_begin < parse_end) {
					row_begin += data % 2 ? 25 : 4;
				} else {
					row_begin = strstr(row_end, "<tr>");
					if (row_begin) {
						row_begin += 4;
					}
				}
			}
		}
		fputs("\n\t}\n}", json);
	}
	fflush(json);
	fclose(json);
	return 0;
}