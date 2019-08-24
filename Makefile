install:
	docker-compose build --no-cache
	docker-compose up -d
	docker-compose exec php composer install
	docker-compose exec php cp .env.example .env
	docker-compose exec php php artisan key:generate
	make db
	open http://localhost:8000
	
up:
	docker-compose up -d
	open http://localhost:8000

down:
	docker-compose down

db:
	docker-compose exec php php artisan migrate:fresh --seed

sh:
	docker-compose exec php bash

dbg:
	open http://localhost:8000/telescope
