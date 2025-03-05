<?php
// models/Order.php
require_once __DIR__ . '/../config.php';

class Order {
    // 创建订单记录，返回新订单ID；total_amount 为订单总金额
    public static function createOrder($user_id, $total_amount, $card_number, $card_ccv, $card_expiration) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, card_number, card_ccv, card_expiration) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("idsss", $user_id, $total_amount, $card_number, $card_ccv, $card_expiration);
        if(!$stmt->execute()){
            $stmt->close();
            $conn->close();
            return false;
        }
        $order_id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        return $order_id;
    }

    // 添加订单详情记录
    public static function addOrderItem($order_id, $product_id, $quantity, $price) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 获取当前用户的所有订单
    public static function getOrdersByUser($user_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = array();
        while($row = $result->fetch_assoc()){
            $orders[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $orders;
    }
    
    // 获取订单详情（包括订单项及产品部分信息）
    public static function getOrderItems($order_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT oi.*, p.model, p.type FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id = ?");
        $stmt->bind_param("i", $order_id);
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
    
    // 获取单个订单信息
    public static function getOrderById($order_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $order;
    }

    // 管理员：获取所有订单
    public static function getAllOrders() {
        $conn = getDBConnection();
        $result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
        $orders = array();
        while($row = $result->fetch_assoc()){
            $orders[] = $row;
        }
        $conn->close();
        return $orders;
    }

    // 管理员：更新订单状态
    public static function updateOrderStatus($order_id, $order_status) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $order_status, $order_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 管理员：删除订单（订单详情会自动删除）
    public static function deleteOrder($order_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
