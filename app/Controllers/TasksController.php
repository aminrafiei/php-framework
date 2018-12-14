<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:22 PM
 */

namespace App\Controller;

use \Task;
use \User;

class TasksController
{

    public function index()
    {

        $user = new User();
        dd($user->all()->get());
//        dd($user->create([
//            'name' => 'rez',
//            'password' => 123456,
//            'age' => 12
//        ]));

//        $task = new Task();
//        $task->create([
//            'name' => 'amin'
//        ]);
//        dd($task->find('1'));
//        $task->update();
        //App::get('database')->table('task')->select()->get();

//        $tasks = App::get('database')->selectAll('task');
//
//        return view('task',compact('tasks'));
    }

    public function store()
    {

    }
}