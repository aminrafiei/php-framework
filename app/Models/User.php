<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/14/2018
 * Time: 11:30 PM
 */

use Core\BaseModel;

class User extends BaseModel
{

    public function __construct()
    {
        parent::__construct('users');
    }
}