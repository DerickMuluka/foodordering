<?php
include '../includes/connect.php';
session_start();

$user_id = $_SESSION['user_id'];

$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];
$email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);

// Check if the username is already taken by another user
$check_sql = "SELECT id FROM users WHERE username = '$username' AND id != $user_id";
$result = $con->query($check_sql);

if ($result->num_rows > 0) {
    // Redirect back with an error message
    header("Location: ../details.php?error=Username already exists");
    exit();
}

// Update user details
$sql = "UPDATE users SET name = '$name', username = '$username', password='$password', contact='$phone', email='$email', address='$address' WHERE id = $user_id";

if ($con->query($sql) === true) {
    $_SESSION['name'] = $name;
    header("Location: ../details.php?success=Details updated successfully");
} else {
    header("Location: ../details.php?error=Failed to update details");
}
exit();
?>
