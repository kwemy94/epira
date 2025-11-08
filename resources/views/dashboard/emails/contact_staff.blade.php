<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $subjectText ?? 'Notification' }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            padding: 30px;
        }

        .mail-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .signature {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            color: #555;
        }

        .logo {
            height: 40px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mail-container">
        <h3>{{ $subjectText }}</h3>
        <p>{!! nl2br(e($messageBody)) !!}</p>

        <div class="signature">
            {!! $signature !!}
            <br>
            <img src="{{ asset('logo_chre22.png') }}" alt="Logo" class="logo">
        </div>
    </div>
</body>

</html>
