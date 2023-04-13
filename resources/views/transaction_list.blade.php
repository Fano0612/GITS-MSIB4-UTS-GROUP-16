
<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Please login to access the system');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
}
?>

<?php
if (auth()->user()->access_rights != 'Merchant') {
    echo "<script>alert('You are not a merchant!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/homepage'; }, 1000);</script>";
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
    <style>
        
        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url('https://media-cldnry.s-nbcnews.com/image/upload/newscms/2023_05/1963490/puff-pastry-beef-wellington-valentines-day-2x1-zz-230201.jpg');
            filter: blur(5px);
        }
    </style>
</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<body>
    <!-- Navbar & Hero Start -->
    <div class="background"></div>
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
                    <a class="nav-item nav-link" aria-current="page" href="{{route ('productlist')}}">Products</a>
                    <a class="nav-item nav-link" aria-current="page" href="{{route ('product_menu')}}">Manage</a>
                    <a class="nav-item nav-link" aria-current="page" href="{{route ('category')}}">Category</a>
                    <a class="nav-item nav-link active" aria-current="page" href="{{route ('transaction_list')}}">Transactions</a>
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

    <!-- transaction start -->
    <div class="mt-5 mb-5 text-center">
    <div class="container" style="width: 500px; display: inline-block;">
        @php
            $transactionData = App\Models\Transaction::all()->groupBy('user_id');
        @endphp

        @foreach($transactionData as $userId => $transactions)
            <ul class="list-group">

                <li class="list-group-item d-flex justify-content-center align-items-center">
                    <div class="mb-2">
                        <div class="fw-bold">{{ $userId }}</div>
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
                                Transaction ID: {{ $td->transaction_id }}
                                <span>
                            <a href="{{ route('viewProductTransaction', ['transactionId' => $td->transaction_id]) }}" class="btn btn-success" style="float:right">
                                View
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
                                Product Name: {{ $td->product_name }}
                            </div>
                            <div class="mb-2">
                                Quantity: {{ $td->quantity }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-2">
                                Price: Rp {{ number_format($td->product_price, 0, ',', '.') }}.00
                            </div>
                            <div class="mb-2">
                                Status:
                                <span class="badge bg-primary rounded-pill">{{ $td->transaction_status }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach

                </ul>
            @endforeach
        </div>
    </div>
    

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>