<?php

class HomeController extends BaseController
{
    public function index()
    {
        $this->renderLayout('home', [
            'title' => 'Trading Journal'
        ]);
    }
}