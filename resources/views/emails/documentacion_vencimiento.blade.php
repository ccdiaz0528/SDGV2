<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Aviso: Documentación por vencer</title>
    <style>
        body {
            background-color: #f5f9fa;
            color: #333333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            margin: 40px auto;
            padding: 30px 40px;
            box-shadow: 0 6px 18px rgba(0, 236, 210, 0.15);
            border: 2px solid #00ECD2;
        }
        h1 {
            color: #00a79d;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 18px;
        }
        strong {
            color: #00a79d;
        }
        .footer {
            font-size: 14px;
            color: #666666;
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚨 ¡Atención!</h1>
        <p>La documentación de tu vehículo (Placa: <strong>{{ $documentacion->vehiculo->placa }}</strong>) está próxima a vencer.</p>
        <p><strong>Fecha de vencimiento:</strong> {{ \Carbon\Carbon::parse($documentacion->fecha_vencimiento)->format('d/m/Y') }}</p>
        <p>Te recomendamos renovarla o revisarla con anticipación para evitar inconvenientes legales o administrativos.</p>
        <div class="footer">
            Gracias por tu atención.<br />
            Saludos,<br />
            El equipo de {{ config('app.name') }}
        </div>
    </div>
</body>
</html>
