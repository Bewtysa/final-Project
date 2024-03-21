<?php
 session_start();

 require_once '../config/bd.php';
     if (!isset($_SESSION['admin_login'])) {
     $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
     header('location: login.php');
   

   }

   if (isset($_GET['delete'])) {
     $delete_id = $_GET['delete'];
     $deletestmt = $conn->query("DELETE FROM booking WHERE id = $delete_id");
     $deletestmt->execute();

     if ($deletestmt) {
         echo "<script>alert('Data has been deleted successfully');</script>";
         $_SESSION['success'] = "Data has been deleted succesfully";
         header("refresh:1; url=admin.php");
     }
     
 
// ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่าค่า booking_id และ homestay_name ถูกส่งมาหรือไม่
    if (isset($_POST['booking_id']) && isset($_POST['homestay_name'])) {
        // เชื่อมต่อกับฐานข้อมูล (ใช้ตัวแปร $conn จากโค้ดเดิม)

        // ดึงข้อมูลที่ส่งมาจากฟอร์ม
        $booking_id = $_POST['booking_id'];
        $homestay_name = $_POST['homestay_name'];

        // ทำการบันทึกข้อมูลลงในตาราง "homestay"
        $stmt = $conn->prepare("INSERT INTO homestay (homestay_name) VALUES (?)");
        $stmt->bind_param("s", $homestay_name);
        if ($stmt->execute()) {
            // บันทึกสำเร็จ
            $homestay_id = $stmt->insert_id; // รับค่า ID ที่เพิ่มล่าสุด
            // อัปเดตคอลัมน์ homestay_id ในตาราง booking
            $stmt = $conn->prepare("UPDATE booking SET homestay_id = ? WHERE id = ?");
            $stmt->bind_param("ii", $homestay_id, $booking_id);
            if ($stmt->execute()) {
                // บันทึกสำเร็จ
                header("Location: view_user.php?id=" . $booking_id); // พากลับไปยังหน้าแสดงข้อมูลการจอง
            } else {
                // บันทึกไม่สำเร็จ
                echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูลการจอง";
            }
        } else {
            // บันทึกไม่สำเร็จ
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูลบ้าน";
        }
    }
}
   }
?>
