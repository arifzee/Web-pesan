<?php
include "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_to_edit = $_POST['sqlQueryId'];
    $pengirim_pesan = $_POST['sqlQueryPengirim'];

    $sql = "SELECT * FROM messages WHERE id=? AND sender_name=?";
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        die("Error in statement preparation: " . $koneksi->error);
    }
    $stmt->bind_param("is", $id_to_edit, $pengirim_pesan);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo $data['id'];

    if ($data['sender_name'] == $_SESSION['username']) {

        $message_hapus = "<i>" . "(pesan ini telah dihapus)" . "</i>";
        $sql_edit = "UPDATE messages SET message_text=? WHERE id=?";
        $stmt_update = $koneksi->prepare($sql_edit);
        if (!$stmt_update) {
            die("Error in statement preparation: " . $koneksi->error);
        }
        $stmt_update->bind_param("si", $message_hapus, $id_to_edit);
        $stmt_update->execute();
        $stmt_update->close();

        if ($data['id'] == $id_to_edit) {
            $hapus_button = "";
            $sql_hapus_button = "UPDATE messages SET hapus_button=? WHERE id=?";
            $stmt_delete = $koneksi->prepare($sql_hapus_button);
            if (!$stmt_delete) {
                die("Error in statement preparation: " . $koneksi->error);
            }
            $stmt_delete->bind_param("si", $hapus_button, $id_to_edit);
            $stmt_delete->execute();
            $stmt_delete->close();

        } else {
            return false;
        }
    } else {
        echo '<script>alert("gak boleh hapus pesan orang lain😏");</script>';
    }



    $stmt->close();
}

$koneksi->close();
