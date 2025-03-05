<?php
// views/customer/header.php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['user'])) {
    echo "<script>alert('请先登录');window.location.href='../views/login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>在线摩托车商店</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f2f2f2; }
        .navbar { background-color: #232f3e; padding: 10px; display: flex; align-items: center; }
        .navbar a { color: #fff; margin-right: 20px; text-decoration: none; font-weight: bold; }
        .navbar .reserved { color: #aaa; }
        .navbar .logout-btn { margin-left: auto; background-color: #d9534f; padding: 8px 12px; border-radius: 3px; color: #fff; text-decoration: none; }
        .navbar .logout-btn:hover { background-color: #c9302c; }
        .container { padding: 20px; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="../controllers/CustomerController.php?action=home">首页</a>
        <a href="../controllers/CustomerController.php?action=personal_info">个人信息管理</a>
        <a href="#" class="reserved">购物车</a>
        <a href="#" class="reserved">订单</a>
        <a href="../controllers/UserController.php?action=logout" class="logout-btn">退出</a>
    </div>
    <div class="container">
