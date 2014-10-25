<?php namespace AdammBalogh\KeyValueStore\Adapter;

use AdammBalogh\KeyValueStore\AbstractKvsMemcacheTestCase;
use AdammBalogh\KeyValueStore\KeyValueStore;

class MemcacheAdapterTest extends AbstractKvsMemcacheTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testInstantiation(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        new MemcacheAdapter($dummyMemch);
    }
}
