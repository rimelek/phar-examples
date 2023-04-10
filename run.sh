#!/usr/bin/env bash

set -eu -o pipefail

dir="$(cd "$(dirname "$0")" && pwd)"

cd "$dir"

if [[ -f ".env" ]]; then
  source .env
fi

docker compose up -d --build

echo "URL: http://localhost:$PORT"
