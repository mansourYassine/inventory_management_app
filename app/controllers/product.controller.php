<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'product.model.php';

$products = getAllProducts();
mysqli_close($connect);

dd($products);

require VIEWS_PATH . 'product/products.view.php';