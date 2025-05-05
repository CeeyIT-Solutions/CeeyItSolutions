<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }


        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Hello, {{ $name }}</h2>
        </div>

        <p>We noticed that your email address has not been verified yet on CeeyITSolutions.</p>

        <p>To make sure you don't miss important updates, please verify your email by clicking the link below</p>
        <p>Then login in. An email will be sent to the email address you provided for verification.</p>
        <p style="text-align:center;">
            https://www.ceeyitsolutions.com/login
        </p>

        <p>If you didn’t create an account with us, you can safely ignore this message.</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>