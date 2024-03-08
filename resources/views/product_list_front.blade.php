<?php
if (auth()->check() && auth()->user()->status != 'active') {
    header('Location: /login');
    exit();
}
if (auth()->user()->jabatan != 'pelanggan') {
    echo "<script>alert('Anda Bukan Pelanggan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
    <style>
        .box {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            border-radius: 10px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>

    <div class="box">

        <h1 style="display:flex; justify-content:center; align-items:center;">Pilihan Cara Berbelanja</h1>
        <div class="d-inline-flex">
            <a href="{{route ('product_list3')}}">
            <div class="card m-2 position-relative" style="width: 400px;">
                <img src="https://www.hashmicro.com/id/blog/wp-content/uploads/2022/11/self-service-3-scaled.jpg" alt="" style="height: 100%; width: 100%; filter: blur(8px);">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <h3 class="text-white" style="text-shadow: 2px 2px 2px black;">Belanja Mandiri</h3>
                </div>
            </div>
            </a>
            <a href="{{route ('product_list3')}}">
            <div class="card m-2" style="width: 400px;">
                <img src="https://assets-global.website-files.com/637610b6e8be873142dadb34/63e23006e168492abf6c2ff6_5-Reasons-Why-Every-Employee-Need-Customer-Service-1.png" alt="" style="height: 100%; width: 100%;filter: blur(8px);">
                <div class="position-absolute top-50 start-50 translate-middle text-center">
                    <h3 class="text-white" style="text-shadow: 2px 2px 2px black;">Belanja dengan Bantuan Karyawan</h3>
                </div>
            </div>
            </a>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>