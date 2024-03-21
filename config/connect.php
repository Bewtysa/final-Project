<?php 

$server = "localhost";
$username = "root";
$password = "";
$dbname =  "homes";
$condb = mysqli_connect($server,$username,$password,$dbname);

if (!$condb) {
  exit('ไม่สามารถเชื่อมต่อกับฐานข้อมูล');
}


// Timezone information
date_default_timezone_set('Asia/Bangkok');
$date_now = date("Y-m-d");



//กำหนด title เว็บไซต์
$title = "ระบบจองโฮมสเตย์";


//เปิดใช้งาน SESSION
session_start();


// เลือกข้อมูลผู้ใช้งาน

//check_submit
$check_submit = "";
//สำหรับเกิดข้อผิดพลาด
function check_submit_p1($check_submit_p1) {
  $check_submit = "<div class='col-md-12 mb-2'>";
  $check_submit .= "<div class='row justify-content-md-center'>";
  $check_submit .= "<div class='col-md-auto'><span class='badge bg-danger' style='font-size: 1rem;'><i class='bi bi-exclamation-diamond'></i> $check_submit_p1</span></div>";
  $check_submit .= "</div>";
  $check_submit .= "</div>";

  return  $check_submit;
}
//สำหรับการทำงานสำเร็จ
function check_submit_p2($check_submit_p2) {
  $check_submit = "<div class='col-md-12 mb-2'>";
  $check_submit .= "<div class='row justify-content-md-center'>";
  $check_submit .= "<div class='col-md-auto'><span class='badge bg-success' style='font-size: 1rem;'><i class='bi bi-check-circle'></i> $check_submit_p2</span></div>";
  $check_submit .= "</div>";
  $check_submit .= "</div>";

  return  $check_submit;
}

?>
