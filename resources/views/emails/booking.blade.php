<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Notification</title>
    <style>
        /* Inline CSS for email styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header,
        .footer {
            text-align: center;
            padding: 10px 0;
            background: #007bff;
            color: #fff;
            border-radius: 8px;
        }

        .footer {
            background: #343a40;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmation</h1>
        </div>

        <p>Dear {{ $serviceProvider->first_name }} {{ $serviceProvider->last_name }},</p>

        <p>We are pleased to inform you that a new appointment has been booked. Here are the details:</p>

        <table width="100%" cellpadding="10" cellspacing="0" border="0">
            <tr>
                <td><strong>Service Provider:</strong></td>
                <td>{{ $serviceProvider->first_name }} {{ $serviceProvider->last_name }}</td>
            </tr>
            <tr>
                <td><strong>User Name:</strong></td>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            </tr>
            <tr>
                <td><strong>Service:</strong></td>
                <td>{{ $serviceDetails->serviceCategory->name }}</td>
            </tr>
            <tr>
                <td><strong>Start Date:</strong></td>
                <td>{{ \Carbon\Carbon::parse($appointment->start_date)->format('M d, Y') }}</td>
            </tr>
            <tr>
                <td><strong>End Date:</strong></td>
                <td>{{ \Carbon\Carbon::parse($appointment->end_date)->format('M d, Y') }}</td>
            </tr>
            <tr>
                <td><strong>Start Time:</strong></td>
                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>End Time:</strong></td>
                <td>{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Location:</strong></td>
                <td>{{ $appointment->location }}</td>
            </tr>
            <tr>
                <td><strong>Amount:</strong></td>
                <td>${{ number_format($appointment->purchase_amount, 2) }}</td>
            </tr>
        </table>

        <p>Please ensure to review and prepare for this appointment. If you have any questions or need further
            information, feel free to contact us.</p>

        <p>Thank you for your prompt attention to this matter.</p>

        <div class="footer">
            <p>Best regards,</p>
            <p>The {{ config('app.name') }} Team</p>
        </div>
    </div>
</body>

</html>
