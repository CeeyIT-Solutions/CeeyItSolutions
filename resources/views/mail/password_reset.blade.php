<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body>
    <h1>Password Reset Request</h1>
    <p>Dear {{ $data['user']->name }},</p>

    <p>You have requested to reset your password. Here are the details:</p>
    <ul>
        <li><strong>Reset Code:</strong> {{ $data['code'] }}</li>
        <li><strong>Operating System:</strong> {{ $data['operating_system'] ?? 'Unknown' }}</li>
        <li><strong>Browser:</strong> {{ $data['browser'] ?? 'Unknown' }}</li>
        <li><strong>IP Address:</strong> {{ $data['ip'] ?? 'Unknown' }}</li>
        <li><strong>Time:</strong> {{ $data['time'] ?? 'Unknown' }}</li>
    </ul>

    <p>If you didn't make this request, please ignore this email.</p>

    <p>Thank you,<br>{{ env("APP_NAME") }} Team</p>
</body>

</html>