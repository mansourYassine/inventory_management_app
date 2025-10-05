<?php
declare(strict_types=1);

function getTotalProdutsNumber() : string {
    global $connect;

    $sql = "
        SELECT COUNT(*) AS total_products_number
        FROM products;
    ";

    $result = mysqli_query($connect, $sql);
    $totalProductsNumber = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $totalProductsNumber['total_products_number'];
}

function getTotalProdutsQuantity() : string {
    global $connect;

    $sql = "
        SELECT SUM(product_quantity) AS total_products_quantity
        FROM products;
    ";

    $result = mysqli_query($connect, $sql);
    $totalProductsQuantity = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $totalProductsQuantity['total_products_quantity'];
}

function getTotalProdutsValue() : string {
    global $connect;

    $sql = "
        SELECT SUM(product_quantity * product_price) AS total_products_value
        FROM products;
    ";

    $result = mysqli_query($connect, $sql);
    $totalProductsValue = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $totalProductsValue['total_products_value'];
}

function getLowStockProducts() : array {
    global $connect;

    $sql = "
        SELECT *
        FROM products
        WHERE product_quantity <= 5;
    ";

    $result = mysqli_query($connect, $sql);
    $lowStockProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $lowStockProducts;
}