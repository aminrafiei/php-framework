<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:22 PM
 */

namespace App\Controller;

use Core\App;

class TasksController
{

    public function index()
    {
        $tasks = App::get('database')->selectAll('task');

        return view('task',compact('tasks'));
    }

    public function store()
    {
        
    }
}