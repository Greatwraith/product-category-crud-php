<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Product</title>
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
        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="file"] {
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

<h2>Add Product</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <fieldset>
        <label>Category</label>
        <select name="kategori" required>
            <option value="">-- SELECT --</option>
            <?php 
            $kategori = mysqli_query($conn, "SELECT * FROM t_kategoriproduk ORDER BY id_kategori DESC");
            while ($k = mysqli_fetch_array($kategori)) {
                echo '<option value="'.$k['id_kategori'].'">'.$k['nama_kategori'].'</option>';
            }
            ?>
        </select>
    </fieldset>

    <fieldset>
        <label>Product Name</label>
        <input type="text" name="nama" required />
    </fieldset>

    <fieldset>
        <label>Price</label>
        <input type="text" name="harga" required />
    </fieldset>

    <fieldset>
        <label>Stock</label>
        <input type="number" name="stok" required />
    </fieldset>

    <fieldset>
        <label>Description</label>
        <textarea name="deskripsi" rows="5" required></textarea>
    </fieldset>

    <fieldset>
        <label>Image</label>
        <input type="file" name="foto" required />
    </fieldset>

    <fieldset>
        <label>Status</label>
        <select name="status" required>
            <option value="">-- SELECT --</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </fieldset>

    <fieldset>
        <label>Product Code</label>
        <input type="text" name="kode_produk" required />
    </fieldset>

    <fieldset>
        <button type="submit" name="submit">ADD</button>
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

    $filename = $_FILES['foto']['name'];
    $filetmp = $_FILES['foto']['tmp_name'];

    $type1 = explode('.', $filename);
    $type2 = strtolower(end($type1));

    $newname = 'product_' . time() . '.' . $type2;

    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');

    if (!in_array($type2, $allowed_types)) {
        echo '<script>alert("File format is not allowed");</script>';
    } else {
        if (move_uploaded_file($filetmp, 'gambarproduk/' . $newname)) {
            $insert = mysqli_query($conn, "INSERT INTO t_produk 
                (id_kategori, nama, harga, deskripsi, foto, status, tanggal_masuk, stok, kode_produk)
                VALUES ('$kategori', '$nama', '$harga', '$deskripsi', '$newname', '$status', NOW(), '$stok', '$kode_produk')");

            if ($insert) {
                echo '<script>alert("Product added successfully"); window.location="index.php";</script>';
            } else {
                echo 'Failed to add product: ' . mysqli_error($conn);
            }
        } else {
            echo '<script>alert("Failed to upload image");</script>';
        }
    }
}
?>

</body>
</html>
