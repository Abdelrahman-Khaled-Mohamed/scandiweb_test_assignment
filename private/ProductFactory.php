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
    public static function create($properties)
    {
        if ($properties["type"] === 'book')
            return new Book($properties["sku"], $properties["name"], $properties["price"], $properties["weight"]);
        else if ($properties["type"] === 'dvd')
            return new DVD($properties["sku"], $properties["name"], $properties["price"], $properties["size"]);
        else if ($properties["type"] === 'furniture')
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