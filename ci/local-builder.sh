#!/usr/bin/env bash

set -eu -o pipefail

if [[ -z "${COPY_MODE+x}" ]]; then
  COPY_MODE=0
fi

compose=(docker-compose -f local-builder.yml)

(
  cd "$(dirname "$0")"

  workdir="$(cd .. && pwd)"

  echo "Workdir: $workdir"

  "${compose[@]}" build --progress plain --build-arg "WORKDIR=$workdir"

  echo "COPY_MODE: $COPY_MODE"

  if [[ "$COPY_MODE" != "1" ]]; then
    export WORKDIR="$workdir"
    compose+=(-f local-builder.volumes.yml)
  fi

  "${compose[@]}" up -d
  set +e
  "${compose[@]}" exec --user 0 ci bash -c "mkdir -p $workdir/var && chown -R circleci:circleci $workdir/var"
  "${compose[@]}" exec ci "$@"
  err=$?
  set -e
  "${compose[@]}" down
  if [[ "$err" != "0" ]]; then
    >&2 echo "Build failed"
    exit 1
  fi
)