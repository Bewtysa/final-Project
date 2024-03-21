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
    

// ดึงข้อมูลการจองและข้อมูลบ้านที่เก็บในตาราง "booking" และ "homestay"
$stmt = $conn->prepare("SELECT booking.*, homestay.homestay_name FROM booking LEFT JOIN homestay ON booking.homestay_id = homestay.id");
$stmt->execute();
$bookings = $stmt->fetchAll();

if (!$bookings) {
    echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
} else {
    foreach($bookings as $booking)  {  
        ?>
        <tr>
            <th scope="row"><?php echo $booking['id']; ?></th>
            <td><?php echo $booking['name']; ?></td>
            <td><?php echo $booking['phone']; ?></td>
            <td><?php echo $booking['guest']; ?></td>
            <td><?php echo $booking['checkin']; ?></td>
            <td class="td text-center">
                <?php
                if ($booking['package'] == '2200') {
                    echo "2 วัน 1 คืน";
                } else if ($booking['package'] == '500') {
                    echo "ไปกลับ";
                }
                if ($booking['package'] == '3500') {
                    echo "3 วัน 2 คืน";
                }
                ?>
            </td>
            <td><?php echo $booking['total']; ?></td>
            <td width="120px"><img class="rounded" width="100%" src="../uploads/<?php echo $booking['img']; ?>" alt=""></td>
            <td><?php echo $booking['homestay_name']; ?></td>
            <td>
                <a href="../admin/edit.php?id=<?php echo $booking['id']; ?>" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        <?php
    }
}
  }

?>