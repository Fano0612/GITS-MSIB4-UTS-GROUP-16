<?php
if (!auth()->check() || auth()->user()->status != 'active') {
    echo "<script>alert('Silakan login untuk mengakses sistem!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
    die();
  }
?>

<?php
if (auth()->user()->jabatan != 'generalmanageroperasional') {
    echo "<script>alert('Anda Bukan General Manager Operasional!');</script>";
    echo "<script>setTimeout(function() { window.location.href = '/dashboardgeneralmanageroperasional'; }, 1000);</script>";
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System - Pembaharuan Data Kategori</title>
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
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
            background-image: url('https://swamediainc.storage.googleapis.com/swa.co.id/wp-content/uploads/2022/01/17165433/Transaksi-GoPay-di-Indomaret.jpg');
            filter: blur(5px);
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

    </style>

</head>

<body>

    <!-- <div class="background"></div> -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container-fluid">

            <nav class="navbar bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="">
                    <img src="    https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" style="width:150px;height:50px;">
</a>
                </div>
            </nav>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">



                <h1 class="position-absolute top-50 start-50 translate-middle">Pembaharuan Data Kategori</h1>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    &nbsp; &nbsp;
                    <div class="dropdown ml-auto">


                    </div>
                </nav>
            </div>
        </div>
    </nav>


    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">ID</label>
                            <input type="number" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$category->id}}" onchange="checkIdLength(this.value)" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Product Category</label>
                            <input type="text" name="product_category" class="form-control" id="exampleInputName" aria-describedby="nameHelp" value="{{$category->product_category}}" onchange="checkNameLength(this.value)" required>
                        </div>
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @if($errors->has('error'))
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $errors->first('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

    <script>
        function checkIdLength(id) {
            if (id.length !== 1) {
                alert('ID must be 1 digit only.');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var initialValues = {
                id: $('input[name="id"]').val(),
                product_category: $('input[name="product_category"]').val(),
            };

            function isFormChanged() {
                var currentValues = {
                    id: $('input[name="id"]').val(),
                    product_category: $('input[name="product_category"]').val(),
                };

                return JSON.stringify(currentValues) !== JSON.stringify(initialValues);
            }

            $('form').submit(function() {
                if (!isFormChanged()) {
                    $('button[type="submit"]').prop('disabled', true);
                }
            });

            $('input').on('change', function() {
                if (isFormChanged()) {
                    $('button[type="submit"]').prop('disabled', false);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>