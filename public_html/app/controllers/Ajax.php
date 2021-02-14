<?php


namespace app\controllers;


class Ajax
{
    public $data;

    public function __construct()
    {
        $this->data = ["status" => "false", "message" => "invalid input"];
    }

    public function post()
    {
        $headers = getallheaders();
        $this->data['headers'] = $headers;
        echo json_encode($this->data);
    }

    public function login()
    {

    }
    public function products()
    {

    }
}