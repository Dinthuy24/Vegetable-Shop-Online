<?php
require_once __DIR__ . '/../dal/UserDAL.php';
require_once __DIR__ . '/../entity/User.php';

function redirectError($msg) {
    header("Location: register.php?error=" . urlencode($msg));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";
    $confirm  = $_POST['confirm_password'] ?? "";
    $phone    = trim($_POST['phone'] ?? "");
    $email    = trim($_POST['email'] ?? "");

    // ---- VALIDATE ----
    if ($username === "" || $password === "" || $confirm === "" || $phone === "") {
        redirectError("Vui lòng nhập đầy đủ thông tin bắt buộc.");
    }

    if ($password !== $confirm) {
        redirectError("Mật khẩu nhập lại không khớp.");
    }

    if (!preg_match('/^(0[0-9]{9})$/', $phone)) {
        redirectError("Số điện thoại không hợp lệ (VD: 0912345678).");
    }

    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirectError("Email không hợp lệ.");
    }

    $dal = new UserDAL();

    // Kiểm tra trùng username
    [$exists, $err] = $dal->checkUserExists($username);
    if ($err) redirectError($err);
    if ($exists) redirectError("Tên tài khoản đã tồn tại.");

    // Hash mật khẩu
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Tạo user
    $user = new User($username, $password_hash, $phone, $email);

    // Đăng ký
    [$success, $err2] = $dal->registerUser($user);

    if (!$success) redirectError($err2);

    // Thành công -> chuyển sang trang thông báo
    header("Location: register_success.php");
    exit;
}
