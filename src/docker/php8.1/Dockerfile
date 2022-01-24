FROM debian:11

RUN cat /etc/os-release
RUN apt update && apt -y upgrade
RUN apt install -y lsb-release ca-certificates apt-transport-https software-properties-common gnupg2
RUN apt install wget
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'

RUN apt update && apt -y upgrade
RUN apt install php8.1-fpm php8.1-xdebug php8.1-pdo-mysql -y

RUN rm /etc/php/8.1/fpm/pool.d/www.conf && rm /etc/php/8.1/fpm/php-fpm.conf
ADD www.conf /etc/php/8.1/fpm/pool.d
ADD php-fpm.conf /etc/php/8.1/fpm/php-fpm.conf

COPY entrypoint.sh /
RUN sh entrypoint.sh

RUN service php8.1-fpm start

ENTRYPOINT ["/bin/bash"]