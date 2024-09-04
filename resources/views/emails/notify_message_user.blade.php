<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Message Notification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }

        .header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h3 {
            color: #007bff;
        }

        .blockquote {
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>New Message Notification</h3>
        </div>
        <p><strong>Dear {{ $messageData['toUser']->first_name }} {{ $messageData['toUser']->last_name }},</strong></p>
        <p>You have received a new message from <strong>{{ $sender->first_name }} {{ $sender->last_name }}</strong>.</p>
        <p><strong>Message:</strong></p>
        <blockquote class="blockquote">
            <p class="mb-0">{{ $messageData['message'] }}</p>
        </blockquote>
        <p>To view and reply to this message, please <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
            to your account.</p>
        <div class="footer">
            <p>Best regards,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>
