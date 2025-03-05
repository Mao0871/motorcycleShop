<?php
// models/Cart.php
// 购物车模型：操作 cart_items 表
require_once __DIR__ . '/../config.php';

class Cart {
    // 获取当前用户购物车内的所有商品（同时关联产品数据）
    public static function getCartItems($user_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT c.cart_item_id, c.product_id, c.quantity, p.model, p.price, p.image_url 
                                FROM cart_items c 
                                JOIN products p ON c.product_id = p.product_id 
                                WHERE c.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = array();
        while($row = $result->fetch_assoc()){
            $items[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $items;
    }

    // 添加商品到购物车：如果已存在则增加数量，否则插入新记录
    public static function addToCart($user_id, $product_id, $quantity) {
        $conn = getDBConnection();
        // 检查该用户购物车中是否已经有该产品
        $stmt = $conn->prepare("SELECT cart_item_id, quantity FROM cart_items WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()){
            // 更新数量
            $new_quantity = $row['quantity'] + $quantity;
            $stmt->close();
            $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?");
            $stmt->bind_param("ii", $new_quantity, $row['cart_item_id']);
            $result_update = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $result_update;
        } else {
            // 插入新记录
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity, added_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);
            $result_insert = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $result_insert;
        }
    }

    // 更新购物车中指定记录的数量
    public static function updateCartItem($cart_item_id, $quantity) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?");
        $stmt->bind_param("ii", $quantity, $cart_item_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 删除购物车中指定记录
    public static function removeFromCart($cart_item_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_item_id = ?");
        $stmt->bind_param("i", $cart_item_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
