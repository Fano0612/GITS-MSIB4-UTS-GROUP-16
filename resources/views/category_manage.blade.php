
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

    <style>
        /* .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8NHx8fGVufDB8fHx8&w=1000&q=80');
            filter: blur(5px);
        } */

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
<link rel="stylesheet" href="{{ asset('js/category.js') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">



<body>
    <!-- Navbar & Hero Start -->
    {{-- <div class="background"></div> --}}
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
                    <a class="nav-item nav-link active" aria-current="page" href="{{route ('category')}}">Category</a>
                    <a href="{{route ('transaction_list')}}" class="nav-item nav-link">Transactions</a>
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


    <!-- category start -->
    <div class="background"></div>
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="number" name="id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" id="id" placeholder="Enter ID" value="{{ old('id') }}" required>

                            </div>

                            <div class="mb-3">
                                <label for="product_category" class="form-label">Product Category</label>
                                <input type="text" name="product_category" class="form-control {{ $errors->has('product_category') ? 'is-invalid' : '' }}" id="product_category" placeholder="Enter Product Category" value="{{ old('product_category') }}" required>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="container">
        <div class="row">
            <table id="example" class="table table-striped table-bordered">
            {{-- <table id="example" class="table table-striped table-bordered" style="width:75%"> --}}
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product Category</th>
                            <th scope="col" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $cat)
                            <tr>
                                <th scope="row">{{$cat->id}}</th>
                                <td>{{$cat->product_category}}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('category.edit', ['id' => $cat->id]) }}" class="btn btn-success">Edit</a>



                                    <a href="#" class="btn btn-danger delete" data-id="{{$cat->id}}">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

<script>
    $('.delete').click(function() {
        var catId = $(this).data('id');
        swal({
                title: "Delete Category?",
                text: "Delete category " + catId + "?\n" + "Once it's deleted, you won't be able to recover this category anymore",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('category') }}" + '/' + catId,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            swal("Category has been deleted successfully!", {
                                icon: "success",
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(data) {
                            swal("Oops", "You can't delete a category with products connected to it", "error");
                        }
                    });
                } else {
                    swal("Category deletion cancelled!");
                }
            });
    });
</script>

</html>