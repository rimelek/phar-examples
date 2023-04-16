FROM cimg/base:2023.04 as base

ARG WORKDIR=/app
COPY --chown=circleci:circleci . "$WORKDIR"
WORKDIR "$WORKDIR"