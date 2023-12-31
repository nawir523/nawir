<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $checkUserQuery = "SELECT * FROM `user` WHERE `marital_id` = $id";
        $_SESSION['success'] = "Data Berhasil Dihapus";
        $checkUserResult = mysqli_query($conn, $checkUserQuery);

        if ($checkUserResult->num_rows > 0) {
            echo "Tidak dapat menghapus status perkawinan karena masih ada pengguna yang terkait.";
            exit();
        }

        $deleteQuery = "DELETE FROM `marital` WHERE `marital_id` = $id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            header("Location: marital.php");
            exit();
        } else {
            echo "Gagal menghapus status perkawinan: " . mysqli_error($conn);
        }
    }
?>
