<?php
// views/admin/header.php
// 每个后台管理页面都包含此文件，内含导航栏样式以及管理员权限检查（以确保非管理员和未登录者无法进入）。
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['user']) || $_SESSION['user']['user_type'] != 'admin') {
    echo "<script>alert('没有权限访问该页面，请先登录管理员账户');window.location.href='../login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>后台管理界面</title>
    <style>
        /* 基本样式 */
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .navbar { background-color: #343a40; color: #fff; padding: 10px; }
        .navbar a { color: #fff; margin-right: 15px; text-decoration: none; }
        .container { padding: 20px; }
        .nav-placeholder { float: right; }
    </style>
</head>
<body>
    <div class="navbar">
        <span>后台管理界面</span>
        <div class="nav-placeholder">
            <a href="../controllers/AdminController.php?action=users">用户管理</a>
            <a href="../controllers/AdminController.php?action=products">商品管理</a>
            <a href="../controllers/AdminController.php?action=categories">类别管理</a>
            <!-- 预留其他管理选项 -->
        </div>
    </div>
    <div class="container">
