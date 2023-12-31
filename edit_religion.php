<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $religion_id = $_POST['religion_id'];
        $newReligionName = $_POST['religion_name'];

        $updateQuery = "UPDATE `religion` SET `religion_name` = '$newReligionName' WHERE `religion_id` = $religion_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            header("Location: religion.php");
            exit();
        } else {
            echo "Gagal menyimpan perubahan: " . mysqli_error($conn);
        }
    }

    if (isset($_GET['id'])) {
        $religion_id = $_GET['id'];
        $selectQuery = "SELECT * FROM `religion` WHERE `religion_id` = $religion_id";
        $result = mysqli_query($conn, $selectQuery);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Data agama tidak ditemukan.";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Edit Agama</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <div class="container">
            <h2>Edit Agama</h2>
            <form method="post" action="edit_religion.php">
                <input type="hidden" name="religion_id" value="<?= $row['religion_id']; ?>">
                <div class="mb-3">
                    <label for="religion_name" class="form-label">Nama Agama:</label>
                    <input type="text" class="form-control" id="religion_name" name="religion_name" value="<?= $row['religion_name']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="religion.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
