<?php namespace AdammBalogh\KeyValueStore\Adapter;

use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter\ClientTrait;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter\KeyTrait;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter\ValueTrait;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter\ServerTrait;

class MemcacheAdapter extends AbstractAdapter
{
    use ClientTrait, KeyTrait, ValueTrait, ServerTrait {
        ClientTrait::getClient insteadof KeyTrait;
        ClientTrait::getClient insteadof ValueTrait;
        ClientTrait::getClient insteadof ServerTrait;
    }

    /**
     * @var \Memcache
     */
    protected $client;

    /**
     * @param \Memcache $client
     */
    public function __construct(\Memcache $client)
    {
        $this->client = $client;
    }
}
