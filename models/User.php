<?php
// models/User.php
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
}
?>
