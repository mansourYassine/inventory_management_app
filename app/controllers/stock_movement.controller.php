<?php
declare (strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require (MODELS_PATH . 'stock_movement.model.php');

// $stockMovementInfo = getStockMovementInfo(23);

// editStockMovement(23, 11, 100, 'IN', '2024-02-05 16:01:37', $stockMovementInfo);

$stockMovements = getAllStockMovements();

require (VIEWS_PATH . 'stock_movement/stock_movements.view.php');