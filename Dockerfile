FROM webdevops/php-apache:8.2-alpine

RUN apk update && apk add git nodejs npm

RUN npm install -g mjml && mjml -V && which mjml
