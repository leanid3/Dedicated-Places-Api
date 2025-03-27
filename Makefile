artisan:
	docker-compose exec app php artisan $(filter-out $@,$(MAKECMDGOALS))
key:
	docker-compose exec app php artisan key:generate
composer:
	docker-compose exec app composer install
docker-dev:
	docker-compose down & docker-compose build --ne-cache & docker-compose up -d