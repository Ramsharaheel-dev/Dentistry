<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<style>
    .bold {
        font-weight: bold;
    }

</style>

<body style="background-color: ; padding-top: 0px;">
    <div
        style="background-color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 40px; margin-top: 10px;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <div style="flex: 0 0 50%;">
                <h2 class="bold">RECEIPT</h2>
                {{-- <p>Email: info@example.com</p> --}}
            </div>
            <div style="flex: 0 0 50%; text-align: right;margin-top:-20%">
                {{-- <h1>Dian Club Ltd.</h1> --}}
                <p><span class="bold">Transaction ID:</span> {{ $transactionId }}</p>
            </div>
        </div>
        <hr style="border-bottom: 1px solid #dee2e6; margin-bottom: 20px;">
        <div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <div style="flex: 0 0 50%;">
                    <h2 class="bold">DIAN CLUB</h2>
                    <p><span class="bold">Email:</span> {{ $email }}</p>
                </div>
                <div style="flex: 0 0 50%; text-align: right;margin-top:-20%">
                    <h1 class="bold">Dian Club Ltd.</h1>
                    <p><span class="bold">Date:</span> {{ $currentDate }}</p>
                </div>
            </div>
            <hr style="border-bottom: 1px solid #dee2e6; margin-bottom: 20px;">
            <table style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #dee2e6; padding: 12px;">Item</th>
                        <th style="border: 1px solid #dee2e6; padding: 12px;">Date</th>
                        <th style="border: 1px solid #dee2e6; padding: 12px;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #dee2e6; padding: 12px;">{{ strtoupper($packageName) }}</td>
                        <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $startDate }}</td>
                        <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $amount }}</td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align: center; margin-top: 20px;">
                <h2 style="color: #D9AA5A; font-weight: bold; font-size: 30px;">Thank you.</h2>
                <img style="width: 20%; margin-top: -15%;margin-left:45%;"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/forum/PAID stamp.png'))) }}"
                    alt="">
                <p style="margin-top: -2%;">Questions About Your Order? Contact Us at: dianclub@gmail.com</p>
                <img style="width: 30%;"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/dian-gold-logo.png'))) }}"
                    alt="">
            </div>
        </div>
    </div>
</body>

</html>
