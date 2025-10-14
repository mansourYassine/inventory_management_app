<?php
declare (strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require (MODELS_PATH . 'stock_movement.model.php');
require (MODELS_PATH . 'product.model.php');

$path = $uri['path'];

if (strcmp($path, '/stock_movements') === 0) { // Main Stock Movements page
    $stockMovements = getAllStockMovements($connect);
    mysqli_close($connect);
    require VIEWS_PATH . 'stock_movement/stock_movements.view.php';

} else {
    if (strcmp($path, '/stock_movements/add') === 0) { // handle add stock movement request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Prepare parameters for the addNewStockMovement function
            $productId = intval($_POST['product_id']);
            $movementQuantity = intval($_POST['movement_quantity']);
            $movementType = $_POST['movement_type'];
            $movementDate = $_POST['movement_date'];
            addNewStockMovement(
                $connect,
                $productId,
                $movementQuantity,
                $movementType,
                $movementDate
            );
            mysqli_close($connect);
            header('Location: /stock_movements');
            exit();
        } else {
            $products = getAllProducts($connect);
            require VIEWS_PATH . 'stock_movement/add_stock_movement.view.php';
        }
        
    } elseif (strcmp($path, '/stock_movements/info') === 0) { // Handle stock movement info request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postKey = array_key_first($_POST);
            // Supplier informations request
            if (strcmp($postKey, 'stock_movement_id') === 0){
                $stockMovementId = intval($_POST['stock_movement_id']);
                $stockMovementInfo = getStockMovementInfo($connect, $stockMovementId);
                mysqli_close($connect);
                require VIEWS_PATH . 'stock_movement/stock_movement_info.view.php';

            // Delete supplier request
            } elseif (strcmp($postKey, 'delete_stock_movement_id') === 0) {
                $stockMovementToDeleteId = intval($_POST['delete_stock_movement_id']);
                $stockMovementInfo = getStockMovementInfo($connect, $stockMovementToDeleteId);
                deleteStockMovement(
                    $connect,
                    $stockMovementInfo['stock_movement_id'],
                    $stockMovementInfo['product_id'],
                    $stockMovementInfo['movement_type'],
                    $stockMovementInfo['movement_quantity']                    
                );
                mysqli_close($connect);
                header('Location: /stock_movements');
                exit();
            } else {
                abort();
            }
        } else {
            abort();
        }
        
    } elseif (strcmp($path, '/stock_movements/edit') === 0) {
        // handle edit stock movement request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // edit stock movement
            if (count(array_keys($_POST)) > 1) {
                $stockMovementId = intval($_POST['stock_movement_id']);
                $productId = intval($_POST['product_id']);
                $movementQuantity = intval($_POST['movement_quantity']);
                $movementType = $_POST['movement_type'];
                $movementDate = $_POST['movement_date'];
                $stockMovementInfo = getStockMovementInfo($connect, $stockMovementId);
                editStockMovement(
                    $connect, 
                    $stockMovementId, 
                    $productId,
                    $movementQuantity,
                    $movementType,
                    $movementDate,
                    $stockMovementInfo
                );
                mysqli_close($connect);
                header('Location: /stock_movements');
                exit();
            } else { // show info of the stock movement to be edited
                $postKey = array_key_first($_POST);
                if (strcmp($postKey, 'edit_stock_movement_id') === 0) {
                    $stockMovementIdToEdit = intval($_POST['edit_stock_movement_id']);
                    $stockMovementInfo = getStockMovementInfo($connect, $stockMovementIdToEdit);
                    $products = getAllProducts($connect);
                    mysqli_close($connect);
                    require VIEWS_PATH . 'stock_movement/edit_stock_movement.view.php';
                }
            }
        } else {
            abort();
        }

    } else {
        abort();
    }
}