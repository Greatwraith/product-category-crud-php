<?php 
include('db.php'); 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Category</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
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
<body>
    
    <h2 style="text-align: center;">Add Category</h2>
    <form action="" method="post">
        <br>
        <legend style="font-size: 1em; font-weight: bold; color: #333;">
            Category Name
        </legend>
        <br>
        <div>
            <input type="text" name="nama" placeholder="Product category..." required>
        </div>    
        <br>
        <button name="submit" type="submit"
            style="background: #007bff; color: #fff; border: none; padding: 10px 20px; margin-top: 4px; font-size: 1em; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
            onmousedown="this.style.backgroundColor='#004085'; this.style.transform='scale(0.95)';"
            onmouseup="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';"
            onclick="return confirm('Are you sure you want to add this category?')">
            ADD
        </button>            
    </form>

    <?php             
    if (isset($_POST['submit'])) {
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);

        $insert = mysqli_query($conn, "INSERT INTO t_kategoriproduk (nama_kategori) VALUES ('$nama')");

        if ($insert) {
            echo '<script>alert("Category successfully added."); window.location="kategori_data.php";</script>';
        } else {
            echo '<script>alert("Failed to add category.");</script>';
        }
    }
    ?>
</body>
</html>
