<?php
// เริ่ม Session
session_start();

// เช็คว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['customer_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
    exit();
}

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
require_once 'config/bd.php';
$customer_id = $_SESSION['customer_login'];
$stmt = $conn->query("SELECT * FROM customer WHERE id = $customer_id");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// ดึงข้อมูลบ้านพักจากฐานข้อมูล
$stmt = $conn->query("SELECT * FROM booking2 WHERE customer_id = $customer_id");
$accommodation_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1 = $conn->query("SELECT booking2.*, customer.* FROM booking2 INNER JOIN customer ON booking2.customer_id = customer.id WHERE customer.id = $customer_id");
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="50x50" href="images/icon.png">
    <!-- bootstrap cdn datepicker link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- css -->
    <link rel="stylesheet" href="assets/css/templatemo-main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <meta charset="utf-8">
    <title>รายการบ้านพัก</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.c   ss" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


</head>
<body>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            
            </div>

            <div class="col-lg-4 text-center text-lg-end">
               
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 px-lg-5 py-3 py-lg-0">
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    
                   
                    <div class="nav-item dropdown">
                    <?php 

                    if (isset($_SESSION['customer_login'])) {
                    $customer_id = $_SESSION['customer_login'];
                    $stmt = $conn->query("SELECT * FROM customer WHERE id = $customer_id");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>  
                    

                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">โปรไฟล์ของ<?php echo $row['Cfirsname'] ?></a>
                        
                        <div class="dropdown-menu m-0">
                            <a href="homestay.php" class="text-primary">หน้าแรก</a><br>
                            <a href="edit_profile.php" class="text-primary">แก้ไขโปรไฟล์</a><br>
                            <a href="logout.php" class="btn btn-m btn-danger">Logout</a>
                        </div>
                        
                    </div>

                    
                </div>
               
            </div>
        
        </nav>

            
                
        </div>
    </div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- เพิ่ม stylesheet, CSS libraries, หรืออื่น ๆ ตามต้องการ -->
</head>

<body>
    <br><br>
<CENTER><h1>โปรไฟล์ของ<?php echo $row['Cfirsname'] ?></h1></CENTER><br>
    
    <h2 class="text-primary">รายการบ้านพัก</h2>
    <a href="profile.php"  class="btn btn-warning">รายการจอง</a>
    <a href="cancel_booking2.php"  class="btn btn-danger">รายการยกเลิก</a>
    <a href="accommodation_table.php"  class="btn btn-primary">รายการบ้านพัก</a>   
    <a href="pay.php"  class="btn btn-warning">ชำระเงิน</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">บ้าน</th>
                <th scope="col">จำนวนที่เข้าพัก</th>
                <th scope="col">วันที่เข้าพัก</th>
                <th scope="col">สถานะการจอง</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accommodation_data as $accommodation) : ?>
                <tr>
                    <!-- แสดงข้อมูลบ้านพัก -->
                    <td><?php echo $accommodation['homestay_name']; ?></td>

                  
                    <td><?php echo $accommodation['guest2']; ?></td>
                    <td><?php echo $accommodation['checkin']; ?></td>
                    <td><?php echo $accommodation['room']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>








