<?php

declare(strict_types=1);

function getAllProducts(): array
{
    global $connect;
    $sql = "
        SELECT p.product_id, p.product_name, c.category_id, c.category_name, s.supplier_id, s.supplier_name, p.product_quantity, p.product_price
        FROM products p
        JOIN categories c
            ON p.category_id = c.category_id
        JOIN suppliers s
            ON p.supplier_id = s.supplier_id
    ";
    $result = mysqli_query($connect, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $products;
}

function addNewProduct(string $productName, int $categoryId, int $supplierId, int $quantity, float $price)
{
    global $connect;
    $sql = "
        INSERT INTO products (product_name, category_id, supplier_id, product_quantity, product_price)
        VALUES ('$productName', '$categoryId', '$supplierId', '$quantity', '$price');
    ";
    mysqli_query($connect, $sql);
}

function getProductInfo(int $productId): array
{
    global $connect;
    $sql = "
        SELECT p.product_id, p.product_name, c.category_name, s.supplier_name, p.product_quantity, p.product_price
        FROM products p
        JOIN categories c
            ON p.category_id = c.category_id
        JOIN suppliers s
            ON p.supplier_id = s.supplier_id
        WHERE p.product_id = '$productId';
    ";
    $result = mysqli_query($connect, $sql);
    $productInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $productInfo;
}

function deleteProduct(int $productId)
{
    global $connect;
    $sql = "
        UPDATE products
        SET is_active = 'NO'
        WHERE product_id = '$productId';
    ";
    mysqli_query($connect, $sql);
}

function editProductInfo(
    int $productId,
    string $productName,
    int $categoryId,
    int $supplierId,
    int $productQuantity,
    float $productPrice
) {
    global $connect;
    $sql = "
        UPDATE products
        SET 
            product_name = '$productName', 
            category_id = '$categoryId', 
            supplier_id = '$supplierId', 
            product_quantity = '$productQuantity', 
            product_price = '$productPrice'
        WHERE product_id = '$productId';
    ";
    mysqli_query($connect, $sql);
}
