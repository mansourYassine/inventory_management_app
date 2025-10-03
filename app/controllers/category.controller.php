<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'category.model.php';

// addNewCategory('Cosmitic');
// deleteCategory(4);
$categories = getAllCategories();

// $categoryInfo = getCategoryInfo(4);
// dd($categoryInfo);

// editCategoryInfo(4, 'Food');

mysqli_close($connect);
require (VIEWS_PATH . 'category/categories.view.php');