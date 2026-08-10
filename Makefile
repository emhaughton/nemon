###############################################################################
# Configuration
###############################################################################

.DEFAULT_GOAL := help

ENV_FILES := --env-file .env.docker --env-file .env.local

DOCKER := docker compose $(ENV_FILES)

PHP := $(DOCKER) exec php sh -c
NODE := $(DOCKER) exec node sh -c

BACKEND_DIR := /backend
FRONTEND_DIR := /frontend

###############################################################################
# Phony Targets
###############################################################################

.PHONY: \
	help \
	build rebuild rebuild-node up down restart logs ps \
	shell shell-node \
	composer-install composer-update composer-dump \
	artisan key migrate rollback fresh seed optimize cache-clear test pint \
	setup

###############################################################################
# Help
###############################################################################

help:
	@echo ""
	@echo "Laravel Vue Starter"
	@echo ""
	@echo "Docker"
	@echo "  build              Build Docker images"
	@echo "  rebuild            Rebuild all images"
	@echo "  rebuild-node       Rebuild Node image"
	@echo "  up                 Start containers"
	@echo "  down               Stop containers"
	@echo "  restart            Restart containers"
	@echo "  logs               Show container logs"
	@echo "  ps                 List running containers"
	@echo ""
	@echo "Laravel"
	@echo "  shell              Open PHP shell"
	@echo "  composer-install   Install Composer dependencies"
	@echo "  composer-update    Update Composer dependencies"
	@echo "  composer-dump      Dump Composer autoload"
	@echo "  key                Generate APP_KEY"
	@echo "  migrate            Run migrations"
	@echo "  rollback           Rollback last migration"
	@echo "  fresh              Fresh database"
	@echo "  seed               Seed database"
	@echo "  optimize           Optimize Laravel"
	@echo "  cache-clear        Clear Laravel cache"
	@echo "  test               Run PHPUnit"
	@echo "  pint               Run Laravel Pint"
	@echo ""
	@echo "Frontend"
	@echo "  shell-node         Open Node shell"
	@echo "  vue-create         Create Vue project"
	@echo "  npm-install        Install npm dependencies"
	@echo "  npm-dev            Start Vite development server"
	@echo "  npm-build          Build frontend"
	@echo "  npm-test           Run frontend tests"
	@echo "  npm-lint           Run ESLint"
	@echo "  npm-format         Run Prettier"
	@echo ""
	@echo "Utilities"
	@echo "  setup             Initialize the project"
	@echo ""

###############################################################################
# Docker
###############################################################################

build:
	$(DOCKER) build

rebuild:
	$(DOCKER) down
	$(DOCKER) build --no-cache
	$(DOCKER) up -d

rebuild-node:
	$(DOCKER) build node
	$(DOCKER) up -d --force-recreate node

up:
	$(DOCKER) up -d

down:
	$(DOCKER) down

restart:
	$(DOCKER) restart

logs:
	$(DOCKER) logs -f

ps:
	$(DOCKER) ps

###############################################################################
# Laravel
###############################################################################

shell:
	$(DOCKER) exec php bash

composer-install:
	$(PHP) "cd $(BACKEND_DIR) && composer install"

composer-update:
	$(PHP) "cd $(BACKEND_DIR) && composer update"

composer-dump:
	$(PHP) "cd $(BACKEND_DIR) && composer dump-autoload"

key:
	$(PHP) "cd $(BACKEND_DIR) && php artisan key:generate"

migrate:
	$(PHP) "cd $(BACKEND_DIR) && php artisan migrate"

rollback:
	$(PHP) "cd $(BACKEND_DIR) && php artisan migrate:rollback"

fresh:
	$(PHP) "cd $(BACKEND_DIR) && php artisan migrate:fresh"

seed:
	$(PHP) "cd $(BACKEND_DIR) && php artisan db:seed"

optimize:
	$(PHP) "cd $(BACKEND_DIR) && php artisan optimize"

cache-clear:
	$(PHP) "cd $(BACKEND_DIR) && php artisan optimize:clear"

test:
	$(PHP) "cd $(BACKEND_DIR) && php artisan test"

pint:
	$(PHP) "cd $(BACKEND_DIR) && ./vendor/bin/pint"

###############################################################################
# Frontend
###############################################################################

shell-node:
	$(DOCKER) exec node sh

vue-create:
	$(NODE) "cd $(FRONTEND_DIR) && npm create vue@latest ."

npm-install:
	$(NODE) "cd $(FRONTEND_DIR) && npm install"

npm-dev:
	$(NODE) "cd $(FRONTEND_DIR) && npm run dev -- --host 0.0.0.0"

npm-build:
	$(NODE) "cd $(FRONTEND_DIR) && npm run build"

npm-test:
	$(NODE) "cd $(FRONTEND_DIR) && npm run test"

npm-lint:
	$(NODE) "cd $(FRONTEND_DIR) && npm run lint"

npm-format:
	$(NODE) "cd $(FRONTEND_DIR) && npm run format"

###############################################################################
# Utilities
###############################################################################

setup:
	chmod +x ./bin/setup.sh
	./bin/setup.sh