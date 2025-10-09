<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products page</title>
    <link rel="stylesheet" href="\assets\css\master.css">
    <link rel="stylesheet" href="\assets\css\all.min.css">
</head>
<body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
    <h1>Products Page</h1>
    <a href="/products/add">Add New Product</a>
    <table border="1">
        <?php foreach ($products as $product):?>
            <?php if (strcmp($product['is_active'], 'YES') === 0):?>
                <tr>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['category_name'] ?></td>
                    <td><?= $product['supplier_name'] ?></td>
                    <td><?= $product['product_quantity'] ?></td>
                    <td><?= $product['product_price'] ?></td>
                    <td><a href="/products/info?product_id=<?= $product['product_id'] ?>">More Info</a></td>
                </tr>
            <?php endif ?>
        <?php endforeach?>
    </table>
</body>
</html>