<?php

namespace app\controllers;
use app\core\Request;
use app\core\Controller;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isGet()){
            return $this->render('home');
        }
    }
}