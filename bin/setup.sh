#!/bin/bash

set -e

echo "====================================="
echo " Laravel Vue Starter Setup"
echo "====================================="

if ! command -v docker >/dev/null 2>&1; then
    echo "❌ Docker no está instalado."
    exit 1
fi

UID_VALUE=$(id -u)
GID_VALUE=$(id -g)

cat > .env.local <<EOF
UID=$UID_VALUE
GID=$GID_VALUE
EOF

echo ""
echo "✅ Archivo .env.local generado"
echo ""
cat .env.local
echo ""
echo "Setup finalizado correctamente."