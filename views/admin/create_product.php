<?php include 'header.php'; ?>
<h2>创建新产品</h2>
<form action="../controllers/AdminController.php?action=store_product" method="POST" enctype="multipart/form-data">
    <p>
        <label>型号：</label>
        <input type="text" name="model" required>
    </p>
    <p>
        <label>类别：</label>
        <select name="category_id" required>
            <option value="">请选择</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>类型：</label>
        <input type="text" name="type" required>
    </p>
    <p>
        <label>价格：</label>
        <input type="number" step="0.01" name="price" required>
    </p>
    <p>
        <label>动力参数：</label>
        <input type="text" name="engine_power" required>
    </p>
    <p>
        <label>库存：</label>
        <input type="number" name="stock" required>
    </p>
    <p>
        <label>简介：</label>
        <textarea name="description" required></textarea>
    </p>
    <p>
        <label>产品图片：</label>
        <input type="file" name="image" required>
    </p>
    <p>
        <input type="submit" value="创建产品">
    </p>
</form>
<?php include 'footer.php'; ?>
