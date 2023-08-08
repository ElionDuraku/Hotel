<?php

namespace Admin\Libs;

use PDO;
use PDOException;

class Rooms extends Database
{
    protected static $db_table = "room";
    protected static $db_fields = array("id", "type", 'bedding', 'place', 'cusid');

    protected $id;
    protected $type;
    protected $bedding;
    protected $place;
    protected $cusid;

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getBedding()
    {
        return $this->bedding;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function getCusid()
    {
        return $this->cusid;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setBedding($bedding)
    {
        $this->bedding = $bedding;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function setCusid($cusid)
    {
        $this->cusid = $cusid;
    }

    public function getRoomIds()
    {
        $sql = "SELECT id FROM room";
        $stmt = $this->prepare($sql);

        try {
            $stmt->execute();
            $roomIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            return $roomIds;
        } catch (PDOException $e) {
            // Handle the exception as needed
            echo "Error fetching room IDs: " . $e->getMessage();
            return [];
        }
    }
}
