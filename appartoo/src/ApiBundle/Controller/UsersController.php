<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;

class UsersController extends FOSRestController
{
    public function getUsersAction()
    {
        $arr = [];
        $users = $this->get('core.manager.user_manager')->findAll();
        foreach ($users as $user) {
            $arr[] = array('username' => $user->getUsername(), 'email' => $user->getEmail());
        }
        $view = $this->view($arr);
        return $this->handleView($view);
    }
    public function getUserAction($id)
    {
        $user = $this->get('core.manager.user_manager')->find($id);
        $datas = array('username' => $user->getUsername(), 'email' => $user->getEmail(),
            'number' => $user->getNumber(),'address' => $user->getAddress(), 'web' => $user->getWebAddress());
        $view = $this->view($datas);
        return $this->handleView($view);
    }

}
