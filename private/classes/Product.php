<?php

namespace classes;

use \PDO;

abstract class Product
{
    private static $connection;
    
    private $sku;
    private $name;
    private $price;

    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }
    
    public static function makeConnection()
    {
    	require __DIR__ . "/../../config.php";
    	
        if (!isset(self::$connection)) {
            try {
                self::$connection = new PDO($dsn, $username, $password, $options);
            } catch (Exception $e) {
                error_log($e->getMessage());
                return NULL;
            }
        }
        
        return self::$connection;
    }

    public function insert()
    {
    	try {
            $productValues = get_object_vars($this);

            $sql = sprintf(
    	    	"INSERT INTO Products (%s) VALUES (%s)",
    	    	join(', ', array_keys($productValues)),
                join(', ', array_values($productValues))
            );

            $statement = self::makeConnection()->prepare($sql)->execute();
    	    
    	    return true;
    	} catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    abstract public static function selectAll();
    
    public function delete()
    {
    	try {
    	    $sql = "DELETE FROM Products WHERE SKU=$this->sku";
    	    
    	    $statement = self::makeConnection()->prepare($sql)->execute();
    	    
    	    return $statement;
    	} catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}