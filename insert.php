<?php 

session_start();
require_once "config/bd.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $guest = $_POST['guest'];
    $checkin = $_POST['checkin'];
    $package = $_POST['package'];

    $total = $_POST['total'];

    if (empty($name)) {
        $errorMsg = "Please enter tname";
    } else if (empty($phone)) {
        $errorMsg = "please Enter $phone";
    } else {
        try {
            if (!isset($errorMsg)) {
                $insert_stmt = $conn->prepare("INSERT INTO booking(name, phone, guest, checkin, package, total) VALUES (:fname, :phone, :guest, :checkin, :package, :total)");
                $insert_stmt->bindParam(':fname', $name);
                $insert_stmt->bindParam(':phone', $phone);

                $insert_stmt->bindParam(':guest', $guest);
                $insert_stmt->bindParam(':checkin', $checkin);
                $insert_stmt->bindParam(':package', $package);
                $insert_stmt->bindParam(':total', $total);

                if ($insert_stmt->execute()) {
                    $insertMsg = "Insert Successfully...";
                    header("refresh:2;index.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // $img = $_FILES['img'];

    //     $allow = array('jpg', 'jpeg', 'png');
    //     $extension = explode('.', $img['name']);
    //     $fileActExt = strtolower(end($extension));
    //     $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    //     $filePath = 'uploads/'.$fileNew;

    //     if (in_array($fileActExt, $allow)) {
    //         if ($img['size'] > 0 && $img['error'] == 0) {
    //             if (move_uploaded_file($img['tmp_name'], $filePath)) {
    //                 $sql = $conn->prepare("INSERT INTO booking(name, phone, guest, checkin, package, total, img) VALUES(:name, :phone, :guest, :checkin, :package, :total, :img)");
    //                 $sql->bindParam(":name", $name);
    //                 $sql->bindParam(":phone", $phone);
    //                 $sql->bindParam(":guest", $guest);
    //                 $sql->bindParam(":checkin", $checkin    );
    //                 $sql->bindParam(":package", $package    );
    //                 $sql->bindParam(":total", $total        );
    //                 $sql->bindParam(":img", $fileNew);
    //                 $sql->execute();

    //                 if ($sql) {
    //                     $_SESSION['success'] = "Data has been inserted successfully";
    //                     header("location: homeadd.php");
    //                 } else {
    //                     $_SESSION['error'] = "Data has not been inserted successfully";
    //                     header("location: homeadd.php");
    //                 }
    //             }
    //         }
    //     }
}


?>