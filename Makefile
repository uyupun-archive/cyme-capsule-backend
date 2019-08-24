install:
	docker-compose build --no-cache
	docker-compose exec php bash compser install
	docker-compose exec php bash cp .env.example .env
	docker-compose exec php bash php artisan key:generate
	make db
	make up

db:
	docker-compose exec php bash php artisan migrate:fresh --seed
	
up:
	docker-compose up -d
	open http://localhost:8000
