<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:22 PM
 */

namespace App\Controller;

use App\Models\User;
use Core\BaseController;
use Task;

class TasksController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
//        dd("asd");
//        request()->get();
//        dd($this->user->find(1)->password);

            $this->user->where('password', 123456, '=')->where('name','b','=');
//            dd($this->user->data);
//            ->where('name', 'b', '=')
//            ->get();

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
//        $user = new Task();
//        $id = request()->get(['name']);
//
//        dd($user->delete($user->find($id)->id));
    }
}