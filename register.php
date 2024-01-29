<?php
session_start();
include "database.php";

$register_message = "";

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
}

$isLogin = isset($_SESSION['is_login']);

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);
    
    try {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ss", $username, $hash_password);
        if ($stmt->execute()) {
            $register_message = "<div class='text-green-500'>" . "daftar akun berhasil, silahkan " . "<a class='underline font-light sm:text-md text-normal text-blue-600 hover:text-black' href='login.php'>login</a>" . "</div>";
        } else {
            $register_message = "daftar akun gagal";
        }
        $stmt->close();
    } catch (mysqli_sql_exception) {
        $register_message = "username sudah ada, silahkan ganti yang lain";
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php";
    if (!$isLogin) : ?>
        <script>
            document.getElementById('logout').style.display = 'none';
        </script>
    <?php endif; ?>
    <?php if ($isLogin) : ?>
        <script>
            // Jika is_login di sesi PHP adalah true, sembunyikan elemen dengan id 'register'
            document.getElementById('register').style.display = 'none';
            document.getElementById('login').style.display = 'none';
            document.getElementById('logout').style.display = 'display';
        </script>
    <?php endif; ?>
    <div class="min-h-svh items-center flex justify-center">
        <div class="container w-96 min-h-fit p-4 ">
            <h2>Daftar Akun</h2>
            <form class="items-center flex-col flex justify-center" action="register.php" method="POST">
                <div class="py-7 w-full">
                    <i class="text-red-500"><?= $register_message ?></i>
                    <h4>Username:</h4>
                    <input class="w-full p-2 border-b-2" type="text" placeholder="masukkan username.." name="username" />
                    <h4 class="pt-4">Password:</h4>
                    <input class="w-full p-2 border-b-2" type="password" placeholder="masukkan password.." name="password" />
                    <div class="flex justify-center pt-5">
                        <button class="py-2 w-full px-4 rounded bg-green-400 w-2/5 hover:shadow-lg hover:bg-neutral-200" type="submit" name="register">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>