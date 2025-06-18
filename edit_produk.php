<?php 
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        fieldset {
            margin-bottom: 15px;
            border: none;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select, textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }
        button:active {
            background-color: #004085;
            transform: scale(0.95);
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<?php 
$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM t_produk WHERE id_produk = '$id'");
if (mysqli_num_rows($produk) == 0) {
    echo '<script>window.location="produk_data.php";</script>';
}
$p = mysqli_fetch_object($produk);
?>

<h2>Edit Product</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <fieldset>
        <label>Category</label>
        <select name="kategori" required>
            <?php 
            $kategori = mysqli_query($conn, "SELECT * FROM t_kategoriproduk ORDER BY id_kategori DESC");
            while ($k = mysqli_fetch_array($kategori)) {
                echo '<option value="'.$k['id_kategori'].'" '.($p->id_kategori == $k['id_kategori'] ? 'selected' : '').'>'.$k['nama_kategori'].'</option>';
            }
            ?>
        </select>
    </fieldset>

    <fieldset>
        <label>Product Name</label>
        <input type="text" name="nama" value="<?php echo $p->nama ?>" required>
    </fieldset>

    <fieldset>
        <label>Price</label>
        <input type="text" name="harga" value="<?php echo $p->harga ?>" required>
    </fieldset>

    <fieldset>
        <label>Stock</label>
        <input type="number" name="stok" value="<?php echo $p->stok ?>" required>
    </fieldset>

    <fieldset>
        <label>Description</label>
        <textarea name="deskripsi" rows="5" required><?php echo $p->deskripsi ?></textarea>
    </fieldset>

    <fieldset>
        <label>Image</label>
        <img src="../gambarproduk/<?php echo $p->foto ?>" width="100px" alt="Product Image"><br><br>
        <input type="hidden" name="foto_lama" value="<?php echo $p->foto ?>">
        <input type="file" name="gambar">
    </fieldset>

    <fieldset>
        <label>Status</label>
        <select name="status" required>
            <option value="1" <?php echo ($p->status == 1 ? 'selected' : '') ?>>Active</option>
            <option value="0" <?php echo ($p->status == 0 ? 'selected' : '') ?>>Inactive</option>
        </select>
    </fieldset>

    <fieldset>
        <label>Product Code</label>
        <input type="text" name="kode_produk" value="<?php echo $p->kode_produk ?>" required>
    </fieldset>

    <fieldset>
        <button type="submit" name="submit">EDIT</button>
    </fieldset>
</form>

<?php
if (isset($_POST['submit'])) {
    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $kode_produk = $_POST['kode_produk'];
    $foto_lama = $_POST['foto_lama'];

    $filename = $_FILES['gambar']['name'];
    $filetmp = $_FILES['gambar']['tmp_name'];

    if ($filename != '') {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newname = 'product' . time() . '.' . $ext;
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];

        if (!in_array($ext, $allowed)) {
            echo '<script>alert("Unsupported image format");</script>';
            exit;
        }

        // delete old image
        if (file_exists('../gambarproduk/'.$foto_lama)) {
            unlink('../gambarproduk/'.$foto_lama);
        }

        move_uploaded_file($filetmp, '../gambarproduk/'.$newname);
        $foto = $newname;
    } else {
        $foto = $foto_lama;
    }

    $update = mysqli_query($conn, "UPDATE t_produk SET
        id_kategori = '$kategori',
        nama = '$nama',
        harga = '$harga',
        stok = '$stok',
        deskripsi = '$deskripsi',
        foto = '$foto',
        status = '$status',
        kode_produk = '$kode_produk'
        WHERE id_produk = '$id'");

    if ($update) {
        echo '<script>alert("Product successfully updated"); window.location="index.php";</script>';
    } else {
        echo 'Failed to update product: ' . mysqli_error($conn);
    }
}
?>

</body>
</html>
