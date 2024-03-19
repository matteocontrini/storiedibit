FROM webdevops/php-apache:8.2

RUN apt-get update && apt-get install -y git

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - &&\
    apt-get install -y nodejs

RUN npm install -g mjml && mjml -V && which mjml
