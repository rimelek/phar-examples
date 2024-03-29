write_info "Get the latest version"

LATEST_VERSION="$(getLatestStableOrPreVersion "$CI_BRANCH")"
if [[ -z "$LATEST_VERSION" ]]; then
  write_info "There is no stable version nor pre-release $CI_BRANCH"
  exit 0
fi
write_info "LATEST_VERSION=$LATEST_VERSION"

write_info "Prepare build directory"
BUILD_DIR="$PROJECT_ROOT/var/.build"
if [[ -d "$BUILD_DIR" ]]; then
  execute_command rm -rf "$BUILD_DIR"
fi

write_info "Check if the the repository URL is not defined or empty"
if [[ "${CI_REPOSITORY_URL-x}" == "x" ]] || [[ -z "$CI_REPOSITORY_URL" ]]; then
  write_info "Repository URL is not defined."
  write_info "Get repository URL from the repository: $CI_REPOSITORY_ALIAS"
  CI_REPOSITORY_URL="$(execute_command git remote get-url "$CI_REPOSITORY_ALIAS")"
fi

write_info "Cloning from $CI_REPOSITORY_URL to $BUILD_DIR"
execute_command git clone --branch "v$LATEST_VERSION" "$CI_REPOSITORY_URL" "$BUILD_DIR"
cd "$BUILD_DIR"

write_info "Start building triggered by cronjob"

docker_build_cache
docker_build_push
