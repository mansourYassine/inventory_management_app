<?php
declare(strict_types=1);

function getAllSuppliers(): array
{
    global $connect;
    $sql = "SELECT * FROM suppliers";
    $result = mysqli_query($connect, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}

function addNewSupplier(string $supplierName, string $supplierEmail, string $supplierPhone, string $supplierAddress)
{
    global $connect;
    $sql = "
        INSERT INTO suppliers (supplier_name, supplier_email, supplier_phone, supplier_address)
        VALUES ('$supplierName', '$supplierEmail', '$supplierPhone', '$supplierAddress');
    ";
    mysqli_query($connect, $sql);
}

function getSupplierInfo(int $supplierId): array
{
    global $connect;
    $sql = "
        SELECT supplier_id, supplier_name, supplier_email, supplier_phone, supplier_address
        FROM suppliers
        WHERE supplier_id = '$supplierId';
    ";
    $result = mysqli_query($connect, $sql);
    $supplierInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $supplierInfo;
}

function deleteSupplier(int $supplierId)
{
    global $connect;
    $sql = "
        DELETE FROM suppliers
        WHERE supplier_id = '$supplierId';
    ";
    mysqli_query($connect, $sql);
}

function editSupplierInfo(int $supplierId, string $supplierName, string $supplierEmail, string $supplierPhone, string $supplierAddress) 
{
    global $connect;
    $sql = "
        UPDATE suppliers
        SET 
            supplier_name = '$supplierName',
            supplier_email = '$supplierEmail',
            supplier_phone = '$supplierPhone',
            supplier_address = '$supplierAddress'
        WHERE supplier_id = '$supplierId';
    ";
    mysqli_query($connect, $sql);
}