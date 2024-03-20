# Storie di bit

This repository contains the Kirby-based website for [Storie di bit](https://storiedibit.it).

## Development

Run once:

```bash
git config core.hooksPath .hooks
```

Then launch with Docker and run `npm run dev`.

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

- Run with Docker:

```bash
docker-compose up
```
