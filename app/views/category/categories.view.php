<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products page</title>
</head>
<body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
    <h1>Categories Page</h1>
    <table border="1">
        <?php foreach ($categories as $category):?>
            <tr>
                <td><?= $category['category_name'] ?></td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>