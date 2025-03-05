<?php include 'header.php'; ?>
<h2>编辑类别</h2>
<form action="../controllers/AdminController.php?action=update_category" method="POST">
    <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
    <p>
        <label>类别名称：</label>
        <input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" required>
    </p>
    <p>
        <label>简介：</label>
        <textarea name="description" required><?php echo $category['description']; ?></textarea>
    </p>
    <p>
        <input type="submit" value="更新类别">
    </p>
</form>
<?php include 'footer.php'; ?>
