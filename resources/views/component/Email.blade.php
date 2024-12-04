<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Pemberitahuan Pengajuan Beasiswa' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 15px;
            background-color: #0056b3;
            color: #ffffff;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f1f1f1;
            font-size: 12px;
            color: #888;
            border-radius: 0 0 5px 5px;
        }
        a {
            color: #0056b3;
            text-decoration: none;
        }
        .button {
            background-color: #0056b3;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>{{ $subject ?? 'Pemberitahuan Pengajuan Beasiswa' }}</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>{{ $data['message'] }}</p>

            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email <a href="mailto:support@example.com">support@example.com</a> atau kunjungi <a href="https://example.com">situs kami</a>.</p>

            <p>Terima kasih atas perhatian Anda.</p>
            <p>Salam hangat,</p>
            <p>Tim Beasiswa Politeknik Negeri Bandung</p>

        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Politeknik Negeri Bandung, Jl. Gegerkalong Hilir, Kota Bandung, Indonesia</p>
            <p><a href="unsubscribe-link">Berhenti Berlangganan</a> | <a href="support-link">Dukungan</a></p>
        </div>
    </div>
</body>
</html>
