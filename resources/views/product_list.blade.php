<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}

if (auth()->user()->jabatan != 'generalmanageroperasional') {
    echo "<script>alert('Anda Bukan General Manager Operasional!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/dashboardgeneralmanageroperasional'; }, 1000);</script>";
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
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="title" style="text-align:center; background:white; display: flex; align-items: center; justify-content: space-between; border-bottom: 0.5px solid black; padding-top:10px;padding-bottom:10px;">

        <div style="display: flex; align-items: center;">
            <a href="" class="navbar-brand p-0">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" style="width:150px;height:50px;">
            </a>
        </div>

        <form class="d-flex" role="search" style="max-width: 100%; width: 100%;">
            <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="width: 100%; max-width: 1000px;">

        </form>
        <a href="{{route ('showProductCart2')}}" style=" margin-right:10px; padding-top:10px;">
            <i class="fa fa-shopping-cart" style="font-size:30px"></i>
        </a>

        <div style="display: inline-block;">


            <div class="dropdown" style="display: inline-block;">
                <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('images/'.$profilePicture) }}" alt="" width="48" height="48" style="border-radius: 50%;">
                </button>
                <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
                    @if (auth()->check())
                    <a class="dropdown-item" href="">Hello <b>{{ auth()->user()->username }}</b></a>
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
                    <a href="{{route ('dashboardgeneralmanageroperasional')}}" class="nav-item nav-link">Home</a>
                    <a class="nav-item nav-link active" aria-current="page" href="{{route ('productlist')}}">Belanja</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('product_menu')}}">Data Barang</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('daftarlaporankriminalitas')}}">Laporan Kriminalitas</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('daftarpelanggan')}}">Data Pelanggan</a>
                    <a href="{{route ('transaction_list')}}" class="nav-item nav-link">Daftar Transaksi</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Navbar & Hero End -->
    <button id="categoryDropdownBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top:150px;margin-left:40px; background:black; border-radius: 10px;">
    Kategori
</button>
<ul class="dropdown-menu">
    @php
        $categories = App\Models\Category::all();
    @endphp
    @foreach($categories as $category)
        <li><a class="dropdown-item category-item" href="#" data-category-id="{{ $category->id }}">{{ $category->product_category }}</a></li>
    @endforeach
</ul>

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
                            <form action="{{ route('buyproduct2') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $prod->id_barang }}">
                                @if (auth()->user()->id_pelanggan_belanja_bantuan_karyawan != 0)
                                <button type="submit" class="btn btn-primary">Beli</button>
                                @endif
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
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
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
    <div class="col-6">${category}}</div>
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
            $('#categoryDropdownBtn').text(categoryText); // Update button text to selected category
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