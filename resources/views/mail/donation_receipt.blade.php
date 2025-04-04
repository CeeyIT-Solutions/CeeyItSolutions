<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .receipt-container {
            max-width: 600px;
            background: #ffffff;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .details {
            text-align: left;
            margin-top: 20px;
        }
        .details p {
            margin: 8px 0;
            font-size: 16px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <h2>Donation Receipt</h2>
        <p>Thank you for your generous donation!</p>
        <div class="details">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Amount Donated:</strong> ${{ number_format($amount, 2) }}</p>
            <p><strong>Transaction ID:</strong> {{ $transaction_id }}</p>
            <p><strong>Date & Time:</strong> {{ $donated_at }}</p>
        </div>
        <div class="footer">
            <p><strong>{{ $foundation_name }}</strong></p>
        </div>
    </div>
</body>
</html>
