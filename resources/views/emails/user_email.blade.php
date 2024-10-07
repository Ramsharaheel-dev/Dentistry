<html>

<head>
    <style>
        div#\:2a {
            text-align: center;
        }

        .btn.btn-primary1 {
            background-color: #000;
            border-color: #000;
        }

        footer.page-footer.py-4.mt-4 {
            display: none;

        }

        button {
            background-color: black;
            color: white;
            border-color: black;
            padding: 9px 10px;
            border-radius: 10px;
        }

        .button2 {
            background-color: black;
            color: white;
            border-color: black;
            padding: 9px 10px;
            border-radius: 10px;
            width: 8%;
            position: relative;
            left: 43rem;
        }

        .page1 {
            transform: translate(10px, 18%);
        }

        .text-gradient {
            background: #E19F65;
            /* -webkit-background-clip: text; */
            -webkit-text-fill-color: transparent;
        }

        h2 {
            color: #E19F65;

        }

        .text-center {
            text-align: center !important;
        }

        body {
            overflow-x: hidden;

        }
    </style>
</head>

<body>
    <div class="page1">
        <div class="card-body text-center" style="text-align: center;">

            <h2 class=" " style=" color: #E19F65;">{{ $user['name']}}</h2>

            <p>Email: {{ $user['email'] }}</p>
            <a href="{{ route('signin') }}">
                <button style="background-color: black; color: white; border-color: black; padding: 9px 10px; border-radius: 10px; width: 12%; position: relative; left: 0rem;">Click</button>
            </a>

        </div>
    </div>

</body>

</html>
