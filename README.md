# Nemon

Nemon is a web application for calculating indexed electricity prices from hourly energy consumption and market price data.

The application allows users to:

- Browse hourly electricity consumption records.
- Browse hourly electricity market prices.
- Calculate an indexed price for a selected date range using a custom formula.

The project has been designed following Clean Architecture principles, keeping the domain independent from Laravel and the infrastructure layer.

---

## Tech Stack

### Backend

- Laravel 13
- PHP 8.5
- MySQL 8.4
- Redis
- PHPUnit
- Laravel Pint

### Frontend

- Vue 3
- TypeScript
- Vue Router
- Pinia
- Axios
- Vite
- Vitest
- ESLint
- Prettier

### Infrastructure

- Docker
- Nginx
- Redis
- Mailpit
- phpMyAdmin

---

## Architecture

The backend follows a layered architecture inspired by Clean Architecture.

```text
Domain
    ↑
Application
    ↑
Infrastructure
    ↑
HTTP
```

The project is organised into the following layers:

- **Domain**: Business rules, entities, value objects and contracts.
- **Application**: Use cases and application DTOs.
- **Infrastructure**: Persistence, formula evaluation and framework integrations.
- **HTTP**: Controllers, requests and API responses.

The frontend is implemented as a standalone Vue Single Page Application that communicates with the backend exclusively through REST APIs.

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

## Features

- Hourly consumption listing
- Hourly price listing
- Pagination
- Indexed price calculation
- Formula validation
- API Key authentication
- Redis cache for paginated endpoints
- Automatic cache invalidation using Laravel Observers
- REST API
- Docker development environment

---

## Requirements

- Docker Desktop
- WSL2 (Windows)
- GNU Make
- Git

---

## Quick Start

Initialize the project

```bash
make init
```

---

## Services

| Service | URL |
|----------|--------------------------|
| Backend API | http://nemon.test |
| Frontend | http://nemon.test:5173 |
| phpMyAdmin | http://localhost:8081 |
| Mailpit | http://localhost:8025 |

---

## Documentation

Additional documentation can be found inside each component.

- backend/README.md
- frontend/README.md
- docs/

---

## License

This project was developed as a technical assessment and is intended for educational and demonstration purposes.