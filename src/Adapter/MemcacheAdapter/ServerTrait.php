<?php namespace AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

trait ServerTrait
{
    use ClientTrait;

    /**
     * Removes all keys.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function flush()
    {
        if (!$this->getClient()->flush()) {
            throw new \Exception('Cannot flush Memcache!');
        }
    }
}
