<?php


namespace Admin\Libs;



class Payment extends Database
{

    protected static $db_table = "payment";
    protected static $db_fields = array("title", "fname", "lname", "troom", "tbed", "nroom", "cin", "cout", "ttot", "fintot", "mepr", "meal", "btpt", "noofdays");
    // Add any specific methods related to payments here
    protected $id;
    protected $title;
    protected $fname;
    protected $lname;
    protected $troom;
    protected $tbed;
    protected $nroom;
    protected $cin;
    protected $cout;
    protected $ttot;
    protected $fintot;
    protected $mepr;
    protected $meal;
    protected $btot;
    protected $noofdays;

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFirstName()
    {
        return $this->fname;
    }

    public function getLastName()
    {
        return $this->lname;
    }

    public function getTotalRooms()
    {
        return $this->troom;
    }

    public function getTotalBeds()
    {
        return $this->tbed;
    }

    public function getNumRooms()
    {
        return $this->nroom;
    }

    public function getCheckInDate()
    {
        return $this->cin;
    }

    public function getCheckOutDate()
    {
        return $this->cout;
    }

    public function getTotalAmount()
    {
        return $this->ttot;
    }

    public function getFinalTotal()
    {
        return $this->fintot;
    }

    public function getMealPrice()
    {
        return $this->mepr;
    }

    public function getMeal()
    {
        return $this->meal;
    }

    public function getBaseTotal()
    {
        return $this->btot;
    }

    public function getNumberOfDays()
    {
        return $this->noofdays;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setFirstName($fname)
    {
        $this->fname = $fname;
    }

    public function setLastName($lname)
    {
        $this->lname = $lname;
    }

    public function setTotalRooms($troom)
    {
        $this->troom = $troom;
    }

    public function setTotalBeds($tbed)
    {
        $this->tbed = $tbed;
    }

    public function setNumRooms($nroom)
    {
        $this->nroom = $nroom;
    }

    public function setCheckInDate($cin)
    {
        $this->cin = $cin;
    }

    public function setCheckOutDate($cout)
    {
        $this->cout = $cout;
    }

    public function setTotalAmount($ttot)
    {
        $this->ttot = $ttot;
    }

    public function setFinalTotal($fintot)
    {
        $this->fintot = $fintot;
    }

    public function setMealPrice($mepr)
    {
        $this->mepr = $mepr;
    }

    public function setMeal($meal)
    {
        $this->meal = $meal;
    }

    public function setBaseTotal($btot)
    {
        $this->btot = $btot;
    }

    public function setNumberOfDays($noofdays)
    {
        $this->noofdays = $noofdays;
    }

    public function getPaymentChartData()
    {
        $sql = "SELECT * FROM payment";
        $stmt = $this->prepare($sql);
        $stmt->execute();

        $chart_data = '';
        $tot = 0;

        while ($row = $stmt->fetch()) {
            $chart_data .= "{ date:'" . $row["cout"] . "', profit:" . $row["fintot"] * 10 / 100 . "}, ";
            $tot = $tot + $row["fintot"] * 10 / 100;
        }

        $chart_data = substr($chart_data, 0, -2);
        return $chart_data;
    }
}
