<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'product.model.php';
require MODELS_PATH . 'category.model.php';
require MODELS_PATH . 'supplier.model.php';

$path = $uri['path'];

if (strcmp($path, '/products') === 0) { // Main products page
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $products = getAllProducts($connect);
        $filteredProducts = array_filter(
            $products,
            function ($product) {
                return strcmp($product['category_id'], $_POST['category_id']) === 0;
            }
        );
        $products = $filteredProducts;
        $allCategories = getAllCategories($connect);
        mysqli_close($connect);
        require VIEWS_PATH . 'product/products.view.php';
    } else {
        $products = getAllProducts($connect);
        $allCategories = getAllCategories($connect);
        mysqli_close($connect);
        require VIEWS_PATH . 'product/products.view.php';
    }
} else { 
    if (strcmp($path, '/products/info') === 0) { // Handle product info requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postKey = array_key_first($_POST);
            // product informations request
            if (strcmp($postKey, 'product_id') === 0){
                $productId = intval($_POST['product_id']);
                $productInfo = getProductInfo($connect, $productId);
                mysqli_close($connect);
                require VIEWS_PATH . 'product/product_info.view.php';
            // Delete product request
            } elseif (strcmp($postKey, 'delete_product_id') === 0) {
                $productIdToDelete = intval($_POST['delete_product_id']);
                deleteProduct($connect, $productIdToDelete);
                mysqli_close($connect);
                header('Location: /products');
                exit();
            } else {
                abort();
            }
        } else {
            abort();
        }

    } elseif (strcmp($path, '/products/add') === 0) { // handle add product request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Prepare parameters for the addNewProduct function
            // Check if product name doesn't already exist
            $products = getAllProducts($connect);
            $productsName = array_map(function ($product) {
                return $product['product_name'];
            }, $products);
            $productName = "";
            for ($i=0; $i < count($productsName); $i++) { 
                if (strcmp(strtolower($_POST['product_name']),strtolower($productsName[$i]))) {
                    $productName = $_POST['product_name'];
                } else {
                    echo ('<h1>Product name already existed</h1>');
                    die;
                }
            }

            $categoryId = intval($_POST['category_id']);
            $supplierId = intval($_POST['supplier_id']);
            $productQuantity = intval($_POST['product_quantity']);
            $productPrice = floatval($_POST['product_price']);
            addNewProduct($connect, $productName, $categoryId, $supplierId, $productQuantity, $productPrice);
            mysqli_close($connect);
            header('Location: /products');
            exit();
        } else {
            $allCategories = getAllCategories($connect);
            $allSuppliers = getAllSuppliers($connect);
            mysqli_close($connect);
            require VIEWS_PATH . 'product/add_product.view.php';
        }

    } elseif (strcmp($path, '/products/edit') === 0) { // handle edit product request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (count(array_keys($_POST)) > 1) {
                $productId = intval($_POST['product_id']);
                $productName = $_POST['product_name'];
                $categoryId = intval($_POST['category_id']);
                $supplierId = intval($_POST['supplier_id']);
                $productQuantity = intval($_POST['product_quantity']);
                $productPrice = floatval($_POST['product_price']);
                editProductInfo($connect, $productId, $productName, $categoryId, $supplierId, $productQuantity, $productPrice);
                mysqli_close($connect);
                header('Location: /products');
                exit();
            } else { // show info of the product to be edited
                $postKey = array_key_first($_POST);
                if (strcmp($postKey, 'edit_product_id') === 0) {
                    $productIdToEdit = intval($_POST['edit_product_id']);
                    $productInfo = getProductInfo($connect, $productIdToEdit);
                    $allCategories = getAllCategories($connect);
                    $allSuppliers = getAllSuppliers($connect);
                    mysqli_close($connect);
                    require VIEWS_PATH . 'product/edit_product.view.php';
                }
            }
        } else {
            abort();
        }

    } else {
        abort();
    }
}





