<?php
$cl = (object) array('product_id' => '');
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
  }
if (auth()->user()->jabatan != 'karyawan') {
    echo "<script>alert('Anda Bukan Karyawan!');</script>";
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
  <title>Indomaret Self Service System - Keranjang Belanja Karyawan</title>
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
                  .adjustment{
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
                    .card-border{
                      border-style: solid;
                      flex-wrap:wrap; 
                      justify-content:center;
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
                    .Cart-Container{
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
  </style>

</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


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
                <a href="{{route ('dashboardpelanggan')}}" class="nav-item nav-link">Home</a>
                    <a href="{{route ('product_list_front')}}" class="nav-item nav-link">Belanja</a>
                    <a href="{{route ('laporankriminalitas')}}" class="nav-item nav-link">Laporan Kriminalitas</a>
                    <a href="{{route ('transaction_list')}}" class="nav-item nav-link">Riwayat Transaksi</a>
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
<div class ="background"></div>



<div class="Cart-Container">
  <div class="Cart-content" style="display:inline-block;">
    <div class="card-border">
      <?php $total = 0; ?>

      @foreach($cart->where('user_id', auth()->user()->id) as $cl)
  <div class="card" style="width: 18rem;">
    <img src="{{ URL::asset('images/product_pictures/'.$cl->product_picture) }}" class="card-img-top" alt="">
    <div class="card-body">
      <h5 class="card-title">{{ $cl->product_name }}</h5>
      <p class="card-text">Rp {{ number_format($cl->product_price, 0, ',', '.') }}.00</p>
      <p class="card-text">Quantity:
    <button class="btn btn-sm btn-primary increment-btn" data-product-id="{{$cl->product_id}}">+</button>
    <span class="quantity">{{$cl->quantity}}</span>
    <button class="btn btn-sm btn-danger decrement-btn" data-product-id="{{$cl->product_id}}">-</button>
</p>
    <a href="#" class="btn btn-danger delete" data-id="{{ $cl->product_id }} ">Remove</a>
    <form id="delete-form" action="{{ route('removeProductCart', $cl->product_id) }}" method="POST" style="display: none;">
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
      <form action="{{ route('paymentProductCart') }}" method="POST" id="payment-form">
  @csrf
  <button type="submit" class="btn btn-success mb-3 Payment">Pay</button>
</form>
</div>
  </div>
</div>
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
    $(document).ready(function() {
        $('.increment-btn').click(function(e) {
            e.preventDefault();

            var productId = $(this).data('product-id');
            var quantityElement = $(this).siblings('.quantity');

            $.ajax({
                type: 'POST',
                url: "{{ route('incrementProductCart') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
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
                url: "{{ route('decrementProductCart') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
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
                });
</script>
<script>
    $('.delete').click(function() {
        var catId = $(this).data('id');
        swal({
            title: "Delete Data?",
            text: "Delete data " + catId + "?\n" + "Once it's deleted, you won't be able to recover this data anymore",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $('#delete-form').submit();
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