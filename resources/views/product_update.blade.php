<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan Login ke dalam Sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
?>

<?php
if (!auth()->check() || auth()->user()->jabatan != 'generalmanageroperasional' && auth()->user()->jabatan != 'karyawan') {
    echo "<script>alert('Anda Bukan General Manager Operasional/Karyawan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/homepage'; }, 1000);</script>";
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System - Login</title>
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url('https://swamediainc.storage.googleapis.com/swa.co.id/wp-content/uploads/2022/01/17165433/Transaksi-GoPay-di-Indomaret.jpg');
            filter: blur(5px);

        }

        .hr1 {
            padding: 0;
            margin: 0;
        }

        footer {
            background-color: rgba(255, 255, 255, 0.7);
        }

        .h1-footer {
            color: rgb(152, 255, 200);
            text-align: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .text-muted {
            text-align: center;
            color: white;
        }

        img.sosimg {
            height: 20px;
            width: 20px;
            margin-right: 2px;
        }
    </style>

</head>

<body>
    <div class="background"></div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container-fluid">

            <nav class="navbar bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="">
                    <img src="    https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" style="width:150px;height:50px;"> </a>
                </div>
            </nav>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <h1 class="position-absolute top-50 start-50 translate-middle">Pembaharuan Data Barang</h1>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    &nbsp; &nbsp;
                    <div class="dropdown ml-auto">
                    </div>
                </nav>
            </div>
        </div>
    </nav>



    <div class="container" style="margin-bottom: 30px;">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/editproduct/{{$productdata->id_barang}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID Barang</label>
                                <input type="number" name="id_barang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->id_barang}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->namabarang}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Barang</label>
                                <input type="text" name="jenisbarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->jenisbarang}}">
                            </div>
                            <div class="mb-3">

                                <label for="exampleInputEmail1" class="form-label">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->harga}}">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->deskripsi}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Komposisi</label>
                                <input type="text" name="komposisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->komposisi}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Kedaluwarsa</label>
                                <input type="text" name="tanggalkedaluwarsa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$productdata->tanggalkedaluwarsa}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah Stok Barang</label>
                                <input type="number" name="jumlahstokbarang" class="form-control input-number" id="exampleInputEmail1" value="{{ $productdata->jumlahstokbarang }}" min="1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Picture</label>
                                <input type="file" name="foto" class="form-control custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" value="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Product Category</label>
                                <select class="form-select" name="kategori_id" aria-label="Default select example">
                                    <option value="{{$productdata->kategori_id}}" selected>{{$productdata->categories->product_category }}</option>
                                    @php
                                    $category = App\Models\Category::all();
                                    @endphp
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->product_category}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</body>

</html>