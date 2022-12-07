CC = gcc -l m -pthread -o $@

.PHONY: all
all: recursive_.

.DELETE_ON_ERROR:
.NOTINTERMEDIATE:
.SILENT:

.PHONY: recursive_%
recursive_%:
	@file=`echo $* | tr '_' '/'`; \
	head="$(HEADERS)"; \
	all="$(ALLHEADERS)"; \
	for curr in $$file/*; do \
		next=`echo $$curr | tr '/' '_'`; \
		if [ -f $$curr ]; then \
			d="$${curr##*.}"; \
			if [[ $$curr != "./scraper.c" && $$d == 'c' ]]; then \
				obj=../int/$${next:2}; \
				obj=$${obj%?}o; \
				make $$obj HEADERS="$$curr $${curr%?}h $(HEADERS)"; \
			elif [ $$d == 'h' ]; then \
				head="$$head $$curr"; \
				all="$$all $$curr"; \
				echo $$curr; \
			fi; \
		fi; \
	done; \
	for curr in $$file/*; do \
		next=`echo $$curr | tr '/' '_'`; \
		if [ -d $$curr ]; then \
			new=`make recursive_$$next ALLHEADERS="$$all" HEADERS="$$head" | tr '\n' ' '`; \
			all="$$all $$new"; \
			if [ $* != "." ]; then \
				echo $$new; \
			fi; \
		fi; \
	done; \
	if [ $* == "." ]; then \
		make ../int/scraper.o HEADERS="scraper.c $$all"; \
		make ../bin/scraper; \
	fi

../bin/scraper: ../bin ../int ../int/*.o
	$(CC) ../int/*.o

../bin:
	mkdir ../bin

../int/%.o: $(HEADERS) ../int
	file=`echo $* | tr '_' '/'`; \
	$(CC) -c $<

../int:
	mkdir ../int

.PHONY: clean
clean:
	rm ../bin/*
	rm ../int/*