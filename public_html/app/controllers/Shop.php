<?php

namespace app\controllers;

use \app\core\Controller;


class Shop extends Controller
{
    protected $mainPage = 'shop';
    public function __construct()
    {
        parent::__construct();
    }

    public function welcome()
    {
        echo "welcome";
    }
}
