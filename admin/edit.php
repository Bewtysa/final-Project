<?php

session_start();

require_once "../config/bd.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $guest = $_POST['guest'];
    $room = $_POST['room'];
    $checkin = $_POST['checkin'];
    $package = $_POST['package'];

    $img = $_FILES['img'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];

    if ($upload != '') {
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = '../uploads/' . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);
            }
        }
    } else {
        $fileNew = $img2;
    }

    $sql = $conn->prepare("UPDATE booking SET name = :name, phone = :phone, guest = :guest, room = :room, checkin = :checkin, package = :package, img = :img WHERE id = :id ");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":name", $name);
    $sql->bindParam(":phone", $phone);
    $sql->bindParam(":guest", $guest);
    $sql->bindParam(":room", $room);
    $sql->bindParam(":checkin", $checkin);
    $sql->bindParam(":package", $package);
    $sql->bindParam(":img", $fileNew);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        header("location: ../admin/admin.php");
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
        header("location: ../admin/admin.php");
    }
}

?>
<!DOCTYPE html>
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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 750px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 0.1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">จักการ การชำระ</h1>
        <div class="row justify-content-center">
            <div class="col-md-50">
                <form action="../admin/edit.php" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM booking WHERE id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                    }
                    ?>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td><input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id"></td>
                            <tr>
                             <th>ชื่อ-สกุล</th>
                            <td><input type="text" readonly value="<?php echo $data['name']; ?>" required class="form-control" name="name"></td>
                            
                           
                        </tr>
                        
                        <tr>
                            <th>Package</th>
                            <td>
                                <select class="form-select" name="package">
                                    <option readonly value="2200" <?php echo ($data['package'] == '2200') ? 'selected' : ''; ?>>2 วัน 1 คืน</option>
                                    <option readonly value="500" <?php echo ($data['package'] == '500') ? 'selected' : ''; ?>>ไปกลับ</option>
                                    <option readonly value="3500" <?php echo ($data['package'] == '3500') ? 'selected' : ''; ?>>3 วัน 2 คืน</option>
                                </select>
                            </td>
                            <th>Checkin</th>
                            <td><input type="text" readonly value="<?php echo $data['checkin']; ?>" required class="form-control" name="checkin"></td>
                        </tr>
                        
                        <tr>
                            <th>เบอร์โทร</th>
                            <td><input type="text" readonly value="<?php echo $data['phone']; ?>" required class="form-control" name="phone"></td>
                            <th>จำนวน(คน)</th>
                            <td><input type="text" readonly value="<?php echo $data['guest']; ?>" required class="form-control" name="guest"></td>
                        </tr>
                        <tr>
                            
                        </tr>
                        <tr>
                            <th>สถานะ</th>
                            <td>
                                <select class="form-select" name="room">
                                    <option value="ชำระเงินแล้ว" <?php echo ($data['room'] == 'ชำระเงินแล้ว') ? 'selected' : ''; ?>>ชำระเงินแล้ว</option>
                                    <option value="รอชำระเงิน" <?php echo ($data['room'] == 'รอชำระเงิน') ? 'selected' : ''; ?>>รอชำระเงิน</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                <input type="hidden" value="<?php echo $data['img']; ?>" required class="form-control" name="img2" >
                                <input type="file" class="form-control" id="imgInput" name="img">
                                <img width="50%" src="../uploads/<?php echo $data['img']; ?>" id="previewImg" alt="">
                            </td>
                        </tr>
                    </table>
                    <div class="mb-3 d-grid">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <a href="../admin/admin.php" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>

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
</body>

</html>
