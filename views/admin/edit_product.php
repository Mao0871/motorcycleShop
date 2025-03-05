<?php include 'header.php'; ?>
<h2>编辑产品</h2>
<form action="../controllers/AdminController.php?action=update_product" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
    <input type="hidden" name="current_image" value="<?php echo $product['image_url']; ?>">
    <p>
        <label>型号：</label>
        <input type="text" name="model" value="<?php echo $product['model']; ?>" required>
    </p>
    <p>
        <label>类别：</label>
        <select name="category_id" required>
            <?php foreach($categories as $cat): ?>
                <option value="<?php echo $cat['category_id']; ?>" <?php echo ($product['category_id'] == $cat['category_id'] ? 'selected' : ''); ?>>
                    <?php echo $cat['category_name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>类型：</label>
        <input type="text" name="type" value="<?php echo $product['type']; ?>" required>
    </p>
    <p>
        <label>价格：</label>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
    </p>
    <p>
        <label>动力参数：</label>
        <input type="text" name="engine_power" value="<?php echo $product['engine_power']; ?>" required>
    </p>
    <p>
        <label>库存：</label>
        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
    </p>
    <p>
        <label>简介：</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
    </p>
    <p>
        <label>产品图片：</label>
        <?php if($product['image_url']): ?>
            <img src="../<?php echo $product['image_url']; ?>" alt="当前图片" style="width:50px;height:50px;">
        <?php endif; ?>
        <input type="file" name="image">
    </p>
    <p>
        <input type="submit" value="更新产品">
    </p>
</form>
<?php include 'footer.php'; ?>
