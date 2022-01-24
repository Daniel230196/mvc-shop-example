#!/usr/bin/env bash

SCRIPT_DIR=$( dirname ${BASH_SOURCE[0]})
FRAMEWORK_COMPOSE_DIR="${SCRIPT_DIR}/../../docker"


while getopts p: flag
do
  case ${flag} in
    c) command=${OPTARG};;
  esac
done

cd "${FRAMEWORK_COMPOSE_DIR}"

docker-compose run composer "composer" "install"
