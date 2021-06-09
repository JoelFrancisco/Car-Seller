<?php

interface ITable 
{
    public function insert($user);
    public function update($user);
    public function delete($user);
    public function select($user);
}

?>