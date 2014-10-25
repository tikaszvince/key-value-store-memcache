# Key Value Memcache Store

[![Author](http://img.shields.io/badge/author-@adammbalogh-blue.svg?style=flat)](https://twitter.com/adammbalogh)
[![Build Status](https://img.shields.io/travis/adammbalogh/key-value-store-memcache/master.svg?style=flat)](https://travis-ci.org/adammbalogh/key-value-store-memcache)
[![Coverage Status](https://img.shields.io/coveralls/adammbalogh/key-value-store-memcache.svg?style=flat)](https://coveralls.io/r/adammbalogh/key-value-store-memcache)
[![Quality Score](https://img.shields.io/scrutinizer/g/adammbalogh/key-value-store-memcache.svg?style=flat)](https://scrutinizer-ci.com/g/adammbalogh/key-value-store-memcache)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/adammbalogh/key-value-store-memcache.svg?style=flat)](https://packagist.org/packages/adammbalogh/key-value-store-memcache)
[![Total Downloads](https://img.shields.io/packagist/dt/adammbalogh/key-value-store-memcache.svg?style=flat)](https://packagist.org/packages/adammbalogh/key-value-store-memcache)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8c151f77-b059-400b-bead-b47bd8cc69cc/small.png)](https://insight.sensiolabs.com/projects/8c151f77-b059-400b-bead-b47bd8cc69cc)

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

**tip:** you should browse the [`adammbalogh/key-value-store-memcache`](https://packagist.org/packages/adammbalogh/key-value-store-memcache)
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

# Support

[![Support with Gittip](http://img.shields.io/gittip/adammbalogh.svg?style=flat)](https://www.gittip.com/adammbalogh/)
