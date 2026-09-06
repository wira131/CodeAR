<?php
$host = "127.0.0.1"; // หรือ "localhost"
$dbname = "webar";   // ชื่อฐานข้อมูลตามในภาพ
$username = "root";  // Username เริ่มต้นของ phpMyAdmin ในเครื่องจำลอง (เช่น XAMPP)
$password = "";      // รหัสผ่านเริ่มต้นมักจะปล่อยว่างไว้

try {
    // สร้างการเชื่อมต่อด้วย PDO (PHP Data Objects)
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // กำหนดให้ PDO แจ้งเตือนเมื่อเกิด Error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // ทดสอบการเชื่อมต่อ (เอาคอมเมนต์ออกเพื่อทดสอบได้)
    // echo "เชื่อมต่อฐานข้อมูลสำเร็จ!";
    
} catch(PDOException $e) {
    // กรณีที่เชื่อมต่อไม่ได้ ให้แสดงข้อความแจ้งเตือน
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>