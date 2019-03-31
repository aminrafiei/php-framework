<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 1/18/19
 * Time: 11:54 AM
 */

namespace Core;

use App\Models\User;

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
        $this->user = $this->where($this->getUsername(), $username)
            ->andWhere('password', $password)
            ->get();

        if ($this->user) {
            session()->login($this->user);
            return true;
        }

        return false;
    }

    /**
     * @param $request
     * @return bool
     */
    public function register($request)
    {
        $user = new User();

        $result = $user->create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => $request['password']
        ]);
        $this->user = $this->find($request['username'], 'username');

        if ($result) {
            session()->login($this->user);
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