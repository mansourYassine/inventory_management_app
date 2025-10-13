<?php
declare(strict_types=1);
require DB_CONNECTION_PATH . 'db.php';
require MODELS_PATH . 'category.model.php';

$path = $uri['path'];

if (strcmp($path, '/categories') === 0) { // Main categories page
    $categories = getAllCategories($connect);
    mysqli_close($connect);
    require VIEWS_PATH . 'category/categories.view.php';

} else {
    if (strcmp($path, '/categories/add') === 0) { // handle add category request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Prepare parameters for the addNewCategory function

            // Check if product name doesn't already exist
            $categories = getAllcategories($connect);
            $categoriesName = array_map(function ($category) {
                return $category['category_name'];
            }, $categories);
            $categoryName = "";
            for ($i=0; $i < count($categoriesName); $i++) { 
                if (strcmp(strtolower($_POST['category_name']),strtolower($categoriesName[$i]))) {
                    $categoryName = $_POST['category_name'];
                } else {
                    echo ('<h1>category name already existed</h1>');
                    die;
                }
            }
            addNewCategory($connect, $categoryName);
            mysqli_close($connect);
            header('Location: /categories');
            exit();
        } else {
            require VIEWS_PATH . 'category/add_category.view.php';
        }

    } elseif (strcmp($path, '/categories/info') === 0) { // Handle product info request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postKey = array_key_first($_POST);
            // category informations request
            if (strcmp($postKey, 'category_id') === 0){
                $categoryId = intval($_POST['category_id']);
                $categoryInfo = getcategoryInfo($connect, $categoryId);
                mysqli_close($connect);
                require VIEWS_PATH . 'category/category_info.view.php';
            // Delete category request
            } elseif (strcmp($postKey, 'delete_category_id') === 0) {
                $categoryIdToDelete = intval($_POST['delete_category_id']);
                deleteCategory($connect, $categoryIdToDelete);
                mysqli_close($connect);
                header('Location: /categories');
                exit();
            } else {
                abort();
            }
        } else {
            abort();
        }

    } elseif (strcmp($path, '/categories/edit') === 0) { // Handle edit category request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // edit category
            if (count(array_keys($_POST)) > 1) {
                $categoryId = intval($_POST['category_id']);
                $categoryName = $_POST['category_name'];
                editCategoryInfo($connect, 
                                $categoryId, 
                                $categoryName
                                );
                mysqli_close($connect);
                header('Location: /categories');
                exit();
            } else { // show info of the category to be edited
                $postKey = array_key_first($_POST);
                if (strcmp($postKey, 'edit_category_id') === 0) {
                    $categoryIdToEdit = intval($_POST['edit_category_id']);
                    $categoryInfo = getcategoryInfo($connect, $categoryIdToEdit);
                    mysqli_close($connect);
                    require VIEWS_PATH . 'category/edit_category.view.php';
                }
            }
        } else {
            abort();
        }

    } else {
        abort();
    }
}
