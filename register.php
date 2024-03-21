<?php

    session_start();
    require_once 'config/bd.php';


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
    <title>สมัครสมาชิก</title>
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
                <a href="index.php" class="nav-item nav-link">หน้าแรก</a>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="1Day.html" class="dropdown-item">1 วัน ไป-กลับ</a>
                            <a href="2Day.html" class="dropdown-item">2 วัน 1 คืน</a>
                            <a href="3Day.html" class="dropdown-item">3 วัน 2 คืน</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="contact" class="nav-item nav-link">ติดต่อเรา</a>
                </div>
                
            </div>
        
        </nav>

            <div class="container-fluid bg-primary py-5 mb-5 hero-header">
                <div class="container py-5">
                    <div class="row justify-content-center py-5">
                        <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                            <h1 href="register.php" class="display-3 text-white animated slideInDown">สมัครสมาชิก</h1>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
        


       
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                
                            </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    
    


    <!-- Testimonial Start -->
    <div class="container-xxl py-10 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Register</h6>
                <h1 class="mb-5">สมัครสมาชิก!!!</h1>
            </div>
            
        </div>  
    </div>
    <!-- Testimonial End -->
        
</html>

    <div class="position-relative mx-auto" style="max-width: 400px;">
        


        <div class=" card  mt-2 shadow p-3 mb-5 bg-white rounded">
            <?php if(isset($_SESSION['error'])) { ?>
                
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>

            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

            <form action="signupDB.php" method="post">
                
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <label for="Cfirsname" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" placeholder="ชื่อ"  name = "Cfirsname" aria-describedby="Cfirsname">

                </div>

                <div class="position-relative mx-auto" style="max-width: 400px;">
                     <label for="Clastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" placeholder="นามสกุล" name = "Clastname" aria-describedby="Clastname">
    
                </div>

                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <label for="Ctel" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" name = "Ctel" aria-describedby="Ctel">
    
                </div>

                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" placeholder="อีเมล" name = "email" aria-describedby="email">
    
                </div>

                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" placeholder="รหัสผ่าน" name = "password">

                </div>

                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <label for="confirm Password" class="form-label">ยืนยันรหัสผ่าน</label>
                    <h><input type="password" class="form-control"  placeholder="ยืนยันรหัสผ่าน" name = "Cconfirmpassword"></h>
                </div>

                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <h1><button type="submit" name="submit" class="btn btn-primary">ยื่นยันการสมัครสมาชิก</button></h1>
                    <hr>
                    <p>หากเป็นสมาชิกอยู่เเล้ว กดปุ่มนี้เพื่อ <a href="login.php"  class="nav-item">เข้าสู่ระบบ</a></p>
                    
                </div>

                <hr>

            </form>     
        </div>
    </div>

    <!-- Testimonial Start -->

    <!-- Testimonial End -->
        
  
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                   
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">ช่องทางการติดต่อ</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>ประชาสัมพันธ์ชมรมไทยพวน นางลัดดา ใจหาญ </p>
                    
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>โทร 081-544-2319</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> องค์การบริหารส่วนตำบลโพธิ์ตาก </p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>โทร 042-530837</p>
                    <div class="d-flex pt-2">
                        
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        
                    </div>
                </div>
               
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">รูปภาพ</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/Trip1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/Trip2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/Trip3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/Trip5.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/Trip6.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/Trip7.jpg" alt="">
                        </div>
                    </div>
                </div>

                
            </div>
            
        <div class="container">
            <div class="copyright">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


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