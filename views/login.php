<!DOCTYPE html>
<!-- 前台登录页面 -->
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <style>
        /* 内嵌CSS，美化登录页面 */
        body { font-family: Arial, sans-serif; background-color: #f2f2f2; }
        .container { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 5px; }
        h2 { text-align: center; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%; padding: 10px; background: #0275d8; color: #fff; border: none; border-radius: 3px;
            cursor: pointer;
        }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>用户登录</h2>
        <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <!-- 表单提交到 UserController.php?action=login -->
        <form action="../controllers/UserController.php?action=login" method="POST">
            <input type="email" name="email" placeholder="电子邮箱" required>
            <input type="password" name="password" placeholder="密码" required>
            <input type="submit" value="登录">
        </form>
        <p>没有账号？ <a href="register.php">点击注册</a></p>
    </div>
</body>
</html>
