#!/usr/bin/env bash

command=(
  ./ci/local-builder.sh
  ./ci/deploy.sh
  -i "$CI_IMAGE_NAME"
  -I "$CI_IMAGE_NAME_ALTERNATIVE"
  -t "$CIRCLE_TAG"
  -b "$CIRCLE_BRANCH"
  -e "$CI_EVENT_TYPE"
  -B "circleci-$CIRCLE_BUILD_NUM"
)

if [[ "${CI_DEBUG+x}" == "x" ]] && [[ "$CI_DEBUG" != "" ]]; then
  command+=(-d)
fi

"${command[@]}"