<?php
// models/Product.php
require_once __DIR__ . '/../config.php';

class Product {
    // 获取所有产品数据
    public static function getAllProducts() {
        $conn = getDBConnection();
        $result = $conn->query("SELECT * FROM products");
        $products = array();
        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }
        $conn->close();
        return $products;
    }

    // 根据类别ID获取产品数据
    public static function getProductsByCategory($category_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = array();
        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $products;
    }

    // 根据产品ID获取单个产品数据
    public static function getProductById($product_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $product;
    }

    // 更新产品信息，包括图片路径
    public static function updateProduct($product_id, $model, $category_id, $type, $image_url, $price, $engine_power, $description, $stock) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("UPDATE products SET model = ?, category_id = ?, type = ?, image_url = ?, price = ?, engine_power = ?, description = ?, stock = ? WHERE product_id = ?");
        $stmt->bind_param("sissdssii", $model, $category_id, $type, $image_url, $price, $engine_power, $description, $stock, $product_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 删除产品
    public static function deleteProduct($product_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 创建新产品，同时存储图片的 URL
    public static function createProduct($model, $category_id, $type, $image_url, $price, $engine_power, $description, $stock) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO products (model, category_id, type, image_url, price, engine_power, description, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissdssi", $model, $category_id, $type, $image_url, $price, $engine_power, $description, $stock);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
