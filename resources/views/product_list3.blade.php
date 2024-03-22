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

<body>
    <div class="background">

    </div>
    <div class="title" style="text-align:center; background:white; display: flex; align-items: center; justify-content: space-between; border-bottom: 0.5px solid black; padding-top:10px;padding-bottom:10px;">

        <div style="display: flex; align-items: center;">
            <a href="" class="navbar-brand p-0">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" style="width:150px;height:50px;">
            </a>
        </div>

        <form class="d-flex" role="search" style="max-width: 100%; width: 100%;">
            <input id="searchInput" class="form-control me-2" type="search" placeholder="Cari" aria-label="Search" style="width: calc(100% - 30px); max-width: 1200px; border-radius:20px;">
        </form>

        <a href="{{route ('showProductCart')}}" style=" margin-right:10px; padding-top:10px;">
            <i class="fa fa-shopping-cart" style="font-size:30px"></i>
        </a>

        <div style="display: inline-block;">


            <div class="dropdown" style="display: inline-block;">
                <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('images/'.$profilePicture) }}" alt="" width="48" height="48" style="border-radius: 50%;">
                </button>
                <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
                    @if (auth()->check())
                    <a class="dropdown-item" href="/showAccount3/{{$user->id}}">Hello <b>{{ auth()->user()->username }}</b></a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route ('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid position-relative p-2">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="background-color: white; border-bottom: 0.5px solid white;">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                <div class="navbar-nav py-0">
                    <a href="{{route ('dashboardpelanggan')}}" class="nav-item nav-link ">Home</a>
                    <a href="{{route ('product_list_front')}}" class="nav-item nav-link active">Belanja</a>
                    <a href="{{route ('laporankriminalitas')}}" class="nav-item nav-link">Laporan Kriminalitas</a>
                    <a href="{{route ('transaction_list3')}}" class="nav-item nav-link">Riwayat Belanja</a>

                </div>
            </div>
        </nav>
    </div>

    <!-- Navbar & Hero End -->
    <button id="categoryDropdownBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top:150px;margin-left:40px; background:white; border-radius: 10px; color: black;">
        Kategori <span class="caret" style="color: black;"></span>
    </button>



    @php
    $categories = App\Models\Category::all();
    @endphp
    @if($categories->isEmpty())
    <p>Data tidak ditemukan!</p>
    @else
    <ul class="dropdown-menu">
        @foreach($categories as $category)
        <li><a class="dropdown-item category-item" href="#" data-category-id="{{ $category->id }}">{{ $category->product_category }}</a></li>
        @endforeach
    </ul>
    @endif
    <!-- Navbar & Hero End -->
    @php
    $products = App\Models\Barang::all();
    @endphp


    <div class="container-xxl py-3" style="margin-top: 10px;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                @foreach($products as $prod)
                <div class="col mb-4" data-category-id="{{ $prod->kategori_id }}">
                    <div class="card">
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
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                                @else
                                <p class="card-text text-danger">Stok Habis</p>
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
        var products = <?php echo $productsJson; ?>;
        var categories = <?php echo json_encode($categories); ?>;


        $(document).ready(function() {
            $('.detail-btn').click(function() {
                var productId = $(this).data('product-id');
                var product = products.find(p => p.id_barang === productId);

                if (product) {
                    var category = categories[product.kategori_id];

                    $('#productDetailModal .modal-body').html(
                        `<div class="card">
        <img src="{{ asset('images/product_pictures/') }}/${product.foto}" class="card-img-top mx-auto d-block" alt="" style="width: 200px; height: 200px;">
        <div class="card-body">

        <div class="container">
  <div class="row">

    <div class="col-4">Nama: </div>
    <div class="col-6">${product.namabarang}</div>
    <div class="col-4">Jenis: </div>
    <div class="col-6">${product.jenisbarang}</div>
    <div class="col-4">Deskripsi: </div>
    <div class="col-6">${product.deskripsi}</div>
    <div class="col-4">Komposisi: </div>
    <div class="col-6">${product.komposisi}</div>
    <div class="col-4">Kategori: </div>
    <div class="col-6">${category}</div>
    <div class="col-4">Tanggal Kedaluwarsa: </div>
    <div class="col-6">${product.tanggalkedaluwarsa}</div>
    <div class="col-4">Jumlah Stok Barang: </div>
    <div class="col-6">${product.jumlahstokbarang}</div>
  </div>
</div>
 
            
        </div>
    </div>`
                    );

                    $('#productDetailModal').modal('show');
                }
                else{
                    
                    $('#productDetailModal .modal-body').html(
                        `<div class="card">
        <img src="{{ asset('images/product_pictures/') }}/${product.foto}" class="card-img-top mx-auto d-block" alt="" style="width: 200px; height: 200px;">
        <div class="card-body">

        <div class="container">
  <div class="row">

    <h1>Data tidak ditemukan!</h1>
  </div>
</div>
 
            
        </div>
    </div>`
                    );

                    $('#productDetailModal').modal('show');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function filterProducts(searchTerm) {
                searchTerm = searchTerm.toLowerCase();
                $('.card').each(function() {
                    var productName = $(this).find('.card-title').text().toLowerCase();
                    if (productName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val();
                filterProducts(searchTerm);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.category-item').click(function(e) {
                e.preventDefault();
                var categoryId = $(this).data('category-id');
                var categoryText = $(this).text();
                $('#categoryDropdownBtn').text(categoryText);
                filterProducts(categoryId);
            });

            function filterProducts(categoryId) {
                $('.col.mb-4').each(function() {
                    var productCategoryId = $(this).data('category-id');
                    if (productCategoryId == categoryId || categoryId == 0) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    </script>

</body>

</html>