<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Reset Your Password</title>
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
  <h2>Reset Your Password</h2>
  <p>You are receiving this email because we received a password reset request for your account.</p>
  <p>Please click the following link to reset your password:</p>
  <a href="{{ $resetLink }}" class="button"> Reset Password</a>
  <p>If you did not request a password reset, no further action is required.</p>
  <p>Thank you,</p>
  <p>Your App Team</p>
</body>

</html>
