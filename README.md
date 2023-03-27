# Praktikum 3: PHP dan Database MySQL

# Langkah-langkah Praktikum
1. Persiapan
- Persiapkan text editor misalnya VSCode.
- Buat folder baru dengan nama lab3_php_database pada docroot webserver (htdocs)
![image](https://user-images.githubusercontent.com/115923969/227814421-0b0f97c2-9ce9-497d-9fb4-a407ee35a6e9.png)
- tambahkan file css dan bootstrap serta folder gambar unttuk menampung file gambar yang akan diuploud di dalam folder lab3_php_database
![image](https://user-images.githubusercontent.com/115923969/227816631-6843e28f-0203-4acf-9804-c92da787e97e.png)

- Untuk memulai membuat aplikasi CRUD sederhana, yang perlu disiapkan adalah database server
menggunakan MySQL. Pastikan MySQL Server sudah dapat dijalankan melalui XAMPP.

2. Menjalankan MySQL Server
Untuk menjalankan MySQL Server dari menu XAMPP Contol.
![image](https://user-images.githubusercontent.com/115923969/227814529-cb3c99d1-5925-468d-9b12-adb145c02b81.png)

3. Mengakses MySQL Client menggunakan PHP MyAdmin
Pastikan webserver Apache dan MySQL server sudah dijalankan. Kemudian buka melalui browser:
http://localhost/phpmyadmin/


4. Membuat Database: Studi Kasus Data Barang
- Membuat Database


      CREATE DATABASE latihan1;
![image](https://user-images.githubusercontent.com/115923969/227814566-ee7f6829-31d2-4ed8-8127-f74a1965b7da.png)

- Membuat Tabel


      CREATE TABLE data_barang (
      id_barang int(10) auto_increment Primary Key,
      kategori varchar(30),
      nama varchar(30),
      gambar varchar(100),
      harga_beli decimal(10,0),
      harga_jual decimal(10,0),
      stok int(4)
      );
      
      
      
      
![image](https://user-images.githubusercontent.com/115923969/227814636-f83201bb-bb4b-4936-ab9c-ded25a880b58.png)

- Menambahkan Data

      INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual,stok)
      VALUES ('Elektronik', 'HP Samsung Android', 'hp_samsung.jpg', 2000000,2400000, 5),
      ('Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5),
      ('Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5);
      



![image](https://user-images.githubusercontent.com/115923969/227814722-3dd68746-74da-4130-b324-1bcc51a6ec88.png)
 
5. Membuat Program CRUD
Buat folder lab8_php_database pada root directory web server (d:\xampp\htdocs)
![image](https://user-images.githubusercontent.com/115923969/227816851-8da6b056-b0f2-4e8f-bd9b-8a4697faf600.png)

Kemudian untuk mengakses direktory tersebut pada web server dengan mengakses URL:
http://localhost/lab3_php_database/
![image](https://user-images.githubusercontent.com/115923969/227816881-216f66d0-44a9-48f7-8f3c-2c1d99ff80ff.png)

6. Membuat file koneksi database
Buat file baru dengan nama koneksi.php




        <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "latihan1";

        $conn = mysqli_connect($host, $user, $pass, $db);
        if ($conn == false) {
            echo "Koneksi ke server gagal.";
            die();
        } #else echo "Koneksi berhasil";
        ?>
      
      
      

Buka melalui browser untuk menguji koneksi database (untuk menyampilkan pesan koneksi berhasil,
uncomment pada perintah echo “koneksi berhasil”;
![image](https://user-images.githubusercontent.com/115923969/227814894-ee74d387-d352-47ee-8382-b53457551bc1.png)


7. Membuat file index untuk menampilkan data (Read)
Buat file baru dengan nama index.php





        <?php
        include("koneksi.php");
        // query untuk menampilkan data
        $sql = 'SELECT * FROM data_barang';
        $result = mysqli_query($conn, $sql);
        ?>

        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Data Barang</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
                <style>
                     .preview img {
                            width: 100%;
                            height: auto;
                      }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Data Barang</h1>
                    <div class="main">
                        <td><a class="button" href="tambah.php">Tambah Barang</a>        
                        <table>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Katagori</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                        <?php if ($result) : ?>
                        <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><img src="<?= $row['gambar']; ?>" alt="<?=
                            $row['nama']; ?>"></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= $row['harga_jual']; ?></td>
                            <td><?= $row['harga_beli']; ?></td>
                            <td><?= $row['stok']; ?></td>
                            <td><a href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a> <a href="hapus.php?id=<?= $row['id_barang']; ?>">Hapus</a></td>
                        </tr>
                        <?php endwhile; else : ?>
                        <tr>
                            <td colspan="7">Belum ada data</td>
                        </tr>
                        <?php endif; ?>
                        </table>
                    </div>
                </div>
            </body>
        </html>


![image](https://user-images.githubusercontent.com/115923969/227816141-debcc8c2-709d-414c-8975-016c8da69082.png)


Tambahkan style css agar tampilan lebih menarik dalam file index.php



               <style>
                    body{
                        background: #84D2C5;
                    }
                    h1 {
                        font-weight: bold;
                        margin-top: 30px;
                        font-size: 40px;
                        text-align: center;
                        }
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        }
                    tr:nth-of-type(even){
                        background-color:#f3f3f3;
                        }
                    tr:nth-of-type(odd){
                        background-color:#ddd;
                        }
                    th,
                    td {
                        padding: 8px;
                        text-align: center;
                      border-bottom: 1px solid #ddd;
                      border: 1px solid #ccc;
                      }
                  th {
                      background-color: #417A07;
                      color: white;
                      }
                  td img {
                      width: 50px;
                      height: 50px;
                      }
                  td a {
                      background-color: #417A07;
                      color: white;
                      padding: 6px 12px;
                      text-align: center;
                      text-decoration: none;
                      display: inline-block;
                      border-radius: 4px;
                      }
                  .button {
                      background-color: #417A07;
                      font-size: 15px;
                      color: white;
                      padding: 6px 12px;
                      text-align: center;
                      text-decoration: none;
                      border-radius: 4px;
                      margin-top: 10px;
                      margin-bottom: 10px;
                      float: left;
                      }
                  .preview img {
                      width: 100%;
                      height: auto;
                      }
              </style>






![image](https://user-images.githubusercontent.com/115923969/227816223-77b5d2a7-00fb-4e16-98b1-0f34d12f21d5.png)




8. Menambah Data (Create)
Buat file baru dengan nama tambah.php



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



![image](https://user-images.githubusercontent.com/115923969/227816342-7498f481-e54c-4cb8-ab24-583b95dbf9b3.png)

9. Mengubah Data (Update)
Buat file baru dengan nama ubah.php


        <?php
        error_reporting(E_ALL);
        include_once 'koneksi.php';
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $kategori = $_POST['kategori'];
            $harga_jual = $_POST['harga_jual'];
            $harga_beli = $_POST['harga_beli'];
            $stok = $_POST['stok'];
            $file_gambar = $_FILES['file_gambar'];
            $gambar = null;
            if ($file_gambar['error'] == 0) {
                $filename = str_replace(' ', '_', $file_gambar['name']);
                $destination = dirname(__FILE__) . '/gambar/' . $filename;
                if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
                    $gambar = 'gambar/' . $filename;;
                }
            }
            $sql = 'UPDATE data_barang SET ';
            $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
            $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}',
            stok = '{$stok}' ";
            if (!empty($gambar))
            $sql .= ", gambar = '{$gambar}' ";
            $sql .= "WHERE id_barang = '{$id}'";
            $result = mysqli_query($conn, $sql);
            header('location: index.php');
        }
        $id = $_GET['id'];
        $sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
        $result = mysqli_query($conn, $sql);
        if (!$result) die('Error: Data tidak tersedia');
        $data = mysqli_fetch_array($result);
        function is_select($var, $val){
            if ($var == $val) return 'selected="selected"';
            return false;
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <title>Ubah Barang</title>
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
                    <h1>Ubah Barang</h1>
                    <div class="main">
                        <form method="post" action="ubah.php" enctype="multipart/form-data">
                            <div class="input">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" value="<?php echo $data['nama']; ?>" />
                            </div>
                            <div class="input">
                                <label>Kategori</label>
                                <select name="kategori">
                                    <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
                                    <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Elektronik">Elektronik</option>
                                    <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Hand Phone">Hand Phone</option>
                                </select>
                            </div>
                            <div class="input">
                                <label>Harga Jual</label>
                                <input type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" />
                            </div>
                            <div class="input">
                                <label>Harga Beli</label>
                                <input type="text" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" />
                            </div>
                            <div class="input">
                                <label>Stok</label>
                                <input type="text" name="stok" value="<?php echo $data['stok']; ?>" />
                            </div>
                            <div class="input">
                                <label>File Gambar</label>
                                <input type="file" name="file_gambar" />
                            </div>
                            <div class="submit">
                                <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>" />
                                <input type="submit" name="submit" value="Simpan" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
        </html>



![image](https://user-images.githubusercontent.com/115923969/227816391-7df243aa-357d-4b9f-bbf0-922c04193de2.png)

10. Menghapus Data (Delete)
Buat file baru dengan nama hapus.php



        <?php
        include_once 'koneksi.php';
        $id = $_GET['id'];
        $sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
        $result = mysqli_query($conn, $sql);
        header('location: index.php');
        ?>

