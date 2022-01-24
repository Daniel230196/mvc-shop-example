#!/usr/bin/env bash

SCRIPT_DIR=$( dirname ${BASH_SOURCE[0]})
FRAMEWORK_COMPOSE_DIR="${SCRIPT_DIR}/../../docker/composer"


cd "${FRAMEWORK_COMPOSE_DIR}"
cat "../../../composer.json" > "composer.json"
cd "../"
docker-compose run composer composer install