#!/usr/bin/env bash

set -e
SCRIPT_DIR=`dirname $0`
COMPOSE_FILE="${SCRIPT_DIR}/../docker-compose.yml"

echo
echo "Initializing"
echo

export $(cat ${SCRIPT_DIR}/../.env | xargs)

docker-compose -p shop -f ${COMPOSE_FILE} config
docker-compose -p shop -f ${COMPOSE_FILE} up -d --build --remove-orphans
docker-compose -p shop -f ${COMPOSE_FILE} ps
