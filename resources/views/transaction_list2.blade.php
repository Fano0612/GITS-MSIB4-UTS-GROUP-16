<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
if (auth()->user()->jabatan != 'karyawan') {
    echo "<script>alert('Anda Bukan Karyawan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/dashboardkaryawan'; }, 1000);</script>";
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

</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


<body>
    <div class="title" style="text-align:center; background:white; display: flex; align-items: center; justify-content: center;border-bottom: 0.5px solid black;">
        <h1>Daftar Transaksi</h1>
    </div>
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="background-color: White; border-bottom: 1px solid black;">
            <a href="" class="navbar-brand p-0">
                <img src="    https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" style="width:150px;height:50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{route ('dashboardkaryawan')}}" class="nav-item nav-link ">Home</a>
                    <a class="nav-item nav-link" aria-current="page" href="{{route ('product_list2')}}">Belanja</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('product_menu2')}}">Data Barang</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('daftarlaporankriminalitas2')}}">Laporan Kriminalitas</a>
                    <a class="nav-item nav-link active" aria-current="page" href="{{route ('transaction_list2')}}">Daftar Transaksi</a>
                </div>
                <a href="{{route ('shopwithhelp')}}">
                    <i class="fas fa-comments" style="font-size:30px"></i>
                </a>
                &nbsp; &nbsp;
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

    <!-- transaction start -->
    <div class="mt-5 mb-5 text-center">
        <div class="container" style="width: 1200px; display: inline-block;">
            @php
            $transactionData = App\Models\Transaction::all()->groupBy('user_id');
            $userIdCount = 0;
            @endphp

            @foreach($transactionData as $userId => $transactions)
            @if($userIdCount % 3 == 0)
            <div class="row">
                @endif

                <div class="col-md-4">
                    <div class="transaction-box" style="max-height: 300px; overflow-y: auto;">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-center align-items-center">
                                <div class="mb-2">
                                    <div class="fw-bold">ID Pelanggan: {{ $userId }}</div>
                                </div>
                            </li>

                            @php
                            $prevTransactionId = null;
                            $itemCount = 0;
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
                                    <a href="{{ route('viewProductTransaction2', ['transactionId' => $td->transaction_id]) }}" class="btn btn-primary" style="float:right;">
                                        Detil
                                    </a>
                                    <a href="#" style="float:right; opacity: 0;">
                                        a
                                    </a>
                                    <a href="{{ route('printTransaction2', ['transactionId' => $td->transaction_id]) }}" class="btn btn-warning" style="float:right;">
                                        Print
                                    </a>
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
                            @php
                            $itemCount++;
                            @endphp

                            @endforeach
                        </ul>
                    </div>
                </div>

                @if($userIdCount % 3 == 2 || $loop->last)
            </div>
            @endif

            @php
            $userIdCount++;
            @endphp
            @endforeach
        </div>
    </div>
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

<script>
    window.addEventListener('scroll', function() {
        var hiddenItems = document.querySelectorAll('.list-group-item:not([style="display: block;"])');

        if (hiddenItems.length > 0) {
            var lastHiddenItem = hiddenItems[hiddenItems.length - 1];
            var lastHiddenItemOffset = lastHiddenItem.offsetTop + lastHiddenItem.clientHeight;
            var pageOffset = window.pageYOffset + window.innerHeight;

            if (pageOffset > lastHiddenItemOffset - 20) {
                hiddenItems.forEach(function(item) {
                    item.style.display = 'block';
                });
            }
        }
    });
</script>

</html>