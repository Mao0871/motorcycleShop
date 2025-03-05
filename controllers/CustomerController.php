<?php
// controllers/CustomerController.php
session_start();
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';

//购物车
require_once __DIR__ . '/../models/Cart.php';

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

    //购物车part
    case 'cart':
        $cart_items = Cart::getCartItems($_SESSION['user']['user_id']);
        include __DIR__ . '/../views/customer/cart.php';
        break;
    // 新增：添加商品到购物车（由商品详情页触发）
    case 'add_to_cart':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user_id = $_SESSION['user']['user_id'];
            $product_id = intval($_POST['product_id']);
            $quantity = intval($_POST['quantity']);
            if($quantity < 1) $quantity = 1;
            $result = Cart::addToCart($user_id, $product_id, $quantity);
            if($result){
                echo "<script>alert('添加成功');window.location.href='../controllers/CustomerController.php?action=cart';</script>";
            } else {
                echo "<script>alert('添加失败');window.location.href='../controllers/CustomerController.php?action=home';</script>";
            }
        }
        break;
    // 新增：批量更新购物车（支持修改数量或删除，即数量设为0时删除）
    case 'update_cart':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $cart_item_ids = $_POST['cart_item_id']; // 数组
            $quantities = $_POST['quantity']; // 数组
            $success = true;
            for($i = 0; $i < count($cart_item_ids); $i++){
                $cart_item_id = intval($cart_item_ids[$i]);
                $quantity = intval($quantities[$i]);
                if($quantity < 1){
                    $result = Cart::removeFromCart($cart_item_id);
                } else {
                    $result = Cart::updateCartItem($cart_item_id, $quantity);
                }
                if(!$result) {
                    $success = false;
                }
            }
            if($success){
                echo "<script>alert('更新成功');window.location.href='../controllers/CustomerController.php?action=cart';</script>";
            } else {
                echo "<script>alert('更新失败');window.location.href='../controllers/CustomerController.php?action=cart';</script>";
            }
        }
        break;
    // 新增：删除购物车中的单个商品
    case 'remove_from_cart':
        if(isset($_GET['id'])){
            $cart_item_id = intval($_GET['id']);
            $result = Cart::removeFromCart($cart_item_id);
            if($result){
                echo "<script>alert('删除成功');window.location.href='../controllers/CustomerController.php?action=cart';</script>";
            } else {
                echo "<script>alert('删除失败');window.location.href='../controllers/CustomerController.php?action=cart';</script>";
            }
        }
        break;

    default:
        include __DIR__ . '/../views/customer/home.php';
        break;
}
?>
