<?php

namespace Controllers;


use Core\Controller;

class BaseController extends Controller
{
    public function onConstruct()
    {
        $logged = $this->session->get('auth');
        $this->view->alert = $this->alert;
        $this->view->logged = !empty($logged);
    }
}