<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificación de vencimiento de documentación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f2f1; /* verde menta suave */
            color: #004d40; /* verde oscuro */
            padding: 20px;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #00796b;
        }
        .fecha {
            font-weight: bold;
            color: #004d40;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚨 ¡Atención!</h1>
        <p>La documentación de tu vehículo <strong>(Placa: {{ $documentacion->vehiculo->placa }})</strong> está próxima a vencer.</p>
        <p>Fecha de vencimiento: <span class="fecha">{{ \Carbon\Carbon::parse($documentacion->fecha_vencimiento)->format('d/m/Y') }}</span></p>
        <p>Te recomendamos renovar o revisar tu documentación con anticipación para evitar inconvenientes legales o administrativos.</p>
    </div>
</body>
</html>
