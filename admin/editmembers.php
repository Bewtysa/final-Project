<?php

    session_start();

    require_once '../config/bd.php';
        if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: login.php');
      

     
        
    }

      

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แอดมิน</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">จักการสมาชิก</h1>
        <form action="update_user.php" method="POST">
            <?php
                // Include database connection
                require_once "../config/bd.php";

                // Get user ID from URL parameter
                $id = $_GET['id'];

                // Fetch user data from database
                $stmt = $conn->prepare("SELECT * FROM customer WHERE id = ?");
                $stmt->execute([$id]);
                $customer = $stmt->fetch();

                // Display form with user data pre-filled
            ?>
            <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $customer['Cfirsname']." ".$customer['Clastname']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">เบอร์โทร</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $customer['Ctel']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="homestay" class="form-label">บ้าน</label>
                <span class="details"></span>
                                        <select name="homestay" class="form-control" id="homestay" required>
                                            <option value="<?php echo $customer['homestay']; ?>">เลือกบ้าน</option>
                                            <?php
                                            $stmt = $conn->query("SELECT * FROM homestay");
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row['homestay_name'] . '">' . $row['homestay_name'] . ' - ' . $row['homestay_name'] . ' </option>';
                                            }
                                            ?>
                                        </select>
            </div>
            <div class="mb-3">
                <label for="urole" class="form-label">แก้ไข้</label>
                <span class="details">ระดับสมาชิก</span>
                                        <select name="urole" class="form-control" id="urole" required>
                                            <option value="<?php echo $customer['urole']; ?>">-</option>
                                            <option value="admin">admin</option>
                                            <option value="homestays">homestays</option>
                                            <option value="customer">customer</option>
                                            
                                        </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่านใหม่">
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
    <!-- Add Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
