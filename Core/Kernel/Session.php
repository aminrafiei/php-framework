<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 1/18/19
 * Time: 11:36 AM
 */

namespace Core\Kernel;


/**
 * Class Session
 * @package Core\Kernel
 */
class Session
{

    private static $instance = null;

    /**
     * @var bool
     */
    private $logged_in = false;

    /**
     * @var \User
     */
    private $user;

    /**
     * Session constructor.
     */
    private function __construct()
    {
        session_start();
        $this->checkLogin();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    /**
     * @param $user
     */
    public function login($user)
    {
        if ($user) {
            $this->user = $user;
            $_SESSION['user'] = serialize($user);
            $this->logged_in = true;
        }
    }

    /**
     *
     */
    public function logout()
    {
        unset($_SESSION['user']);
        unset($this->user);
        $this->logged_in = false;
    }

    /**
     * check user is logged in
     */
    private function checkLogin()
    {
        if (isset($_SESSION['user'])) {
            $this->logged_in = true;
            $this->user = unserialize($_SESSION['user']);
        } else {
            $this->logged_in = false;
            unset($this->user);
        }
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->logged_in;
    }
}