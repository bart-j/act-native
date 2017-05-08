FROM ubuntu:16.04

MAINTAINER Bart Jeukendrup <bart@infty.io>

RUN apt-get update && apt-get install -y \
    apache2 \
    libapache2-mod-php \
    default-jre \
    composer \
    unzip \
&& rm -rf /var/lib/apt/lists/*

RUN mkdir /app
ADD . /app

RUN cd /app && \
    composer install --no-interaction

RUN cp /app/docker/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

RUN cp /app/docker/run.sh /run.sh

EXPOSE 80

ENTRYPOINT ["/run.sh"]