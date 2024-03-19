FROM webdevops/php-apache:8.2

RUN apt-get update && apt-get install -y git
