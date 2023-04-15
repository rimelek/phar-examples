FROM cimg/python:3.7 as base

ARG WORKDIR=/app
COPY --chown=circleci:circleci . "$WORKDIR"
WORKDIR "$WORKDIR"