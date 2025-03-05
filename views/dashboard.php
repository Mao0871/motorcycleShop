<?php
// views/dashboard.php
session_start();
if(!isset($_SESSION['user'])) {
    echo "<script>alert('请先登录');window.location.href='login.php';</script>";
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户中心</title>
    <style>
        /* 内嵌CSS，美化用户中心页面 */
        body { font-family: Arial, sans-serif; background-color: #f2f2f2; }
        .container { width: 600px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 5px; text-align: center; }
        h2 { text-align: center; }
        a { text-decoration: none; color: #0275d8; }
    </style>
</head>
<body>
    <div class="container">
        <h2>欢迎 <?php echo ($user['user_type'] == 'admin') ? '管理员' : '用户'; ?>: <?php echo $user['nickname']; ?></h2>
        <p>您已成功登录，当前身份为：<?php echo ($user['user_type'] == 'admin') ? '管理员' : '普通用户'; ?>。</p>
        <p><a href="../controllers/UserController.php?action=logout">退出登录</a></p>
    </div>
</body>
</html>
