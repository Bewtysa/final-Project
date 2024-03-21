
<?php

session_start();

require_once '../config/bd.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}

// ตรวจสอบการยกเลิกการจองและเพิ่มความคิดเห็นลงในฐานข้อมูล
if (isset($_POST['submit'])) {
    $booking_id = $_POST['booking_id'];
    $comment = $_POST['comment'];

    // อัปเดตคอมเมนต์ในฐานข้อมูล
    $update_stmt = $conn->prepare("UPDATE booking SET Comment = :comment WHERE id = :booking_id");
    $update_stmt->bindParam(':comment', $comment);
    $update_stmt->bindParam(':booking_id', $booking_id);

    if ($update_stmt->execute()) {
        // อัปเดตสำเร็จ
        $_SESSION['success'] = 'บันทึกความคิดเห็นเรียบร้อยแล้ว!';
        header('location: admin.php');
        exit();
    } else {
        // มีข้อผิดพลาดในการอัปเดต
        $_SESSION['error'] = 'เกิดข้อผิดพลาดในการบันทึกความคิดเห็น!';
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
                    <h1>ข้อมูลการจอง</h1>
                    
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">เพิ่มสมาชิกhomestay</button>
                        
                </div>
                

                

                <div class="mb-3">
                    <button class="btn btn-primary" onclick="filterMembers('ไปกลับ')">ไปกลับ</button>
                    <button class="btn btn-primary" onclick="filterMembers('2 วัน 1 คืน')">2 วัน 1 คืน</button>
                    <button class="btn btn-primary" onclick="filterMembers('3 วัน 2 คืน')">3 วัน 2 คืน</button>
                    <button class="btn btn-primary" onclick="showAllMembers()">Show All</button>
                    <a href="cancel_booking.php" class="btn btn-danger ">รายการยกเลิก</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal1" data-bs-whatever="@mdo">เพิ่มแพ็กเกจ</button>
                        
                </div>

                <div class="modal fade" id="userModal1" tabindex="-1" aria-labelledby="userModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel1">เพิ่มแพ็กเกจ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- ฟอร์มสำหรับเพิ่มข้อมูลผู้ใช้ -->

                                <form action="addpackage.php" method="post">
                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <span class="details">แพ็กเกจ</span>
                                        
                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Pname" class="form-label">ชื่อแพ็กเกจ ไทย</label>
                                        <input type="text" class="form-control" placeholder="ชื่อแพ็กเกจ ไทย" name="Pname" aria-describedby="Pname">

                                    </div>
                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Pname_eng" class="form-label">ชื่อแพ็กเกจ Eng</label>
                                        <input type="text" class="form-control" placeholder="ชื่อแพ็กเกจ Eng" name="Pname_eng" aria-describedby="Pname_eng">

                                    </div>
                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Pday" class="form-label">จำนวนวัน</label>
                                        <input type="text" class="form-control" placeholder="จำนวนวัน" name="Pday" aria-describedby="Pday">
                                        
                                    </div>
                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Pprice" class="form-label">ราคา</label>
                                        <input type="text" class="form-control" placeholder="จำนวนวัน" name="Pprice" aria-describedby="Pprice">
                                        
                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <h1><button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button></h1>  
                                    


                                   

                                </form>
                            </div>
                            

                        </div>
                    </div>
                </div>
                

            </div>

                <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel">เพิ่มสมาชิกhomestay</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-body">
                                <!-- ฟอร์มสำหรับเพิ่มข้อมูลผู้ใช้ -->

                                <form action="addhomestaysDB.php" method="post">
                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <span class="details">แพ็กเกจ</span>
                                        <select name="homestay" class="form-control" id="homestay" required>
                                            <option value="">เลือกบ้าน</option>
                                            <?php
                                            $stmt = $conn->query("SELECT * FROM homestay");
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row['homestay_name'] . '">' . $row['homestay_name'] . ' - ' . $row['homestay_name'] . ' </option>';
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Cfirsname" class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" placeholder="ชื่อ" name="Cfirsname" aria-describedby="Cfirsname">

                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Clastname" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" placeholder="นามสกุล" name="Clastname" aria-describedby="Clastname">

                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="Ctel" class="form-label">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" name="Ctel" aria-describedby="Ctel">

                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="email" class="form-label">อีเมล</label>
                                        <input type="text" class="form-control" placeholder="อีเมล" name="email" aria-describedby="email">

                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="password" class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password">

                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <label for="confirm Password" class="form-label">ยืนยันรหัสผ่าน</label>
                                        <h><input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="Cconfirmpassword"></h>
                                    </div>

                                    <div class="position-relative mx-auto" style="max-width: 400px;">
                                        <h1><button type="submit" name="submit" class="btn btn-primary">ยื่นยันการสมัครสมาชิก</button></h1>


                                </form>
                            </div>
                            

                        </div>
                    </div>
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
                        <th scope="col">ชื่อ-สกุล</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col">จำนวน(คน)</th>
                        <th scope="col">แพ็กเกจ</th>
                        <th scope="col">ราคารวม</th>
                        <th scope="col">วันที่เช็คอิน</th>
                        <th scope="col">Img</th>
                        <th scope="col">Actions</th>


                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->query("SELECT * FROM booking");
                    $stmt->execute();
                    $users = $stmt->fetchAll();

                    if (!$users) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                        foreach ($users as $user) {
                    ?>
                            <?php if (!empty($user['Comment'])) continue; ?>
                            <tr>
                                <th scope="row"><?php echo $user['id']; ?></th>
                                <td><?php echo $user['name']; ?><br />
                                    <?php
                                    if ($user['room'] == 'รอชำระเงิน') {
                                        echo '<a href="#" class="btn btn-warning">รอชำระเงิน</a>';
                                    } elseif ($user['room'] == 'ชำระเงินแล้ว') {
                                        echo '<a href="#" class="btn btn-success">ชำระเงินแล้ว</a>';
                                    } ?></td>

                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['guest']; ?></td>
                                <td class="td text-center"><?php if ($user['package'] == '2200') {
                                                                echo "2 วัน 1 คืน";
                                                            } else if ($user['package'] == '500') {
                                                                echo "ไปกลับ";
                                                            }
                                                            if ($user['package'] == '3500') {
                                                                echo "3 วัน 2 คืน";
                                                            }
                                                            ?>

                                </td>
                                <td><?php echo $user['total']; ?></td>
                                <td><?php echo $user['checkin']; ?></td>
                                <!-- <td><?php echo $user['Comment']; ?></td> -->

                                <td width="120px"><img class="rounded" width="100%" src="../uploads/<?php echo $user['img']; ?>" alt=""></td>
                                <td>

                                    <a href="../admin/edit.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">จักการการชำระ</a>
                                    <br />
                                    <a href="../admin/edit2.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">จักการบ้านพัก</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#commentModal<?php echo $user['id']; ?>">
                                        ยกเลิกการจอง
                                    </button>
                                    <!-- Modal -->
                        <div class="modal fade" id="commentModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="commentModalLabel">ยกเลิกการจอง</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="">
                                        <div class="modal-body">
                                            <input type="hidden" name="booking_id" value="<?php echo $user['id']; ?>">
                                            <div class="mb-3">
                                                <label for="comment" class="form-label">เหตุผลสำหรับการยกเลกการจอง</label>
                                                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                                </td>
                                

        </div>

        <!-- <td>
            <?php
                            if ($user['room'] == 'รอชำระเงิน') {
                                echo '<a href="#" class="btn btn-warning">รอชำระเงิน</a>';
                            } elseif ($user['room'] == 'ชำระเงินแล้ว') {
                                echo '<a href="#" class="btn btn-success">ชำระเงินแล้ว</a>';
                            }
            ?>
        </td> -->







        </tr>
<?php }
                    } ?>
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