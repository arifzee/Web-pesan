<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location: index.php');
}
include "database.php";
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <script src="pesan.js"></script>

    <?php include "header.php" ?>
    <div class="flex p-4 justify-center">
        <div class="p-3 flex w-full border border-black rounded-xl justify-center flex-wrap sm:flex-nowrap">
            <!-- <iframe src="https://blackspoort.com/albaplayer/%d8%a7%d8%b3%d8%aa%d8%b1%d8%a7%d9%84%d9%8a%d8%a7-%d8%a7%d9%84%d8%a7%d9%85%d8%a7%d8%b1%d8%a7%d8%aa" width="100%" height="500px" frameborder="0" scrolling="1" allowfullscreen="allowfullscreen" __idm_id__="917505"></iframe> -->
            <iframe name="iframe" src="https://playeriframe.shop/?url=https%3A%2F%2Fstream.hownetwork.xyz%2Fvideo.php%3Fid%3D1c031dc7955ffb7a6c0ada472b4ba942" scrolling="no" frameborder="0" width="100%" height="500px" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" id="player-iframe" style="z-index:0;" __idm_id__="7143425"></iframe>
            <div class="items-center gap-5 flex flex-col">
                <div id="chatContainer" class="flex-col flex py-2 px-3 bg-neutral-100 min-h-96 max-h-96 max-w-96  overflow-y-scroll">
                    <?php
                    include "get_messages.php";
                    ?>
                </div>
                <form>
                    <div class="flex gap-2 p-2">
                        <div>
                            <div>
                                <div class=" w-1/4 items-center rounded-t flex justify-center text-lg bg-black text-white">
                                    <p><?= $_SESSION['username'] ?></p>
                                </div>
                                <textarea id="sqlQuery" name="sqlQuery" rows="1" cols="50" class="border rounded border-black w-full p-2" placeholder=" ketik disini.." required></textarea>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <button class="p-2 rounded bg-green-400 " type="button" onclick="kirimPesan()">kirim</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function kirimPesan() {
            // Ambil nilai SQL dari input
            var sqlQueryKirim = $("#sqlQuery").val();
            if (sqlQueryKirim == "") {
                return false;
            }

            // Kirim permintaan AJAX ke server
            $.ajax({
                type: "POST",
                url: "kirim_pesan.php", // Ganti dengan nama file PHP yang menangani permintaan SQL
                data: {
                    sqlQueryKirim: sqlQueryKirim
                },
                success: function(response) {
                    // Tampilkan hasil respons di dalam div dengan id "result"
                    $("#result").html(response);
                    $("#sqlQuery").val("")
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }
    </script>
    <div id="result"></div>

</body>

</html>