<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'dashboard.model.php';

$totalProductsNumber = getTotalProdutsNumber();
$totalProductsQuantity = getTotalProdutsQuantity();
$totalProductsValue = getTotalProdutsValue();

$lowStockProducts = getLowStockProducts();

// dd($lowStockProducts);

require (VIEWS_PATH . 'dashboard.view.php');