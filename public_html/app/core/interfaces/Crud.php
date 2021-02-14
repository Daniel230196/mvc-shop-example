<?php

namespace app\core\interfaces;

/**
 * Interface for DataBase objects
 */
interface Crud
{
    function create(array $data);
    function read();
    function update();
    function delete();
}
