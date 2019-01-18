<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 1/18/19
 * Time: 11:54 AM
 */

use Core\Kernel\App;

/**
 * Trait Authentic
 */
trait Authentic
{
    /**
     * @var string
     */
    private $username = 'username';

    /**
     * @var null
     */
    private $user = null;

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function auth($username, $password)
    {
        if ($this->find($username, $this->getUsername()) &&
            $this->user = $this->find($password, 'password')
        ) {
            App::get('session')->login($this->user);
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}