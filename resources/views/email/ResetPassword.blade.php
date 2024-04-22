<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">
  <p>hello ,{{ $mailData['user']->name}}</p>
  <h1>{{ $mailData['subject'] }}</h1>
  <p>Please click the below link to reset password.</p>
  <a href="{{ route('account.reset-password' ,$mailData['token']) }}">Click Here</a>
</body>
</html>