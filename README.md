arnaud.tierant.me
==================

> *Copyright 2019 [Arnaud Tiérant](https://arnaud.tiérant.me). Licensed under the MIT license.*

# Stenope Skeleton

This is my static website build with  [Stenope](https://stenopephp.github.io/Stenope/).

It contains a few features with the following stack:

- Symfony 6.2
- Bootstrap 5.3
- Webpack Encore
- Sass
- Lint / CS (php-cs-fixer, phpstan, eslint, …)
- Glide integration for images resizing
- and more…

## Prerequisites

Either:

- PHP 8.1+
- [Symfony CLI](https://symfony.com/download)
- Composer
- Make

## Setup

Install the dependencies using

```shell
make install
```

## Dev

Start a server using

```shell
make serve
```

The Symfony CLI exposes the URL at which the site is available.

> **Note**
> `make serve` is enough to serve both PHP app and assets.  
> You're ready to dev!

## Build

### Assets

```shell
make build.assets
```

### Content

```shell
make build.content
````

### Assets+Content

Build the whole static site from source, with assets:

```shell
make build.static
```

Serve the static version using:

```shell
make serve.static
```

## Going further

Learn more by browsing its content.
