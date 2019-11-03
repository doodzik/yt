server:
	cd html && php -S localhost:8000; cd ..

install:
	composer install

.PHONY: serve install

