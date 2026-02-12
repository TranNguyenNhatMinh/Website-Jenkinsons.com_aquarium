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

// Xử lý đăng ký
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Debug mode
    $debug_mode = isset($_GET['debug']);
    
    if ($debug_mode) {
        echo "<pre>POST data: ";
        print_r($_POST);
        echo "</pre>";
    }
    
    $username = sanitize($_POST['username'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $full_name = sanitize($_POST['full_name'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    
    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill in all required fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Password confirmation does not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address';
    } else {
        // Call register function
        $result = register($username, $email, $password, $full_name, $phone);
        
        if ($result['success']) {
            if (!isset($_GET['test'])) {
                header('Location: index.php');
                exit();
            } else {
                $success = 'Registration successful! (Test mode - no redirect)';
            }
        } else {
            if (strpos($result['message'], 'đã tồn tại') !== false || strpos($result['message'], 'already exists') !== false) {
                $error = 'Username or email already exists';
            } else {
                $error = 'Registration failed. Please try again.';
            }
            // Log error
            error_log("Registration error: " . $result['message']);
            
            if ($debug_mode) {
                $error .= "<br><small style='color: #666;'>Debug: " . htmlspecialchars($result['message']) . "</small>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Jenkinson's Aquarium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-page auth-register">
    <?php include 'includes/header.php'; ?>
    
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="auth-bar">
                        <div class="auth-bar-right">
                            <h3>Create account</h3>
                            <div class="subtitle-small">Fill in your information to get started</div>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger">
                                    <i class="fa-solid fa-exclamation-circle"></i>
                                    <span><?php echo htmlspecialchars($error); ?></span>
                                    <?php if (isset($_GET['debug'])): ?>
                                        <br><small>Debug: Check PHP error log</small>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span><?php echo htmlspecialchars($success); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_GET['test'])): ?>
                                <div class="alert alert-info">
                                    <i class="fa-solid fa-info-circle"></i>
                                    <span>Test mode: form will not redirect.</span>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="" id="registerForm" class="auth-form">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Min. 6 characters" required minlength="6">
                                        <small class="text-muted">Minimum 6 characters</small>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="confirm_password" class="form-label">Confirm password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="full_name" class="form-label">Full name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full name">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number">
                                    </div>
                                </div>
                                <button type="submit" name="register" class="auth-btn">Create account</button>
                            </form>

                            <div class="auth-footer">
                                <p class="mb-0">Already have an account? <a href="login.php" class="auth-link">Sign in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Debug: Log form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            console.log('Form submitting...');
            console.log('Username:', document.getElementById('username').value);
            console.log('Email:', document.getElementById('email').value);
        });
    </script>
</body>
</html>
