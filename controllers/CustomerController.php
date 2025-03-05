<?php
// controllers/CustomerController.php
session_start();
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';

// 检查是否已登录且为普通用户
if(!isset($_SESSION['user']) || $_SESSION['user']['user_type'] != 'customer') {
    echo "<script>alert('请先登录');window.location.href='../views/login.php';</script>";
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch($action) {
    case 'home':
        // 判断是否按类别过滤
        if(isset($_GET['category_id']) && $_GET['category_id'] != "all") {
            $category_id = intval($_GET['category_id']);
            $products = Product::getProductsByCategory($category_id);
        } else {
            $products = Product::getAllProducts();
        }
        $categories = Category::getAllCategories();
        include __DIR__ . '/../views/customer/home.php';
        break;
    case 'product_detail':
        if(isset($_GET['id'])) {
            $product = Product::getProductById($_GET['id']);
            include __DIR__ . '/../views/customer/product_detail.php';
        } else {
            echo "<script>alert('未找到产品');window.location.href='../controllers/CustomerController.php?action=home';</script>";
        }
        break;
    case 'personal_info':
        include __DIR__ . '/../views/customer/personal_info.php';
        break;
    case 'update_personal_info':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user_id = $_SESSION['user']['user_id'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $result = User::updateUser($user_id, $nickname, $email, 'customer');
            if($result) {
                $_SESSION['user']['nickname'] = $nickname;
                $_SESSION['user']['email'] = $email;
                echo "<script>alert('个人信息更新成功');window.location.href='../controllers/CustomerController.php?action=personal_info';</script>";
            } else {
                echo "<script>alert('更新失败');window.location.href='../controllers/CustomerController.php?action=personal_info';</script>";
            }
        }
        break;
    case 'update_password':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user_id = $_SESSION['user']['user_id'];
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            // 验证当前密码是否正确
            $user = User::login($_SESSION['user']['email'], $current_password);
            if(!$user){
                echo "<script>alert('当前密码不正确');window.location.href='../controllers/CustomerController.php?action=personal_info';</script>";
                exit();
            }
            if($new_password !== $confirm_password){
                echo "<script>alert('新密码与确认密码不一致');window.location.href='../controllers/CustomerController.php?action=personal_info';</script>";
                exit();
            }
            $result = User::updatePassword($user_id, $new_password);
            if($result) {
                echo "<script>alert('密码更新成功');window.location.href='../controllers/CustomerController.php?action=personal_info';</script>";
            } else {
                echo "<script>alert('密码更新失败');window.location.href='../controllers/CustomerController.php?action=personal_info';</script>";
            }
        }
        break;
    default:
        include __DIR__ . '/../views/customer/home.php';
        break;
}
?>
