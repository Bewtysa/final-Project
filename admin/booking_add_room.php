<?php
require_once('../config/bd.php');

/*

echo $_POST['home1'].'*'.$_POST['home2'].'*'.$_POST['home3'].'*'.$_POST['home4'].'*'.$_POST['home5'].'*'.$_POST['home6'];

*/


if ($_SESSION == NULL) {
  header("location:../login");
  exit();
} elseif ($_SESSION["a_level"] != "admin" &&  $_SESSION["a_level"] != "system") {
  header("location:../index");
  exit();
}



if(isset($_POST["b_id"])) {
  $homestays = array(
    array('id' => 1, 'name' => 'บ้านแม่กาวี'),
    array('id' => 2, 'name' => 'บ้านแม่กองชัย'),
    array('id' => 3, 'name' => 'บ้านแม่สมบูรณ์'),
    array('id' => 4, 'name' => 'บ้านแม่จรีภรณ์'),
    array('id' => 5, 'name' => 'บ้านแม่ภัทราพร'),
    array('id' => 6, 'name' => 'บ้านแม่เจริญ')
  );
  $h = '';
  foreach($homestays as $key => $homestay) {
    $field_name = 'home' . $homestay['id'];
    $guest_count = isset($_POST[$field_name]) ? $_POST[$field_name] : 0;
    if($guest_count > 0) {
      $sql = "UPDATE `tb_homestay` SET `homestay_guest` = '$guest_count' WHERE `homestay_id` = '{$homestay['id']}'";
      $query = mysqli_query($condb, $sql);
      $homestay_name = $homestay['name'];
      $h .= $homestay_name . ' ' . $guest_count . ' คน, ';
    } else {
      $sql = "UPDATE `tb_homestay` SET `homestay_guest` = '0' WHERE `homestay_id` = '{$homestay['id']}'";
      $query = mysqli_query($condb, $sql);
    }
  }
  $h = rtrim($h, ', '); // ลบเครื่องหมาย ',' ตัวสุดท้ายออกจาก string
  $sql ="UPDATE `tb_booking` SET `room` = '$h' WHERE `b_id` = '{$_POST["b_id"]}'";
  $query = mysqli_query($condb, $sql);
}



header("location:index?add=pass");
exit();
