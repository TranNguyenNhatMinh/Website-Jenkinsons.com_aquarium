# Hướng dẫn Import Database vào phpMyAdmin

## Bước 1: Mở phpMyAdmin
1. Khởi động XAMPP
2. Mở trình duyệt và vào: `http://localhost/phpmyadmin`
3. Đăng nhập (thường không cần password hoặc password là rỗng)

## Bước 2: Import Database
1. Click vào tab **"Import"** ở menu trên cùng
2. Click **"Choose File"** và chọn file: `database/eproject2_database.sql`
3. Để nguyên các tùy chọn mặc định
4. Click **"Go"** hoặc **"Import"**

## Bước 3: Kiểm tra
Sau khi import thành công, bạn sẽ thấy:
- Database: `eproject2_db`
- Các bảng: `users`, `categories`, `products`, `orders`, `order_items`, `cart`

## Thông tin đăng nhập mặc định

### Admin Account:
- **Username:** `admin`
- **Email:** `admin@eproject2.com`
- **Password:** `admin123` (⚠️ **QUAN TRỌNG:** Đổi mật khẩu ngay sau khi đăng nhập!)

## Cấu trúc Database

### 1. `users` - Người dùng
- Quản lý admin và customer
- Fields: user_id, username, email, password (hashed), role, status

### 2. `categories` - Danh mục
- Danh mục sản phẩm (Aquarium, Boardwalk, Sweet Shop)
- Fields: category_id, category_name, slug, description

### 3. `products` - Sản phẩm
- Sản phẩm/tickets/merchandise
- Fields: product_id, category_id, product_name, price, stock_quantity, image

### 4. `orders` - Đơn hàng
- Thông tin đơn hàng
- Fields: order_id, user_id, order_number, total_amount, order_status, payment_status

### 5. `order_items` - Chi tiết đơn hàng
- Sản phẩm trong mỗi đơn hàng
- Fields: item_id, order_id, product_id, quantity, product_price

### 6. `cart` - Giỏ hàng
- Giỏ hàng của user (hoặc có thể dùng session)
- Fields: cart_id, user_id, product_id, quantity

## Lưu ý bảo mật

1. **Đổi mật khẩu admin ngay sau khi import**
2. File `config.php` sẽ chứa thông tin kết nối database
3. Không commit file `config.php` lên Git nếu có thông tin nhạy cảm

## Cấu hình kết nối Database

Sửa file `database/config.php` với thông tin sau:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Mặc định XAMPP không có password
define('DB_NAME', 'eproject2_db');
?>
```
