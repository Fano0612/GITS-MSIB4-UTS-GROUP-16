<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System - Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forgotpassword.css">
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
    <style>

    </style>
</head>

<body>

    <div class="forgot-box">
        <img src="https://www.cakeresume.com/cdn-cgi/image/fit=scale-down,format=auto,w=1200/https://images.cakeresume.com/images/19f33da4-afbc-4abd-8f66-cb6c24fa4aa2.jpeg" alt="" style="width:auto; height:250px; border-radius: 30px;">
        <h1 style="text-align:center; margin: 10px 0px;">Reset Password</h1>
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{$err}}</p>
        @endforeach
        @endif

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('forgotPassword') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
        <a href="{{ route('login') }}" style="display: block;">Ingat Password?</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>