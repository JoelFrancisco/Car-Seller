<?php

class User 
{
    public function __construct(
        $name=null, $login=null, $password=null, $photo=null) {
        $this->name = $name;    
        $this->login = $login;    
        $this->password = $password;    
        $this->photo = $photo;    
    }

    public function getAtributesArray() {
        $usersAtributes = array(
            "name" => $this->name, 
            "login" => $this->login, 
            "password" => $this->password, 
            "photo" => $this->photo
        );
        return $usersAtributes;
    }
}

?>