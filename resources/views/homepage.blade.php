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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G.16 Food & Bev's.</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://www.theworlds50best.com/filestore/png/SRA-Logo-1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<body>

    <div class="background"></div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <nav class="navbar bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="{{route ('homepage')}}">
                        <img src="{{ URL::asset('https://marketplace.canva.com/EAEzOw_ovvE/1/0/1600w/canva-watercolor-food-logo-0GcpZ9_7Xls.jpg') }}" alt="" width="60" height="55" style="border-radius: 50%;">
                    </a>
                </div>
            </nav>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center text-lg-start">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route ('homepage')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route ('productlist')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('product_menu')}}">Manage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('category')}}">Category</a>
                    </li>
                </ul>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a href="{{route ('showProductCart')}}">
                        <i class="fa fa-shopping-cart" style="font-size:36px"></i>
                    </a>
                    &nbsp; &nbsp;
                    <div class="dropdown ml-auto" style="margin-left: auto;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ URL::asset('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZzoDeEjIOxYT2dL6zhz9J0RH-T_sNpeucjSd10omQQMSQYjUD5z9vHKjH03Vj1I4Nxwk&usqp=CAU') }}" alt="" width="60" height="55" style="border-radius: 50%;">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
                            @if (auth()->check())
                            <a class="dropdown-item" href="">Hello <b>{{ auth()->user()->username }}</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route ('logout')}}">Logout</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </nav>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>