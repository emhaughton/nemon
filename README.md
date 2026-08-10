# Nemon

A production-ready starter template for building modern web applications using Laravel as the backend API and Vue.js as the frontend SPA.

The goal of this project is to provide a clean, maintainable and reusable architecture that can be used as the foundation for future projects.

---

## Tech Stack

### Backend

- Laravel 13
- PHP 8.5
- MySQL 8.4
- Redis
- PHPUnit
- PHPStan
- Laravel Pint

### Frontend

- Vue 3
- TypeScript
- Vue Router
- Pinia
- Vite
- Vitest
- ESLint
- Prettier

### Infrastructure

- Docker
- Nginx
- Mailpit
- phpMyAdmin

---

## Project Structure

```text
.
├── backend/
├── frontend/
├── docker/
├── docs/
├── bin/
├── docker-compose.yml
├── Makefile
├── .env.docker
└── .env.local
```

---

## Philosophy

This starter follows a few simple principles:

- Docker-first development
- Backend and frontend are independent applications
- Laravel exposes only APIs
- Vue is a standalone SPA
- One service per container
- Reusable infrastructure
- Clean architecture
- Easy to extend

---

## Requirements

- Docker Desktop
- WSL2
- GNU Make
- Git

---

## Quick Start

Build the project

```bash
make build
```

Start the containers

```bash
make up
```

Install Laravel dependencies

```bash
make composer-install
```

Install Vue dependencies

```bash
make npm-install
```

Run migrations

```bash
make migrate
```

Start Vite

```bash
make npm-dev
```

Get your user and group id

```bash
id -u

id -g
```

---

## Services

| Service | URL |
|----------|------------------------------|
| Laravel | http://nemon.test |
| Vue (Vite) | http://localhost:5173 |
| phpMyAdmin | http://localhost:8081 |
| Mailpit | http://localhost:8025 |

---

## Documentation

Additional documentation is available inside each component.

- backend/README.md
- frontend/README.md
- docker/README.md
- docs/

---

## License

This project is intended to be used as a reusable starter template.