<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:18 PM
 */

namespace App\Controller;

class PagesController
{

    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }


}