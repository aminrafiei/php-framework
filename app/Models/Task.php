<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/14/2018
 * Time: 8:43 PM
 */

use Core\BaseModel;

class Task extends BaseModel
{

    /**
     * Task constructor.
     */
    public function __construct()
    {
        parent::__construct('task');
    }


}