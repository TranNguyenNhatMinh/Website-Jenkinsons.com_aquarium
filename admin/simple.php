<?php
/**
 * Simple Admin Test - Không có requireAdmin để test
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/auth.php';

echo "<h1>Simple Admin Test</h1>";
echo "<style>body { font-family: Arial; padding: 20px; }</style>";

echo "<h2>Session Info:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>isLoggedIn(): " . (isLoggedIn() ? 'YES' : 'NO') . "</h2>";
echo "<h2>isAdmin(): " . (isAdmin() ? 'YES' : 'NO') . "</h2>";

if (isLoggedIn()) {
    $user = getCurrentUser();
    echo "<h2>User Info:</h2>";
    echo "<pre>";
    print_r($user);
    echo "</pre>";
    
    if ($user['role'] === 'admin' || isAdmin()) {
        echo "<h2 style='color: green;'>✅ Bạn là ADMIN! Có thể vào trang admin.</h2>";
        echo "<p><a href='index.php'>Vào Admin Dashboard</a></p>";
    } else {
        echo "<h2 style='color: red;'>❌ Bạn KHÔNG phải admin.</h2>";
        echo "<p>Role trong database: <strong>" . htmlspecialchars($user['role']) . "</strong></p>";
        echo "<p>Role trong session: <strong>" . htmlspecialchars($_SESSION['role'] ?? 'not set') . "</strong></p>";
        echo "<p><a href='../make_admin.php'>Set thành admin</a></p>";
    }
} else {
    echo "<h2 style='color: red;'>❌ Bạn chưa đăng nhập!</h2>";
    echo "<p><a href='../login.php'>Đăng nhập</a></p>";
}

echo "<hr>";
echo "<p><a href='../index.php'>Về trang chủ</a></p>";
?>
