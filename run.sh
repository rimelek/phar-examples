#!/usr/bin/env bash

set -eu -o pipefail

dir="$(cd "$(dirname "$0")" && pwd)"

cd "$dir"

port="${1:-}"

if [[ -n "$port" ]]; then
  export PORT="$port"
elif [[ -f ".env" ]]; then
  # Only for showing the URL. Compose would load the file without it.
  source .env
fi

docker compose up -d --build

echo "URL: http://localhost:$PORT"
