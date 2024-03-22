<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
?>

<?php
if (auth()->user()->jabatan != 'karyawan') {
    echo "<script>alert('Anda Bukan Karyawan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/dashboardkaryawan'; }, 1000);</script>";
    die();
}
?>

<?php
if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['product_picture']['tmp_name'];
    $name = $_FILES['product_picture']['name'];
    move_uploaded_file($tmp_name, "uploads/$name");
}

?>
<?php
$user = auth()->user();
$profilePicture = $user->gambar;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>Indomaret Self Service System - Manajemen Produk</title>
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
        
    </style>

</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<body>
    <!-- Navbar & Hero Start -->
    <!-- <div class="background"></div> -->
    <div class="title" style="text-align:center; background:white; display: flex; align-items: center; justify-content: center;border-bottom: 0.5px solid black;">
        <h1>Data Barang</h1>
    </div>

    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="background-color: white;">
            <a href="" class="navbar-brand p-0">
                <img src="    https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" style="width:150px;height:50px;">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
          <a href="{{route ('dashboardkaryawan')}}" class="nav-item nav-link">Home</a>
          <a class="nav-item nav-link" aria-current="page" href="{{route ('product_list2')}}">Belanja</a>
          <a class="nav-item nav-link active" aria-current="page" href="{{route ('product_menu2')}}">Data Barang</a>
          <a class="nav-item nav-link " aria-current="page" href="{{route ('daftarlaporankriminalitas2')}}">Laporan Kriminalitas</a>
          <a class="nav-item nav-link" aria-current="page" href="{{route ('transaction_list2')}}">Daftar Transaksi</a>
        </div>


        <a href="{{route ('shopwithhelp2')}}">
          <i class="fas fa-comments" style="font-size:30px"></i>
        </a>
                <div class="dropdown ml-auto" style="margin-left: auto;">
                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/'.$profilePicture) }}" alt="" width="48" height="48" style="border-radius: 50%;">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
                        @if (auth()->check())
                        <a class="dropdown-item" href="/showAccount2/{{$user->id}}">Hello <b>{{ auth()->user()->username }}</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route ('logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->


    <!-- manage start -->
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="/insertproduct2" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ID Barang</label>
                                <input type="number" name="id_barang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" onchange="checkIdLength(this.value)">
                                <script>
                                    function checkIdLength(id) {
                                        if (id.length !== 5) {
                                            alert("Invalid Product ID! \nPlease enter a 5 digit number.");
                                            document.getElementById("exampleInputEmail1").value = "";
                                        }
                                    }
                                </script>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Nama Barang</label>
                                <input type="text" name="namabarang" class="form-control" id="exampleInputName" aria-describedby="nameHelp" onchange="checkNameLength(this.value)">
                                <span id="name-error-msg" class="error-msg"></span>
                                <script>
                                    function checkNameLength(name) {
                                        if (name.length > 255) {
                                            alert("Invalid Name! Please enter a name with less than 255 characters.");
                                            document.getElementById("exampleInputName").value = "";
                                            document.getElementById("name-error-msg").textContent = "";
                                        } else {
                                            document.getElementById("name-error-msg").textContent = "";
                                        }
                                    }
                                </script>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Jenis Barang</label>
                                <input type="text" name="jenisbarang" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" onchange="checkNameLength(this.value)">
                                <span id="name-error-msg" class="error-msg"></span>

                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('form').submit(function(event) {
                                            var price = $('input[name="harga"]').val();
                                            if (isNaN(price)) {
                                                alert('Please enter a valid number for the price.');
                                                event.preventDefault();
                                            }
                                        });
                                    });
                                </script>

                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" onchange="checkNameLength(this.value)">
                                <span id="name-error-msg" class="error-msg"></span>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Komposisi</label>
                                <input type="text" name="komposisi" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" onchange="checkNameLength(this.value)">
                                <span id="name-error-msg" class="error-msg"></span>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Tanggal Kedaluwarsa</label>
                                <input type="text" name="tanggalkedaluwarsa" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" onchange="checkNameLength(this.value)">
                                <span id="name-error-msg" class="error-msg"></span>

                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah Stok Barang</label>
                                <input type="number" name="jumlahstokbarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="1" min="1">
                            </div>



                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                <select class="form-select" name="kategori_id" aria-label="Default select example">
                                    <option value="" selected disabled hidden>Pilih Kategori</option>
                                    @php
                                    $category = App\Models\Category::all();
                                    @endphp
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->product_category}}</option>
                                    @endforeach
                                </select>
                                <span id="category-error-msg" class="error-msg"></span>
                                <script>
                                    function checkCategory(category) {
                                        if (category === "") {
                                            document.getElementById("category-error-msg").textContent = "Please choose a category";
                                            return false;
                                        } else {
                                            document.getElementById("category-error-msg").textContent = "";
                                            return true;
                                        }
                                    }

                                    document.querySelector("form").addEventListener("submit", function(event) {
                                        const category = document.querySelector("[name='kategori_id']").value;
                                        if (!checkCategory(category)) {
                                            event.preventDefault();
                                        }
                                    });
                                </script>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <table class="table table-dark table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">ID Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Komposisi</th>
                        <th scope="col">Tanggal Kedaluwarsa</th>
                        <th scope="col">Jumlah Stok Barang</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Kategori</th>
                        <th scope="col" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                    <tr>
                        <th scope="row">{{$prod->id_barang}}</th>
                        <td>{{$prod->namabarang}}</td>
                        <td>{{$prod->jenisbarang}}</td>
                        <td>Rp {{ number_format($prod->harga, 0, ',', '.') }}.00</td>
                        <td>{{$prod->deskripsi}}</td>
                        <td>{{$prod->komposisi}}</td>
                        <td>{{$prod->tanggalkedaluwarsa}}</td>
                        <td>{{$prod->jumlahstokbarang}}</td>
                        <td><img src="{{ URL::asset('images/product_pictures/'.$prod->foto) }}" alt="" class="card-img-top"></td>
                        <td>{{ $prod->categories->product_category }}</td>
                        <td style="text-align: center;">
                            <a href="/showproduct2/{{$prod->id_barang}}" class="btn btn-success">Edit</a>
                            <a href="#" class="btn btn-danger delete" id-data="{{$prod->id_barang}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="https://www.linkedin.com/in/yonathan-fanuel-mulyadi-08a690231/">2024 Copyright: Yonathan Fanuel Mulyadi</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

<script>
    $('.delete').click(function() {
        var stdid = $(this).attr('id-data');
        swal({
                title: "Delete Data?",
                text: "Apakah Anda Yakin Menghapus Barang " + stdid + "?\n" ,
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Data Berhasil Dihapus!", {
                        icon: "success",
                    }).then(() => {
                        window.location = "/deleteproduct2/" + stdid;
                    });
                } else {
                    swal("Penghapusan Data Dibatalkan!");
                }
            });
    });
</script>

</html>