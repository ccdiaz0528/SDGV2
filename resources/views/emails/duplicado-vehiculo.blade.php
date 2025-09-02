<!-- filepath: c:\laragon\www\SDGV2\resources\views\emails\duplicado-vehiculo.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Duplicado de Documentación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 600px;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header img {
            display: block;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/auto.png'))) }}" alt="SDGV Logo" width="60">
        </div>
        <div class="content">
            <h1 style="text-align: center;">Duplicado de Documentación</h1>
            <p>Hola, <strong>{{ $vehiculo->user->username }}</strong>, se ha generado el duplicado de la documentación de tu vehículo con placa <strong>{{ $vehiculo->placa }}</strong>.</p>
            <hr>
            {{-- Mostrar el contenido generado de la documentación --}}
            {!! $contenido !!}
        </div>
        <div class="footer">
            <p>© 2025 SDGV - Sistema de Gestión Vehicular</p>
        </div>
    </div>
</body>
</html>
