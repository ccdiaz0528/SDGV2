<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Licencia Próxima a Vencer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e6f2f1;
            color: #2f4f4f;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #3eb489; /* verde menta */
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .highlight {
            background-color: #d0f0c0;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
            color: #2f4f4f;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background-color: #3eb489;
            color: white !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚨 ¡Atención, {{ $user->name }}!</h1>
        <p>Tu licencia con número <strong>{{ $licencia->numero_licencia }}</strong> está próxima a vencer.</p>

        <div class="highlight">
            Fecha de vencimiento: {{ $licencia->fecha_vencimiento->format('d/m/Y') }}
        </div>

        <p>Te recomendamos renovar o revisar tu documentación con anticipación para evitar inconvenientes legales o administrativos.</p>

        <a href="{{ url('/') }}" class="btn">Ir al sistema</a>

        <p class="footer">
            Gracias por utilizar nuestro sistema de gestión de vehículos.<br>
            Saludos cordiales,<br>
            <strong>{{ config('app.name') }}</strong>
        </p>
    </div>
</body>
</html>
