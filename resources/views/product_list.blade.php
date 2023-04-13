<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Please login to access the system!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title>G.16 Food & Bev's.</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://www.theworlds50best.com/filestore/png/SRA-Logo-1.png') }}">
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
    {{-- <style>
        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
        }
	</style> --}}
</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


<body>
     <!-- Navbar & Hero Start -->
     <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="background-color: #ECBC76;">
            <a href="" class="navbar-brand p-0">
                <img src="{{ asset('images/draft/foodies-nobg.png') }}" alt="" width="90" height="66" style="border-radius: 50%;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{route ('homepage')}}" class="nav-item nav-link">Home</a>
                    <a class="nav-item nav-link active" aria-current="page" href="{{route ('productlist')}}">Products</a>
                    <a href="{{route ('product_menu')}}" class="nav-item nav-link">Manage</a>
                    <a href="{{route ('category')}}" class="nav-item nav-link">Category</a>
                    <a href="{{route ('transaction_list')}}" class="nav-item nav-link">Transactions</a>
                </div>

                <a href="{{route ('showProductCart')}}">
                    <i class="fa fa-shopping-cart" style="font-size:30px"></i>
                </a>
                <div class="dropdown ml-auto" style="margin-left: auto;"> 
                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/draft/aku.jpg') }}" alt="" width="48" height="48" style="border-radius: 50%;">
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
    </div>
    <!-- Navbar & Hero End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="card-border">
                @foreach($products as $prod)
                <div class="card" style="width: 18rem;">
                    <img src="{{ URL::asset('images/product_pictures/'.$prod->product_picture) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $prod->product_name }}</h5>
                        <p class="card-text">Rp {{ number_format($prod->product_price, 0, ',', '.') }}.00</p>
                        <p class="card-text">Stock: {{ $prod->product_stock }}</p>
                        @if($prod->product_stock > 0)
                        <form action="{{route ('buyproduct')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $prod->product_id }}">
                            <button type="submit" class="btn btn-primary">Buy</button>
                        </form>
                        @else
                        <p class="card-text text-danger">Out of stock</p>
                        @endif
                    </div>
                </div>
                @if(($loop->iteration % 3) == 0)
                <div style="flex-basis: 100%;"></div>
                @endif
                @endforeach
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/product/sushi.jpg') }}" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Surabaya</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa text-primary me-2"></i>27 minute</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>2 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Rp. 120.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Sushi is a Japanese dish featuring specially prepared rice and usually some type of fish or seafood, often raw, but sometimes cooked.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/product/sushi.jpg') }}" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Bandung</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa text-primary me-2"></i>30 minute</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Rp. 130.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Sushi is a Japanese dish featuring specially prepared rice and usually some type of fish or seafood, often raw, but sometimes cooked.</p>
                            <div class="d-flex justify-content-center mb-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/product/sushi.jpg') }}" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Jakarta</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa text-primary me-2"></i>45 minute</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Rp. 160.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Sushi is a Japanese dish featuring specially prepared rice and usually some type of fish or seafood, often raw, but sometimes cooked.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/product/kebab.jpg') }}" alt=""  width="430" height="450">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Surabaya</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa text-primary me-2"></i>23 minute</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Rp. 20.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Kebabs are a popular Middle Eastern food made by mounting pieces of meat and/or vegetables on a skewer and mounting the skewer on a grill.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/product/kebab.jpg') }}" alt="" width="430" height="450">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Bandung</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa text-primary me-2"></i>27 minute</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Rp. 26.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Kebabs are a popular Middle Eastern food made by mounting pieces of meat and/or vegetables on a skewer and mounting the skewer on a grill.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/product/kebab.jpg') }}" alt=""  width="430" height="450">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Jakarta</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa text-primary me-2"></i>33 minute</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Rp. 35.000</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Kebabs are a popular Middle Eastern food made by mounting pieces of meat and/or vegetables on a skewer and mounting the skewer on a grill.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Package End -->

    
        <div class="card-border">
            @foreach($products as $prod)
            <div class="card" style="width: 18rem;">
                <img src="{{ URL::asset('images/product_pictures/'.$prod->product_picture) }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $prod->product_name }}</h5>
                    <p class="card-text">Rp {{ number_format($prod->product_price, 0, ',', '.') }}.00</p>
                    <p class="card-text">Stock: {{ $prod->product_stock }}</p>
                    @if($prod->product_stock > 0)
                    <form action="{{route ('buyproduct')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $prod->product_id }}">
                        <button type="submit" class="btn btn-primary">Buy</button>
                    </form>
                    @else
                    <p class="card-text text-danger">Out of stock</p>
                    @endif
                </div>
            </div>
            @if(($loop->iteration % 3) == 0)
            <div style="flex-basis: 100%;"></div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Foodies</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Contact</a>
                        </div>
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
    
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
    
</html>