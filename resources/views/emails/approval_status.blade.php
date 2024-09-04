<!DOCTYPE html>
<html>

<head>
    <title>Approval Status</title>
</head>

<body>
    <h1>Hello {{ $user->name }},</h1>

    @if ($approvalStatus == 1)
        <p>We are pleased to inform you that your account has been approved.</p>
    @else
        <p>We regret to inform you that your account has been rejected.</p>
    @endif

    @if ($note)
        <p>Note from the admin: {{ $note }}</p>
    @endif

    <p>Thank you,</p>
    <p>The Team</p>
</body>

</html>
