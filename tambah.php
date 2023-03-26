<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['gambar'];

    $file = $_FILES['gambar'];
    $filename = $file['name'];
    $filetmp = $file['tmp_name'];
    $filetype = $file['type'];
    $filesize = $file['size'];
    $fileerror = $file['error'];

    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($filetype, $allowed_types)) {

        if ($filesize <= 2000000) {
            $new_filename = uniqid('', true) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
            $destination = 'gambar/' . $new_filename;
            // Move uploaded file to destination folder
            if (move_uploaded_file($filetmp, $destination)) {
                // Insert data into database
                $sql = "INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) 
                VALUES ('{$kategori}', '{$nama}', '{$destination}', '{$harga_beli}', '{$harga_jual}', '{$stok}')";

                    if (mysqli_query($conn, $sql)) {
                        header('location: index.php');
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                echo 'Error uploading file.';
            }
        } else {
            echo 'File size exceeds limit.';
        }
    } else {
        echo 'File type not allowed.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Tambah Barang</title>
    <style>
        label {
            display : block;
        }
        body{
            background: #84D2C5;
        }
        .kotak-login{
            width: 350px;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            background: white;
            /*meletakkan form ke tengah*/
            margin: 80px auto;
            padding: 30px 20px;
        }
        .kartu {
            width: 500px;
            margin: 0 auto;
            margin-top: 30px;
            box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.03);
            transition: all .3s;
            background-color: #8DCBE6;
            border: solid 8px #ECECEC;
            border-top-right-radius: 80px;
            border-bottom-left-radius: 80px;
        } 
        .kartu:hover {
            background-color: #DDDDDD;
            border: solid 8px #EEEEEE;
            border-top-left-radius: 80px;
            border-bottom-right-radius: 80px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 0px;
        }
        .input label {
            display: block;
            margin-bottom: 5px;
            margin-left: 40px;
            font-weight: bold;
        }
        .input input[type="text"],
        .input input[type="file"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            margin-left: 40px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .input select {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            margin-left: 40px;
            padding-right: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .submit input[type="submit"] {
            background-color: #417A07;
            color: white;
            padding: 12px;
            border: none;
            margin-left: 40px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 30px;
        }
        .submit input[type="submit"]:hover {
            background-color: #417A07;
        }
        .preview {
            margin-top: 10px;
            width: 50%;
            height: 200px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            font-weight:bold;
            font-size: 24px;
        }
        .preview img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card kartu">
            <h1>Tambah Barang</h1>
            <div class="main">
                <form method="post" action="tambah.php" enctype="multipart/form-data">
                    <div class="input">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" />
                    </div>
                    <div class="input">
                        <label>Kategori</label>
                    <select name="kategori">
                        <option value="Komputer">Komputer</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Hand Phone">Hand Phone</option>
                    </select>
                    </div>
                    <div class="input">
                        <label>Harga Jual</label>
                        <input type="text" name="harga_jual" />
                    </div>
                    <div class="input">
                        <label>Harga Beli</label>
                        <input type="text" name="harga_beli" />
                    </div>
                    <div class="input">
                        <label>Stok</label>
                        <input type="text" name="stok" />
                    </div>
                    <div class="input">
                        <label>File Gambar</label>
                        <input type="file" name="gambar">
                    </div>
                    <div class="submit">
                        <input type="submit" name="submit" value="Simpan" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>