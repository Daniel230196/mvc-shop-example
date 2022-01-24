FROM nginx

ARG host

COPY nginx.conf /etc/nginx
COPY shop /etc/nginx/shop

RUN rm /etc/nginx/conf.d/default.conf

RUN sed -i -e "s/{host}/${host}/g" /etc/nginx/shop/server.conf

RUN cat /etc/nginx/nginx.conf
RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

WORKDIR /etc/nginx
