<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Duplicado de Licencia</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        .section p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .section p strong {
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Duplicado de Licencia de Tránsito</h1>

        <div class="section">
            <h2>Información de la Licencia</h2>
            <p><strong>Número de Licencia:</strong> {{ $licencia->numero_licencia }}</p>
            <p><strong>Fecha de Expedición:</strong> {{ \Carbon\Carbon::parse($licencia->fecha_expedicion)->format('d/m/Y') }}</p>
            <p><strong>Fecha de Vencimiento:</strong> {{ \Carbon\Carbon::parse($licencia->fecha_vencimiento)->format('d/m/Y') }}</p>
            <p><strong>Estado:</strong> {{ $licencia->estado }}</p>
            <p><strong>Días Restantes:</strong>
    {{ $diasRestantes >= 0 ? floor($diasRestantes) : 'Vencido' }}
</p>
        </div>

        <div class="section">
            <h2>Categorías</h2>
            @foreach ($licencia->categorias as $categoria)
                <p><strong>{{ $categoria->nombre }}:</strong> {{ $categoria->descripcion }}</p>
                <hr>
            @endforeach
        </div>

        <div class="footer">
            <p>Generado por SDGV - Sistema de Gestión Vehicular</p>
        </div>
    </div>
</body>
</html>
