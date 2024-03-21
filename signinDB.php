<?php 

    session_start();
    require_once 'config/bd.php';

    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

      
        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: login.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: login.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: login.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 3) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: login.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM customer WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($email == $row['email']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin/admin.php");
                            } else if ($row['urole'] == 'customer') {
                                $_SESSION['customer_login'] = $row['id'];
                                header("location: homestay.php");
                            } else { // สำหรับ urole อื่น ๆ
                                $_SESSION['homestays_login'] = $row['id'];
                                header("location: homestays/homestays.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: login.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: login.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: login.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>