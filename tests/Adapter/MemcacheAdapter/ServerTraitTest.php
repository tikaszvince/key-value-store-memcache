<?php namespace AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

use AdammBalogh\KeyValueStore\AbstractKvsMemcacheTestCase;
use AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;
use AdammBalogh\KeyValueStore\KeyValueStore;

class ServerTraitTest extends AbstractKvsMemcacheTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param MemcacheAdapter $dummyMemchAdapter
     * @param \Memcache $dummyMemch
     */
    public function testFlush(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('flush')->andReturn(true);

        $this->assertNull($kvs->flush());
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
    public function testFlushError(KeyValueStore $kvs, MemcacheAdapter $dummyMemchAdapter, \Memcache $dummyMemch)
    {
        $dummyMemch->shouldReceive('flush')->andReturn(false);

        $kvs->flush();
    }
}
