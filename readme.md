# Key Value Memcache Store

[![Author](http://img.shields.io/badge/author-@tikaszvince-blue.svg?style=flat)](https://twitter.com/tikaszvince)

# Description

This library provides a layer to a key value memcache store.

It uses the [memcache](http://docs.php.net/manual/en/book.memcache.php) extension.

Check out the [abstract library](https://github.com/adammbalogh/key-value-store) to see the other adapters and the Api.

# Installation

Install it through composer.

```json
{
    "require": {
        "tikaszvince/key-value-store-memcache": "@stable"
    }
}
```

**tip:** you should browse the [`tikaszvince/key-value-store-memcache`](https://packagist.org/packages/tikaszvince/key-value-store-memcache)
page to choose a stable version to use, avoid the `@stable` meta constraint.

# Usage

```php
<?php
use AdammBalogh\KeyValueStore\KeyValueStore;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter as Adapter;

$memcacheClient = new Memcache();
$memcacheClient->addServer('localhost', 11211);

$adapter = new Adapter($memcacheClient);

$kvs = new KeyValueStore($adapter);

$kvs->set('sample_key', 'Sample value');
$kvs->get('sample_key');
$kvs->delete('sample_key');
```

# API

**Please visit the [API](https://github.com/adammbalogh/key-value-store#api) link in the abstract library.**

# Toolset

| Key                 | Value               | Server           |
|------------------   |---------------------|------------------|
| ✔ delete            | ✔ get               | ✔ flush          |
| ✔ expire            | ✔ set               |                  |
| ✔ getTtl            |                     |                  |
| ✔ has               |                     |                  |
| ✔ persist           |                     |                  |
