<?php


namespace app\models;


use app\App;

class Model
{
    protected $db;
    protected function __construct()
    {
        $this->db = App::getService('provider', 'connection');
    }

}