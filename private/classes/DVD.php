<?php

class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price, $size) {
    	parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function insert() {
        try {
            $productInsertion = parent::insert();

            if(!$productInsertion)
                return false;

            $dvdValues = get_object_vars($this);

            $sql = sprintf(
                "INSERT INTO DVDs (sku, %s) VALUES (%s, %s)",
                join(', ', array_keys($dvdValues)),
                parent::getSku(),
                join(', ', array_values($dvdValues))
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
                "SELECT parent.*, %s FROM Products parent, DVDs this WHERE parent.SKU = this.SKU",
                join(', ', array_map(fn ($key) => 'this.' . $key, array_keys((new ReflectionClass('DVD'))->getDefaultProperties())))
            );
    	    
    	    $statement = parent::makeConnection()->query($sql);
    	    
    	    return $statement->fetchAll(PDO::FETCH_ASSOC);
    	} catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getSize() {
        return $this->size;
    }
}
