<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_GET['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];

    $updateQuery = "UPDATE `user` SET `user_fullname`='$fullname', `user_name`='$username' WHERE `user_id`='$user_id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("Location: user.php");
        exit();
    } else {
        echo "Gagal menyimpan perubahan: " . mysqli_error($conn);
    }
}
?>
