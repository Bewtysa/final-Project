<?php

    session_start();

    require_once 'config/bd.php';
        if (!isset($_SESSION['customer_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: login.php');

      }
      
      
      if (isset($_POST['submit'])) {
        $id = $_SESSION['customer_login'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $guest = $_POST['guest'];
        $checkin = $_POST['checkin'];
        $package = $_POST['package'];
        $total = $_POST['total'];
    
        // เพิ่ม room ที่มีค่าเป็น "Go"
        $room = "รอชำระเงิน";
    
        if (empty($name)) {
            $errorMsg = "Please enter name";
        } else if (empty($phone)) {
            $errorMsg = "please Enter $phone";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $conn->prepare("INSERT INTO booking(customer_id, name, phone, guest, checkin, package, total, room) VALUES (:customer_id, :fname, :phone, :guest, :checkin, :package, :total, :room)");
                    $insert_stmt->bindParam(':customer_id', $id);
                    $insert_stmt->bindParam(':fname', $name);
                    $insert_stmt->bindParam(':phone', $phone);
                    $insert_stmt->bindParam(':guest', $guest);
                    $insert_stmt->bindParam(':checkin', $checkin);
                    $insert_stmt->bindParam(':package', $package);
                    $insert_stmt->bindParam(':total', $total);
                    $insert_stmt->bindParam(':room', $room); // นำค่า $room มา bind parameter
    
                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;pay.php");
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

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
    <title>จองโฮมสเตย์</title>

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
    <link href="lib/animate/animate.min.css" rel="stylesheet">
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
                <h4 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>โฮมสเเตย์ บ้านโพธิ์ตาก</h6>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="homestay.php" class="nav-item nav-link active">หน้าแรก</a>
                    <a href="aboutlog.php" class="nav-item nav-link">เกี่ยวกับเรา</a>
                    
                    <a href="packagelog.php" class="nav-item nav-link">แพ็กเกจ</a>
                    

                    <div class="nav-item dropdown">
                    <?php 

                        if (isset($_SESSION['customer_login'])) {
                            $customer_id = $_SESSION['customer_login'];
                            $stmt = $conn->query("SELECT * FROM customer WHERE id = $customer_id");
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            }
                    ?>  
                    
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <?php echo $row['Cfirsname'] ?></a>
                        
                        <div class="dropdown-menu m-0">
                            <a href="profile.php" class="dropdown-item">โปรไฟล์e</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        </div>
                        
                    </div>

                    <a href="contactlog.php" class="nav-item nav-link">ติดต่อเรา</a>
                </div>
                
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">

                       
                        <h1 class="display-3 text-white animated slideInDown">Packages</h1>
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


    <!-- Package Start -->
    <div class="container-xxl py-5">

    
        
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3"></h6>
                <h1 class="mb-5">จอง</h1>
            </div>
            <div class="modal-body">
            <form id="contact-form"  method="post" enctype="multipart/form-data">
                            
                       
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span class="details">ชื่อ-นามสกุล</span>
                                <input type="text" class="form-control" name="name" value="<?php echo $row['Cfirsname'] ?> <?php echo $row['Clastname'] ?>" required>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span class="details">เบอร์โทรศัพท์</span>
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row['Ctel'] ?>" required>
                            </div>

                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span class="details">แพ็กเกจ</span>
                                <select name="package" class="form-control" id="package" required>
                            <option value="">เลือกแพ็กเกจ</option>
                            <?php
                                $stmt = $conn->query("SELECT * FROM package");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['Pprice'] . '">' . $row['Pname'] . ' - ' . $row['Pprice'] . ' บาท (ต่อคน)</option>';
                                }
                            ?>
                            </select>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span class="details">จำนวนผู้เข้าพัก</span>
                                <input type="number"    class="form-control"   id="guest" name="guest" min="1" max="30" required>
                                <?php


                                ?>
                            
                                <span class="details">ราคารวมที่ต้องชำระ</span>
                                <input type="text" id="total" class="form-control" name="total" readonly>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <span class="details">วันที่เข้าพัก</span>
                                <input type="date" class="form-control" name="checkin" placeholder="เลือกวันที่" required>
                            </div>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                            <!-- <h5> <img src="images/krungthai_bank.png" width="200x180"></h5>
                                <label for="img" class="col-form-label">เลขบัญชีธนาคาร 441-0-10451-9</label>
                                <label for="img" class="col-form-label">ชื่อบัญชี นางกาวี คำภูแก้ว
                                </label>
                                <input type="file" required class="form-control" id="imgInput" name="img">
                                <img loading="lazy" width="100%" id="previewImg" alt="">
                                </div>
                                <hr> -->
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            </div>
                            
                        

                        
            </form>
            </div>
        </div>
    </div>

    
  
    
        
  
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


    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        $(document).on('change keyup blur', "#guest, #package", function() {
            var guest = $("#guest").val()
            var package = $("#package").val()
            var result = guest * package
            $("#total").val(result)
        });
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }

    </script>

    <!-- โค้ด SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- โค้ด JavaScript ที่ใช้สำหรับแสดงข้อความแจ้งเตือน -->
<script>
    $(document).ready(function() 
    {
        $('#contact-form').on('submit', function(e) 
        {
            $.ajax(
                {
                url:'homeadd.php',
                data: $(this).serialize(),
                type: 'POST',
                success: function(data) 
                {
                    console.log(data);
                swal("สำเร็จ");
                },
                error: function(data) 
                {
                swal("ผิดผลาด");
                }
    });

});

});
</script>



</body>

</html>