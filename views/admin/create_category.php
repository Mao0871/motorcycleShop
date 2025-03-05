<?php include 'header.php'; ?>
<h2>创建新类别</h2>
<form action="../controllers/AdminController.php?action=store_category" method="POST">
    <p>
        <label>类别名称：</label>
        <input type="text" name="category_name" required>
    </p>
    <p>
        <label>简介：</label>
        <textarea name="description" required></textarea>
    </p>
    <p>
        <input type="submit" value="创建类别">
    </p>
</form>
<?php include 'footer.php'; ?>
