<?php
require_once "../config/db.php";
require_once "../entity/User.php";

class UserDAL {

    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // Kiểm tra username đã tồn tại chưa
    public function checkUserExists($username) {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return [false, "Lỗi chuẩn bị truy vấn: " . $this->conn->error];
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return [$result->num_rows > 0, null];
    }

    // Đăng ký user
    public function registerUser(User $user) {
        $sql = "INSERT INTO users (username, password, phone, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return [false, "Lỗi chuẩn bị truy vấn: " . $this->conn->error];
        }

        $stmt->bind_param("ssss", 
            $user->username, 
            $user->password, 
            $user->phone, 
            $user->email
        );

        if (!$stmt->execute()) {
            return [false, "Lỗi thực thi SQL: " . $stmt->error];
        }

        return [true, null];
    }
}
