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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G.16 Food & Bev's.</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://www.theworlds50best.com/filestore/png/SRA-Logo-1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            /* background-image: url('https://media-cldnry.s-nbcnews.com/image/upload/newscms/2023_05/1963490/puff-pastry-beef-wellington-valentines-day-2x1-zz-230201.jpg'); */
            /* filter: blur(5px); */
		    /* img {
                max-width: 100%;
                max-height: 50%;
                padding-top:10px;
            }
            h1 {
                color: green;
            } */
        }
	</style>
</head>

<body>
    <div class="background"></div>

    <nav class="navbar navbar-expand-lg bg-warning text-dark">
        <div class="container-fluid">
            <nav class="navbar bg-warning text-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{route ('homepage')}}">
                        <img src="{{ asset('images/foodies-logo.png') }}" alt="" width="58" height="48" style="border-radius: 50%;">
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
                        <a class="nav-link" href="{{route ('homepage')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('homepage')}}">Manage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('homepage')}}">Category</a>
                    </li>
                </ul>
                <nav class="navbar navbar-expand-lg navbar-light bg-warning">
                    <a href="{{route ('homepage')}}">
                        <i class="fa fa-shopping-cart" style="font-size:36px"></i>
                    </a>
                    &nbsp; &nbsp;
                    <div class="dropdown ml-auto" style="margin-left: auto;"> 
                        <button class="btn btn-warning" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <img src="{{ URL::asset('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZzoDeEjIOxYT2dL6zhz9J0RH-T_sNpeucjSd10omQQMSQYjUD5z9vHKjH03Vj1I4Nxwk&usqp=CAU') }}" alt="" width="60" height="55" style="border-radius: 50%;"> --}}
                            <img src="{{ asset('images/aku.jpg') }}" alt="" width="48" height="48" style="border-radius: 50%;">
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

    {{-- BESTSELLER/RECOMENDED --}}
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100 mt-3" src="{{ asset('images/beef-long.jpg') }}" alt="First slide" height="350">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 mt-3" src="{{ asset('images/sup-long.jpg') }}" alt="Second slide" height="350">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 mt-3" src="{{ asset('images/all-long.jpg') }}" alt="Third slide" height="350">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      {{-- CATEGORIES --}}
	<h1 class="mt-5 mb-5" style="color:rgb(254, 196, 60);text-align:center;">
		Categories
	</h1>

	<div class="container">
		<div class="card-group">

			<div class="row">
				<div class="card col-md-4">
					<img class="card-img-top" src="{{ asset('images/pizza.jpg')}}">

					<div class="card-body">
						<h3 class="card-title">Pizza</h3>
						<p class="card-text">Makanan Berat | Western</p>
					</div>
				</div>

				<div class="card col-md-4">
					<img class="card-img-top" src="{{ asset('images/mie.jpg')}}">
					
					<div class="card-body">
						<h3 class="card-title">Nasi Goreng</h3>
						<p class="card-text">Makanan Berat | Asia</p>
					</div>
				</div>
				
				<div class="card col-md-4">
					<img class="card-img-top" src="{{ asset('images/burger.jpg')}}">
					
					<div class="card-body">
						<h3 class="card-title">Burger</h3>
						<p class="card-text">Makanan Berat | Western</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>					



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>