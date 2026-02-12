<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

requireAdmin();

// Lấy thống kê
$conn = getDBConnection();

// Tổng số đơn hàng
$result = $conn->query("SELECT COUNT(*) as total FROM orders");
$total_orders = $result->fetch_assoc()['total'];

// Tổng doanh thu
$result = $conn->query("SELECT SUM(total_amount) as total FROM orders WHERE payment_status = 'paid'");
$total_revenue = $result->fetch_assoc()['total'] ?? 0;

// Tổng số sản phẩm
$result = $conn->query("SELECT COUNT(*) as total FROM products");
$total_products = $result->fetch_assoc()['total'];

// Tổng số user
$result = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'customer'");
$total_users = $result->fetch_assoc()['total'];

// Đơn hàng gần đây
$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 10");
$recent_orders = [];
while ($row = $result->fetch_assoc()) {
    $recent_orders[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Jenkinson's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-page">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'includes/sidebar.php'; ?>
            
            <!-- Main Content -->
            <div class="admin-content">
                <div class="admin-header">
                    <h2><i class="fa-solid fa-chart-line me-2"></i>Dashboard</h2>
                </div>
                
                <!-- Statistics -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card primary">
                            <div class="stat-card-icon">
                                <i class="fa-solid fa-shopping-cart"></i>
                            </div>
                            <h5>Tổng đơn hàng</h5>
                            <h2><?php echo $total_orders; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card success">
                            <div class="stat-card-icon">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                            <h5>Doanh thu</h5>
                            <h2><?php echo formatCurrency($total_revenue); ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card warning">
                            <div class="stat-card-icon">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <h5>Sản phẩm</h5>
                            <h2><?php echo $total_products; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card danger">
                            <div class="stat-card-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h5>Khách hàng</h5>
                            <h2><?php echo $total_users; ?></h2>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders -->
                <div class="admin-table">
                    <div class="card-header" style="padding: 1.5rem; background: white; border-bottom: 2px solid #f0f0f0;">
                        <h5 style="margin: 0; font-weight: 700; color: #1e3a5f;">
                            <i class="fa-solid fa-clock me-2"></i>Đơn hàng gần đây
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_orders as $order): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($order['order_number']); ?></td>
                                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                                            <td><?php echo formatCurrency($order['total_amount']); ?></td>
                                            <td>
                                                <span class="badge bg-warning"><?php 
                                                    $status_labels = ['pending' => 'Chờ xử lý', 'processing' => 'Đang xử lý', 'shipped' => 'Đã giao hàng', 'delivered' => 'Đã nhận hàng', 'cancelled' => 'Đã hủy'];
                                                    echo $status_labels[$order['order_status']] ?? $order['order_status'];
                                                ?></span>
                                            </td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                            <td>
                                                <a href="order_detail.php?id=<?php echo $order['order_id']; ?>" class="admin-btn admin-btn-primary admin-btn-sm">
                                                    <i class="fa-solid fa-eye me-1"></i>Xem
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
