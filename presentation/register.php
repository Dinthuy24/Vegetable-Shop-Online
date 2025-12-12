<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; }
        .container {
            width: 380px; margin: 40px auto; background: white;
            padding: 25px; border-radius: 6px; box-shadow: 0 0 12px #ccc;
        }
        h2 { text-align: center; color: #2a8a3a; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input {
            width: 100%; padding: 10px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        button {
            width: 100%; padding: 10px; background: #28a745; 
            color: white; border: none; border-radius: 4px; 
            margin-top: 15px; cursor: pointer;
        }
        .error {
            background: #ffdddd; border-left: 4px solid red;
            padding: 10px; margin-bottom: 10px; color: #c40000;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>ĐĂNG KÝ TÀI KHOẢN</h2>

    <!-- Hiển thị lỗi (nếu có) -->
    <?php if (isset($_GET['error'])): ?>
        <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="register_process.php" method="POST">

        <label>Tên tài khoản (*)</label>
        <input type="text" name="username" required>

        <label>Mật khẩu (*)</label>
        <input type="password" name="password" required>

        <label>Nhập lại mật khẩu (*)</label>
        <input type="password" name="confirm_password" required>

        <label>Số điện thoại (*)</label>
        <input type="text" name="phone" required>

        <label>Email</label>
        <input type="email" name="email">

        <button type="submit">ĐĂNG KÝ</button>
    </form>
</div>

</body>
</html>
