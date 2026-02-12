<?php
/**
 * Admin Sidebar - Include này cho tất cả trang admin
 */
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<div class="admin-sidebar">
    <div class="admin-sidebar-header">
        <h4>Admin Panel</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page === 'index' ? 'active' : ''; ?>" href="index.php">
                <i class="fa-solid fa-chart-line"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page === 'products' ? 'active' : ''; ?>" href="products.php">
                <i class="fa-solid fa-box"></i>Sản phẩm
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page === 'orders' || $current_page === 'order_detail' ? 'active' : ''; ?>" href="orders.php">
                <i class="fa-solid fa-shopping-cart"></i>Đơn hàng
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page === 'categories' ? 'active' : ''; ?>" href="categories.php">
                <i class="fa-solid fa-folder"></i>Danh mục
            </a>
        </li>
        <li class="nav-item" style="margin-top: 1rem;">
            <a class="nav-link" href="../index.php">
                <i class="fa-solid fa-home"></i>Về trang chủ
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../logout.php">
                <i class="fa-solid fa-sign-out-alt"></i>Đăng xuất
            </a>
        </li>
    </ul>
</div>
