<?php
session_start();

// เช็คว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['homestays_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
    exit();
}

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
require_once '../config/bd.php';
$homestays_id = $_SESSION['homestays_login'];
$stmt = $conn->query("SELECT * FROM customer WHERE id = $homestays_id");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$booking_history_stmt = $conn->prepare("SELECT * FROM booking2 WHERE homestay_id = :homestay_id");
$booking_history_stmt->bindParam(':homestay_id', $homestays_id);
$booking_history_stmt->execute();
$booking_history_result = $booking_history_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="50x50" href="../images/icon.png">
    <!-- bootstrap cdn datepicker link -->
    <link rel="stylesheet" href="../https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font awesome -->
    <link rel="stylesheet" href="../https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- css -->
    <link rel="../stylesheet" href="../assets/css/templatemo-main.css">
    <link rel="../stylesheet" href="../assets/css/style.css">
    <link rel="../stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="../stylesheet" href="../assets/css/owl-carousel.css">
    <meta charset="utf-8">
    <title>เจ้าของโฮมสเตย์</title>


    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="../https://fonts.googleapis.com">
    <link rel="preconnect" href="../https://fonts.gstatic.com" crossorigin>
    <link href="../https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="../https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
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

        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h4 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>โฮมสเตย์ บ้านโพธิ์ตาก</h6>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">



                    <div class="nav-item dropdown">
                        <?php

                        if (isset($_SESSION['admin_login'])) {
                            $customer_id = $_SESSION['admin_login'];
                            $stmt = $conn->query("SELECT * FROM customer WHERE id = $customer_id");
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>

                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <?php echo $row['Cfirsname'] ?></a>

                        <div class="dropdown-menu m-0">
                           <a href="homestays.php">หน้าแรก</a> <br>
                           <a href="edit_profilehomestays.php">แก้ไขโปรไฟล์</a>
                           
                            <a href="../logout.php" class="btn btn-danger">Logout</a>
                        </div>

                    </div>



                </div>


            </div>

        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">




                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Navbar & Hero End -->

    <div class="container mt-5">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ของคุณ</title>
    <!-- เพิ่ม stylesheet, CSS libraries, หรืออื่น ๆ ตามต้องการ -->
</head>
<body>
<CENTER><h1><?php echo $row['homestay'] ?></h1></CENTER>
 <br>
</body>
</div>




<!-- Package Start -->
    <div class="container-xxl py-5">



        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">

            </div>


        </div>
        <!-- Package End -->
        <div class="container mt-5">

            <div class="row">
                <div class="col-md-6">
                    <h2>ข้อมูล จำนวนลูกค้าเข้าบ้านพักของท่าน</h2>
                </div>
                
                <div class="mb-3">
             
                    <button class="btn btn-primary" onclick="showAllMembers()">Show All</button>
                </div>
                

            </div>
            <hr>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อ-สกุล(ลูกค้า)</th>
                        <th scope="col">เบอร์โทร(ลูกค้า)</th>
                        <th scope="col">จำนวน(คน)</th>
                        <th scope="col">บ้าน</th>

                        <th scope="col">วันที่เช็คอิน</th>
                        <th scope="col">หมายเหตุ</th>



                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($booking_history_result as $booking) : ?>
                            <tr>
                                <th scope="row"><?php echo $booking['id']; ?></th>
                                <td><?php echo $booking['name']; ?><br />
                                    <?php
                                    if ($booking['room'] == 'รอชำระเงิน') {
                                        echo '<a href="#" class="btn btn-warning">รอชำระเงิน</a>';
                                    } elseif ($booking['room'] == 'ชำระเงินแล้ว') {
                                        echo '<a href="#" class="btn btn-success">ชำระเงินแล้ว</a>';
                                    } ?></td>

                                <td><?php echo $booking['phone']; ?></td>
                                <td><?php echo $booking['guest2']; ?></td>
                                <td><?php echo $booking['homestay_name']; ?>

                                </td>
                                <td><?php echo $booking['checkin']; ?></td>
                                <td><?php echo $booking['comment']; ?></td>

                                </td>
        </div>

        <!-- <td>
            <?php
                            if ($booking['room'] == 'รอชำระเงิน') {
                                echo '<a href="#" class="btn btn-warning">รอชำระเงิน</a>';
                            } elseif ($booking['room'] == 'ชำระเงินแล้ว') {
                                echo '<a href="#" class="btn btn-success">ชำระเงินแล้ว</a>';
                            }
            ?>
        </td> -->







        </tr>
        <?php endforeach; ?>
</tbody>
</table>
    </div>




    <!-- Booking Start -->

    <!-- Booking Start -->


    <!-- Process Start -->

    <!-- Process Start -->


    <!-- Team Start -->

    <!-- Team End -->







    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="../#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- Add Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- ส่วนของฟังก์ชันกรองข้อมูลการจอง -->
    <script>
        function filterMembers(role) {
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var roleColumn = row.querySelector('td:nth-child(5)').textContent;
                if (roleColumn.trim().toLowerCase() === role.trim().toLowerCase()) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function showAllMembers() {
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                row.style.display = 'table-row';
            });
        }
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>