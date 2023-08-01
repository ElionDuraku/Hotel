<?php

namespace Admin\Libs;

use PDOException;
use Exception;
use PDO;

class Users extends Database
{
    protected static $db_table = "login";
    protected static $db_fields = array("id", "usname", "pass", "role");

    protected $id;
    protected $usname;
    protected $pass;
    protected $role;


    public function getId()
    {
        return $this->id;
    }

    public function getUsname()
    {
        return $this->usname;
    }

    public function setUsname($usname)
    {
        $this->usname = $usname;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function verifyUser($usname, $password)
    {
        $sql = "SELECT * FROM login";
        $sql .= " WHERE usname=:usname AND pass=:pass";
        $result = $this->prepare($sql);
        $result->bindParam(':usname', $usname);
        $result->bindParam(':pass', $password);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\{$this->getClassName()}");
        return $result->fetch();
    }
}
