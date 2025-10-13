<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'supplier.model.php';

$path = $uri['path'];

if (strcmp($path, '/suppliers') === 0) { // Main suppliers page
    $suppliers = getAllSuppliers($connect);
    mysqli_close($connect);
    require VIEWS_PATH . 'supplier/suppliers.view.php';
} else {
    if (strcmp($path, '/suppliers/add') === 0) {
        echo 'condition 1';

    } elseif (strcmp($path, '/suppliers/info') === 0) { // Handle product info request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postKey = array_key_first($_POST);
            // Supplier informations request
            if (strcmp($postKey, 'supplier_id') === 0){
                $supplierId = intval($_POST['supplier_id']);
                $supplierInfo = getSupplierInfo($connect, $supplierId);
                mysqli_close($connect);
                require VIEWS_PATH . 'supplier/supplier_info.view.php';
            // Delete supplier request
            } elseif (strcmp($postKey, 'delete_supplier_id') === 0) {
                $supplierIdToDelete = intval($_POST['delete_supplier_id']);
                deleteSupplier($connect, $supplierIdToDelete);
                mysqli_close($connect);
                header('Location: /suppliers');
                exit();
            } else {
                abort();
            }
        } else {
            abort();
        }

    } elseif (strcmp($path, '/suppliers/edit') === 0) {
        echo 'condition 3';
    } else {
        abort();
    }
}
