<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/14/2018
 * Time: 11:30 PM
 */

namespace App\Models;

use Core\Authentic;
use Core\BaseModel;

/**
 * Class User
 * @package App\Models
 */
class User extends BaseModel
{
    use Authentic;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct('users');
    }
}