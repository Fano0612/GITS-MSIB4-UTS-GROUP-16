<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
if (auth()->user()->jabatan != 'pelanggan') {
    echo "<script>alert('Anda Bukan Pelanggan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/dashboardpelanggan'; }, 1000);</script>";
    die();
}


$user = auth()->user();
$profilePicture = $user->gambar;
?>



<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>Indomaret Self Service System - Riwayat Transaksi</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png') }}">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
    <div class="background"></div>
    <div class="title" style="text-align:center; background:white; display: flex; align-items: center; justify-content: center;border-bottom: 0.5px solid black;">
        <h1>Riwayat Belanja</h1>
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
                    <a href="{{route ('dashboardpelanggan')}}" class="nav-item nav-link">Home</a>
                    <a href="{{route ('product_list_front')}}" class="nav-item nav-link">Belanja</a>
                    <a href="{{route ('laporankriminalitas')}}" class="nav-item nav-link ">Laporan Kriminalitas</a>
                    <a href="{{route ('transaction_list3')}}" class="nav-item nav-link active">Riwayat Belanja</a>
                </div>

                <a href="{{route ('showProductCart')}}">
                    <i class="fa fa-shopping-cart" style="font-size:30px"></i>
                </a>
                <div class="dropdown ml-auto" style="margin-left: auto;">
                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/'.$profilePicture) }}" alt="" width="48" height="48" style="border-radius: 50%;">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
                        @if (auth()->check())
                        <a class="dropdown-item" href="/showAccount3/{{$user->id}}">Hello <b>{{ auth()->user()->username }}</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route ('logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->

    <!-- transaction start -->
    <div class="mt-5 mb-5 text-center">
        <div class="container" style="width: 500px; display: inline-block;">
            @php
            $userId = Auth::id();
            $transactionData = App\Models\Transaction::where('user_id', $userId)->get()->groupBy('user_id');
            @endphp

            @foreach($transactionData as $userId => $transactions)
            <ul class="list-group">

                <li class="list-group-item d-flex justify-content-center align-items-center">
                    <div class="mb-2">
                        <div class="fw-bold">ID Pelanggan: {{ $userId }}</div>
                    </div>
                </li>

                @php
                $prevTransactionId = null;
                @endphp

                @foreach($transactions as $td)
                @if($td->transaction_id != $prevTransactionId)
                @if(!is_null($prevTransactionId))
            </ul>
            @endif
            <ul class="list-group">
                <li class="list-group-item fw-bold">
                    ID Transaksi: {{ $td->transaction_id }}
                    <span>
                        <a href="{{ route('viewProductTransaction3', ['transactionId' => $td->transaction_id]) }}" class="btn btn-primary" style="float:right; border-radius:10px;">
                            Detil
                        </a>
                        <a href="#" style="float:right; opacity: 0;">
                            a
                        </a>

                        <a href="{{ route('printTransaction3', ['transactionId' => $td->transaction_id]) }}" class="btn btn-warning" style="float:right;border-radius:10px;">
                            Print
                        </a>
                        &nbsp;
                    </span>
                </li>

                @php
                $prevTransactionId = $td->transaction_id;
                @endphp
                @endif
                <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <div class="mb-2">
                            Nama Produk: {{ $td->product_name }}
                        </div>
                        <div class="mb-2">
                            Kuantitas: {{ $td->quantity }}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-2">
                            Harga: Rp {{ number_format($td->product_price, 0, ',', '.') }}.00
                        </div>
                        <div class="mb-2">
                            Status Pembayaran:
                            <span class="badge bg-success rounded-pill">{{ $td->transaction_status }}</span>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            @endforeach
        </div>
    </div>


    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
        <section class="d-flex justify-content-between p-4" style="background-color: #006ab4">
            <div class="me-5">
                <span>Social Media</span>
            </div>

            <div>
                <a href="https://www.facebook.com/IndomaretMudahdanHemat/" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/indomaret" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://indomaret.co.id/" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="https://www.instagram.com/indomaret/" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.youtube.com/indomaretcoid" class="text-white me-4">
                    <i class="fab fa-youtube"></i>
                </a>

            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">

                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold" style="color: white">PT. Petrolux Arya Mandala</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: white; height: 2px" />
                        <p>
                            Berbekal dedikasi dan inovasi, Indomaret mengukuhkan statusnya sebagai perusahaan waralaba minimarket pertama dan terbesar di Indonesia.
                        </p>
                    </div>


                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold" style="color: white">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: white; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> Menara Indomaret:
                            Jl. Pantai Indah Kapuk Boulevard, No 1,
                            Pantai Indah Kapuk, Jakarta Utara, 14470</p>
                        <p><i class="fas fa-envelope mr-3"></i> kontak@indomaret.co.id</p>
                        <p><i class="fas fa-phone mr-3"></i> +62 21 5089 7400</p>
                        <p><i class="fas fa-print mr-3"></i> +62 21 5089 7411</p>

                    </div>
                </div>

            </div>
        </section>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2024 Copyright:
            <a class="text-white" href="https://www.instagram.com/fano12.m/">Yonathan Fanuel Mulyadi</a>
        </div>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/main.js"></script>


</html>