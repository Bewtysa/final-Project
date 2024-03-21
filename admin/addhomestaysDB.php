<?php
    
    session_start();
    require_once '../config/bd.php';

    if (isset($_POST['submit'])) {
        $Cfirsname = $_POST['Cfirsname'];
        $Clastname = $_POST['Clastname'];
        $homestay = $_POST['homestay'];
        $Ctel = $_POST['Ctel'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $Cconfirmpassword = $_POST['Cconfirmpassword'];
        $urole = 'homestays';

        
        if (empty($Cfirsname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: admin.php");
        } else if (empty($Clastname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: admin.php");
        } else if (empty($homestay)) {
            $_SESSION['error'] = 'กรุณาเลือกบ้าน';
            header("location: admin.php");
        } else if (empty($Ctel)) {
            $_SESSION['error'] = 'กรุณากรอกเบอร์';
            header("location: admin.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: admin.php");
        // } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            // header("location: admin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: admin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 3) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: admin.php");
        } else if (empty($Cconfirmpassword)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: admin.php");
        } else if ($password != $Cconfirmpassword) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: admin.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM customer WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: admin.php");

                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO customer(Cfirsname, Clastname, homestay, Ctel, email, password, urole) 
                                            VALUES(:Cfirsname, :Clastname, :homestay, :Ctel, :email, :password, :urole)");
                    $stmt->bindParam(":Cfirsname", $Cfirsname);
                    $stmt->bindParam(":Clastname", $Clastname);
                    $stmt->bindParam(":homestay", $homestay);
                    $stmt->bindParam(":Ctel", $Ctel);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole); //ระดับของผู้ใช้
                    $stmt->execute();
                    $_SESSION['success'] = "ทำการเพิ่มสมาชิกเรียบร้อยแล้ว! <a href='login.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อ.......";
                    header("location: admin.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: admin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>