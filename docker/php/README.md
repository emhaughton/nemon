# PHP Container

This container provides the runtime environment for the Laravel backend.

Unlike the official PHP image, this container is customized to include the extensions and tools required by the project.

---

# Responsibilities

The PHP container is responsible for:

- Executing Laravel
- Running Artisan commands
- Installing Composer dependencies
- Executing queues
- Running tests
- Running code quality tools

---

# Base Image

The container is built from the official PHP FPM image.

```
php:8.5-fpm
```

The PHP version is configured through:

```
.env.docker
```

```env
PHP_VERSION=8.5-fpm
```

This makes future upgrades simple.

---

# Installed Extensions

The image contains the extensions required by Laravel.

Examples:

- PDO MySQL
- Redis
- OPcache
- BCMath
- Intl
- Zip
- GD (future)

Additional extensions can be installed by modifying the Dockerfile.

---

# Composer

Composer is installed inside the image.

The host machine does not require a local Composer installation.

All Composer commands should be executed through the Makefile.

Example:

```bash
make composer-install
```

---

# User Permissions

The container runs using a non-root user.

The UID and GID are inherited from the host machine through:

```env
UID=1000
GID=1000
```

This avoids permission problems when creating or modifying project files.

---

# Working Directory

The Laravel application is mounted at:

```
/backend
```

This mirrors the directory structure of the host machine.

```
Host                Container

backend/   <---->   /backend
```

Using identical names simplifies maintenance and debugging.

---

# Configuration Files

The main configuration files are:

```
Dockerfile
php.ini
```

Future configuration files can be added here if required.

---

# Common Commands

Most daily operations are exposed through the Makefile.

Examples:

```bash
make shell
make migrate
make test
make pint
make phpstan
```

Avoid executing commands directly inside the container whenever possible.

---

# Design Decisions

The container intentionally follows these principles:

- Single responsibility
- No development tools installed on the host
- Non-root execution
- Explicit version management
- Reproducible builds

---

# Future Improvements

Possible future additions include:

- Xdebug
- Blackfire
- Swoole
- RoadRunner
- FrankenPHP

These tools are intentionally excluded until needed.

---

# References

https://www.php.net/

https://hub.docker.com/_/php

https://laravel.com/docs