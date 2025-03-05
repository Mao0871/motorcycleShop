<?php include 'header.php'; ?>
<h2>类别管理</h2>
<p><a href="../controllers/AdminController.php?action=create_category">创建新类别</a></p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>类别ID</th>
        <th>类别名称</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <?php foreach($categories as $cat): ?>
    <tr>
        <td><?php echo $cat['category_id']; ?></td>
        <td><?php echo $cat['category_name']; ?></td>
        <td><?php echo $cat['description']; ?></td>
        <td>
            <a href="../controllers/AdminController.php?action=edit_category&id=<?php echo $cat['category_id']; ?>">编辑</a> |
            <a href="../controllers/AdminController.php?action=delete_category&id=<?php echo $cat['category_id']; ?>" onclick="return confirm('确定删除该类别？');">删除</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
