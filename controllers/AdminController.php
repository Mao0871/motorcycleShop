<?php
// controllers/AdminController.php
// 后台管理相关操作控制器
session_start();
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

// 检查管理员权限
if(!isset($_SESSION['user']) || $_SESSION['user']['user_type'] != 'admin') {
    echo "<script>alert('没有权限访问该页面，请先登录管理员账户');window.location.href='../views/login.php';</script>";
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

switch($action) {
    case 'dashboard':
        include __DIR__ . '/../views/admin/dashboard.php';
        break;
    // 用户管理
    case 'users':
        $users = User::getAllUsers();
        include __DIR__ . '/../views/admin/users.php';
        break;
    case 'edit_user':
        $user_id = $_GET['id'];
        $userData = User::getUserById($user_id);
        include __DIR__ . '/../views/admin/edit_user.php';
        break;
    case 'update_user':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user_id = $_POST['user_id'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $user_type = $_POST['user_type'];
            $result = User::updateUser($user_id, $nickname, $email, $user_type);
            if($result){
                echo "<script>alert('用户信息更新成功');window.location.href='../controllers/AdminController.php?action=users';</script>";
            } else {
                echo "<script>alert('更新失败');window.location.href='../controllers/AdminController.php?action=users';</script>";
            }
        }
        break;
    case 'delete_user':
        $user_id = $_GET['id'];
        $result = User::deleteUser($user_id);
        if($result){
            echo "<script>alert('用户删除成功');window.location.href='../controllers/AdminController.php?action=users';</script>";
        } else {
            echo "<script>alert('删除失败');window.location.href='../controllers/AdminController.php?action=users';</script>";
        }
        break;
    // 商品管理
    case 'products':
        $products = Product::getAllProducts();
        include __DIR__ . '/../views/admin/products.php';
        break;
    case 'edit_product':
        $product_id = $_GET['id'];
        $product = Product::getProductById($product_id);
        $categories = Category::getAllCategories();
        include __DIR__ . '/../views/admin/edit_product.php';
        break;

    case 'update_product':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $product_id = $_POST['product_id'];
            $model = $_POST['model'];
            $category_id = $_POST['category_id'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            $engine_power = $_POST['engine_power'];
            $description = $_POST['description'];
            $stock = $_POST['stock'];
        
            $upload_dir = "../uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
        
            $image_url = $_POST['current_image']; // 默认使用当前图片
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_file = $upload_dir . basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = "uploads/" . basename($_FILES["image"]["name"]);
                }
            }
        
            $result = Product::updateProduct($product_id, $model, $category_id, $type, $image_url, $price, $engine_power, $description, $stock);
            if($result){
                echo "<script>alert('产品更新成功');window.location.href='../controllers/AdminController.php?action=products';</script>";
            } else {
                echo "<script>alert('更新失败');window.location.href='../controllers/AdminController.php?action=products';</script>";
            }
        }
        break;
        

    case 'delete_product':
        $product_id = $_GET['id'];
        // 先获取产品信息，获取图片路径
        $product = Product::getProductById($product_id);
        if ($product && !empty($product['image_url'])) {
            // 拼接图片在本地文件系统中的实际路径
            $image_path = "../" . $product['image_url']; // image_url 存储的是相对路径，如 "uploads/xxx.jpg"
            if (file_exists($image_path)) {
                // 删除本地图片
                unlink($image_path);
            }
        }
            // 再删除数据库中的产品记录
        $result = Product::deleteProduct($product_id);
        if($result){
            echo "<script>alert('产品删除成功');window.location.href='../controllers/AdminController.php?action=products';</script>";
        } else {
            echo "<script>alert('删除失败');window.location.href='../controllers/AdminController.php?action=products';</script>";
        }
        break;
        

    case 'create_product':
        $categories = Category::getAllCategories();
        include __DIR__ . '/../views/admin/create_product.php';
        break;
    case 'store_product':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $model = $_POST['model'];
            $category_id = $_POST['category_id'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            $engine_power = $_POST['engine_power'];
            $description = $_POST['description'];
            $stock = $_POST['stock'];

            $upload_dir = "../uploads/";
             // 检查目录是否存在，不存在则创建
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $image_url = "";
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = "uploads/" . basename($_FILES["image"]["name"]);
                }
            }
            if(empty($category_id)){
                echo "<script>alert('请选择一个分类');window.location.href='../controllers/AdminController.php?action=create_product';</script>";
                exit();
            }
            $result = Product::createProduct($model, $category_id, $type, $image_url, $price, $engine_power, $description, $stock);
            if($result){
                echo "<script>alert('产品创建成功');window.location.href='../controllers/AdminController.php?action=products';</script>";
            } else {
                echo "<script>alert('创建失败');window.location.href='../controllers/AdminController.php?action=create_product';</script>";
            }
        }
        break;
    // 类别管理
    case 'categories':
        $categories = Category::getAllCategories();
        include __DIR__ . '/../views/admin/categories.php';
        break;
    case 'edit_category':
        $category_id = $_GET['id'];
        $category = Category::getCategoryById($category_id);
        include __DIR__ . '/../views/admin/edit_category.php';
        break;
    case 'update_category':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $category_id = $_POST['category_id'];
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];
            $result = Category::updateCategory($category_id, $category_name, $description);
            if($result){
                echo "<script>alert('类别更新成功');window.location.href='../controllers/AdminController.php?action=categories';</script>";
            } else {
                echo "<script>alert('更新失败');window.location.href='../controllers/AdminController.php?action=categories';</script>";
            }
        }
        break;

    case 'delete_category':
        $category_id = $_GET['id'];
        // 先检查该类别是否被产品引用
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM products WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
            
        if ($row['count'] > 0) {
            // 如果存在关联产品，则不允许删除
            echo "<script>alert('无法删除该类别，因为存在相关产品。');window.location.href='../controllers/AdminController.php?action=categories';</script>";
            exit();
        }
            
            // 如果没有关联产品，则调用删除操作
        $result = Category::deleteCategory($category_id);
        if($result){
            echo "<script>alert('类别删除成功');window.location.href='../controllers/AdminController.php?action=categories';</script>";
        } else {
            echo "<script>alert('删除失败');window.location.href='../controllers/AdminController.php?action=categories';</script>";
        }
        break;
        
    case 'create_category':
        include __DIR__ . '/../views/admin/create_category.php';
        break;
    case 'store_category':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];
            $result = Category::createCategory($category_name, $description);
            if($result){
                echo "<script>alert('类别创建成功');window.location.href='../controllers/AdminController.php?action=categories';</script>";
            } else {
                echo "<script>alert('创建失败');window.location.href='../controllers/AdminController.php?action=create_category';</script>";
            }
        }
        break;
    default:
        include __DIR__ . '/../views/admin/dashboard.php';
        break;
}
?>
