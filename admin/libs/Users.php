<?php

namespace Admin\Libs;

use PDOException;
use Exception;
use PDO;

class Users extends Database
{
    protected static $db_table = "login";
    protected static $db_fields = array("id", "usname", "pass");

    protected $id;
    protected $usname;
    protected $pass;

    public function getId()
    {
        return $this->id;
    }

    public function getUsname()
    {
        return $this->usname;
    }

    public function getPass()
    {
        return $this->pass;
    }

    // Setter methods
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsname($usname)
    {
        $this->usname = $usname;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }
}

    
