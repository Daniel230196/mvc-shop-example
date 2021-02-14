<?php

namespace app\models;

use \app\core\interfaces\Crud;
use \app\core\Db;

class  User extends Model
{

    private $data = [
      'login',
      'email',
      'password',
      'date',
      'id'
    ];

    /**
     * fix a problem right down
     **/

/*    public function __construct()
    {
        $stmt = $connection->prepare('SELECT * FROM Users WHERE id=:id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $arr = $stmt->fetch() ;
        var_dump(array_combine($this->data, $arr));
    }*/
    function create(array $data)
    {
    }
    function read()
    {
    }
    function update()
    {

    }
    function delete()
    {
    }
    private function getId() :int
    {

    }
    private function setConnection(\PDO $ConDB)
    {
    }
}
