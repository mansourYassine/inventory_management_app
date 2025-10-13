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
    if (strcmp($path, '/suppliers/add') === 0) { // handle add supplier request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Prepare parameters for the addNewSupplier function

            // Check if product name doesn't already exist
            $suppliers = getAllSuppliers($connect);
            $suppliersName = array_map(function ($supplier) {
                return $supplier['supplier_name'];
            }, $suppliers);
            $supplierName = "";
            for ($i=0; $i < count($suppliersName); $i++) { 
                if (strcmp(strtolower($_POST['supplier_name']),strtolower($suppliersName[$i]))) {
                    $supplierName = $_POST['supplier_name'];
                } else {
                    echo ('<h1>Supplier name already existed</h1>');
                    die;
                }
            }

            $supplierEmail = $_POST['supplier_email'];
            $supplierPhone = $_POST['supplier_phone'];
            $supplierAddress = $_POST['supplier_address'];
            addNewSupplier($connect, $supplierName, $supplierEmail, $supplierPhone, $supplierAddress);
            mysqli_close($connect);
            header('Location: /suppliers');
            exit();
        } else {
            require VIEWS_PATH . 'supplier/add_supplier.view.php';
        }

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

    } elseif (strcmp($path, '/suppliers/edit') === 0) { // Handle edit supplier request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // edit supplier
            if (count(array_keys($_POST)) > 1) {
                $supplierId = intval($_POST['supplier_id']);
                $supplierName = $_POST['supplier_name'];
                $supplierEmail = $_POST['supplier_email'];
                $supplierPhone = $_POST['supplier_phone'];
                $supplierAddress = $_POST['supplier_address'];
                editSupplierInfo($connect, 
                                $supplierId, 
                                $supplierName, 
                                $supplierEmail, 
                                $supplierPhone, 
                                $supplierAddress
                                );
                mysqli_close($connect);
                header('Location: /suppliers');
                exit();
            } else { // show info of the supplier to be edited
                $postKey = array_key_first($_POST);
                if (strcmp($postKey, 'edit_supplier_id') === 0) {
                    $supplierIdToEdit = intval($_POST['edit_supplier_id']);
                    $supplierInfo = getSupplierInfo($connect, $supplierIdToEdit);
                    mysqli_close($connect);
                    require VIEWS_PATH . 'supplier/edit_supplier.view.php';
                }
            }
        } else {
            abort();
        }

    } else {
        abort();
    }
}
