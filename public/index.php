<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../private/ProductFactory.php';

$products = ProductFactory::readAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteIndex'])) {
    foreach (array_values($_POST['deleteIndex']) as $index)
        $products[$index]->delete();

    header('LOCATION: index.php');
}

?>

<?php include('templates/header.php'); ?>

<h3 class='title'>Product List</h3>

<div id='nav-buttons'>
    <a href='add-product.php'><button id='add-product-btn' type='button' autofocus>ADD</button></a> 
    <button id='delete-product-btn' form='product_list' formaction='index.php'>MASS DELETE</button>
</div>

<hr>

<form id='product_list' method='POST'>
    <div class='products-grid-container'>
        <?php foreach ($products as $index=>$product): ?>
            <div class='products-grid-item'>
                <input name='deleteIndex[]' class='delete-checkbox' type='checkbox' value='<?= $index ?>'>
                <h5><?php echo $product->getSku() ?></h5>
                <h5><?php echo $product->getName() ?></h5>
                <h5><?php echo $product->getPrice() ?></h5>
                <h5>
                    <?php
                        if (get_class($product) === 'Book')
                            echo 'Weight: ' . $product->getWeight() . 'KG';
                        else if (get_class($product) === 'DVD')
                            echo 'Size: ' . $product->getSize() . 'MB';
                        else if (get_class($product) === 'Furniture')
                            echo 'Dimension: ' . $product->getHeight() . '×' . $product->getWidth() . '×' . $product->getLength();
                    ?>
                </h5>
            </div>
        <?php endforeach; ?>
    </div>
</form>

<?php include('templates/footer.php'); ?>