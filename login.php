<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';

// Redirect nếu đã đăng nhập
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please fill in all required fields';
    } else {
        $result = login($username, $password);
        if ($result['success']) {
            if ($result['role'] === 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            $error = 'Invalid username or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Jenkinson's Aquarium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-page">
    <?php include 'includes/header.php'; ?>
    
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="auth-bar">
                        <div class="auth-bar-right">
                            <h3>Sign in</h3>
                            <div class="subtitle-small">Enter your credentials to continue</div>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger">
                                    <i class="fa-solid fa-exclamation-circle"></i>
                                    <span><?php echo htmlspecialchars($error); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span><?php echo htmlspecialchars($success); ?></span>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="" class="auth-form">
                                <div class="mb-4">
                                    <label for="username" class="form-label">Username or Email</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username or email" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>
                                <button type="submit" name="login" class="auth-btn">Sign in</button>
                            </form>

                            <div class="auth-footer">
                                <p class="mb-0">Don't have an account? <a href="register.php" class="auth-link">Sign up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
