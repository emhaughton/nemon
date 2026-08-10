# Node Container

This container provides the frontend development environment for the project.

Its primary responsibility is to execute the Vue application and all frontend tooling.

---

# Responsibilities

The Node container is responsible for:

- Installing npm dependencies
- Running the Vite development server
- Building production assets
- Running frontend tests
- Running ESLint
- Running Prettier

The container is **not** responsible for serving production traffic.

Production assets are generated during the build process.

---

# Base Image

The container is built from the official Node image.

```text
node:22-alpine
```

The Node version is configured through:

```env
NODE_VERSION=22-alpine
```

Using the official image simplifies maintenance and security updates.

---

# Why Alpine?

Alpine Linux provides:

- Small image size
- Faster downloads
- Faster builds
- Reduced attack surface

---

# User Permissions

Unlike the PHP container, the official Node image already provides a non-root user:

```text
node
```

The container runs using this user to avoid permission issues and improve security.

Running development tools as root is intentionally avoided.

---

# Working Directory

The frontend application is mounted at:

```text
/frontend
```

Host and container share the same directory structure.

```text
Host                    Container

frontend/      <---->   /frontend
```

Keeping identical paths makes debugging considerably easier.

---

# Package Manager

The project currently uses:

```text
npm
```

No global packages should be installed inside the container.

All project dependencies must be declared in:

```text
package.json
```

---

# Frontend Stack

Current technologies:

- Vue 3
- TypeScript
- Vite
- Vue Router
- Pinia
- Vitest
- ESLint
- Prettier

Additional tools should only be added when they provide clear value.

---

# Daily Commands

The recommended way to interact with the container is through the Makefile.

Examples:

```bash
make npm-install
make npm-dev
make npm-build
make npm-test
make shell-node
```

Avoid executing Docker commands directly unless debugging.

---

# Design Decisions

The Node container follows these principles:

- Official image
- Non-root execution
- Independent frontend
- Explicit version management
- Reproducible builds

The frontend is intentionally isolated from Laravel.

Communication between both applications happens exclusively through HTTP APIs.

---

# Future Improvements

Possible future additions include:

- Playwright
- Storybook
- Cypress
- Bundle Analyzer
- Lighthouse
- pnpm support

These tools will only be added when required.

---

# References

https://nodejs.org/

https://vite.dev/

https://vuejs.org/

https://www.typescriptlang.org/