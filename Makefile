start: # start a project
	sudo chmod -R 777 docker/nginx/log docker/php/log docker/db/mysql/data docker/db/mysql/log www/storage
	docker-compose up -d

down: # down a project
	docker-compose down

restart: # restart a project
	docker-compose restart

composer-install: # install composer
	docker-compose exec php-bundle composer install

build: # project bootstrap
	docker-compose build
	docker-compose up -d
	cp www/.env.example www/.env
	docker-compose exec php-bundle composer install
	docker-compose exec php-bundle php artisan key:generate
	sudo chmod -R 777 docker/nginx/log docker/php/log docker/db/mysql/data docker/db/mysql/log www/storage www/bootstrap/cache www/public/upload

tests:
	docker-compose exec php-bundle phpunit

import-csv:
	docker-compose exec php-bundle php artisan import-csv

