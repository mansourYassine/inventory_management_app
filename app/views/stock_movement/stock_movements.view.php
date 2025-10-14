<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Movements page</title>
</head>
<body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
    <h1>Stock Movements Page</h1>
    <a href="/stock_movements/add">Add New Stock Movement</a>
    <table border="1">
        <?php foreach ($stockMovements as $stockMovement):?>
            <tr>
                <td><?= $stockMovement['product_name'] ?></td>
                <td><?= $stockMovement['movement_type'] ?></td>
                <td><?= $stockMovement['movement_quantity'] ?></td>
                <td><?= $stockMovement['movement_date'] ?></td>
                <td>
                    <form action="/stock_movements/info" method="post">
                        <input type="hidden" name="stock_movement_id" value="<?= $stockMovement['stock_movement_id'] ?>">
                        <button type="submit">More Info</button>
                    </form>
                </td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>