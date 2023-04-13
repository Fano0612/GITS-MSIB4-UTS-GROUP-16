<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G.16 Food & Bev's.</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://www.theworlds50best.com/filestore/png/SRA-Logo-1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- <style>
        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url('https://www.tagar.id/Asset/uploads2019/1636013819631-ketoprak.jpg');
            filter: blur(5px);
        }
    </style> --}}
</head>
<link rel="stylesheet" href="{{ asset('css/register.css') }}">


<body>
    <?php
    session_start();
    if (!isset($_SESSION['id']) && !isset($_GET['stats'])) {
        echo "<script>alert('Access it through login!'); window.location.href = '/login'; </script>";
    }
    ?>

    <div class="container"> 
        <div class="card"> 
            <div class="row g-0"> 
                <div class="col-md-6"> 
                    <div class="h-100 d-flex justify-content-center align-items-center">
                        @if($errors->any())
                        @foreach($errors->all() as $err)
                        <p class="alert alert-danger">{{$err}}</p>
                        @endforeach
                        @endif
                        <form action="{{ route('registeracc') }}" method="POST">
                            @csrf
                            <div class="py-4 px-3"> 
                                <h4>Create Account</h4> 
                                <div class="row mt-2"> 
                                    <div class="col-md-12"> 
                                        <div class="input-field">  
                                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                                            <label for="username">Username</label>
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="row mt-2"> 
                                    <div class="col-md-12"> 
                                        <div class="input-field"> 
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                            <label for="email">Email</label> 
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="row mt-2 mb-2"> 
                                    <div class="col-md-12"> 
                                        <div class="input-field"> 
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <label for="password">Password</label> 
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="row mt-2 mb-2"> 
                                    <div class="col-md-12"> 
                                        <div class="input-field"> 
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required> 
                                            <label for="passwordconfirmation">Confirm Password</label>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="form-group mb-3">
                                    <label for="access_rights">Access</label>
                                    <div class="form-check d-flex mt-2">
                                        <div class="me-3">
                                            <input class="form-check-input" type="radio" name="access_rights" id="merchant" value="Merchant" required>
                                            <label class="form-check-label" for="merchant">Merchant</label>
                                        </div>
                                        <div class="ms-3">
                                            <input class="form-check-input" type="radio" name="access_rights" id="user" value="User" required>
                                            <label class="form-check-label" for="user">User</label>
                                        </div>
                                    </div>
                                </div>    
                                <button class="btn btn-danger w-100 signup-button mt-2 mb-2">Signup</button> 
                                <br> 
                                <a href="{{ route('AccountExist') }}" class="link-danger mt-4">Already have an account?</a>
                            </div>  
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="right-side-content"> 
                            <div class="content d-flex flex-column"> 
                                <img src="{{ asset('images/draft/foodies-nobg.png')}}" class="rounded" alt="" height="170px" width="230px">
                            </div> 
                            <div class="right-side"> 
                                <span></span> 
                                <span></span> 
                                <span></span>
                                <span></span> 
                                <span><img src="{{ asset('images/draft/bg.jpg')}}" ></span> 
                                <span></span> 
                                <span></span> 
                                <span></span> 
                                <span><img src="{{ asset('images/draft/candy.jpg')}}"> </span> <span></span> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="parallelogram"> 
                <span></span> 
                <span></span> 
                <span></span> 
            </div>
        </div>
    </div>                    
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</html>