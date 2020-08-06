all: run

start: run

run:
	docker-compose -f docker-compose.yml -p project1 up -d

stop:
	docker-compose -f docker-compose.yml -p project1 kill

destroy:
	docker-compose -f docker-compose.yml -p project1 down

logs:
	docker-compose -f docker-compose.yml -p project1 logs -f app

shell:
	docker-compose -f docker-compose.yml -p project1 exec --user www app bash

ip:
	docker inspect webserver | grep \"IPAddress\"

ipdb:
	docker inspect db | grep \"IPAddress\"
