<?php
// config.php：数据库配置文件
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');        // 如有密码，请填写
define('DB_NAME', 'motorcycle');

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
         die("数据库连接失败: " . $conn->connect_error);
    }
    return $conn;
}
?>
