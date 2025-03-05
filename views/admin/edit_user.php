<?php include 'header.php'; ?>
<h2>编辑用户</h2>
<form action="../controllers/AdminController.php?action=update_user" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
    <p>
        <label>昵称：</label>
        <input type="text" name="nickname" value="<?php echo $userData['nickname']; ?>" required>
    </p>
    <p>
        <label>邮箱：</label>
        <input type="email" name="email" value="<?php echo $userData['email']; ?>" required>
    </p>
    <p>
        <label>用户类型：</label>
        <select name="user_type">
            <option value="customer" <?php echo ($userData['user_type']=='customer' ? 'selected' : ''); ?>>普通用户</option>
            <option value="admin" <?php echo ($userData['user_type']=='admin' ? 'selected' : ''); ?>>管理员</option>
        </select>
    </p>
    <p>
        <input type="submit" value="更新用户">
    </p>
</form>
<?php include 'footer.php'; ?>
