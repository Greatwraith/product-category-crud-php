<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        a.btn {
            background: #007bff;
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
        a.btn:active {
            background-color: #004085;
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <a href="index.php" class="btn">product data</a>
    <br>
    <a href="tambah_kategori.php" class="btn">ADD KATEGORI</a>

    <table>
        <thead>
            <tr>
              <th>No</th>
              <th>category</th>
              <th>Edit || Delete</th>
            
        </thead>
        <tbody>

        <?php
                $no = 1;
                $kategori = mysqli_query($conn, "SELECT * FROM `t_kategoriproduk` ORDER BY id_kategori DESC");
                if (mysqli_num_rows($kategori) > 0) {
                    while ($row = mysqli_fetch_array($kategori)) {
            ?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_kategori']; ?></td>
                        <td>
                            <a href="edit_kategori.php?id=<?php echo $row['id_kategori']; ?>">Edit</a> ||
                            <a href="hapus_kategori.php?idk=<?php echo $row['id_kategori']; ?>" onclick="return confirm('Are you sure you want to delete it?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="3">category not found.</td></tr>';
            }
            ?>
        </tbody>
    </table>

</body>
</html>
