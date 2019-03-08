<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/8/19
 * Time: 12:42 PM
 */
namespace App\Services;

class NewTestService implements  testInterface
{
    public function __construct()
    {

    }

    public function test()
    {
    }

    public function handle()
    {
        return 'this is new test';
    }
}