<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 08/01/2018
 * Time: 13:36
 */

namespace App\Controller;

use App\Form\loginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class loginController extends Controller
{
    /**
     * @Route("/api/login_check", name="login_check")
     *
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {

    }
}
