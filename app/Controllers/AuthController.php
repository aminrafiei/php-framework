<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:18 PM
 */

namespace App\Controller;

use Core\BaseController;

/**
 * Class AuthController
 * @package App\Controller
 */
class AuthController extends BaseController
{
    /**
     * @return view
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * @return view
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * user login
     */
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

    /**
     * user register
     */
    public function register()
    {
        $request = request()->get();

        $validation = validation()->validate($request, [
            'name'     => ['required'],
            'username' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!$validation){
            return request()->back();
        }

        $user = new \User();
        if ($user->register($request)) {
            flashMessage('Successfully Created');
            return redirect('/');
        }

        return redirect('login');
    }
}