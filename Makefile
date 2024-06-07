DOCKER_COMPOSE_FLAGS=-f docker-compose.yml

up:
	docker-compose ${DOCKER_COMPOSE_FLAGS} up -d --build

down:
	docker-compose ${DOCKER_COMPOSE_FLAGS} down

cli:
	docker-compose ${DOCKER_COMPOSE_FLAGS} exec --user=web php bash || true

test:
	docker-compose ${DOCKER_COMPOSE_FLAGS} exec --user=web php php ./src/vendor/bin/phpunit -c ./src/phpunit.xml