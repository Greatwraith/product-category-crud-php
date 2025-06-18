<?php
include 'db.php'; // Ganti path sesuai posisi file kamu

if (isset($_GET['idk'])) {
    $id = $_GET['idk'];
    $delete = mysqli_query($conn, "DELETE FROM t_kategoriproduk WHERE id_kategori = '$id'");

    if ($delete) {
        echo "<script>alert('Category successfully deleted'); window.location='kategori_data.php';</script>";
    } else {
        echo 'failed to delete: ' . mysqli_error($conn);
    }
}
?>
