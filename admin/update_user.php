<?php
// Include database connection
require_once "../config/bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $email = $_POST['email'];
    $homestay = $_POST['homestay'];
    $urole = $_POST['urole'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Check if password field is not empty
    if (!empty($password)) {
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Update user data with new password
        $stmt = $conn->prepare("UPDATE customer SET email = ?, Ctel = ?, homestay = ?, urole = ?, password = ? WHERE id = ?");
        $stmt->execute([$email, $phone, $homestay, $urole, $hashed_password, $id]);
    } else {
        // Update user data without changing the password
        $stmt = $conn->prepare("UPDATE customer SET email = ?, Ctel = ?, homestay = ?, urole = ? WHERE id = ?");
        $stmt->execute([$email, $phone, $homestay, $urole, $id]);
    }

    // Check if the update was successful
    if ($stmt) {
        // Redirect back to the member list page with a success message
        session_start();
        $_SESSION['success'] = "User data updated successfully";
        header("Location: members.php");
        exit();
    } else {
        // Redirect back to the edit page with an error message
        session_start();
        $_SESSION['error'] = "Failed to update user data";
        header("Location: edit.php?id=$id");
        exit();
    }
} else {
    // Redirect back to the edit page if accessed directly without POST request
    header("Location: edit.php?id=$id");
    exit();
}
?>
