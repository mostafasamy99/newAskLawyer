<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        .email-body {
            padding: 20px;
            text-align: center;
            color: #333333;
            position: relative;
            z-index: 2;
        }
        .email-body h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 16px;
            color: #666666;
            line-height: 1.6;
        }
        .email-body a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #f08000;
            color: #ffffff;
            text-decoration: none;
            border-radius: 30px;
            margin-top: 20px;
            font-size: 16px;
        }
        .email-footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
            background-color: #f9f9f9;
            border-top: 1px solid #dddddd;
        }
        .email-footer p {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; /* مسافة بين الشعار والنص */
        }
        .email-footer img {
            max-width: 20px; /* ضبط حجم اللوجو */
            height: auto;
            vertical-align: middle; /* محاذاة الشعار في وسط النص */
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Body -->
        <div class="email-body">
            <h1>Welcome to Our Platform!</h1>
            <p>Your OTP Code is: <strong>{{ $otp }}</strong></p>
            <p>Please use this code to verify your email address.</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© 2024 ASK LAWYER (Evyx).</p>
        </div>
    </div>

</body>
</html>
