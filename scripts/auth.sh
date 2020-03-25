#! /usr/bin/env bash

SCRIPT_NAME="$(realpath $(dirname "$0"))"

PASSWD_FILE="$(php -r "require '${SCRIPT_NAME}/../config.php'; echo \$config['auth']['file'];")"

HTTP_USER="$(head -n1 < $1 | cut -d@ -f1)"
HTTP_PASSWD="$(tail -n1 < $1)"
HTTP_REALM="$(php -r "require '${SCRIPT_NAME}/../config.php'; echo \$config['auth']['realm'];")"

HASH="$(echo -n "${HTTP_USER}:${HTTP_REALM}:${HTTP_PASSWD}" | md5sum | cut -b -32)"

if grep -Eq "^${HTTP_USER}:${HTTP_REALM}:${HASH}$" "$PASSWD_FILE"; then
  exit 0
fi

exit 1
