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
    <style>
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
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="container" style="position: absolute;top: 50%; left: 50%; transform: translate(-50%, -50%);padding: 20px;margin: auto;">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card border-4 border-warning mb-10" style="background-color: rgb(243, 204, 137)" >
                    <div class="card-body">
                        @if($errors->any())
                        @foreach($errors->all() as $err)
                        <p class="alert alert-danger">{{$err}}</p>
                        @endforeach
                        @endif
                        <form action="{{ route('loginacc') }}" method="POST">
                            @csrf
                            <div class="text-center">  
                                <img src="{{ asset('images/foodies-nobg.png')}}" class="rounded" alt="" height="120px" width="185px">  
                                <h1 class="mt-3">Login</h1>
                            </div>
                            <br>

                           
                            <div class="form-group mb-3 fs-5">
                                <label for="email" >Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>

                            <div class="form-group mb-3 fs-5">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>


                            <a href="{{ route('AccountUnexist') }}?stats=true" class="link-danger">Don't have an account?</a>
                            <button type="submit" class="btn btn-danger" style="float:right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</html>