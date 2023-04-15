write_info "Set cache image tag"

VERSION_CACHE="$GIT_HASH"
if [ "$(isBranch)" == "true" ]; then
  VERSION_CACHE="$CI_BRANCH"
  if [ "${VERSION_CACHE:${#VERSION_CACHE}-4}" != "-dev" ]; then
    VERSION_CACHE="${VERSION_CACHE}-dev"
  fi
fi

write_info "Check if the build was triggered by pushing to a branch"
if [ "$(isBranch)" == "true" ]; then
  image="$CI_IMAGE_NAME:$GIT_HASH"

  write_info "Build the new docker image using $CI_PARENT_IMAGE and $CI_IMAGE_NAME:$VERSION_CACHE as cache".
  write_info "Add the following tags to the image: "
  write_info "- $image"
  write_info "- $CI_IMAGE_NAME:build-$CI_BUILD_NUMBER"

  docker_build \
    --cache-from "$CI_PARENT_IMAGE" \
    --cache-from "$CI_IMAGE_NAME:$VERSION_CACHE" \
    --tag "$image" \
    --tag "$CI_IMAGE_NAME:build-$CI_BUILD_NUMBER"
else
  write_info "The build was not triggered by pushing to a branch. Skipping build."
fi
