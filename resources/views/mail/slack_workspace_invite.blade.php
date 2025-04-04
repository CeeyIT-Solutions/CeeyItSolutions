<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join our Slack Workspace </title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h1>
            <p>Hi {{ $name }},</p>
        </h1>
        <h2 style="text-align: center; color: #4A90E2;">You're Invited to
            Join Our Slack Workspace!
        </h2>

        <p>We’re excited to invite you to our Slack workspace where you can connect with the team, stay updated, and
            collaborate more effectively.</p>
        <p>
            Click the button below to join us:
        </p>
        <div style="text-align: center; margin: 20px 0;">
            <a href="{{ $inviteLink }}"
                style="background-color: #4A90E2; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-size: 16px;">
                Join Slack
            </a>
        </div>
        <p>If the button above doesn’t work, copy and paste the following link into your browser:</p>
        <p><a href="{{ $inviteLink }}">{{ $inviteLink }}</a></p>
        <p>We look forward to collaborating with you!</p>
        <p>Best regards,<br>{{ env("APP_NAME") }} Team</p>
    </div>
</body>

</html>