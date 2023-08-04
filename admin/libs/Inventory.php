<?php

namespace Admin\Libs;

use PDOException;
use Exception;
use PDO;

class Inventory extends Database
{
    protected static $db_table = "inventory";
    protected static $db_fields = array("id", "productName", "quantity", "price", "message");

    protected $id;
    protected $productName;
    protected $quantity;
    protected $price;
    protected $message;

    public function getId()
    {
        return $this->id;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
