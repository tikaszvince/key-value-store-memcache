<?php namespace AdammBalogh\KeyValueStore;

use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

abstract class AbstractKvsMemcacheTestCase extends \PHPUnit_Framework_TestCase
{
    public function getDummyMemcache()
    {
        $mock = \Mockery::mock('Memcache');

        return $mock;
    }

    public function getDummyMemcacheAdapter(\Memcache $memcache)
    {
        return new MemcacheAdapter($memcache);
    }

    public function kvsProvider()
    {
        $dummyMemch = $this->getDummyMemcache();
        $dummyMemchAdapter = $this->getDummyMemcacheAdapter($dummyMemch);

        return [
            [
                new KeyValueStore($dummyMemchAdapter),
                $dummyMemchAdapter,
                $dummyMemch
            ]
        ];
    }
}
