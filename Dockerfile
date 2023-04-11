# syntax=docker/dockerfile:1.5.2
FROM php:8.2-apache

LABEL maintainer="Takács Ákos <rimelek@it-sziget.hu>"

COPY collect-cssjs.sh /

ENV STATIC_BOOTSTRAP_CSS_VERSION=5.2.3
ENV STATIC_BOOTSTRAP_CSS_URL="https://cdn.jsdelivr.net/npm/bootstrap@${STATIC_BOOTSTRAP_CSS_VERSION}/dist/css/bootstrap.min.css"
ENV STATIC_BOOTSTRAP_CSS_INTEGRITY="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"

ENV STATIC_HIGHLIGHT_CSS_VERSION=11.7.0
ENV STATIC_HIGHLIGHT_CSS_URL="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@${STATIC_HIGHLIGHT_CSS_VERSION}/build/styles/default.min.css"
ENV STATIC_HIGHLIGHT_CSS_INTEGRITY="sha384-4Y0nObtF3CbKnh+lpzmAVdAMtQXl+ganWiiv73RcGVdRdfVIya8Cao1C8ZsVRRDz"

ENV STATIC_HIGHLIGHT_JS_VERSION=11.7.0
ENV STATIC_HIGHLIGHT_JS_URL="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/highlight.min.js"
ENV STATIC_HIGHLIGHT_JS_INTEGRITY="sha384-4l+9bhb7rakZ18megzl0/DWczL8ojbDl1jIEzBVffeMho9A6xB/lkqt1K0PC8Jin"

ENV STATIC_JQUERY_JS_VERSION=3.6.4
ENV STATIC_JQUERY_JS_URL="https://code.jquery.com/jquery-${STATIC_JQUERY_JS_VERSION}.min.js"
ENV STATIC_JQUERY_JS_INTEGRITY="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="

ENV STATIC_SHOWDOWN_JS_VERSION=2.1.0
ENV STATIC_SHOWDOWN_JS_URL="https://cdn.rawgit.com/showdownjs/showdown/${STATIC_SHOWDOWN_JS_VERSION}/dist/showdown.min.js"
ENV STATIC_SHOWDOWN_JS_INTEGRITY="sha512-LhccdVNGe2QMEfI3x4DVV3ckMRe36TfydKss6mJpdHjNFiV07dFpS2xzeZedptKZrwxfICJpez09iNioiSZ3hA=="

RUN /collect-cssjs.sh

WORKDIR /var/www/html

COPY examples /var/www/html/examples/
COPY index.php LICENSE README.md /var/www/html/

RUN mkdir /var/www/html/output \
 && chown www-data:www-data /var/www/html/output \
 && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
 && echo "phar.readonly = Off" >> "$PHP_INI_DIR/php.ini"

EXPOSE 80