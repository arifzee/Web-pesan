<?php
// Cek apakah data sesi 'is_login' tersedia
$isLogin = isset($_SESSION['is_login']);
?>
<link rel="stylesheet" href="style.css">
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<header class="p-2 items-center border-b-2">
    <div class=" justify-between flex w-full">
        <div class="flex justify-between w-full">
            <h3 class="font-bold text-lg sm:text-xl sm:w-1/5 w-2/5 flex items-center">belajar php</h3>
            <div class="flex justify-around items-center  w-full">
                <div class="hover:bg-neutral-200 hover:rounded-lg px-3 py-2 font-semibold text-sm sm:text-normal">
                    <a href="index.php">Home</a>
                </div>
                <div class="hover:bg-neutral-200 hover:rounded-lg px-3 py-2 font-semibold text-sm sm:text-normal">
                    <a href="dashboard.php">Dashboard</a>
                </div>
            </div>
        </div>
        <div class="dropdownn">
            <button><i class="ph ph-dots-three-outline"></i></button>
            <div class="dropdownn-content">
                <a id="login" class="hover:rounded-lg hover:bg-neutral-200 underline p-1" href="login.php">Login</a>
                <a id="register" class="hover:rounded-lg hover:bg-neutral-200 underline p-1" href="register.php">Register</a>
                <form class="hover:rounded-lg hover:bg-neutral-200 underline p-1" action="dashboard.php" method="post">
                    <button id="logout" name="logout">Logout</button>
                </form>
                <form class="hover:rounded-lg hover:bg-neutral-200 underline p-1" action="hapus_akun.php" method="post">
                    <button id="hapusAkun" name="hapus_akun">Hapus Akun</button>
                </form>
            </div>
        </div>
        <!-- <div class="flex w-1/12">
            <a id="login" class="hover:rounded-lg hover:bg-neutral-200 underline p-1" href="login.php">Login</a>
            <a id="register" class="hover:rounded-lg hover:bg-neutral-200 underline p-1" href="register.php">Register</a>
            <form class="hover:rounded-lg hover:bg-neutral-200 underline p-1" action="dashboard.php" method="post">
                <button id="logout" name="logout">Logout</button>
            </form>
        </div> -->
    </div>
    <?php if ($isLogin) : ?>
        <script>
            // Jika is_login di sesi PHP adalah true, sembunyikan elemen dengan id 'register'
            document.getElementById('register').style.display = 'none';
            document.getElementById('login').style.display = 'none';
            document.getElementById('logout').style.display = 'display';
            document.getElementById('hapusAkun').style.display = 'display';
            </script>
    <?php endif; ?>
    <?php if (!$isLogin) : ?>
        <script>
            // Jika is_login di sesi PHP adalah true, sembunyikan elemen dengan id 'register'
            document.getElementById('register').style.display = 'display';
            document.getElementById('login').style.display = 'display';
            document.getElementById('logout').style.display = 'none';
            document.getElementById('hapusAkun').style.display = 'none';
        </script>
    <?php endif; ?>

</header>

