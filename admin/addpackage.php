<?php
// เชื่อมต่อกับฐานข้อมูล
require_once '../config/bd.php';

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากฟอร์ม
    $Pname = $_POST['Pname'];
    $Pname_eng = $_POST['Pname_eng'];
    $Pday = $_POST['Pday'];
    $Pprice = $_POST['Pprice'];

    // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลแพ็กเกจ
    $sql = "INSERT INTO package (Pname, Pname_eng, Pday, Pprice) VALUES (:Pname, :Pname_eng, :Pday, :Pprice)";

    // เตรียมคำสั่ง SQL สำหรับการเตรียมข้อมูล
    $stmt = $conn->prepare($sql);

    // ผูกค่าพารามิเตอร์กับตัวแปร
    $stmt->bindParam(':Pname', $Pname);
    $stmt->bindParam(':Pname_eng', $Pname_eng);
    $stmt->bindParam(':Pday', $Pday);
    $stmt->bindParam(':Pprice', $Pprice);

    // ทำการ execute คำสั่ง SQL
    if ($stmt->execute()) {
        // หากสำเร็จให้ redirect ไปยังหน้าที่ต้องการ
        header('Location: admin.php');
        exit;
    } else {
        // หากไม่สำเร็จให้แสดงข้อความผิดพลาด
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>