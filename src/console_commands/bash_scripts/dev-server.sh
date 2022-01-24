#!/usr/bin/env bash

SCRIPT_DIR=$( dirname ${BASH_SOURCE[0]})
FRAMEWORK_COMPOSE_FILE="${SCRIPT_DIR}/../../docker/docker-compose.yml"

bash "${SCRIPT_DIR}/env.sh"

YELLOW='\033[1;33m'
NO_COLOR='\033[0m'
while getopts p:d: flag
do
  case ${flag} in
    p) port=${OPTARG};;
    d) directory=${OPTARG};;
  esac
done



if [ -z "$directory" ]; then
  directory="/home/framework/src";
fi

if [ -z "$port" ]; then
  port=8080;
fi

printf "directory $directory"

printf "${YELLOW}*"
echo '*******************************'
echo '*******************************'
echo '*******************************'
echo '*******************************'
echo '*******************************'
echo 'initializing development server'
echo '*******************************'
echo '*******************************'
echo '*******************************'
echo '*******************************'
echo '*******************************'
printf "*******************************${NO_COLOR}"

docker-compose -p framework -f ${FRAMEWORK_COMPOSE_FILE} up -d --build --remove-orphans
docker config framework
docker ps

printf "${YELLOW}*"
echo '       ______                  _     _______    ___ ______
       / _____) _              | |   (_______)  / __(____  \
      ( (____ _| |_ _____  ____| |  _ _     _ _| |__ ____)  ) ___  ____  _____  ___
       \____ (_   _(____ |/ ___| |_/ | |   | (_   __|  __  ( / _ \|  _ \| ___ |/___)
       _____) )| |_/ ___ ( (___|  _ (| |___| | | |  | |__)  | |_| | | | | ____|___ |
      (______/  \__\_____|\____|_| \_)\_____/  |_|  |______/ \___/|_| |_|_____(___/
'
printf "${NO_COLOR}"

docker exec -i -t framework_php8.1_1 bash -c "php /home/framework/src/console_commands/run_dev_server.php '$port' '$directory'"
