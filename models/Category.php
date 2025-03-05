<?php
// models/Category.php
//类别模型提供获取所有类别、按ID查询、更新、删除和创建类别的方法。
require_once __DIR__ . '/../config.php';

class Category {
    public static function getAllCategories() {
        $conn = getDBConnection();
        $result = $conn->query("SELECT * FROM categories");
        $categories = array();
        while($row = $result->fetch_assoc()){
            $categories[] = $row;
        }
        $conn->close();
        return $categories;
    }

    public static function getCategoryById($category_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $category;
    }

    public static function updateCategory($category_id, $category_name, $description) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("UPDATE categories SET category_name = ?, description = ? WHERE category_id = ?");
        $stmt->bind_param("ssi", $category_name, $description, $category_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function deleteCategory($category_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function createCategory($category_name, $description) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO categories (category_name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $category_name, $description);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
