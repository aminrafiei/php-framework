<?php

use App\Models\User;

/**
 * Created by PhpStorm.
 * User: amin
 * Date: 1/25/19
 * Time: 10:39 PM
 */

class TestService
{
    public $user;

    public function __construct(User $user)
    {
       $this->user = $user->all();
    }

    public function test()
    {
        return 'test';
    }
}