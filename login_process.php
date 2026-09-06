<?php
session_start();
require_once 'config.php'; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // ค้นหา username และรหัสผ่านในฐานข้อมูล 
        // (หมายเหตุ: ใช้การเช็คแบบตรงๆ เพราะก่อนหน้านี้คุณบันทึกรหัส '123456789' ลงไปแบบ Plain-text)
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password_hash = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // กรณี: ล็อกอินสำเร็จ
            $_SESSION['username'] = $username; // เก็บ session ไว้ใช้งาน
            
            // สั่งให้เปลี่ยนหน้าไปยัง home.html
            header("Location: home.html");
            exit();
        } else {
            // กรณี: ล็อกอินไม่ผ่าน (Username หรือ Password ผิด)
            // จะแสดง Alert แจ้งเตือน และเด้งกลับไปหน้า login.html
            echo "<script>
                    alert('Username หรือ Password ไม่ถูกต้อง! กรุณาลองใหม่อีกครั้ง');
                    window.location.href = 'login.html';
                  </script>";
            exit();
        }
    } catch(PDOException $e) {
        die("เกิดข้อผิดพลาด: " . $e->getMessage());
    }
}
?>