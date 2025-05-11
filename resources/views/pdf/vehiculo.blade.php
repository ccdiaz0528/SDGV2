<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Duplicado Vehículo</title>
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
        <h1>Duplicado de Documentación del Vehículo</h1>

        <div class="section">
            <h2>Información del Vehículo</h2>
            <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
            <p><strong>Placa:</strong> {{ $vehiculo->placa }}</p>
            <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
            <p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
        </div>

        <div class="section">
            <h2>Documentación</h2>
            @foreach ($vehiculo->documentacion as $doc)
                @php
                    $diasRestantes = floor(now()->diffInDays($doc->fecha_vencimiento, false));
                    $estadoVigencia = $diasRestantes > 0 ? 'Vigente' : 'No Vigente';
                @endphp
                <p><strong>Tipo de Documento:</strong> {{ $doc->tipoDocumento->nombre }}</p>
                <p><strong>Fecha de Expedición:</strong> {{ $doc->fecha_expedicion }}</p>
                <p><strong>Fecha de Vencimiento:</strong> {{ $doc->fecha_vencimiento }}</p>
                <p><strong>Entidad Emisora:</strong> {{ $doc->entidad_emisora }}</p>
                <p><strong>Estado:</strong> {{ $estadoVigencia }}</p>
                <p><strong>Días Restantes:</strong> {{ $diasRestantes }}</p>
                <hr>
            @endforeach
        </div>

        <div class="footer">
            <p>Generado por SDGV - Sistema de Gestión Vehicular</p>
        </div>
    </div>
</body>
</html>
