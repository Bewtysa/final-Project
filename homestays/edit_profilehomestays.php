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
$customer_id = $_SESSION['homestays_login'];
$stmt = $conn->query("SELECT * FROM customer WHERE id = $customer_id");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// ตรวจสอบการกดปุ่ม "บันทึกการแก้ไข"
if (isset($_POST['save'])) {
    $new_fname = $_POST['new_fname'];
    $new_lname = $_POST['new_lname'];
    $new_tel = $_POST['new_tel'];
    $new_email = $_POST['new_email'];

    // อัปเดตข้อมูลในฐานข้อมูล
    $update_stmt = $conn->prepare("UPDATE customer SET Cfirsname = :new_fname, Clastname = :new_lname, Ctel = :new_tel, email = :new_email WHERE id = :customer_id");
    $update_stmt->bindParam(':new_fname', $new_fname);
    $update_stmt->bindParam(':new_lname', $new_lname);
    $update_stmt->bindParam(':new_tel', $new_tel);
    $update_stmt->bindParam(':new_email', $new_email);
    $update_stmt->bindParam(':customer_id', $customer_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = 'บันทึกการแก้ไขเรียบร้อย!';
        header('location: homestays.php');
        exit();
    } else {
        $_SESSION['error'] = 'มีบางอย่างผิดพลาด!';
        header('location: edit_profile.php');
        exit();
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
    <title>แก้ไขโปรไฟล์</title>


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
                          <a href="homestays.php"><?php echo $row['homestay'] ?></a> <br>
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

    <div class="container-xxl py-5">

    
        
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
                <h1 class="mb-5">แก้ไขโปรไฟล์</h1>
            </div>
            <div class="modal-body">
            <form id="contact-form"  method="post" enctype="multipart/form-data">
                            
                       
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span for="new_fname">ชื่อ</span>
                                <input type="text" class="form-control" name="new_fname" value="<?php echo $row['Cfirsname'] ?>" required>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span for="new_lname">นามสกุล</span>
                                <input type="text" class="form-control" name="new_lname" value="<?php echo $row['Clastname']; ?>" required>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span for="new_tel">เบอร์โทรศัพท์</span>
                                <input type="tel" class="form-control" name="new_tel"  value="<?php echo $row['Ctel']; ?>" required>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span for="new_email">อีเมล</span>
                                <input type="tel" class="form-control" name="new_email" value="<?php echo $row['email']; ?>" required>
                            </div>
                            
                            <br><br>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                            <a href="homestays.php" class="btn btn-secondary ">ยกเลิก</a> 
                            <button type="submit" name="save" class="btn btn-primary">บันทึกการแก้ไข</button>
                            </div>

                           
            </form>
            </div>
        </div>
    </div>

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
</html>
