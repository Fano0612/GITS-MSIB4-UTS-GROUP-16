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
            background-image: url('https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8NHx8fGVufDB8fHx8&w=1000&q=80');
            filter: blur(5px);
        }
    </style>
    <script>
        $(document).ready(function() {

            $("form").submit(function(event) {
                var product_id = $("#exampleInputEmail1").val();
                var product_name = $("#exampleInputName").val();
                var exist = false;
                $("table tbody tr").each(function() {
                    var id = $(this).find("th:eq(0)").text();
                    var name = $(this).find("td:eq(0)").text();
                    if (id == product_id || name == product_name) {
                        exist = true;
                        return false;
                    }
                });
                if (exist) {
                    alert("Product already exists in the table.");
                    event.preventDefault();
                }
            });
        });
    </script>
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
                    <a class="nav-item nav-link active" aria-current="page" href="{{route ('product_menu')}}">Manage</a>
                    <a href="{{route ('category')}}" class="nav-item nav-link">Category</a>
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


    <!-- manage start -->
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card" >
                    <div class="card-body">
                        <form action="/insertproduct" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Product ID</label>
                                <input type="number" name="product_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" onchange="checkIdLength(this.value)" required>
                                <script>
                                    function checkIdLength(id) {
                                        if (id.length !== 5) {
                                            alert("Invalid Product ID! \nPlease enter a 5 digit number.");
                                            document.getElementById("exampleInputEmail1").value = "";
                                        }
                                    }
                                </script>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputName" aria-describedby="nameHelp" onchange="checkNameLength(this.value)" required>
                                <span id="name-error-msg" class="error-msg"></span>
                                <script>
                                    function checkNameLength(name) {
                                        if (name.length > 255) {
                                            alert("Invalid Name! Please enter a name with less than 255 characters.");
                                            document.getElementById("exampleInputName").value = "";
                                            document.getElementById("name-error-msg").textContent = "";
                                        } else {
                                            document.getElementById("name-error-msg").textContent = "";
                                        }
                                    }
                                </script>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="product_price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('form').submit(function(event) {
                                            var price = $('input[name="product_price"]').val();
                                            if (isNaN(price)) {
                                                alert('Please enter a valid number for the price.');
                                                event.preventDefault();
                                            }
                                        });
                                    });
                                </script>

                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Stock</label>
                                <input type="number" name="product_stock" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="1" min="1" required>
                            </div>



                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Picture</label>
                                <input type="file" name="product_picture" class="form-control custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Product Category</label>
                                <select class="form-select" name="category_id" aria-label="Default select example" required>
                                    <option value="" selected disabled hidden>Choose a category</option>
                                    @php
                                    $category = App\Models\Category::all();
                                    @endphp
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->product_category}}</option>
                                    @endforeach
                                </select>
                                <span id="category-error-msg" class="error-msg"></span>
                                <script>
                                    function checkCategory(category) {
                                        if (category === "") {
                                            document.getElementById("category-error-msg").textContent = "Please choose a category";
                                            return false;
                                        } else {
                                            document.getElementById("category-error-msg").textContent = "";
                                            return true;
                                        }
                                    }

                                    document.querySelector("form").addEventListener("submit", function(event) {
                                        const category = document.querySelector("[name='category_id']").value;
                                        if (!checkCategory(category)) {
                                            event.preventDefault();
                                        }
                                    });
                                </script>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <table class="table table-dark table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Category</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                    <tr>
                        <th scope="row">{{$prod->product_id}}</th>
                        <td>{{$prod->product_name}}</td>
                        <td>Rp {{ number_format($prod->product_price, 0, ',', '.') }}.00</td>
                        <td>{{$prod->product_stock}}</td>
                        <td><img src="{{ URL::asset('images/product_pictures/'.$prod->product_picture) }}" alt="" class="card-img-top"></td>
                        <td>{{ $prod->categories->product_category }}</td>
                        <td style="text-align: center;">
                            <a href="/showproduct/{{$prod->product_id}}" class="btn btn-success">Edit</a>
                            <a href="#" class="btn btn-danger delete" id-data="{{$prod->product_id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Foodies</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    
    
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    
    
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
        var stdid = $(this).attr('id-data');
        swal({
                title: "Delete Data?",
                text: "Delete " + stdid + "?\n" + "Once it's deleted, you won't be able to recover this data anymore",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Data has been deleted successfully!", {
                        icon: "success",
                    }).then(() => {
                        window.location = "/deleteproduct/" + stdid;
                    });
                } else {
                    swal("Data deletion cancelled!");
                }
            });
    });
</script>

</html>