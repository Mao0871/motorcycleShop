<?php include 'header.php'; ?>
<h2>用户管理</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>用户ID</th>
        <th>昵称</th>
        <th>邮箱</th>
        <th>用户类型</th>
        <th>操作</th>
    </tr>
    <?php foreach($users as $u): ?>
    <tr>
        <td><?php echo $u['user_id']; ?></td>
        <td><?php echo $u['nickname']; ?></td>
        <td><?php echo $u['email']; ?></td>
        <td><?php echo $u['user_type']; ?></td>
        <td>
            <a href="../controllers/AdminController.php?action=edit_user&id=<?php echo $u['user_id']; ?>">编辑</a> |
            <a href="../controllers/AdminController.php?action=delete_user&id=<?php echo $u['user_id']; ?>" onclick="return confirm('确定删除该用户？');">删除</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
