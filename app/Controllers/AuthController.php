<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:18 PM
 */

namespace App\Controller;

use Core\BaseController;

class AuthController extends BaseController
{
    public function show()
    {
        return view('login');
    }

    public function auth()
    {
        $username = trim(request()->get(['username']));
        $password = trim(request()->get(['password']));

        $user = new \User();
        if ($user->auth($username, $password)) {
            return redirect('/');

        }
        return redirect('login');
    }
}