<!DOCTYPE html>
<!-- 前台注册页面 -->
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <style>
        /* 内嵌CSS，美化注册页面 */
        body { font-family: Arial, sans-serif; background-color: #f2f2f2; }
        .container { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 5px; }
        h2 { text-align: center; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%; padding: 10px; background: #5cb85c; color: #fff; border: none; border-radius: 3px;
            cursor: pointer;
        }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>用户注册</h2>
        <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <!-- 表单提交到 UserController.php?action=register -->
        <form action="../controllers/UserController.php?action=register" method="POST">
            <input type="text" name="nickname" placeholder="昵称" required>
            <input type="email" name="email" placeholder="电子邮箱" required>
            <input type="password" name="password" placeholder="密码" required>
            <input type="password" name="confirm_password" placeholder="确认密码" required>
            <input type="submit" value="注册">
        </form>
        <p>已有账号？ <a href="login.php">点击登录</a></p>
    </div>
</body>
</html>
