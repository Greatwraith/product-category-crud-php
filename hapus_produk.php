<?php
include 'db.php'; // Ganti path sesuai posisi file kamu

if (isset($_GET['idk'])) {
    $id = $_GET['idk'];
    $delete = mysqli_query($conn, "DELETE FROM t_produk WHERE id_produk = '$id'");

    if ($delete) {
         echo "<script>alert('Category successfully deleted'); window.location='index.php';</script>";
    } else {
        echo 'Failed to delete: ' . mysqli_error($conn);
    }
}
?>
