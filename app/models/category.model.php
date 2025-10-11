<?php
declare(strict_types=1);

function getAllCategories(): array
{
    global $connect;
    $sql = "
        SELECT * FROM categories
        WHERE is_categ_active = 'YES'
    ";
    $result = mysqli_query($connect, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}

function addNewCategory(string $categoryName)
{
    global $connect;
    $sql = "
        INSERT INTO categories (category_name)
        VALUES ('$categoryName');
    ";
    mysqli_query($connect, $sql);
}

function getCategoryInfo(int $categoryId): array
{
    global $connect;
    $sql = "
        SELECT category_id, category_name
        FROM categories
        WHERE category_id = '$categoryId';
    ";
    $result = mysqli_query($connect, $sql);
    $categoryInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categoryInfo;
}

function deleteCategory(int $categoryId)
{
    global $connect;
    $sql = "
        UPDATE categories
        SET is_categ_active = 'NO'
        WHERE category_id = '$categoryId';
    ";
    mysqli_query($connect, $sql);
}

function editCategoryInfo(int $categoryId, string $categoryName) 
{
    global $connect;
    $sql = "
        UPDATE categories
        SET category_name = '$categoryName'
        WHERE category_id = '$categoryId';
    ";
    mysqli_query($connect, $sql);
}
