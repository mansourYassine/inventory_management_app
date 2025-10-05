<?php

declare(strict_types=1);

function getAllStockMovements(): array
{
    global $connect;
    $sql = "
        SELECT 
            s.stock_movement_id, 
            s.product_id, 
            p.product_name, 
            s.movement_quantity, 
            s.movement_type, 
            s.movement_date
        FROM stock_movements s
        JOIN products p
        ON s.product_id = p.product_id;
    ";
    $result = mysqli_query($connect, $sql);
    $stockMovements = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $stockMovements;
}

function addNewStockMovement(int $productId, int $movementQuantity, string $movementType, string $movementDate)
{
    global $connect;
    $sql = "
        INSERT INTO stock_movements (product_id, movement_quantity, movement_type, movement_date)
        VALUE ('$productId', '$movementQuantity', '$movementType', '$movementDate');
    ";
    mysqli_query($connect, $sql);

    // Change the quantity of the product in the products table
    if (strcmp($movementType, 'IN') === 0) {
        $sql = "
            UPDATE products
            SET product_quantity = product_quantity + $movementQuantity
            WHERE product_id = $productId;
        ";
        mysqli_query($connect, $sql);
    } else {
        $sql = "
            UPDATE products
            SET product_quantity = product_quantity - $movementQuantity
            WHERE product_id = $productId;
        ";
        mysqli_query($connect, $sql);
    }
}

function getStockMovementInfo(int $stockMovementId) : array
{
    global $connect;
    $sql = "
        SELECT 
            s.stock_movement_id, 
            s.product_id, 
            p.product_name, 
            s.movement_quantity, 
            s.movement_type, 
            s.movement_date
        FROM stock_movements s
        JOIN products p
        ON s.product_id = p.product_id
        WHERE stock_movement_id = $stockMovementId
    ";
    $result = mysqli_query($connect, $sql);
    $stockMovementInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $stockMovementInfo;
}

function deleteStockMovement(int $stockMovementId, int $productId, string $movementType, int $movementQuantity)
{
    global $connect;
    $sql = "
        DELETE FROM stock_movements
        WHERE stock_movement_id = '$stockMovementId';
    ";
    mysqli_query($connect, $sql);

    // Change the quantity of the product in the products table
    if (strcmp($movementType, 'IN') === 0) {
        $sql = "
            UPDATE products
            SET product_quantity = product_quantity - $movementQuantity
            WHERE product_id = $productId;
        ";
        mysqli_query($connect, $sql);
    } else {
        $sql = "
            UPDATE products
            SET product_quantity = product_quantity + $movementQuantity
            WHERE product_id = $productId;
        ";
        mysqli_query($connect, $sql);
    }
}

function editStockMovement(
    int $stockMovementId, 
    int $newProductId, 
    int $newMovementQuantity, 
    string $newMovementType, 
    string $newMovementDate, 
    array $oldMovementInfo) 
{
    global $connect;
    $oldProductId = intval($oldMovementInfo[0]['product_id']);
    $oldMovementType = $oldMovementInfo[0]['movement_type'];
    $oldMovementQuantity = intval($oldMovementInfo[0]['movement_quantity']);

    // Restore the quantity of the product in the products table
    if (strcmp($oldMovementType, 'IN') === 0) {
        $sql1 = "
            UPDATE products
            SET product_quantity = product_quantity - $oldMovementQuantity
            WHERE product_id = $oldProductId;
        ";
        mysqli_query($connect, $sql1);
    } else {
        $sql2 = "
            UPDATE products
            SET product_quantity = product_quantity + $oldMovementQuantity
            WHERE product_id = $oldProductId;
        ";
        mysqli_query($connect, $sql2);
    }

    $sql3 = "
        UPDATE stock_movements
        SET 
            product_id = $newProductId,
            movement_quantity = '$newMovementQuantity',
            movement_type = '$newMovementType',
            movement_date = '$newMovementDate'
        WHERE stock_movement_id = $stockMovementId;
    ";
    mysqli_query($connect, $sql3);

    // Update the quantity of the product in the products table
    if (strcmp($newMovementType, 'IN') === 0) {
        $sql4 = "
            UPDATE products
            SET product_quantity = product_quantity + $newMovementQuantity
            WHERE product_id = $newProductId;
        ";
        mysqli_query($connect, $sql4);
    } else {
        $sql5 = "
            UPDATE products
            SET product_quantity = product_quantity - $newMovementQuantity
            WHERE product_id = $newProductId;
        ";
        mysqli_query($connect, $sql5);
    }
}