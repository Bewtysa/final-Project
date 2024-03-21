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
    <title>แอดมิน</title>


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
                <h4 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>โฮมสเเตย์ บ้านโพธิ์ตาก</h6>
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
                            <!--  <a href="1Day.html" class="dropdown-item">1 วัน ไป-กลับ</a>
                            <a href="2Day.html" class="dropdown-item">2 วัน 1 คืน</a>
                            <a href="3Day.html" class="dropdown-item">3 วัน 2 คืน</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>-->
                            <a href="admin.php" class="dropdown-item">ข้อมูลการจอง</a>
                            <a href="members.php" class="dropdown-item">การจัดการสมาชิก</a>
                            <a href="homes.php" class="dropdown-item">ข้อมูลบ้านพัก</a>
                            <a href="admin_edit_package.php" class="dropdown-item">จัดการแพ็กเกจ</a>
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

    <body>
        <div class="container">
            <h1 class="mt-5">Member List</h1>
            <div class="mb-3">
                <!-- Add buttons for each role -->
                <button class="btn btn-primary" onclick="filterMembers('admin')">Admin</button>
                <button class="btn btn-primary" onclick="filterMembers('customer')">Customer</button>
                <button class="btn btn-primary" onclick="filterMembers('homestays')">Homestays</button>
                <button class="btn btn-primary" onclick="showAllMembers()">Show All</button>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>บ้าน</th>
                        <th>ชื่อ-สกุล</th>
                        <th>Email</th>
                        <th>เบอร์โทร</th>
                        <th>ระดับสมาชิก</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    require_once "../config/bd.php";

                    // Fetch all members from database
                    $stmt = $conn->query("SELECT * FROM customer");
                    $customers = $stmt->fetchAll();

                    // Loop through each member and display their information
                    foreach ($customers as $customer) {
                        echo "<tr>";
                        echo "<td>" . $customer['homestay'] . "</td>";
                        echo "<td>" . $customer['Cfirsname'] . " " . $customer['Clastname'] . "</td>";
                        echo "<td>" . $customer['email'] . "</td>";
                        echo "<td>" . $customer['Ctel'] . "</td>";
                        echo "<td>" . $customer['urole'] . "</td>";
                        // Add Edit and Password Reset buttons
                        echo "<td>";
                        echo '<a href="editmembers.php?id=' . $customer['id'] . '" class="btn btn-primary btn-sm">แก้ไข</a> ';
                        echo '<a href="reset_password.php?id=' . $customer['id'] . '" class="btn btn-danger btn-sm">รีเซ็ตรหัสผ่าน</a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Add Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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
        <!-- Back to Top -->
        <a href="../#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


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

</html>