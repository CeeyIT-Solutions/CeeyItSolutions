<!DOCTYPE html>
<html>

<head>
    <title>Laptop Application Status</title>
</head>

<body>
    <p>Dear {{ $name }},</p>

    <p>Your laptop application has been <strong>{{ $status }}</strong>.</p>

    @if($status == 'rejected' && $remarks)
        <p>Reason: {{ $remarks }}</p>
    @endif

    <p>Thank you,<br>{{ env("APP_NAME") }} Team</p>
</body>

</html>