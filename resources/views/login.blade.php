<?php
if (auth()->check()) {
    header('Location: /homepage');
    exit();
}
if (auth()->check() && auth()->user()->status != 'active') {
    header('Location: /login');
    exit();
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Loding font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="./styles.css">

    <title>Login</title>
    {{-- <style>
        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url('https://www.unileverfoodsolutions.co.id/dam/global-ufs/mcos/SEA/calcmenu/recipes/ID-recipes/salads/nasi-pecel/main-header.jpg');
            filter: blur(5px);
        }
    </style> --}}
</head>
<link rel="stylesheet" href="{{ asset('css/login.css') }}">


<body>
     <!-- Backgrounds -->
    <div id="login-bg" class="container-fluid">
        <div class="bg-img"></div>
        <div class="bg-color"></div>
    </div>
  
      <!-- End Backgrounds -->
  
    <div class="container" id="login">
        <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="login" style="width: 38rem;">
                @if($errors->any())
                    @foreach($errors->all() as $err)
                        <p class="alert alert-danger">{{$err}}</p>
                    @endforeach
                @endif
                <form action="{{ route('loginacc') }}" method="POST">
                    @csrf
                    <div class="text-center">  
                        <img src="{{ asset('images/draft/foodies-nobg.png')}}" class="rounded" alt="" height="120px" width="185px">  
                            <h1 class="mt-1">Login</h1>
                    </div>
                    <br>
                    <div class="form-group mb-2">
                        <label for="email" ></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                    </div>
                    <div class="form-group mb-2 ">
                        <label for="password"></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <br>
                        <a href="{{ route('AccountUnexist') }}?stats=true" class="no link-danger">Don't have an account?</a>
                        <button type="submit" class="btn btn-danger" style="float:right">Submit</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</html>