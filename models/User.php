<?php
// models/User.php
//注册与登录方法外，后台管理需要的获取所有用户、按ID查询、更新（不修改密码）和删除的功能。
require_once __DIR__ . '/../config.php';

class User {
    // 注册用户（仅允许普通用户注册）
    public static function register($nickname, $email, $password) {
        $conn = getDBConnection();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // 密码加密
        $user_type = 'customer'; // 只注册普通用户
        $stmt = $conn->prepare("INSERT INTO users (nickname, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nickname, $email, $hashed_password, $user_type);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 用户登录验证
    public static function login($email, $password) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT user_id, nickname, email, password, user_type FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $nickname, $email, $hashed_password, $user_type);
            $stmt->fetch();
            if(password_verify($password, $hashed_password)) {
                $stmt->close();
                $conn->close();
                return array(
                    'user_id'   => $user_id,
                    'nickname'  => $nickname,
                    'email'     => $email,
                    'user_type' => $user_type
                );
            }
        }
        $stmt->close();
        $conn->close();
        return false;
    }

    // 获取所有用户
    public static function getAllUsers() {
        $conn = getDBConnection();
        $result = $conn->query("SELECT user_id, nickname, email, user_type FROM users");
        $users = array();
        while($row = $result->fetch_assoc()){
            $users[] = $row;
        }
        $conn->close();
        return $users;
    }

    // 通过用户ID获取用户信息
    public static function getUserById($user_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT user_id, nickname, email, user_type FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $user;
    }

    // 更新用户信息（不修改密码）
    public static function updateUser($user_id, $nickname, $email, $user_type) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("UPDATE users SET nickname = ?, email = ?, user_type = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $nickname, $email, $user_type, $user_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // 删除用户
    public static function deleteUser($user_id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
