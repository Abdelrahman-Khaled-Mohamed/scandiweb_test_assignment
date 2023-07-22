<?php

namespace private;

use classes\Book;
use classes\DVD;
use classes\Furniture;

use \ReflectionClass;

spl_autoload_register(function ($class) {
    require_once str_replace('\\', '/', $class) . '.php';
});

class ProductFactory
{
    private const PRODUCT_TYPES = [
        'book' => 'createBook',
        'dvd' => 'createDVD',
        'furniture' => 'createFurniture',
    ];

    public static function create($properties)
    {
        $method = self::PRODUCT_TYPES[$properties["type"]];
        return self::$method($properties);
    }

    private static function createBook($properties)
    {
        return new Book($properties["sku"], $properties["name"], $properties["price"], $properties["weight"]);
    }

    private static function createDVD($properties)
    {
        return new DVD($properties["sku"], $properties["name"], $properties["price"], $properties["size"]);
    }

    private static function createFurniture($properties)
    {
        return new Furniture($properties["sku"], $properties["name"], $properties["price"], $properties["height"], $properties["width"], $properties["length"]);
    }

    public static function readAll()
    {
        $products = [];

        foreach (Book::selectAll() as $key=>$value) 
            array_push($products, (new ReflectionClass('classes\\Book'))->newInstanceArgs(array_values($value)));

        foreach (DVD::selectAll() as $key=>$value)
            array_push($products, (new ReflectionClass('classes\\DVD'))->newInstanceArgs(array_values($value)));

        foreach (Furniture::selectAll() as $key=>$value)
            array_push($products, (new ReflectionClass('classes\\Furniture'))->newInstanceArgs(array_values($value)));

        usort($products, fn ($a, $b) => strnatcmp($a->getSku(), $b->getSku()));

        return $products;
    }
}