<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System - Riwayat Transaksi</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .adjustment {
            display: flex;
            align-items: flex-start;
        }

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
    <div class="card">
        <div class="card-header">
            Transaction Details
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">ID Transaksi:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $transaction->transaction_id }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Username:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $transaction->user->username }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Status Transaksi:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $transaction->transaction_status }}
                </div>
            </div>

            <?php
            $transactions = \App\Models\Transaction::where('transaction_id', $transaction->transaction_id)->get();
            $total = 0;

            foreach ($transactions as $t) {
                $total += $t->product_price * $t->quantity;
            }
            ?>

            <?php
            $tax = $total * 0.1;
            $total += $tax;
            ?>


            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Total Transaction:</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    Rp {{ number_format($total, 0, ',', '.') }}.00
                </div>
            </div>



            @foreach(\App\Models\Transaction::where('transaction_id', $transaction->transaction_id)->get() as $transaction)
            <div class="card" style="width: 18rem; margin-bottom: 9px;">
                <img src="{{ URL::asset('images/product_pictures/'.$transaction->product_picture)  }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $transaction->product_name }}</h5>
                    <p class="card-text">ID Produk: {{ $transaction->product_id }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">ID Transaksi: {{ $transaction->transaction_id }}</li>
                    <li class="list-group-item">Status Transaksi: {{ $transaction->transaction_status }}</li>
                    <li class="list-group-item">Kuantitas: {{ $transaction->quantity }}</li>
                    <li class="list-group-item">Total Harga: Rp {{ number_format($transaction->product_price* $transaction->quantity, 0, ',', '.') }}.00</li>
                </ul>
            </div>
            @endforeach



            <div class="row mb-3">
                <div class="col-sm-3">
                    <a class="btn btn-success" href="{{route ('transaction_list2')}}" role="button">Return</a>
                </div>
            </div>
        </div>
    </div>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>