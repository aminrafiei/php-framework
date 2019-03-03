<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:36 PM
 */

namespace Core\Kernel;

use ReflectionClass;
use Router;

/**
 * Class App
 * @package Core\Kernel
 */
class App
{
    /**
     * @var
     */
    public $register;

    /**
     * @var
     */
    public static $instance;

    /**
     * App constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return App
     */
    public static function instance()
    {
        if (!is_null(self::$instance)) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    /**
     * handle app
     */
    public function handle()
    {
        $this->bind('app', $this);

        $this->handleRequest();
    }

    /**
     * handle request
     */
    private function handleRequest()
    {
        Router::redirect(
            request()->uri(),
            request()->method()
        );
    }

    /**
     * @param $class
     * @return void
     * @throws \ReflectionException
     */
    public function resolveDependency(&$class)
    {
        $ref = new ReflectionClass($class);
        $result = [];

        if (!is_null($con = $ref->getConstructor())) {

            if (!empty($params = $con->getParameters())) {
                foreach ($params as $param) {

                        $cls = $param->getClass();

                        if (!is_null($cls->getConstructor()) && !empty($cls->getConstructor()->getParameters())){
                            $this->resolveDependency($cls->name);
                        }

                        var_dump([$class,$cls]);
                        $result[] = $this->make($cls->name);
                }
            }
        }

        $class = (new $class(...$result));
    }


    /**
     * @param $class
     * @return mixed
     */
    public function make($class)
    {
        if (!in_array($class, $this->register)) {
            $this->bind($class, new $class);
        }

        return $this->get($class);
    }

    /**
     * @param $key
     * @param $value
     */
    public function bind($key, $value)
    {
        $this->register[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->register[$key];
    }
}