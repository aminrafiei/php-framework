<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:22 PM
 */

namespace App\Controller;

use Core\BaseController;
use Task;

class TasksController extends BaseController
{
    public function index()
    {
        $user = new Task();
//        foreach ($user->all()->get() as $item) {
//            dd($item->task);
//        }
//        dd($user->all()->get());
//        dd($user->create([
//            'task' => '123123',
//            'done' => 1,
//        ]));
//        $task = new Task();
//        $task->create([
//            'name' => 'amin'
//        ]);
//        dd($user->find(1));
//        dd($user->update([
//            'done' => 1
//        ], $user->find(1)->id));
//        App::get('database')->table('task')->select()->get();

//        $tasks = App::get('database')->selectAll('task');
//
//        return view('task',compact('tasks'));
    }

    public function store()
    {

    }
}