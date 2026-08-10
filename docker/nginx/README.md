# Nginx Container

This container acts as the public entry point of the application.

It receives all incoming HTTP requests and forwards PHP requests to the PHP-FPM container.

Nginx never executes PHP code itself.

---

# Responsibilities

The Nginx container is responsible for:

- Serving HTTP requests
- Serving static assets
- Forwarding PHP requests to PHP-FPM
- Returning HTTP responses to the client

Application logic is never executed inside this container.

---

# Why Nginx?

Nginx was chosen because it is:

- Lightweight
- Extremely fast
- Widely adopted
- Well documented
- Production ready

It is the most common web server used together with Laravel.

---

# Container Architecture

```text
Browser
    │
    ▼
Nginx
    │
    ▼
PHP-FPM
    │
    ▼
Laravel
```

Nginx only routes requests.

PHP executes the application.

---

# Document Root

The web root points to:

```text
/backend/public
```

Only the `public` directory is exposed.

All application files remain protected.

---

# Configuration

The main configuration file is:

```text
default.conf
```

Future virtual hosts should also be placed inside this directory.

---

# Local Domains

The project is intended to use local domains instead of localhost.

Example:

```text
starter.test
```

The domain must be registered in the operating system hosts file.

Windows:

```text
C:\Windows\System32\drivers\etc\hosts
```

Example:

```text
127.0.0.1 starter.test
```

---

# HTTPS

HTTPS is intentionally not enabled in the starter.

For local development, HTTP keeps the infrastructure simple.

Future versions may introduce:

- Traefik
- mkcert
- Automatic TLS certificates

without changing the project architecture.

---

# Reverse Proxy

Currently Nginx only proxies requests to Laravel.

Future versions may also proxy:

- Vue production assets
- API Gateway
- WebSockets
- SSE
- gRPC services

---

# Design Decisions

This container follows these principles:

- Single responsibility
- Static file serving
- PHP-FPM separation
- Explicit configuration
- Minimal setup

---

# Future Improvements

Possible future additions include:

- HTTP/2
- HTTP/3
- Brotli compression
- Gzip optimization
- Security headers
- Rate limiting

These features will be introduced only when required.

---

# References

https://nginx.org/

https://laravel.com/docs

https://docs.nginx.com/