<?php 
include 'db.php';

$id = $_GET['id'];
$kategori = mysqli_query($conn, "SELECT * FROM t_kategoriproduk WHERE id_kategori = '$id'");
if (mysqli_num_rows($kategori) == 0) {
    echo "<script>window.location='kategori_data.php'</script>";
    exit;
}
$k = mysqli_fetch_object($kategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 500px;
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
        input[type="text"] {
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
    </style>
</head>
<body>

    <h2 style="text-align: center;">Edit Category</h2>
    <form method="POST" action="">
        <fieldset>
            <label>Category Name</label>
            <input style="font-size: 16px;" type="text" name="nama_kategori" value="<?php echo $k->nama_kategori ?>" required>
        </fieldset>
        <fieldset>
            <button type="submit" name="submit">UPDATE</button>
        </fieldset>
    </form>

<?php
if (isset($_POST['submit'])) {
    $nama_kategori = $_POST['nama_kategori'];

    $update = mysqli_query($conn, "UPDATE t_kategoriproduk SET 
        nama_kategori = '$nama_kategori'
        WHERE id_kategori = '$id'
    ");

    if ($update) {
        echo "<script>alert('Category updated successfully'); window.location='kategori_data.php';</script>";
    } else {
        echo "Failed to update category: " . mysqli_error($conn);
    }
}
?>

</body>
</html>
