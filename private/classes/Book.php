<?php

class Book extends Product
{
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
    	parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function insert() {
        try {
            $productInsertion = parent::insert();

            if(!$productInsertion)
                return false;

            $bookValues = get_object_vars($this);

            $sql = sprintf(
                "INSERT INTO Books (sku, %s) VALUES (%s, %s)",
                join(', ', array_keys($bookValues)),
                parent::getSku(),
                join(', ', array_values($bookValues))
            );

            $statement = self::makeConnection()->prepare($sql)->execute();
            
            return true;
        } catch (Exception $e) {
            parent::delete();
            error_log($e->getMessage());
            return false;
        }
    }

    public static function selectAll() {
        try {
            $sql = $sql = sprintf(
                "SELECT parent.*, %s FROM Products parent, Books this WHERE parent.SKU = this.SKU",
                join(', ', array_map(fn ($key) => 'this.' . $key, array_keys((new ReflectionClass('Book'))->getDefaultProperties())))
            );
    	    
    	    $statement = parent::makeConnection()->query($sql);
    	    
    	    return $statement->fetchAll(PDO::FETCH_ASSOC);
    	} catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getWeight() {
        return $this->weight;
    }
}
