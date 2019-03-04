<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:36 PM
 */

namespace Core\Kernel;

use Core\Router;
use ReflectionClass;
use ReflectionException;

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
     *
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
     * @return mixed
     * @throws \ReflectionException
     */
    public function resolveDependency(&$class)
    {
        $ref = new ReflectionClass($class);

        $result = [];
        if (!is_null($con = $ref->getConstructor())) {

            if (!empty($params = $con->getParameters())) {

                foreach ($params as $param) {
                    try {

                        if (!is_null($cls = $param->getClass())) {

                            if (
                                !is_null($cls->getConstructor())
                                && !empty($par = $cls->getConstructor()->getParameters())
                            ) {
                                $option = $this->resolveDependency($cls->name);
                            }

                            $result[] = $this->make($cls->name, $option ?? []);
                        }

                    } catch (\ReflectionException $e) {

                        var_dump($e->getMessage());
                        $this->checkInterface($param);

                    }
                }
            }
        }

        $class = $this->makeInstance($class, $result);

        return $result;
    }

    /**
     * @param $param
     */
    private function checkInterface($param)
    {
        var_dump("its interface !");
    }

    /**
     * @param $class
     * @param array $option
     * @return mixed
     */
    private function makeInstance($class, $option = [])
    {
        return (new $class(...$option));
    }

    /**
     * @param $class
     * @param array $option
     * @return mixed
     */
    public function make($class, $option = [])
    {
        if (!in_array($class, $this->register)) {
            $this->bind($class, new $class(...$option));
        }

        return $this->get($class);
    }

    /**
     * @param $key
     * @param $value
     */
    public function bind($key, $value)
    {
        if (is_object($key)) {
            $key = get_class($key);
        }

        $this->register[$key] = $value;
    }

    /**
     * @param $key
     * @param $class
     */
    public function register($key, $class)
    {
        try {
            $this->resolveDependency($class);
        } catch (ReflectionException $e) {
            dd($e->getMessage());
        }

        $this->bind($key, $class);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if (is_object($key)) {
            $key = get_class($key);
        }

        return $this->register[$key];
    }
}