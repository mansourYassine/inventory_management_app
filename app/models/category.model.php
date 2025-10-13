<?php
declare(strict_types=1);

function getAllCategories(mysqli $connect): array
{
    $sql = "
        SELECT * FROM categories
        WHERE is_categ_active = 'YES'
    ";
    $result = mysqli_query($connect, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}

function addNewCategory(mysqli $connect, string $categoryName)
{
    $sql = "
        INSERT INTO categories (category_name)
        VALUES ('$categoryName');
    ";
    mysqli_query($connect, $sql);
}

function getCategoryInfo(mysqli $connect, int $categoryId): array
{
    $sql = "
        SELECT category_id, category_name
        FROM categories
        WHERE category_id = '$categoryId';
    ";
    $result = mysqli_query($connect, $sql);
    $categoryInfo = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $categoryInfo;
}

function deleteCategory(mysqli $connect, int $categoryId)
{
    $sql = "
        UPDATE categories
        SET is_categ_active = 'NO'
        WHERE category_id = '$categoryId';
    ";
    mysqli_query($connect, $sql);
}

function editCategoryInfo(mysqli $connect, int $categoryId, string $categoryName) 
{
    $sql = "
        UPDATE categories
        SET category_name = '$categoryName'
        WHERE category_id = '$categoryId';
    ";
    mysqli_query($connect, $sql);
}
