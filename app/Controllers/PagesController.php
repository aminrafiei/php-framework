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
    static $middleware = ['auth'];

    /**
     * view
     */
    public function home()
    {
        return view('layout');
    }
}