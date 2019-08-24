install:
	docker-compose build --no-cache
	docker-compose up -d
	make db
	open http://localhost:8000

db:
	docker-compose exec php php artisan migrate:fresh --seed
	
up:
	docker-compose up -d
	open http://localhost:8000
