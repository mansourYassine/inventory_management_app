<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'supplier.model.php';

// addNewSupplier('Hicham', 'hicham@gmail.com', '0747859612', 'Deroua, Morocco');

// deleteSupplier(5);

editSupplierInfo(1, "Sonajib", "sonajib@gmail.com", "+212614785692", "Rachad, Morocco");

$suppliers = getAllSuppliers();

mysqli_close($connect);
require (VIEWS_PATH . 'supplier/suppliers.view.php');