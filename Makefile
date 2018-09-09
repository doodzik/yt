server:
	cd html && php -S localhost:8000; cd ..

install:
	compose install

.PHONY: serve install

