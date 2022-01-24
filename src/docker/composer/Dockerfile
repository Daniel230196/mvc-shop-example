FROM composer

COPY ./composer.json /app

WORKDIR /app
COPY entrypoint.sh /app
RUN chmod +x /app/entrypoint.sh

ENTRYPOINT ["bash", "/app/entrypoint.sh"]