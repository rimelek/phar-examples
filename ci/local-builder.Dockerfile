FROM cimg/base:2026.09 as base

ARG WORKDIR=/app
COPY --chown=circleci:circleci . "$WORKDIR"
WORKDIR "$WORKDIR"