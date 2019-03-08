<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/4/19
 * Time: 9:16 PM
 */

namespace Core\Cache;

interface Cache
{
    /**
     * @param $key
     * @param $value
     * @param $time
     * @return mixed
     */
    public function remember($key, $value, $time);

    /**
     * @param $key
     * @param $value
     */
    public function put($key, $value);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);
}