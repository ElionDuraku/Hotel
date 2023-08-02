<?php
namespace Admin\Libs;
use PDO;

class Roombook extends Database{
    protected static $db_table="roombook";
    protected static $db_fields=array("id","title",'fName','lName','email','country','phone'.'phone','tRoom','bed','meal','cin','cout','stat','nodays');

    private $id;
    private $title;
    private $fName;
    private $lName;
    private $email;
    private $national;
    private $country;
    private $phone;
    private $tRoom;
    private $bed;
    private $nRoom;
    private $meal;
    private $cin;
    private $cout;
    private $stat;
    private $nodays;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getFName() {
        return $this->fName;
    }

    public function setFName($fName) {
        $this->fName = $fName;
    }

    public function getLName() {
        return $this->lName;
    }

    public function setLName($lName) {
        $this->lName = $lName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNational() {
        return $this->national;
    }

    public function setNational($national) {
        $this->national = $national;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getTRoom() {
        return $this->tRoom;
    }

    public function setTRoom($tRoom) {
        $this->tRoom = $tRoom;
    }

    public function getBed() {
        return $this->bed;
    }

    public function setBed($bed) {
        $this->bed = $bed;
    }

    public function getNRoom() {
        return $this->nRoom;
    }

    public function setNRoom($nRoom) {
        $this->nRoom = $nRoom;
    }

    public function getMeal() {
        return $this->meal;
    }

    public function setMeal($meal) {
        $this->meal = $meal;
    }

    public function getCin() {
        return $this->cin;
    }

    public function setCin($cin) {
        $this->cin = $cin;
    }

    public function getCout() {
        return $this->cout;
    }

    public function setCout($cout) {
        $this->cout = $cout;
    }

    public function getStat() {
        return $this->stat;
    }

    public function setStat($stat) {
        $this->stat = $stat;
    }

    public function getNodays() {
        return $this->nodays;
    }

    public function setNodays($nodays) {
        $this->nodays = $nodays;
    }
   
}

