<?php

namespace UsersBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController {

    /**
    * Override loginAction from FOSUser
    *
    * @return Response $response
    */
    public function loginAction(Request $request){

        $response = parent::loginAction($request);
        return $response;
     }
}