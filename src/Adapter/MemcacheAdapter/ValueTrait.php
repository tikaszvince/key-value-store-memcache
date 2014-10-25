<?php namespace AdammBalogh\KeyValueStore\Adapter\MemcacheAdapter;

use AdammBalogh\KeyValueStore\Adapter\Util;
use AdammBalogh\KeyValueStore\Exception\KeyNotFoundException;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
trait ValueTrait
{
    use ClientTrait;

    /**
     * Gets the value of a key.
     *
     * @param string $key
     *
     * @return mixed The value of the key.
     *
     * @throws KeyNotFoundException
     * @throws \Exception
     */
    public function get($key)
    {
        $getResult = $this->getValue($key);
        $unserialized = @unserialize($getResult);

        if (Util::hasInternalExpireTime($unserialized)) {
            $getResult = $unserialized['v'];
        }

        return $getResult;
    }

    /**
     * Sets the value of a key.
     *
     * @param string $key
     * @param mixed $value Can be any of serializable data type.
     *
     * @return bool True if the set was successful, false if it was unsuccessful.
     *
     * @throws \Exception
     */
    public function set($key, $value)
    {
        $setResult = $this->getClient()->set($key, $value);
        if ($setResult === false) {
            throw new \Exception('Failed to set value on key ' . $key . '.');
        }
        return $setResult;
    }

    /**
     * @param string $key
     *
     * @return string
     * @throws KeyNotFoundException
     * @throws \Exception
     */
    protected function getValue($key)
    {
        $getResult = $this->getClient()->get($key);

        if (false === $getResult) {
            throw new KeyNotFoundException();
        }

        return $getResult;
    }
}
