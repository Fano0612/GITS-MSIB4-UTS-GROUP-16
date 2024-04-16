<?php
if (!auth()->check() || auth()->user()->status != 'active') {
  echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
  echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
  die();
}
?>

<?php
if (auth()->user()->jabatan != 'karyawan') {
  echo "<script>alert('Anda Bukan Karyawan');</script>";
  echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
  die();
}
$user = auth()->user();
$profilePicture = $user->gambar;
?>

<?php
if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] == UPLOAD_ERR_OK) {
  $tmp_name = $_FILES['product_picture']['tmp_name'];
  $name = $_FILES['product_picture']['name'];
  move_uploaded_file($tmp_name, "uploads/$name");
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
  <title>Indomaret Self Service System - Dashboard Karyawan</title>
  <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
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
      background-image: url('https://swamediainc.storage.googleapis.com/swa.co.id/wp-content/uploads/2022/01/17165433/Transaksi-GoPay-di-Indomaret.jpg');
      filter: blur(5px);
    }



    .carousel {
      width: 100vw;
      overflow: hidden;
    }

    .carousel-inner {
      text-align: center;
    }

    .carousel-inner .item img {
      display: block;
      margin: auto;
      padding-bottom: 0;
    }

    .carousel-control {
      position: absolute;
      top: 30%;
      transform: translateY(-50%);
    }

    .carousel-control.left {
      left: 0;
    }

    .carousel-control.right {
      right: 0;
    }

    .carousel-caption {
      position: absolute;
      width: 500px;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      padding: 10px;
      text-shadow: 2px 2px 4px black;
      color: #ffffff;
      font-size: 1.75rem;
      background-color: rgb(255, 255, 255, 0.4);
    }

    @media (max-width: 767px) {
      #myCarousel img {
        max-height: 300px;
        width: auto;
      }
    }
  </style>

</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<body>
  <!-- Navbar & Hero Start -->
  <!-- <div class="background"></div> -->
  <div class="title" style="text-align:center; background:white; display: flex; align-items: center; justify-content: center;border-bottom: 0.5px solid black;">
    <h1>Dashboard Karyawan</h1>
  </div>
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
          <a href="{{route ('dashboardkaryawan')}}" class="nav-item nav-link active">Home</a>
          <a class="nav-item nav-link" aria-current="page" href="{{route ('product_list2')}}">Belanja</a>
          <a class="nav-item nav-link " aria-current="page" href="{{route ('product_menu2')}}">Data Barang</a>
          <a class="nav-item nav-link " aria-current="page" href="{{route ('daftarlaporankriminalitas2')}}">Laporan Kriminalitas</a>
          <a class="nav-item nav-link" aria-current="page" href="{{route ('transaction_list2')}}">Daftar Transaksi</a>
        </div>


        <a href="{{route ('shopwithhelp2')}}">
          <i class="fas fa-comments" style="font-size:30px"></i>
        </a>
        <div class="dropdown ml-auto" style="margin-left: auto;">
          <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('images/'.$profilePicture) }}" alt="" width="48" height="48" style="border-radius: 50%;">
          </button>
          <div class="dropdown-menu dropdown-menu-right position-relative" aria-labelledby="dropdownMenuButton">
            @if (auth()->check())
            <a class="dropdown-item" href="/showAccount2/{{$user->id}}">Hello <b>{{ auth()->user()->username }}</a>
            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route ('logout')}}">Logout</a>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <!-- Navbar & Hero End -->
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="7000">
        <img src="https://quotefancy.com/media/wallpaper/3840x2160/2647324-Barbara-De-Angelis-Quote-A-wise-word-is-more-rare-than-the-green.jpg" class="d-block w-100" alt="" style="width:100%; height:400px; object-fit: cover;">

      </div>
      <div class="carousel-item" data-bs-interval="7000">
        <img src="https://quotefancy.com/media/wallpaper/3840x2160/1787147-Lil-Wayne-Quote-My-word-is-my-pride-the-wisdom-is-weak-and-that-s.jpg" class="d-block w-100" alt="" style="width:100%; height:400px; object-fit: cover;">

      </div>
      <div class="carousel-item" data-bs-interval="7000">
        <img src="https://quotefancy.com/media/wallpaper/3840x2160/1177465-Barbara-De-Angelis-Quote-A-wise-word-is-more-rare-than-the-green.jpg" class="d-block w-100" alt="" style="width:100%; height:400px; object-fit: cover;">

      </div>
    </div>
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
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

  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script src="js/main.js"></script>
</body>



</html>
