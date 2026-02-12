<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

requireAdmin();

$order_id = intval($_GET['id'] ?? 0);

if (!$order_id) {
    header('Location: orders.php');
    exit();
}

$conn = getDBConnection();
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$order) {
    header('Location: orders.php');
    exit();
}

$order_items = getOrderItems($order_id);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-page">
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/sidebar.php'; ?>
            
            <div class="admin-content">
                <div class="admin-header">
                    <h2><i class="fa-solid fa-file-invoice me-2"></i>Chi tiết đơn hàng #<?php echo htmlspecialchars($order['order_number']); ?></h2>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_items as $item): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                                <td><?php echo formatCurrency($item['product_price']); ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                                <td><?php echo formatCurrency($item['subtotal']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Thông tin đơn hàng</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="orders.php">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái đơn hàng</label>
                                        <select name="order_status" class="form-select">
                                            <option value="pending" <?php echo $order['order_status'] == 'pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                                            <option value="processing" <?php echo $order['order_status'] == 'processing' ? 'selected' : ''; ?>>Đang xử lý</option>
                                            <option value="shipped" <?php echo $order['order_status'] == 'shipped' ? 'selected' : ''; ?>>Đã giao hàng</option>
                                            <option value="delivered" <?php echo $order['order_status'] == 'delivered' ? 'selected' : ''; ?>>Đã nhận hàng</option>
                                            <option value="cancelled" <?php echo $order['order_status'] == 'cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái thanh toán</label>
                                        <select name="payment_status" class="form-select">
                                            <option value="pending" <?php echo $order['payment_status'] == 'pending' ? 'selected' : ''; ?>>Chờ thanh toán</option>
                                            <option value="paid" <?php echo $order['payment_status'] == 'paid' ? 'selected' : ''; ?>>Đã thanh toán</option>
                                            <option value="failed" <?php echo $order['payment_status'] == 'failed' ? 'selected' : ''; ?>>Thất bại</option>
                                            <option value="refunded" <?php echo $order['payment_status'] == 'refunded' ? 'selected' : ''; ?>>Đã hoàn tiền</option>
                                        </select>
                                    </div>
                                    
                                    <button type="submit" name="update_status" class="admin-btn admin-btn-primary w-100">
                                        <i class="fa-solid fa-save me-2"></i>Cập nhật
                                    </button>
                                </form>
                                
                                <hr>
                                
                                <p><strong>Mã đơn:</strong> <?php echo htmlspecialchars($order['order_number']); ?></p>
                                <p><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                                <p><strong>Tạm tính:</strong> <?php echo formatCurrency($order['subtotal']); ?></p>
                                <p><strong>Thuế:</strong> <?php echo formatCurrency($order['tax']); ?></p>
                                <p><strong>Phí vận chuyển:</strong> <?php echo formatCurrency($order['shipping_fee']); ?></p>
                                <hr>
                                <p><strong>Tổng cộng:</strong> <?php echo formatCurrency($order['total_amount']); ?></p>
                                
                                <h6 class="mt-3">Thông tin khách hàng:</h6>
                                <p><strong>Tên:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($order['customer_email']); ?></p>
                                <p><strong>Điện thoại:</strong> <?php echo htmlspecialchars($order['customer_phone']); ?></p>
                                <p><strong>Địa chỉ:</strong><br><?php echo nl2br(htmlspecialchars($order['customer_address'])); ?></p>
                                
                                <?php if ($order['notes']): ?>
                                    <h6 class="mt-3">Ghi chú:</h6>
                                    <p><?php echo nl2br(htmlspecialchars($order['notes'])); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="orders.php" class="admin-btn admin-btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
