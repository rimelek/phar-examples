#!/usr/bin/env bash

set -eu -o pipefail

PROJECT_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$PROJECT_ROOT"
source "$PROJECT_ROOT/ci/resources.sh"

export CI_BRANCH=""
export CI_TAG=""
export CI_IMAGE_NAME=""
export CI_IMAGE_NAME_ALTERNATIVE=""
export CI_EVENT_TYPE=""
export CI_BUILD_NUMBER="${GIT_HASH}"
export CI_DEBUG=""

while getopts ":t:b:i:I:e:B:dh" opt; do
  case $opt in
  t) CI_TAG="$OPTARG" ;;
  b) CI_BRANCH="$OPTARG" ;;
  i) CI_IMAGE_NAME="$OPTARG" ;;
  I) CI_IMAGE_NAME_ALTERNATIVE="$OPTARG" ;;
  B) CI_BUILD_NUMBER="$OPTARG" ;;
  d) CI_DEBUG="true" ;;
  e)
    case "$OPTARG" in
    push | cron) CI_EVENT_TYPE="$OPTARG" ;;
    *)
      echo >&2 "Invalid event type: $OPTARG"
      exit 1
      ;;
    esac
    ;;
  h)
    echo "Usage: $0 [options]"
    echo "Options:"
    echo -e "\t-t <string>\tGit commit tag if the build was triggered by tag. Do not use it anyway!"
    echo -e "\t-b <string>\tGit branch if the build was triggered by branch. If \"-t\" was given too, \"-b\" will always be ignored!"
    echo -e "\t-i <string>\tDocker image name without version tag."
    echo -e "\t-I <string>\tAlternative Docker image name without version tag. Can be used to push to a second repository."
    echo -e "\t-e <string>\tEvent type. Valid types: api, cron"
    echo -e "\t-B <string>\tBuild number. git commit hash by default"
    echo -e "\t-d         \tTurn on debug outputs"
    echo -e "\t-h         \tShows this help message"
    exit 0
    ;;
  *)
    echo >&2 "Invalid option: -$OPTARG. Use \"-h\" to get help."
    exit 1
    ;;
  esac
done
shift $((OPTIND - 1))

if [[ -n "$CI_TAG" ]]; then
  write_info "CI_TAG is set. Set CI_BRANCH to the value of CI_TAG"
  CI_BRANCH="$CI_TAG" # for easier local test
fi

write_info "CI_BRANCH=$CI_BRANCH"
write_info "CI_TAG=$CI_TAG"

reqVarNonEmpty CI_IMAGE_NAME
reqVarNonEmpty CI_BRANCH
reqVarNonEmpty CI_EVENT_TYPE

if [[ "$CI_EVENT_TYPE" == "cron" ]]; then
  BUILD_DIR="$PROJECT_ROOT/var/.build"
  write_info "Change directory to $BUILD_DIR"
  cd "$BUILD_DIR"
  GIT_HASH="$(git rev-list -n 1 HEAD)"
fi

write_info "Remove leading version flag (v) from $CI_BRANCH"
# remove first character if that is "v"
# remember CI_BRANCH is CI_TAG if tag was set
VERSION=$(echo "$CI_BRANCH" | trimVersionFlag)

write_info "VERSION=$VERSION"

write_info "Download python requirements: "
pip_install_ci_requirements

dcdCommandGen

# debugging missing tags
write_info "Images:"
write_info "$(docker image ls)"
