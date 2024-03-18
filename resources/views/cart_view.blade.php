<?php
$cl = (object) array('product_id' => '');
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
if (auth()->user()->jabatan != 'generalmanageroperasional') {
    echo "<script>alert('Anda Bukan General Manager Operasional!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}



$user = auth()->user();
$profilePicture = $user->gambar;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System - Keranjang Belanja Bantuan Karyawan</title>
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


    <style>
        .adjustment {
            display: flex;
            align-items: flex-start;
        }

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

        .card-border {
            border-style: solid;
            flex-wrap: wrap;
            justify-content: center;
            width: fit-content;
            block-size: fit-content;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-right: auto;
            margin-left: auto;
        }

        .card {
            display: inline-block;
            margin: 10px;

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

        .Cart-Container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px auto;
            width: 70%;
            height: 85%;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 25px 40px #1687d933;

        }

        .container-fluid {
            height: 20vh;
            overflow-y: auto;
        }
    </style>

</head>


<body>
    <!-- Navbar & Hero Start -->

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
                <a href="{{route ('dashboardgeneralmanageroperasional')}}" class="nav-item nav-link ">Home</a>
                    <a class="nav-item nav-link" aria-current="page" href="{{route ('productlist')}}">Belanja</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('product_menu')}}">Data Barang</a>
                    <a class="nav-item nav-link" aria-current="page" href="{{route ('daftarlaporankriminalitas')}}">Laporan Kriminalitas</a>
                    <a class="nav-item nav-link " aria-current="page" href="{{route ('daftarpelanggan')}}">Data Pelanggan</a>
                    <a href="{{route ('transaction_list')}}" class="nav-item nav-link">Daftar Transaksi</a>
                </div>

                <a href="{{route ('showProductCart2')}}">
                    <i class="fa fa-shopping-cart" style="font-size:30px"></i>
                </a>
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
    </div>
    <!-- Navbar & Hero End -->

    @php
    $cart = App\Models\Cart::all();
    @endphp
    <div class="background"></div>



    <div class="Cart-Container">
        <div class="Cart-content" style="display:inline-block;">
            <div class="card-border">
                <?php $total = 0; ?>

                @foreach($cart->where('user_id', auth()->user()->id_pelanggan_belanja_bantuan_karyawan) as $cl)
                <div class="card" style="width: 18rem;">
                    <img src="{{ URL::asset('images/product_pictures/'.$cl->product_picture) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cl->product_name }}</h5>
                        <p class="card-text">Rp {{ number_format($cl->product_price, 0, ',', '.') }}.00</p>
                        <p class="card-text">Quantity:

                            <button class="btn btn-sm btn-danger decrement-btn" data-product-id="{{$cl->product_id}}">-</button>

                            <span class="quantity">{{$cl->quantity}}</span>
                            <button class="btn btn-sm btn-primary increment-btn" data-product-id="{{$cl->product_id}}">+</button>
                        </p>
                        <a href="#" class="btn btn-danger delete" data-id="{{ $cl->product_id }}">Remove</a>
                        <form id="delete-form-{{ $cl->product_id }}" action="{{ route('removeProductCart2', $cl->product_id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <?php $total += $cl->product_price * $cl->quantity; ?>
                </div>
                @if(($loop->iteration % 3) == 0)
                <div style="flex-basis: 100%;"></div>
                @endif
                @endforeach
            </div>
            <hr style="background-color:rgb(0,0,0); height:20px;">
            <?php $tax = $total * 0.1; ?>
            <div class="total">
                <h3>Tax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= Rp {{ number_format($tax, 0, ',', '.') }}.00</h3>
                <br>
                <?php $total += $tax; ?>
                <h2>Total&nbsp;= Rp {{ number_format($total, 0, ',', '.') }}.00</h2>
                <form action="{{ route('paymentProductCart2') }}" method="POST" id="payment-form">
                    @csrf
                    <button type="submit" class="btn btn-success mb-3 Payment">Pay</button>
                </form>
            </div>
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

<script>
    $('.increment-btn').click(function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var quantityElement = $(this).siblings('.quantity');

        $.ajax({
            type: 'POST',
            url: "{{ route('incrementProductCart2') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id_barang: productId, 
                increment: 1
            },
            success: function(data) {
                quantityElement.text(data.quantity);
            },
            error: function(data) {
                alert('Error: ' + data.responseJSON.error);
            }
        });
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var quantityElement = $(this).siblings('.quantity');

        $.ajax({
            type: 'POST',
            url: "{{ route('decrementProductCart2') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id_barang: productId, // Updated parameter name
                decrement: 1
            },
            success: function(data) {
                quantityElement.text(data.quantity);
            },
            error: function(data) {
                alert('Error: ' + data.responseJSON.error);
            }
        });
    });
</script>
<script>
    $('.delete').click(function() {
        var productId = $(this).data('id');
        swal({
                title: "Delete Data?",
                text: "Delete data " + productId + "?\n" + "Once it's deleted, you won't be able to recover this data anymore",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#delete-form-' + productId).submit(); 
                } else {
                    swal("Data deletion cancelled!");
                }
            });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</html>