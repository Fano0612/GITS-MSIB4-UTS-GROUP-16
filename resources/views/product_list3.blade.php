<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan Login ke dalam Sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
if (auth()->user()->jabatan != 'pelanggan') {
    echo "<script>alert('Anda Bukan Pelanggan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
if (auth()->user()->status_belanja_bantuan_karyawan != 'inactive') {
    echo "<script>alert('Anda Sedang Berbelanja dengan Bantuan Karyawan!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/product_list4'; }, 1000);</script>";
    die();
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
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>Indomaret Self Service System - Belanja</title>
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

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
                    <a href="{{route ('dashboardpelanggan')}}" class="nav-item nav-link">Home</a>
                    <a href="{{route ('product_list_front')}}" class="nav-item nav-link active">Belanja</a>
                    <a href="{{route ('laporankriminalitas')}}" class="nav-item nav-link">Laporan Kriminalitas</a>
                    <a href="{{route ('transaction_list3')}}" class="nav-item nav-link ">Riwayat Transaksi</a>

                </div>
                <a href="{{route ('showProductCart')}}">
                    <i class="fa fa-shopping-cart" style="font-size:36px"></i>
                </a>
                &nbsp; &nbsp;
                <div class="dropdown ml-auto" style="margin-left: auto;">
                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/'.$profilePicture) }}" alt="" width="48" height="48" style="border-radius: 50%;">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
                        @if (auth()->check())
                        <a class="dropdown-item" href="">Hello <b>{{ auth()->user()->username }}</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route ('logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Belanja Puas Harga Pas</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
    @php
    $products = App\Models\Barang::all();
    @endphp

    <div class="container-xxl py-5" style="margin-top: 60px;">
        <div class="container d-flex justify-content-center">
            <div class="row">
                @foreach($products as $prod)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('images/product_pictures/'.$prod->foto) }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $prod->namabarang }}</h5>
                            <p class="card-text">Rp {{ number_format($prod->harga, 0, ',', '.') }}.00</p>
                            <p class="card-text">Stock: {{ $prod->jumlahstokbarang }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($prod->jumlahstokbarang > 0)
                                <form action="{{ route('buyproduct') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $prod->id_barang }}">
                                    <button type="submit" class="btn btn-primary">Buy</button>
                                </form>
                                @else
                                <p class="card-text text-danger">Out of stock</p>
                                @endif
                                <button type="button" class="btn btn-secondary detail-btn" data-bs-toggle="modal" data-bs-target="#productDetailModal" data-product-id="{{ $prod->id_barang }}">Detil</button>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Detil Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->


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
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    @php
    $categories = App\Models\Category::all()->pluck('product_category', 'id')->toArray();
    $productsJson = json_encode($products);
    @endphp

    <script>
        var products = { !!$productsJson!! };
        var categories = { !!json_encode($categories) !! };

        $(document).ready(function() {
            $('.detail-btn').click(function() {
                var productId = $(this).data('product-id');
                var product = products.find(p => p.id_barang === productId);

                if (product) {
                    var category = categories[product.kategori_id];

                    $('#productDetailModal .modal-body').html(`
                    <div class="card">
                        <img src="{{ asset('images/product_pictures/') }}/${product.foto}" class="card-img-top mx-auto d-block" alt="" style="width: 200px; height: 200px;">
                        <div class="card-body">
                            <p class="card-text">Nama: ${product.namabarang}</p>
                            <p class="card-text">Jenis: ${product.jenisbarang}</p>
                            <p class="card-text">Deskripsi: ${product.deskripsi}</p>
                            <p class="card-text">Komposisi: ${product.komposisi}</p>
                            <p class="card-text">Kategori: ${category}</p>
                            <p class="card-text">Tanggal Kadaluwarsa: ${product.tanggalkedaluwarsa}</p>
                            <p class="card-text">Jumlah Stok Barang: ${product.jumlahstokbarang}</p>
                        </div>
                    </div>
                `);
                    $('#productDetailModal').modal('show');
                }
            });
        });
    </script>


</body>

</html>