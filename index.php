<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 10px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        a.btn2 {
            background: rgb(232, 2, 248);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        a.btn2:hover {
            background-color: rgb(127, 4, 102);
            transform: scale(1.05);
        }

        a.btn2:active {
            background-color: rgb(127, 4, 102);
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <a href="kategori_data.php" class="btn1">Category Data</a>
    <br><br>
    <a href="tambah_produk.php" class="btn2">Add Product</a>

    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>No</th>
                <th>Name</th>  
                <th>Price</th>
                <th>Stock</th>
                <th>Description</th>
                <th>Image</th>
                <th>Date Added</th>
                <th>Status</th>
                <th>Product Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $produk = mysqli_query($conn, "
                SELECT m.*, f.nama_kategori
                FROM t_produk m
                JOIN t_kategoriproduk f ON m.id_kategori = f.id_kategori
                ORDER BY m.id_produk DESC
            ");

            if (mysqli_num_rows($produk) > 0) {
                while ($row = mysqli_fetch_array($produk)) {
                    ?>
                    <tr>
                        <td><?php echo $row['nama_kategori']; ?></td>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td>
                            <a href="gambarproduk/<?php echo $row['foto'] ?>" target="_blank">
                                <img src="gambarproduk/<?php echo $row['foto'] ?>" width="50px">
                            </a>
                        </td>
                        <td><?php echo $row['tanggal_masuk']; ?></td>
                        <td><?php echo $row['status'] ? 'Active' : 'Inactive'; ?></td>
                        <td><?php echo $row['kode_produk']; ?></td>
                        <td>
                            <a href="edit_produk.php?id=<?php echo $row['id_produk']; ?>">Edit</a> ||
                            <a href="hapus_produk.php?idk=<?php echo $row['id_produk']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="11">No product data found.</td></tr>';
            }
            ?>
        </tbody>
    </table>

</body>
</html>
