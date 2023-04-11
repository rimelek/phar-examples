#!/usr/bin/env bash

set -eu -o pipefail

assets_dir="/var/www/html/static"
css_tmp_dir="$assets_dir/css"
js_tmp_dir="$assets_dir/js"

function download() {
  local url="$1"
  local integrity_expected="$2"
  local local_path="$3"
  
  local integrity_expected_hash
  local integrity_expected_algo
  
  local integrity_actual_hash
  
  integrity_expected_algo="$(echo "$integrity_expected" | cut -d "-" -f1)"
  integrity_expected_hash="$(echo "$integrity_expected" | cut -d "-" -f2)"
  
  mkdir -p "$(dirname "$local_path")"
  
  >&2 echo "Downloading $url"
  
  curl -s -L --output "$local_path" "$url"
  
  integrity_actual_hash="$(< "$local_path" openssl dgst "-$integrity_expected_algo" -binary | openssl base64 -A)"
  
  >&2 echo "Check integrity of $url"
  if [[ "$integrity_expected_hash" != "$integrity_actual_hash" ]]; then
    >&2 echo "Integrity check failed for $url"
    return 1
  fi
}

download "$STATIC_BOOTSTRAP_CSS_URL" "$STATIC_BOOTSTRAP_CSS_INTEGRITY" "$css_tmp_dir/bootstrap-$STATIC_BOOTSTRAP_CSS_VERSION.min.css"
download "$STATIC_JQUERY_JS_URL" "$STATIC_JQUERY_JS_INTEGRITY" "$js_tmp_dir/jquery-$STATIC_JQUERY_JS_VERSION.min.js" 

download "$STATIC_HIGHLIGHT_CSS_URL" "$STATIC_HIGHLIGHT_CSS_INTEGRITY" "$css_tmp_dir/highlight-$STATIC_HIGHLIGHT_CSS_VERSION.min.css"
download "$STATIC_HIGHLIGHT_JS_URL" "$STATIC_HIGHLIGHT_JS_INTEGRITY" "$js_tmp_dir/highlight-$STATIC_HIGHLIGHT_JS_VERSION.min.js"

download "$STATIC_SHOWDOWN_JS_URL" "$STATIC_SHOWDOWN_JS_INTEGRITY" "$js_tmp_dir/showdown-$STATIC_SHOWDOWN_JS_VERSION.min.js"

