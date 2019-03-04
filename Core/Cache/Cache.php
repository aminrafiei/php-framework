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
     * @param $time0
     * @return mixed
     */
    public function remember($key, $value, $time0);

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