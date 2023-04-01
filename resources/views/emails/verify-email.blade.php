<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email Address</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
        }
        
        .button {
            display: inline-block;
            background-color: #1c76d6;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h2>Verify Your Email Address</h2>
    <p>Thank you for creating an account with our service. Please click the following button to verify your email address:</p>
    <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
    <p>If you did not create an account with our service, please ignore this email.</p>
    <p>Thank you,</p>
    <p>Your App Team</p>
</body>

</html>
