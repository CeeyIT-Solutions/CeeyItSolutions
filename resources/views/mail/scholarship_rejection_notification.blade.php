<html>

<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; color: #333; text-align: center; margin-bottom: 20px;">Dear {{ $fullName }} , Your Scholarship Application is rejected</h1>
        <p style="font-size: 16px; color: #555; text-align: center; margin-bottom: 30px;">We regret to inform you that your scholarship application
            has been rejected. Here are the details:</p>

        <ul style="list-style-type: none; padding-left: 0; font-size: 16px; color: #555;">
            <li style="margin-bottom: 10px;">
                <strong style="color: #333;">Application ID:</strong> {{ $applicationId }}
            </li>
            <li style="margin-bottom: 10px;">
                <strong style="color: #333;">Course:</strong> {{ $course }}
            </li>
        </ul>

        <p style="font-size: 16px; color: #555; text-align: center;">We encourage you to apply again in the future if the opportunity arises.
            Thank you for your understanding.</p>

        <p style="font-size: 16px; color: #555; text-align: center;">Best regards, <br> The Scholarship Committee</p>
    </div>
</body>

</html>