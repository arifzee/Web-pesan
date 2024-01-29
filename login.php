<?php
include "database.php";
session_start();

$login_message = "";


if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
}

// Cek apakah data sesi 'is_login' tersedia
$isLogin = isset($_SESSION['is_login']);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $username, $hash_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["is_login"] = true;
        header("location: dashboard.php");
    } else {
        $login_message = "akun tidak ditemukan";
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
            <h2>Login Akun</h2>
            <form class="items-center flex-col flex justify-center" action="login.php" method="POST">
                <div class="py-7 w-full">
                    <i class="text-red-500"><?= $login_message ?></i>
                    <h4 class="text-normal">Username:</h4>
                    <input class="w-full p-2 border-b-2" type="text" placeholder="masukkan username.." name="username" />
                    <h4 class="pt-4 text-normal">Password:</h4>
                    <input class="w-full p-2 border-b-2" type="password" placeholder="masukkan password.." name="password" />
                    <div class="flex justify-between pt-4">
                        <i class="sm:text-md text-sm">belum punya akun?</i>
                        <a href="register.php" class="underline font-light sm:text-md text-sm text-blue-600 hover:text-black">daftar disini</a>
                    </div>
                    <div class="flex justify-center pt-5">
                        <button class="py-2 w-full px-4 rounded bg-green-400 w-2/5 hover:shadow-lg hover:bg-neutral-200" type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php" ?>
    <script src="script.js" type="application/javascript"></script>
</body>

</html>