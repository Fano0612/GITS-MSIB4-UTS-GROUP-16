<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Please login to access the system');</script>";
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
    {{-- <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End --> --}}


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
                    <a href="{{route ('productlist')}}" class="nav-item nav-link">Products</a>
                    <a href="{{route ('product_menu')}}" class="nav-item nav-link">Manage</a>
                    <a href="{{route ('category')}}" class="nav-item nav-link">Category</a>
                    <a href="{{route ('transaction_list')}}" class="nav-item nav-link">Transactions</a>

                </div>
                    <a href="{{route ('showProductCart')}}">
                            <i class="fa fa-shopping-cart" style="font-size:36px"></i>
                        </a>
                        &nbsp; &nbsp;
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
        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Meal With Us</h1>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Home Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('images/draft/foodies-logo.png') }}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Hello</h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary">Foodies</span></h1>
                    <p class="mb-4">Aplikasi foodies mampu untuk memenuhi kebutuhan kalian semua di era serba digital ini. Aplikasi ini memudahkan kalian dalam bertransaksi online.</p>
                    <p class="mb-4">Penjual dan Pembeli diberi kemudahan dengannya adanya berbagai fitur dalam aplikasi ini, seperti
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Home End -->

    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">All</h6>
                <h1 class="mb-5">Product</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/sushi.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Sushi</h3>
                            <h5>Rp. 150.000</h5>
                            <p>Sushi is a Japanese dish featuring specially prepared rice and usually some type of fish or seafood, often raw, but sometimes cooked.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/macaron.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Macaron</h3>
                            <h5>Rp. 70.000</h5>
                            <p>A macaron is a meringue-based sandwich cookie made with almond flour, egg whites, confectioners' sugar, and food coloring.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/orange.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Orange Juice</h3>
                            <h5>Rp. 15.000</h5>
                            <p>Orange juice is a fruit juice obtained by squeezing, pressing or otherwise crushing the interior of an orange.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/friedrice.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Fried Rice</h3>
                            <h5>Rp. 25.000</h5>
                            <p>a dish of boiled or steamed rice that is stir-fried typically with soy sauce, beaten egg, chopped meat, and vegetables</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/spaghetti.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Spaghetti</h3>
                            <h5>Rp. 30.000</h5>
                            <p>Spaghetti is a type of pasta. It is made of milled wheat and water. Italian spaghetti is made from durum wheat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/cocktail.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Cocktail</h3>
                            <h5>Rp. 50.000</h5>
                            <p>Cocktail is a stimulating liquor, composed of spirits of any kind, sugar, water, and bitters.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/pudding.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Pudding</h3>
                            <h5>Rp. 25.000</h5>
                            <p>a dessert of a soft, spongy, or thick creamy consistency. especially : one made from sweetened milk or cream.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/chips.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Potato Chips</h3>
                            <h5>Rp. 15.000</h5>
                            <p>Potato chips are pieces of potato which have been sliced extremely thin and then fried / baked until crisp.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/coffetea.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Coffe & Tea</h3>
                            <h5>Rp. 20.000</h5>
                            <p>Tea is a genteel beverage requiring preparation and time to sip. Coffee is a beverage prepared from roasted coffee beans.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/sandwich.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Sandwich</h3>
                            <h5>Rp. 35.000</h5>
                            <p>Sandwich is a food typically consisting of vegetables, sliced cheese or meat, placed on or between slices of bread.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/kebab.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Kebab</h3>
                            <h5>Rp. 25.000</h5>
                            <p>Kebabs are a popular Middle Eastern food made by mounting pieces of meat and/or vegetables on a skewer and mounting the skewer on a grill.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x text-primary mb-4"></i>
                            <img src="{{ asset('images/product/seafood.jpg') }}" alt="" width="90" height="90" style="border-radius: 50%;">
                            <h3 class="mb-0">Seafood</h3>
                            <h5>Rp. 100.000</h5>
                            <p>Seafood is any form of sea life that humans consume as food. It includes fish, shellfish, and various kinds of crustaceans and echinoderms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End -->

    <!-- Bestseller Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Product</h6>
                <h1 class="mb-5">Bestseller</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('images/product/friedchicken.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Fried Chicken</h5>
                    <h3>Rp. 25.000</h3>
                    <p>3 wings</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('images/product/lemonsoda.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Lemon Soda</h5>
                    <h3>Rp. 10.000</h3>
                    <p>Lemon Fresh</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('images/product/popcorn.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Pop corn</h5>
                    <h3>Rp. 28.000</h3>
                    <p>All Flavour</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('images/product/steak.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Steak</h5>
                    <h3>Rp. 55.000</h3>
                    <p>Sauce bbq</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Bestseller End -->

    <!-- Discount Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Product</h6>
                <h1 class="mb-5">Discount</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('images/product/ramen.jpg') }}" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">10% OFF</div>
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Jepang</div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('images/product/icecream.jpg') }}" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">20% OFF</div>
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Tiongkok</div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="{{ asset('images/product/satee.jpg') }}" alt="">
                                <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">15% OFF</div>
                                <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Indonesia</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('images/product/steak.jpg') }}" alt="" style="object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">5% OFF</div>
                        <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Spanyol</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Discount End -->
        

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


   