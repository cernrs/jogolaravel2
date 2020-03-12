# Makefile for Docker Nginx PHP Composer PostgreSql ExpressGateway

include .env

# POSTGRES
POSTGRES_DUMPS_DIR=data/db/dumps

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  apidoc              Generate documentation of API"
	@echo "  code-sniff          Check the API with PHP Code Sniffer (PSR2)"
	@echo "  clean               Clean directories for reset"
	@echo "  composer-up         Update PHP dependencies with composer"
	@echo "  docker-start        Create and start containers"
	@echo "  docker-stop         Stop and clear all services"
	@echo "  gen-certs           Generate SSL certificates"
	@echo "  logs                Follow log output"
	@echo "  postgres-dump       Create backup the database"
	@echo "  postgres-restore    Restore backup the database"
	@echo "  phpmd               Analyse the API with PHP Mess Detector"
	@echo "  test                Test application"

init:
	@$(shell cp -n $(shell pwd)/web/app/composer.json.dist $(shell pwd)/web/app/composer.json 2> /dev/null)

apidoc:
	@docker-compose exec -T php php -d memory_limit=256M -d xdebug.profiler_enable=0 ./app/vendor/bin/apigen generate app/src --destination app/doc
	@make resetOwner

clean:
	@rm -Rf data/db/postgres/*
	@rm -Rf $(POSTGRES_DUMPS_DIR)/*
	@rm -Rf web/vendor
	@rm -Rf web/composer.lock
	@rm -Rf web/storage/framework/cache/*
	@rm -Rf web/storage/framework/sessions/*
	@rm -Rf web/storage/framework/testing/*
	@rm -Rf web/storage/framework/views/*
	@rm -Rf web/storage/logs/*
	@rm -Rf etc/ssl/*

code-sniff:
	@echo "Checking the standard code..."
	@docker-compose exec -T php ./vendor/bin/phpcs -v --standard=PSR2 app/src

composer-up:
	@docker run --rm -v $(shell pwd)/web/app:/app composer update

docker-start: init
	docker-compose up -d

docker-stop:
	@docker-compose down -v
	@make clean

gen-certs:
	@docker run --rm -v $(shell pwd)/etc/ssl:/certificates -e "SERVER=$(NGINX_HOST)" jacoelho/generate-certificate

logs:
	@docker-compose logs -f

postgres-dump:
	@mkdir -p $(POSTGRES_DUMPS_DIR)
	@docker exec $(shell docker-compose ps -q postgresql) pg_dump -U "$POSTGRES_USER" -d "$POSTGRES_DATABASE" > $(POSTGRES_DUMPS_DIR)/db.pgbkp 2>/dev/null
	@make resetOwner

postgres-restore:
	@docker exec -i $(shell docker-compose ps -q mysqldb) psql -U "$POSTGRES_USER" -d "$POSTGRES_DATABASE" < $(POSTGRES_DUMPS_DIR)/db.pgbkp 2>/dev/null

phpmd:
	@docker-compose exec -T php \
	./vendor/bin/phpmd \
	./src \
	text cleancode,codesize,controversial,design,naming,unusedcode

test: code-sniff
	@docker-compose exec -T php ./vendor/bin/phpunit --colors=always --configuration ./app/
	@make resetOwner

resetOwner:
	@$(shell chown -Rf $(SUDO_USER):$(shell id -g -n $(SUDO_USER)) $(POSTGRES_DUMPS_DIR) "$(shell pwd)/etc/ssl" "$(shell pwd)/web/app" 2> /dev/null)

.PHONY: clean test code-sniff init