ARG PHP_VERSION=8.4
ARG PHP_EXTENSIONS="pdo_mysql"
ARG DOCKER_UID=1000
ARG DOCKER_GID=1000

FROM php:${PHP_VERSION}-fpm-bookworm

ARG PHP_EXTENSIONS
ARG DOCKER_UID
ARG DOCKER_GID

RUN <<EOT
set -xe
apt-get update
apt-get install -y --no-install-recommends \
    supervisor=4.2.5-1
rm -rf /var/lib/apt/lists/*
usermod -u ${DOCKER_UID} www-data
groupmod -g ${DOCKER_GID} www-data
mv "${PHP_INI_DIR}/php.ini-production" "${PHP_INI_DIR}/php.ini"
cat <<EOF > "${PHP_INI_DIR}/conf.d/10-session.ini"
session.cookie_httponly=1
session.cookie_secure=1
session.cookie_samesite=Strict
EOF
docker-php-ext-install ${PHP_EXTENSIONS}
EOT

COPY supervisor.conf /etc/supervisor/conf.d/supervisor.conf
WORKDIR /app
ENTRYPOINT [ "supervisord", "-c", "/etc/supervisor/supervisord.conf" ]
