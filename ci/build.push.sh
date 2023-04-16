
write_info "Check if the build was triggered by pushing to a branch"
if [ "$(isBranch)" == "true" ]; then
  write_info "The build was triggered by pushing to a branch. Let's start to build."
  docker_build_cache
  docker_build_push
else
  write_info "The build was not triggered by pushing to a branch. Skipping build."
fi
