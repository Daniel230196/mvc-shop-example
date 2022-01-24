#!/usr/bin/env bash

ENV_PATH="../../"

if [ ! -f .env ]
  then export $(cat "${ENV_PATH}.env" | sed 's/#.*//g' |  xargs)
fi
