<?php
/**
 * Fix Admin Password - Hash lại password admin
 * Chạy file này một lần để hash lại password admin
 */

require_once 'database/config.php';

echo "<h2>Fix Admin Password</h2>";

$conn = getDBConnection();

// Hash password mới cho admin
$new_password = 'admin123'; // Password mới
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

echo "<p>Hashing password: <strong>$new_password</strong></p>";
echo "<p>Hashed: <code>" . substr($hashed_password, 0, 50) . "...</code></p>";

// Update password cho admin
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
$stmt->bind_param("s", $hashed_password);

if ($stmt->execute()) {
    echo "<p style='color: green;'>✅ Password đã được hash thành công!</p>";
    echo "<p>Bạn có thể đăng nhập với:</p>";
    echo "<ul>";
    echo "<li>Username: <strong>admin</strong></li>";
    echo "<li>Password: <strong>$new_password</strong></li>";
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ Lỗi: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();

echo "<hr>";
echo "<p><a href='login.php'>Đi đến trang đăng nhập</a></p>";
?>
