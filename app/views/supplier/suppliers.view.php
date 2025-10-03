<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers page</title>
</head>
<body>
    <h1>Suppliers Page</h1>
    <table border="1">
        <?php foreach ($suppliers as $supplier):?>
            <tr>
                <td><?= $supplier['supplier_name'] ?></td>
                <td><?= $supplier['supplier_email'] ?></td>
                <td><?= $supplier['supplier_phone'] ?></td>
                <td><?= $supplier['supplier_address'] ?></td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>