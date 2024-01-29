<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <script>
        function konfirmasi() {
            var hasil = confirm("yakin mau dihapus?");
            if (hasil) {
                var sqlQueryId = $("#sqlQueryId").val();
                var sqlQueryPengirim = $("#sqlQueryPengirim").val();
                var sqlQueryHapus = $("#sqlQueryHapus").val();
                $.ajax({
                    type: "POST",
                    url: "hapus_pesan.php", // Ganti dengan nama file PHP yang menangani permintaan SQL
                    data: {
                        sqlQueryHapus: sqlQueryHapus,
                        sqlQueryId: sqlQueryId,
                        sqlQueryPengirim: sqlQueryPengirim
                    },
                    success: function(response) {
                        // Tampilkan hasil respons di dalam div dengan id "result"
                        $("#result").html(response);
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            }
        }
    </script>
    <div class="flex justify-start ">
        <div class='text-normal py-2 sm:text-lg'>
            <div class='border rounded-t-2xl rounded-t-xl'>
                <div class='flex rounded-t-xl px-2 py-1 justify-between'>
                    <strong><?= $pengirim ?></strong>
                    <form class="text-sm md:text-base text-red-400 rounded-md hover:bg-neutral-200 underline px-1">
                        <input id="sqlQueryId" type="hidden" name="sqlQueryId" value="<?= $id ?>">
                        <input id="sqlQueryPengirim" type="hidden" name="sqlQueryPengirim" value="<?= $pengirim ?>">
                        <button id="sqlQueryHapus" value="<?= $hapus_button ?>" onclick="konfirmasi(); return false;" name="sqlQueryHapus"></button>
                    </form>
                </div>
            </div>
            <p class='px-3 py-2 bg-white' style="font-size: 16px;"><?= $pesan ?></p>
            <p class='flex justify-end bg-white px-2 rounded-br-2xl font-thin sm:font-extralight text-xs items-center'><?= $time_send ?></p>
            <div id="result"></div>
        </div>
    </div>
</body>

</html>


<!-- <div class="flex justify-end ">
    <div class='text-normal py-2 sm:text-lg'>
        <div class='border rounded-t-2xl rounded-t-xl'>
            <div class='flex rounded-t-xl px-2 py-1 justify-between'>
                <strong><?= $pengirim ?></strong>
                <form class="text-sm md:text-base text-red-400 rounded-md hover:bg-neutral-200 underline px-1" action="hapus_pesan.php" method="post">
                    <input type="hidden" name="id_to_edit" value="<?= $id ?>">
                    <input type="hidden" name="pengirim_pesan" value="<?= $pengirim ?>">
                    <input id="hapusButton" value="<?= $hapus_button ?>" type="submit" onclick="konfirmasi(); return false;" name="hapus_pesan">
                </form>
            </div>
        </div>
        <p class='px-3 py-2 bg-white'><?= $pesan ?></p>
        <p class='flex justify-end bg-white px-2 rounded-bl-2xl font-thin sm:font-extralight text-xs items-center'><?= $time_send ?></p>
    </div>
</div> -->