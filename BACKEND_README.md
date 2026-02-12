da# Backend System - Hướng dẫn sử dụng

## Tổng quan

Hệ thống backend đã được tích hợp vào website với các tính năng:
- Đăng ký / Đăng nhập
- Quản lý giỏ hàng
- Đặt hàng và thanh toán
- Admin panel để quản lý sản phẩm, đơn hàng, danh mục

## Database

- **Database name:** `project_data`
- **File SQL:** `database/eproject2_database.sql` (đã import vào phpMyAdmin)
- **Config:** `database/config.php`

## Cấu trúc file

### Core Files
- `database/config.php` - Cấu hình kết nối database
- `includes/auth.php` - Authentication functions (login, register, logout)
- `includes/functions.php` - Helper functions (products, cart, orders)

### User Pages
- `login.php` - Trang đăng nhập
- `register.php` - Trang đăng ký
- `logout.php` - Đăng xuất
- `cart.php` - Giỏ hàng
- `checkout.php` - Thanh toán
- `order_success.php` - Xác nhận đơn hàng
- `my_orders.php` - Danh sách đơn hàng của user
- `order_detail.php` - Chi tiết đơn hàng
- `add_to_cart.php` - Thêm sản phẩm vào giỏ hàng (POST)

### Admin Panel
- `admin/index.php` - Dashboard
- `admin/products.php` - Quản lý sản phẩm
- `admin/orders.php` - Quản lý đơn hàng
- `admin/order_detail.php` - Chi tiết đơn hàng (admin)
- `admin/categories.php` - Quản lý danh mục

## Thông tin đăng nhập mặc định

### Admin Account:
- **Username:** `admin`
- **Password:** `admin123`
- ⚠️ **QUAN TRỌNG:** Đổi mật khẩu ngay sau khi đăng nhập!

## Cách sử dụng

### 1. Đăng ký tài khoản mới
- Vào `register.php`
- Điền thông tin và đăng ký
- Tự động đăng nhập sau khi đăng ký

### 2. Đăng nhập
- Vào `login.php`
- Nhập username/email và password
- Sau khi đăng nhập, admin sẽ được redirect đến `admin/index.php`
- User thường sẽ ở lại trang hiện tại hoặc về `index.php`

### 3. Thêm sản phẩm vào giỏ hàng
- Từ trang sản phẩm, submit form POST đến `add_to_cart.php`:
```html
<form method="POST" action="add_to_cart.php">
    <input type="hidden" name="product_id" value="1">
    <input type="hidden" name="quantity" value="1">
    <input type="hidden" name="redirect" value="current_page.php">
    <button type="submit">Thêm vào giỏ hàng</button>
</form>
```

### 4. Xem giỏ hàng
- Click vào icon giỏ hàng ở header
- Hoặc vào `cart.php`
- Có thể cập nhật số lượng hoặc xóa sản phẩm

### 5. Thanh toán
- Từ giỏ hàng, click "Thanh toán"
- Điền thông tin giao hàng
- Chọn phương thức thanh toán
- Submit để đặt hàng

### 6. Admin Panel
- Đăng nhập với tài khoản admin
- Truy cập `admin/index.php`
- Quản lý:
  - **Dashboard:** Xem thống kê tổng quan
  - **Sản phẩm:** Thêm/sửa/xóa sản phẩm
  - **Đơn hàng:** Xem và cập nhật trạng thái đơn hàng
  - **Danh mục:** Quản lý danh mục sản phẩm

## Tính năng bảo mật

- ✅ Password hashing với `password_hash()` / `password_verify()`
- ✅ Prepared statements để chống SQL injection
- ✅ Session management
- ✅ Input sanitization
- ✅ Role-based access control (admin vs customer)

## Lưu ý

1. **Session:** Giỏ hàng sử dụng session, sẽ mất khi đóng trình duyệt (có thể nâng cấp lưu vào database)
2. **File upload:** Hiện tại chỉ hỗ trợ URL ảnh, chưa có upload file
3. **Payment:** Chưa tích hợp gateway thanh toán thực tế
4. **Email:** Chưa có gửi email xác nhận đơn hàng

## Tích hợp vào trang hiện tại

Để thêm nút "Thêm vào giỏ hàng" vào trang sản phẩm (ví dụ Sweet Shop):

```php
<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
$products = getProductsByCategory(3); // Category ID 3 = Sweet Shop
?>

<?php foreach ($products as $product): ?>
    <div class="product-card">
        <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
        <p>Giá: <?php echo formatCurrency($product['price']); ?></p>
        
        <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="redirect" value="componets/sweet-shop.php">
            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
        </form>
    </div>
<?php endforeach; ?>
```

## Troubleshooting

### Lỗi kết nối database
- Kiểm tra XAMPP đã chạy MySQL
- Kiểm tra `database/config.php` có đúng thông tin
- Kiểm tra database `project_data` đã được tạo

### Session không hoạt động
- Đảm bảo `session_start()` được gọi ở đầu file
- Kiểm tra PHP session path có quyền ghi

### Không đăng nhập được
- Kiểm tra password đã được hash đúng chưa
- Kiểm tra username/email có tồn tại trong database

## Hỗ trợ

Nếu gặp vấn đề, kiểm tra:
1. PHP error logs
2. MySQL error logs
3. Browser console (F12)
4. Network tab để xem request/response
