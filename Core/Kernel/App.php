<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:36 PM
 */

namespace Core\Kernel;

require 'helper.php';

use Core\Cache\Cache;
use Core\Database\Connection;
use Core\Database\MySql\MySqlQueryBuilder;
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
        $this->bootstrap();
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
     *
     */
    private function bootstrap()
    {
        $this->bind('config', require 'config.php');

        $binds = [
            'app' => self::$instance,
            'database' => new MySqlQueryBuilder(Connection::make()),
            'session' => Session::getInstance(),
        ];

        $registers = [
            'request' => Request::class,
            'validation' => Validation::class,
            'cache' => Cache::class,
        ];

        $this->resolveBootstrap($binds, $registers);
    }

    /**
     * @param $binds
     * @param $registers
     */
    private function resolveBootstrap($binds, $registers)
    {
        $binds = array_merge(bootstrap::$binds, $binds);
        $registers = array_merge(bootstrap::$registers, $registers);

        $this->resolveBinds($binds);
        $this->resolveRegisters($registers);
    }


    /**
     * @param $binds
     */
    private function resolveBinds($binds)
    {
        foreach ($binds as $key => $value) {
            $this->bind($key, $value);
        }
    }

    /**
     * @param $registers
     */
    private function resolveRegisters($registers)
    {
        foreach ($registers as $key => $value) {
            $this->register($key, $value);
        }
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

        if (!is_null($con = $ref->getConstructor()) && !empty($params = $con->getParameters())) {

            foreach ($params as $param) {
                try {

                    $result[] = $this->makeDependency($param);

                } catch (\ReflectionException $e) {
                    dd($e->getMessage());
                }
            }
        }

        if ($ref->isInterface()) {
            try {
                $class = $this->resolveInterface($ref);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            $class = $this->makeInstance($class, $result);
        }

        return $result;
    }

    /**
     * @param \ReflectionParameter $parameters
     * @return mixed
     * @throws ReflectionException
     */
    private function makeDependency(\ReflectionParameter $parameters)
    {
        if (!is_null($class = $parameters->getClass())) {

            if (
                !is_null($class->getConstructor())
                && !empty($class->getConstructor()->getParameters())
            ) {
                $option = $this->resolveDependency($class->name);
            }

            return $this->make($class->name, $option ?? []);
        }

        return null;
    }

    /**
     * @param ReflectionClass $class
     * @return mixed
     * @throws \Exception
     */
    private function resolveInterface(ReflectionClass $class)
    {
        if (is_null($this->register[$class->name])) {
            throw new \Exception("cant resolve interface!");
        }

        return $this->get($class);
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
        if (is_null($this->register[$class])) {
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