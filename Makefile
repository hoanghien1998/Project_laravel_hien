all: run

start: run

run:
	docker-compose -f docker-compose.yml -p hien up -d

stop:
	docker-compose -f docker-compose.yml -p hien kill

destroy:
	docker-compose -f docker-compose.yml -p hien down

logs:
	docker-compose -f docker-compose.yml -p hien logs -f app

shell:
	docker-compose -f docker-compose.yml -p hien exec --user www app bash

ip:
	docker inspect hien-web | grep \"IPAddress\"

ipdb:
	docker inspect hien-db | grep \"IPAddress\"
