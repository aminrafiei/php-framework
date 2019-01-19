<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:18 PM
 */

namespace App\Controller;

use Core\BaseController;
use Core\Kernel\App;

class AuthController extends BaseController
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function login()
    {
        $username = trim(request()->get(['username']));
        $password = trim(request()->get(['password']));

        $user = new \User();

        if ($user->auth($username, $password)) {
            return redirect('/');
        }

        return redirect('login');
    }

    public function register()
    {
        $request = request()->get();

        $validate = App::get('validation')->validate($request, [
            'name'     => ['required'],
            'username' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (!is_bool($validate)){
            dd([$validate,'asd']);
        }
        dd($validate);


        $user = new \User();
        if ($user->register($request)) {
            return redirect('/');
        }

        return redirect('login');
    }
}