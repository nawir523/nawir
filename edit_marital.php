<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $marital_id = $_POST['marital_id'];
        $newMaritalName = $_POST['marital_name'];

        $updateQuery = "UPDATE `marital` SET `marital_name` = '$newMaritalName' WHERE `marital_id` = $marital_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            header("Location: marital.php");
            exit();
        } else {
            echo "Gagal menyimpan perubahan: " . mysqli_error($conn);
        }
    }

    if (isset($_GET['id'])) {
        $marital_id = $_GET['id'];
        $selectQuery = "SELECT * FROM `marital` WHERE `marital_id` = $marital_id";
        $result = mysqli_query($conn, $selectQuery);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Data status perkawinan tidak ditemukan.";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Edit Status Perkawinan</title>
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
            <h2>Edit Status Perkawinan</h2>
            <form method="post" action="edit_marital.php">
                <input type="hidden" name="marital_id" value="<?= $row['marital_id']; ?>">
                <div class="mb-3">
                    <label for="marital_status" class="form-label">Status Perkawinan:</label>
                    <input type="text" class="form-control" id="marital_name" name="marital_name" value="<?= $row['marital_name']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="marital.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
