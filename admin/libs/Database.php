<?php

namespace Admin\Libs;


use PDO, PDOException;
use ReflectionClass;

// require_once('./admin/config/config.php');
require_once(__DIR__ . '/../../admin/config/config.php');

abstract class Database
{

    protected static $db_table;
    protected static $db_fields;
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Lidhja me DB deshtoi " . $e->getMessage();
        }
    }
    public function prepare($sql)
    {
        return $this->connectDB()->prepare($sql);
    }

  

    public function properties()
    {
        $properties = array();
        foreach (static::$db_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }
    public function getClassName()
    {
        $className = new ReflectionClass($this);
        return $className->getShortName();
    }
    public function find_all()
    {
        $sql = "SELECT * FROM " . static::$db_table;
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\" . $this->getClassName());
        return $stmt->fetchAll();
    }
    public function find_id($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE id=:id";
        $result = $this->prepare($sql);
        $result->bindParam(':id', $this->id);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\{$this->getClassName()}");
        return $result->fetch();
    }

    public function find_by_email($email)
    {
        $this->email = $email;
        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE email=:email";
        $result = $this->prepare($sql);
        $result->bindParam(':email', $this->email);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\{$this->getClassName()}");
        return $result->fetch();
    }


    public function create()
    {
        $properties = $this->properties();
        $columns = implode(", ", array_keys($properties));
        $values = ":" . implode(", :", array_keys($properties));

        try {
            $sql = "INSERT INTO " . static::$db_table . " ({$columns}) VALUES ({$values})";
            $stmt = $this->prepare($sql);

            // Bind each property's value with its corresponding named parameter
            foreach ($properties as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error in user registration process: " . $e->getMessage();
            return false;
        }
    }


    public function update()
    {
        $properties = $this->properties();
        try {
            $properties_pair = array();
            foreach ($properties as $key => $value) {
                $properties_pair[] = "{$key}='{$value}'";
            }
            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(",", $properties_pair);
            $sql .= " WHERE id=:id ";
            $res = $this->prepare($sql);
            $res->bindParam(':id', $this->id);
            $res->execute();
            return true;
            //echo $this->getClassName() ." modified succesfully";
        } catch (PDOException $e) {
            echo "Error in user modification process" . $e->getMessage();
        }
    }
    public function delete()
    {
        try {
            $sql = "DELETE FROM " .  static::$db_table . " WHERE id=:id ";
            $res = $this->prepare($sql);
            $res->bindParam(':id', $this->id);
            $res->execute();
            return true;
            //echo "User deleted succesfully";
        } catch (PDOException $e) {
            echo "Error in user deletion process" . $e->getMessage();
        }
    }
}
