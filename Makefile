artisan:
	docker-compose exec app php artisan $(filter-out $@,$(MAKECMDGOALS))
key:
	docker-compose exec app php artisan key:generate
composer:
	docker-compose exec app composer install
docker-dev:
	docker-compose down & docker-compose build --no-cache & docker-compose up -d
down: 
	docker-compose down
build:
	docker-compose build
build-cache: 
	docker-compose build --no-cache
up:
	docker-compose up -d