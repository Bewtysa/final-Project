<?php
    
    session_start();
    require_once 'config/bd.php';

    if (isset($_POST['submit'])) {
        $Cfirsname = $_POST['Cfirsname'];
        $Clastname = $_POST['Clastname'];
        $Ctel = $_POST['Ctel'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $Cconfirmpassword = $_POST['Cconfirmpassword'];
        $urole = 'customer';

        
        if (empty($Cfirsname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: register.php");
        } else if (empty($Clastname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: register.php");
        } else if (empty($Ctel)) {
            $_SESSION['error'] = 'กรุณากรอกเบอร์';
            header("location: register.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: register.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: register.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: register.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 3) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: register.php");
        } else if (empty($Cconfirmpassword)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: register.php");
        } else if ($password != $Cconfirmpassword) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: register.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM customer WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: register.php");

                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO customer(Cfirsname, Clastname, Ctel, email, password, urole) 
                                            VALUES(:Cfirsname, :Clastname, :Ctel, :email, :password, :urole)");
                    $stmt->bindParam(":Cfirsname", $Cfirsname);
                    $stmt->bindParam(":Clastname", $Clastname);
                    $stmt->bindParam(":Ctel", $Ctel);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole); //ระดับของผู้ใช้
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='login.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: register.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: register.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>