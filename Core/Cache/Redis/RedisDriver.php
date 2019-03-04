<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/4/19
 * Time: 9:19 PM
 */
namespace Core\Cache\Redis;

use Core\Cache\Cache;
use Predis\Client;

class RedisDriver implements Cache
{
    /**
     * @var Client
     */
    protected $redis;

    /**
     * RedisDriver constructor.
     * @param Client $redis
     */
    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param $key
     * @param $value
     * @param int $minutes
     * @return mixed
     */
    public function remember($key, $value, $minutes = 240)
    {
        if (($val = $this->redis->get($key)) !== null) {
            return unserialize($val);
        }

        $this->redis->setex(
            $key,
            $minutes,
            (is_callable($value) ? $value = call_user_func($value) : serialize($value))
        );

        return $value;
    }

    /**
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        $this->redis->set($key, json_encode($value));
    }

    /**
     * @param $key
     * @return bool|string
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }
}