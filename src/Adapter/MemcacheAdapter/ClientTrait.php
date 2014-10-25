<?php namespace AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

trait ClientTrait
{
    /**
     * @return \Memcache
     */
    public function getClient()
    {
        return $this->client;
    }
}
