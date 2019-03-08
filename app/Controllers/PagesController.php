<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:18 PM
 */

namespace App\Controller;

use App\Models\User;
use App\Services\testInterface;
use Core\BaseController;
use TestService;

/**
 * Class PagesController
 * @package App\Controller
 */
class PagesController extends BaseController
{
    public $test;

    public function __construct(TestService $testService, User $user, testInterface $yeah)
    {
        $this->test = $yeah;
    }

    /**
     * view
     */
    public function home()
    {
//        dd(cache()->remember('test',function (){
//            return $this->test->user->first();
//        },999));
//
//        dd($this->test->user->first());
        return view('layout');
    }

    /**
     * view
     */
    public function about()
    {
        return view('about');
    }
}