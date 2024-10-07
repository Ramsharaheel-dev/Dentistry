<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<style>
    body {
        background-color: #f8f9fa;
        padding-top: 50px;
        /* Adjust as needed */
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-top: 20px;
        /* Adjust as needed */
    }

    .ptb-20 {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .dian {
        color: #D9AA5A;
        font-weight: bold;
        font-size: 50px;
    }

    .w-20 {
        width: 60%;
        position: relative;
        top: -6rem;
    }

    .table th {
        /* background-color: #007bff; */
        color: #918d8d;
        border-color: #007bff;
    }

    .table td,
    .table th {
        border: 1px solid #dee2e6;
        padding: 12px;
    }

    @media (min-width: 300px) and (max-width:480px) {


        .w-20 {
            width: 45%;
            position: relative;
            left: 6rem;
            top: 0rem;
        }

        .h2,
        h2 {
            font-size: 19px;
        }

        .h1,
        h1 {
            font-size: 20px;
        }
    }
    .bold{
        font-weight: bold;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <h2 class="bold">RECEIPT</h2>

            </div>
            <div class="col-md-6 text-right">
                <p><span class="bold">Transaction ID:</span> {{ $transactionId }}</p>

            </div>
        </div>
        <div class="border-bottom"></div>
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <h2 class="bold">DIAN CLUB</h2>
                <p><span class="bold">Email:</span> {{ $email }}</p>
            </div>
            <div class="col-md-6 text-right">
                <h1 class="bold">Dian Club Ltd.</h1>
                <p><span class="bold">Date:</span> {{ $currentDate }}</p>
            </div>
        </div>

        <div class="border-bottom"></div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="bold">Item</th>
                            <th class="bold">Date</th>
                            <th class="bold">Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ strtoupper($packageName) }} </td>
                            <td>{{ $startDate }}</td>
                            <td>{{ $amount }}</td>
                        </tr>
                    </tbody>

                </table>

                <div class="ptb-20">
                    <h2 class="text-center dian">Thankyou.</h2>

                    <div class="row">
                        <div class="col-md-4 offset-md-8">
                            {{-- <img class="w-20" src="./img/PAID stamp.png" alt=""> --}}
                            <img class="w-20" src="{{ asset('images/forum/PAID stamp.png') }}">
                        </div>
                    </div>

                </div>

                <div class="border-bottom"></div>

                <div class="ptb-20">
                    <div class="row justify-content-between mb-4">
                        <div class="col-md-6">

                            <p>Questions About Your Order ? Contact Us at :<a class=""
                                    href="mailto:dianclub@gmail.com">dianclub@gmail.com</a></p>

                            </p>
                        </div>
                        <div class="col-md-6 text-right">

                            <img class="w-50" src="{{ asset('images/dian-gold-logo.png') }}">
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</body>

</html>
