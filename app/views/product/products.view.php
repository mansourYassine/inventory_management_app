<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products page</title>
</head>
<body>
    <h1>Products Page</h1>
    <table border="1">
        <?php foreach ($products as $product):?>
            <?php if (strcmp($product['is_active'], 'YES') === 0):?>
                <tr>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['product_quantity'] ?></td>
                    <td><?= $product['product_price'] ?></td>
                </tr>
            <?php endif ?>
        <?php endforeach?>
    </table>
</body>
</html>