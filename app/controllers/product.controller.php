<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'product.model.php';

// editProductInfo(7, 'Genova', 2, 4, 800, 2.5);

// deleteProduct(8);

// addNewProduct('Komoma', 4, 3, 600, 178.56);

$products = getAllProducts();
mysqli_close($connect);
require VIEWS_PATH . 'product/products.view.php';