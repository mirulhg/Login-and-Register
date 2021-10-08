<?php

include "config.php";

error_reporting(0);

session_start();

if (isset($_SESSION['register'])) {
    header("Location: login.php");
}

if (isset($_POST["register"])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT); 
    

    if ($password == $password1) {
        $sql = "SELECT * FROM tbl_users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO tbl_users (username, name, email, password)
                    VALUES ('$username', '$name', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('REGISTRASI BERHASIL.')</script>";
                $username = "";
                $name = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['password1'] = "";    
            } else {
                echo "<script>alert('Woops! Something Wrong Went.')</script>";
            } 
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pengguna Kamar Sablon</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">

        <p>&larr; <a href="index.php">Home</a>

        <h4>Registrasi Pengguna Kamar Sablon</h4>
        <p>Jika sudah punya akun<a href="login.php">Login di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
            </div>

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input class="form-control" type="text" name="name" placeholder="" value="<?php echo $name; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Alamat Email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" requierd>
            </div>

           <div class="form-group">
                <label for="password">Confrim Password</label>
                <input class="form-control" type="password" name="password1" placeholder="Confrim Password" value="<?php echo $_POST['password1']; ?>" required>
            </div>

            <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />

        </form>
            
        </div>

        <div class="col-md-6">
            <img class="img img-responsive" src="img/connect.png" />
        </div>

    </div>
</div>

</body>
</html>