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
        
    }

      

?>
<!-- add_house.php -->
<form method="post" action="save_house.php">
    <input type="hidden" name="booking_id" value="<?php echo $_GET['id']; ?>">
    <label for="homestay_name">ชื่อบ้าน:</label>
    <input type="text" name="homestay_name" id="homestay_name">
    <!-- เพิ่มฟิลด์อื่น ๆ ตามความต้องการ -->
    <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
