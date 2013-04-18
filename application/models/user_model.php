<?php

class User_model extends CI_Model
{

    public function __construct ()
    {
        parent::__construct();
    }

    public function getUserByID ($id)
    {
        $user = array(
                'id' => 1,
                "name" => "John",
                "surname" => "Doe",
                "age" => 41
        );
        
        return $user;
    }
}

?>