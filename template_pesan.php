<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="flex justify-start">
        <div class='text-normal py-2 sm:text-lg'>
            <div class='border rounded-t-2xl rounded-t-xl'>
                <div class='flex gap-10 rounded-t-xl px-2 py-1 justify-between'>
                    <strong><?= $pengirim ?></strong>
                    <form>
                        <input id="sqlQueryId<?= $id ?>" type="hidden" name="sqlQueryId" value="<?= $id ?>">
                        <input id="sqlQueryPengirim<?= $id ?>" type="hidden" name="sqlQueryPengirim" value="<?= $pengirim ?>">
                        <input class="text-red-400 text-xs rounded-md hover:underline px-1 hover:cursor-pointer" id="sqlQueryHapus<?= $id ?>" type="button" onclick="konfirmasi('<?= $id ?>');" name="sqlQueryHapus" value="<?= $hapus_button ?>">
                    </form>
                </div>
            </div>
            <p class='px-3 py-2 bg-white' style="font-size: 16px;"><?= $pesan ?></p>
            <p class='flex justify-end bg-white px-2 rounded-br-2xl font-thin sm:font-extralight text-xs items-center'><?= $time_send ?></p>
            <div id="result<?= $id ?>"></div>
        </div>
    </div>
    <script>
        function konfirmasi(id) {
            var hasil = confirm("yakin mau dihapus?");
            if (hasil) {
                var sqlQueryId = $("#sqlQueryId" + id).val();
                var sqlQueryPengirim = $("#sqlQueryPengirim" + id).val();
                var sqlQueryHapus = $("#sqlQueryHapus" + id).val();
                $.ajax({
                    type: "POST",
                    url: "hapus_pesan.php", // Ganti dengan nama file PHP yang menangani permintaan SQL
                    data: {
                        sqlQueryId: sqlQueryId,
                        sqlQueryPengirim: sqlQueryPengirim,
                        sqlQueryHapus: sqlQueryHapus
                    },
                    success: function(response) {
                        // Tampilkan hasil respons di dalam div dengan id "result"
                        $("#result" + id).html(response);
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            } else {
                return false;
            }
        }
    </script>
</body>

</html>

