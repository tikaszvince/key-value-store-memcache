<?php namespace AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

use AdammBalogh\KeyValueStore\AbstractKvsMemcacheTestCase;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;
use AdammBalogh\KeyValueStore\Adapter\Util;
use AdammBalogh\KeyValueStore\KeyValueStore;

class KeyTraitTest extends AbstractKvsMemcacheTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testDelete(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('delete')->with('key-e')->andReturn(true);
        $dummyMemch->shouldReceive('delete')->with('key-ne')->andReturn(false);

        $this->assertTrue($kvs->delete('key-e'));
        $this->assertFalse($kvs->delete('key-ne'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testExpire(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn('value-e');
        $dummyMemch->shouldReceive('replace')->andReturn(true);

        $this->assertTrue($kvs->expire('key-e', 1));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testExpireKeyNotFound(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-ne')->andReturn(false);
        $this->assertFalse($kvs->expire('key-ne', 1));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testGetTtl(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn(Util::getDataWithExpire('value-e', 5, time()));

        $this->assertLessThanOrEqual(5, $kvs->getTtl('key-e'));
    }

    /**
     * @expectedException \Exception
     *
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testGetTtlNonSerialized(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn('value-e');

        $kvs->getTtl('key-e');
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testHas(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn('value-e');

        $this->assertTrue($kvs->has('key-e'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testHasKeyNotFound(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-ne')->andReturn(false);

        $this->assertFalse($kvs->has('key-ne'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testPersist(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn(Util::getDataWithExpire('value-e', 5, time()));
        $dummyMemch->shouldReceive('replace')->andReturn(true);

        $this->assertTrue($kvs->persist('key-e'));
    }

    /**
     * @expectedException \Exception
     *
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testPersistNonSerialized(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn('value-e');

        $kvs->persist('key-e');
    }
}
