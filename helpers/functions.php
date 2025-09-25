<?php 
declare(strict_types = 1);

function dd($value) {
    echo '<pre>';
    var_dump($value);
    echo '<pre>';
    die();
}

function abort() {
    http_response_code(404);
    require VIEWS_PATH . '404.view.php';
}
