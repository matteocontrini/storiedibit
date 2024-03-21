# Storie di bit

This repository contains the Kirby-based website for [Storie di bit](https://storiedibit.it).

## Development

Run once:

```bash
git config core.hooksPath .hooks
```

Then run:

```
docker compose -f docker-compose.dev.yml up
npm run dev
```

## Deployment

- Clone this repository:

```bash
git clone --recursive git@github.com:matteocontrini/storiedibit.git
```

- Set user config locally:

```bash
git config user.name "Matteo Contrini"
git config user.email "matteo@contrini.it"
```

- Create the `site/config/secrets.php` config file with:

```php
<?php

return [
    'thathoff.git-content.commit' => false,
    'emailoctopus.api_key' => '',
    'emailoctopus.list_id' => '',
];
```  

- Run with Docker:

```bash
docker compose -f docker-compose.prod.yml up -d
```
