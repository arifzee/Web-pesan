<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: index.php');
}

if (isset($_POST['kirim_pesan'])) {
    header('location: pesan.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include "header.php" ?>
    <div class="min-h-screen justify-center items-center flex">
        <div class="flex-row justify-center text-lg ">

            <h3>
                <?= "selamat datang" . "<strong> " . $_SESSION["username"] . " </strong>" . "kamu bisa kirim pesan disini" ?>
            </h3>

            <form class="flex justify-center p-3" action="dashboard.php" method="POST">
                <button class="p-1 rounded bg-green-400" name="kirim_pesan">kirim pesan</button>
            </form>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>