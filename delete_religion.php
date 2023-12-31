<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $deleteQuery = "DELETE FROM `religion` WHERE `religion_id` = $id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            header("Location: religion.php");
            exit();
        } else {
            echo "<b>Gagal Menyimpan Perubahan Dikarenakan Nama Agama Sudah Terisi Di Salah Satu Pengguna</b>";
        }
    }
?>