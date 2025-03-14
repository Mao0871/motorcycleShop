<?php
// controllers/UserController.php
// 此界面用户注册登陆相关
session_start();
require_once __DIR__ . '/../models/User.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    // 处理注册请求
    case 'register':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nickname         = trim($_POST['nickname']);
            $email            = trim($_POST['email']);
            $password         = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            
            // 简单验证密码一致性
            if($password !== $confirm_password) {
                $error = "密码和确认密码不匹配";
                include __DIR__ . '/../views/register.php';
                exit();
            }
            
            // 调用模型注册用户
            $result = User::register($nickname, $email, $password);
            if($result) {
                // 注册成功后弹出通知，随后跳转到登录页面
                echo "<script>alert('注册成功，请登录');window.location.href='../views/login.php';</script>";
            } else {
                $error = "注册失败，请重试。";
                include __DIR__ . '/../views/register.php';
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
        break;
        
    // 处理登录请求
    case 'login':
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email']);
            $password = $_POST['password'];
        
            $user = User::login($email, $password);
            if($user) {
                $_SESSION['user'] = $user;
                // 根据用户类型决定跳转路径
                if($user['user_type'] == 'admin'){
                    // 如果是管理员，跳转到后台管理首页
                    header("Location: ../controllers/AdminController.php?action=dashboard");
                } else {
                    // 如果是普通用户，跳转到前台商店首页（CustomerController）
                    header("Location: ../controllers/CustomerController.php?action=home");
                }
                exit();
            } else {
                $error = "登录失败，请检查邮箱和密码。";
                include __DIR__ . '/../views/login.php';
            }
        } else {
            include __DIR__ . '/../views/login.php';
        }   
        break;
        
    // 退出登录操作
    case 'logout':
        session_destroy();
        header("Location: ../views/login.php");
        exit();
        break;
        
    // 默认跳转到登录页面
    default:
        header("Location: ../views/login.php");
        break;
}
?>
