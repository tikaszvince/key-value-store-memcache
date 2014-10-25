<?php namespace AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

use AdammBalogh\KeyValueStore\AbstractKvsMemcacheTestCase;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;
use AdammBalogh\KeyValueStore\Adapter\Util;
use AdammBalogh\KeyValueStore\KeyValueStore;

class ValueTraitTest extends AbstractKvsMemcacheTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testGet(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn('value-e');

        $this->assertEquals('value-e', $kvs->get('key-e'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testGetSerialized(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn(Util::getDataWithExpire('value-e', 5, time()));

        $this->assertEquals('value-e', $kvs->get('key-e'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testSet(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('set')->with('key-e', 'value-e')->andReturn(true);

        $this->assertTrue($kvs->set('key-e', 'value-e'));
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
    public function testSetError(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('set')->with('key-e', 'value-e')->andReturn(false);

        $kvs->set('key-e', 'value-e');
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
    public function testGetValueError(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('get')->with('key-e')->andReturn(false);

        $kvs->get('key-e');
    }
}
