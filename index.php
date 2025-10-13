<?php 

declare(strict_types = 1);

$root = dirname(__FILE__) . DIRECTORY_SEPARATOR;
define('CONTROLLERS_PATH'       , $root . 'app/controllers' . DIRECTORY_SEPARATOR);
define('MODELS_PATH'            , $root . 'app/models' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH'             , $root . 'app/views' . DIRECTORY_SEPARATOR);
define('DB_CONNECTION_PATH'     , $root . 'config' . DIRECTORY_SEPARATOR);
define('FUNCTIONS_HELPERS_PATH' , $root . 'helpers' . DIRECTORY_SEPARATOR);
define('STYLING_PATH'           , $root . 'assets' . DIRECTORY_SEPARATOR);

require (FUNCTIONS_HELPERS_PATH . 'functions.php');

$uri = parse_url($_SERVER['REQUEST_URI']);

$routes = [
    '/'               => CONTROLLERS_PATH . 'dashboard.controller.php',
    '/products'        => CONTROLLERS_PATH . 'product.controller.php',
    '/products/add'        => CONTROLLERS_PATH . 'product.controller.php',
    '/products/info'        => CONTROLLERS_PATH . 'product.controller.php',
    '/products/edit'        => CONTROLLERS_PATH . 'product.controller.php',
    '/suppliers'       => CONTROLLERS_PATH . 'supplier.controller.php',
    '/suppliers/add'       => CONTROLLERS_PATH . 'supplier.controller.php',
    '/suppliers/info'       => CONTROLLERS_PATH . 'supplier.controller.php',
    '/suppliers/edit'       => CONTROLLERS_PATH . 'supplier.controller.php',
    '/categories'       => CONTROLLERS_PATH . 'category.controller.php',
    '/stock_movements' => CONTROLLERS_PATH . 'stock_movement.controller.php',
];

if (array_key_exists($uri['path'], $routes)) {
    require $routes[$uri['path']];
} else {
    abort();
}