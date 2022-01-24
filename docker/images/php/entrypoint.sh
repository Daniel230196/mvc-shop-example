#!/bin/bash
printf "\n" >> /etc/php/8.1/fpm/php.ini
printf "[xdebug]\n" >> /etc/php/8.1/fpm/php.ini
printf "xdebug.mode=develop,debug\n" >> /etc/php/8.1/fpm/php.ini
printf "xdebug.client_host=0.0.0.0\n" >> /etc/php/8.1/fpm/php.ini
printf "xdebug.start_with_request=yes\n" >> /etc/php/8.1/fpm/php.ini
printf "xdebug.idekey=framework\n" >> /etc/php/8.1/fpm/php.ini
printf "xdebug.discover_client_host=1\n" >> /etc/php/8.1/fpm/php.ini

#TODO: Move log path in .env variable
printf "xdebug.log=/home/shop/src/logs/xdebug.log" >> /etc/php/8.1/fpm/php.ini

php --version