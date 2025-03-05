<?php include 'header.php'; ?>
<h2>个人信息管理</h2>

<!-- 更新个人信息 -->
<div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
    <h3>更新个人信息</h3>
    <form action="../controllers/CustomerController.php?action=update_personal_info" method="POST">
        <p>
            <label>昵称:</label>
            <input type="text" name="nickname" value="<?php echo $_SESSION['user']['nickname']; ?>" required>
        </p>
        <p>
            <label>电子邮箱:</label>
            <input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
        </p>
        <p>
            <button type="submit" style="padding: 8px 16px; background-color: #2980b9; color: #fff; border: none; border-radius: 3px; cursor: pointer;">更新信息</button>
        </p>
    </form>
</div>

<!-- 更新密码 -->
<div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <h3>更新密码</h3>
    <form action="../controllers/CustomerController.php?action=update_password" method="POST">
        <p>
            <label>当前密码:</label>
            <input type="password" name="current_password" required>
        </p>
        <p>
            <label>新密码:</label>
            <input type="password" name="new_password" required>
        </p>
        <p>
            <label>确认新密码:</label>
            <input type="password" name="confirm_password" required>
        </p>
        <p>
            <button type="submit" style="padding: 8px 16px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; cursor: pointer;">更新密码</button>
        </p>
    </form>
</div>

<?php include 'footer.php'; ?>
