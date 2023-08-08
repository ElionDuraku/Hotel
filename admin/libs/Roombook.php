<?php

namespace Admin\Libs;

use DateTime;
use PDO;

class Roombook extends Database
{
    protected static $db_table = "roombook";
    protected static $db_fields = array("id", "Title", 'FName', 'LName', 'Email', 'National', 'Country', 'Phone', 'TRoom', 'Bed', 'NRoom', 'Meal', 'cin', 'cout', 'stat', 'nodays');

    protected $id;
    protected $Title;
    protected $FName;
    protected $LName;
    protected $Email;
    protected $National;
    protected $Country;
    protected $Phone;
    protected $TRoom;
    protected $Bed;
    protected $NRoom;
    protected $Meal;
    protected $cin;
    protected $cout;
    protected $stat;
    protected $nodays;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getTitle()
    {
        return $this->Title;
    }

    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    public function getFName()
    {
        return $this->FName;
    }

    public function setFName($FName)
    {
        $this->FName = $FName;
    }

    public function getLName()
    {
        return $this->LName;
    }

    public function setLName($LName)
    {
        $this->LName = $LName;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getNational()
    {
        return $this->National;
    }

    public function setNational($National)
    {
        $this->National = $National;
    }

    public function getCountry()
    {
        return $this->Country;
    }

    public function setCountry($Country)
    {
        $this->Country = $Country;
    }

    public function getPhone()
    {
        return $this->Phone;
    }

    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
    }

    public function getTRoom()
    {
        return $this->TRoom;
    }

    public function setTRoom($TRoom)
    {
        $this->TRoom = $TRoom;
    }

    public function getBed()
    {
        return $this->Bed;
    }

    public function setBed($Bed)
    {
        $this->Bed = $Bed;
    }

    public function getNRoom()
    {
        return $this->NRoom;
    }

    public function setNRoom($NRoom)
    {
        $this->NRoom = $NRoom;
    }

    public function getMeal()
    {
        return $this->Meal;
    }

    public function setMeal($Meal)
    {
        $this->Meal = $Meal;
    }


    public function getCin()
    {
        return $this->cin;
    }

    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    public function getCout()
    {
        return $this->cout;
    }

    public function setCout($cout)
    {
        $this->cout = $cout;
    }

    public function getStat()
    {
        return $this->stat;
    }

    public function setStat($stat)
    {
        $this->stat = $stat;
    }

    public function getNodays()
    {
        return $this->nodays;
    }

    public function setNodays($nodays)
    {
        $this->nodays = $nodays;
    }

    public function calculateNumberOfDays()
    {
        $cinDate = new DateTime($this->getCin());
        $coutDate = new DateTime($this->getCout());
        $interval = $cinDate->diff($coutDate);
        $this->nodays = $interval->days;
    }
}
