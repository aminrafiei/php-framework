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
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var bool
     */
    private $logged_in = false;

    /**
     * @var string
     */
    public $message = '';

    /**
     * @var \User
     */
    private $user;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        if (isset($_SESSION['message'])) {

            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
            return $this->message;
        }

        return '';
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $_SESSION['message'] = $message;
    }

    /**
     * @return bool
     */
    public function hasMessage()
    {
        return !empty($_SESSION['message']);
    }

    /**
     * Session constructor.
     */
    private function __construct()
    {
        session_start();
        $this->checkLogin();
    }

    /**
     * @return Session|null
     */
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