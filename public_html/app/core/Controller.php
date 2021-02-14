<?php

namespace app\core;


abstract class Controller
{
    protected $viewsPath = DOC_ROOT.'/app/views/';
    protected $action;
    protected $mainPage;
    protected $model;
    protected $title;
    protected $default;

    protected function __construct()
    {
        $page = $this->setPage();
        include $page;

    }

    public function resource($action)
    {
        $this->action = $action;
        return $this;
    }

    protected function setPage()
    {
        $page = $this->mainPage;
        return $this->viewsPath.$page.'.php';
    }

    public function render()
    {
        $view = $this->action;
        if ((new \ReflectionClass(static::class))->hasMethod($view)){
            $this->$view();
        } else {
        $this->{$this->$default}();
        }

    }
    protected function notFound()
    {
        include $this->viewsPath.'404.php';
    }
}
