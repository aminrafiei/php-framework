<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 9:18 PM
 */

namespace App\Controller;

use Core\BaseController;
use testInterface;
use TestService;
use User;

/**
 * Class PagesController
 * @package App\Controller
 */
class PagesController extends BaseController
{
    public $test;

    public function __construct(TestService $testService, User $user)//, testInterface $yeah)
    {
        $this->test = $testService;
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function home()
    {
        dd($this->test->user->first());
        return view('layout');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function about()
    {
        return view('about');
    }
}