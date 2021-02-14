<?php

namespace app\controllers ;

use \app\core\Controller;

class Main extends Controller
{
    protected $mainPage = 'main';
    protected $default = 'welcome';

    public function __construct()
    {
        if (!empty($_POST)) {
        } else {
        parent::__construct();
        }

    }

    public function ajax()
    {
        if (!empty($_POST)) {
            echo "test";
        }
    }
    public function login()
    {
        if (!empty($_POST)) {
            echo "test";
        }
        $this->title = 'Log-in';
        require $this->viewsPath . 'login.php';


    }

    public function registration()
    {
        $this->title = 'Registration';
        require $this->viewsPath . 'registration.php';

    }

    public function about()
    {
        $this->title = 'About project';
        require $this->viewsPath . 'about.php';
    }

    public function welcome()
    {
        $this->title = 'Welcome to Just Some Content!';
        include $this->viewsPath . 'welcome.php';
    }

    public function personal()
    {
        require $this->viewsPath . 'personal.php';
    }

    public function default()
    {
        $this->welcome();
    }
}
