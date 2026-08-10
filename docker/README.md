# Docker Infrastructure

This directory contains the complete Docker infrastructure used by the project.

The goal is to provide a reproducible, isolated and production-like development environment.

---

# Philosophy

The infrastructure follows a few simple principles:

- One service per container.
- Services communicate through an internal Docker network.
- Development should be identical on every machine.
- No global PHP, Node.js or MySQL installation is required.
- Every service can be updated independently.

---

# Services

The project currently contains the following containers.

| Service | Purpose |
|----------|---------|
| PHP | Executes Laravel |
| Nginx | HTTP server |
| Node | Vue development server and frontend tooling |
| MySQL | Main relational database |
| Redis | Cache, queues and locks |
| Mailpit | SMTP server for local development |
| phpMyAdmin | Database administration |

---

# Directory Structure

```text
docker/

├── nginx/
├── php/
└── node/
```

Each service contains its own configuration and documentation.

---

# Networking

All services communicate through the internal Docker network called:

```text
starter
```

No container communicates directly with the host unless a port is explicitly exposed.

---

# Persistent Data

Persistent services use Docker volumes.

Examples:

- MySQL data
- Redis data (optional)

This allows containers to be recreated without losing application data.

---

# Development Workflow

The recommended workflow is:

1. Build images.
2. Start containers.
3. Install dependencies.
4. Develop.
5. Stop containers.

All commands should be executed from the project root using the Makefile.

---

# Why Docker?

Docker guarantees that every developer works with exactly the same environment.

This eliminates the classic "it works on my machine" problem and simplifies onboarding, upgrades and deployments.

---

# Future Improvements

The infrastructure has been designed to grow.

Possible future additions include:

- Traefik
- MinIO
- Meilisearch
- Selenium
- OpenTelemetry
- Grafana
- Prometheus

---

# References

- https://docs.docker.com/
- https://docs.docker.com/compose/