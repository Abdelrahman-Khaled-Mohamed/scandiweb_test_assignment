<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../private/ProductFactory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $productInsertion = ProductFactory::create($_POST)->insert();

        if($productInsertion)
            header('LOCATION: index.php');
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}

?>

<?php include('templates/header.php'); ?>

<h3 class='title'>Product Add</h3>

<div id='nav-buttons'>
    <button id='save-product-btn' form='product_form' formaction='add-product.php' autofocus>Save</button>
    <a href='index.php'><button id='cancel-btn' type='button'>Cancel</button></a> 
</div>

<hr>

<form id='product_form' method='POST'>
    <div id='sku-input-div'>
        <label for='sku'>SKU</label>
        <input name='sku' id='sku' type='text' required>
    </div>

    <div id='name-input-div'>
        <label for='name'>Name</label>
        <input name='name' id='name' type='text' required>
    </div>

    <div id='price-input-div'>
        <label for='price'>Price (&dollar;)</label>
        <input name='price' id='price' type='number' step='0.0001' min='0' required>
    </div>

    <div id='type-input-div'>
        <label for='type'>Type Switcher</label>
        <select name='type' id='productType' required>
            <option id='Book' value='book'>Book</option>
            <option id='DVD' value='dvd'>DVD</option>
            <option id='Furniture' value='furniture'>Furniture</option>
        </select>
    </div>

    <div id='book-input-div'>
        <div id='weight-input-div'>
            <label for='weight'>Weight (KG)</label>
            <input name='weight' id='weight' type='number' step='0.01' min='0' required>
        </div>

        <div id='book-input-description'>
            <h5>Please provide weight in kilogram</h5>
        </div>
    </div>

    <div id='dvd-input-div'>
        <div id='size-input-div'>
            <label for='size'>Size (MB)</label>
            <input name='size' id='size' type='number' step='0.01' min='0' required>
        </div>

        <div id='dvd-input-description'>
            <h5>Please provide size in megabyte</h5>
        </div>
    </div>

    <div id='furniture-input-div'>
        <div id='height-input-div'>
            <label for='height'>Height (CM)</label>
            <input name='height' id='height' type='number' step='0.01' min='0' required>
        </div>

        <div id='width-input-div'>
            <label for='width'>Width (CM)</label>
            <input name='width' id='width' type='number' step='0.01' min='0' required>
        </div>

        <div id='length-input-div'>
            <label for='length'>Length (CM)</label>
            <input name='length' id='length' type='number' step='0.01' min='0' required>
        </div>

        <div id='furniture-input-description'>
            <h5>Please provide dimensions in H×W×L format</h5>
        </div>
    </div>
</form>

<?php include('templates/footer.php'); ?>

<script src='js/scandiweb-script.js'></script>