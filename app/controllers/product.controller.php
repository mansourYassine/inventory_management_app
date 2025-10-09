<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'product.model.php';

$path = $uri['path'];
if (strcmp($path, '/products') === 0) {
    $products = getAllProducts();
    mysqli_close($connect);
    require VIEWS_PATH . 'product/products.view.php';
} else {
    if (strcmp($path, '/products/info') === 0) {
        $productId = intval($_GET['product_id']);
        $productInfo = getProductInfo($productId);
        require VIEWS_PATH . 'product/product_info.view.php';
    } elseif (strcmp($path, '/products/add') === 0) {
        require VIEWS_PATH . 'product/add_product.view.php';
    } elseif (strcmp($path, '/products/edit') === 0) {
        require VIEWS_PATH . 'product/edit_product.view.php';
    } else {
        abort();
    }
}





