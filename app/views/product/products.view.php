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
    <br>
    <br>
    <!-- Filter by supplier -->
    <form action="" method="post">
        <label for="">Filter By Supplier:</label>
        <select name="supplier_id" id="">
            <?php foreach ($allSuppliers as $supplier) :?>
                <?php if (strcmp($supplier['supplier_id'], $_POST['supplier_id']) === 0) :?>
                    <option value="<?= $supplier['supplier_id'] ?>" selected><?= $supplier['supplier_name'] ?></option>
                    <?php else :?>
                    <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
        <button type="submit">filter</button>
    </form>
    <!-- Filter by category -->
    <form action="" method="post">
        <label for="">Filter By Category:</label>
        <select name="category_id" id="">
            <?php foreach ($allCategories as $category) :?>
                <?php if (strcmp($category['category_id'], $_POST['category_id']) === 0) :?>
                    <option value="<?= $category['category_id'] ?>" selected><?= $category['category_name'] ?></option>
                    <?php else :?>
                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
        <button type="submit">filter</button>
    </form>
    <br>
    <table border="1">
        <?php foreach ($products as $product):?>
            <?php if (strcmp($product['is_active'], 'YES') === 0):?>
                <tr>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['category_name'] ?></td>
                    <td><?= $product['supplier_name'] ?></td>
                    <td><?= $product['product_quantity'] ?></td>
                    <td><?= $product['product_price'] ?></td>
                    <td>
                        <form action="/products/info" method="post">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <button type="submit">More Info</button>
                        </form>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach?>
    </table>
</body>
</html>