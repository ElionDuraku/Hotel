<?php

namespace Admin\Libs;



class Contact extends Database
{

    protected static $db_table = "contact";
    protected static $db_fields = array("fullname", "phoneno", "email", "cdate", "approval");

    private $id;
    private $fullname;
    private $phoneno;
    private $email;
    private $cdate;
    private $approval;



    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function getPhoneNo()
    {
        return $this->phoneno;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCDate()
    {
        return $this->cdate;
    }

    public function getApproval()
    {
        return $this->approval;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFullName($fullname)
    {
        $this->fullname = $fullname;
    }

    public function setPhoneNo($phoneno)
    {
        $this->phoneno = $phoneno;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCDate($cdate)
    {
        $this->cdate = $cdate;
    }

    public function setApproval($approval)
    {
        $this->approval = $approval;
    }
}
