<?php

namespace classes;

use \PDO;
use \ReflectionClass;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length)
    {
    	parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function insert()
    {
        try {
            $productInsertion = parent::insert();

            if(!$productInsertion)
                return false;

            $furnitureValues = get_object_vars($this);

            $sql = sprintf(
                "INSERT INTO Furniture (sku, %s) VALUES (%s, %s)",
                join(', ', array_keys($furnitureValues)),
                parent::getSku(),
                join(', ', array_values($furnitureValues))
            );

            $statement = self::makeConnection()->prepare($sql)->execute();
            
            return true;
        } catch (Exception $e) {
            parent::delete();
            error_log($e->getMessage());
            return false;
        }
    }

    public static function selectAll()
    {
        try {
    	    $sql = $sql = sprintf(
                "SELECT parent.*, %s FROM Products parent, Furniture this WHERE parent.SKU = this.SKU",
                join(', ', array_map(fn ($key) => 'this.' . $key, array_keys((new ReflectionClass('classes\\Furniture'))->getDefaultProperties())))
            );
    	    
    	    $statement = parent::makeConnection()->query($sql);
    	    
    	    return $statement->fetchAll(PDO::FETCH_ASSOC);
    	} catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }
}