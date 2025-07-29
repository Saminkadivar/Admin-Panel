<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin OTP Code</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #0d6efd;
        }

        .otp-box {
            text-align: center;
            font-size: 32px;
            background: #e7f1ff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            letter-spacing: 8px;
            color: #0d6efd;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Admin Panel OTP</h2>
            <p>Please use the code below to log in</p>
        </div>

        <div class="otp-box">
            {{ $otp }}
        </div>

        <p style="text-align:center; color: #555;">This OTP is valid for 5 minutes. Do not share it with anyone.</p>

        <div class="footer">
            &copy; {{ date('Y') }} YourCompanyName. All rights reserved.
        </div>
    </div>
</body>
</html>
