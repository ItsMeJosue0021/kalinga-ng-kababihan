<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kalinga Email</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chewy&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            font-family: "Poppins", serif;
            box-sizing: border-box;
            margin: 0;
        }

        .chewy {
            font-family: "Chewy", serif;
        }

        body {
            font-family: Arial, sans-serif;
        }

        footer {
            padding: 10px 5px;
            text-align: center;
            background: #f4f4f4;
        }

        .content {
            padding: 20px;
            background: #fff;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
        }

        p {
            font-size: small
        }

        span {
            font-size: small;
            color: white;
        }

        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            text-align: left;
            background: #F97316;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <header>
            <p class="logo chewy">Kalinga Ng Kababaihan</p>
        </header>

        <div class="content">
            <p>{!! nl2br(e($messageContent)) !!}</p>
        </div>

        <footer>
            <p>&copy; {{ date('Y') }} Kalinga Ng Kababaihan LPC. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>