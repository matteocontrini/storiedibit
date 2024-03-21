# Storie di bit

This repository contains the Kirby-based website for [Storie di bit](https://storiedibit.it).

## Development

Configure git hooks (do it once):

```bash
git config core.hooksPath .hooks
```

To launch, run:

```
docker compose -f docker-compose.dev.yml up
npm run dev
```

## Deployment

Initial setup:

- Create a folder for the project
- Clone the repository in `app`
- Put SSH keys in `ssh`

To clone:

```bash
git clone --recursive git@github.com:matteocontrini/storiedibit.git app
```

Put the following in `ssh/config`:

```
IdentityFile ~/.ssh/storiedibit
```

Generate SSH keys for GitHub and add them as deploy keys to the repository.

Start the thing:

```bash
cd app
docker-compose -f docker-compose.prod.yml up -d
```

Enter the container and setup git:

```bash
sudo docker-compose -f ../deploy/storiedibit/app/docker-compose.prod.yml exec --user application kirby /bin/bash
git config user.name "Matteo Contrini"
git config user.email "matteo@contrini.it"
```

Create the `site/config/secrets.php` config file with:

```php
<?php

return [
    'thathoff.git-content.commit' => false,
    'emailoctopus.api_key' => '',
    'emailoctopus.list_id' => '',
];
```  

### Common commands

To redeploy:

```bash
docker compose -f docker-compose.prod.yml up -d
```

Add `--build` to rebuild the image.

To enter the container:

```bash
sudo docker-compose -f ../deploy/storiedibit/app/docker-compose.prod.yml exec --user application kirby /bin/bash
```
