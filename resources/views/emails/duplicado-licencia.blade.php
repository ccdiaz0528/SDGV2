<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Duplicado de Licencia</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; }
        h2 { color: #333; }
        .info { margin-bottom: 20px; }
        ul { padding-left: 20px; }
    </style>
</head>
<body>
    <h2>Duplicado de Licencia de Tránsito</h2>

    <div class="info">
        <p><strong>Número de Licencia:</strong> {{ $licencia->numero_licencia }}</p>
        <p><strong>Fecha de Expedición:</strong> {{ \Carbon\Carbon::parse($licencia->fecha_expedicion)->format('d/m/Y') }}</p>
        <p><strong>Fecha de Vencimiento:</strong> {{ \Carbon\Carbon::parse($licencia->fecha_vencimiento)->format('d/m/Y') }}</p>
        <p><strong>Días Restantes:</strong> {{ $diasRestantes >= 0 ? $diasRestantes : 'Vencido' }}</p>
        <p><strong>Estado:</strong> {{ $licencia->estado }}</p>
    </div>

    <h3>Categorías</h3>
    <ul>
        @foreach ($licencia->categorias as $categoria)
            <li><strong>{{ $categoria->nombre }}:</strong> {{ $categoria->descripcion }}</li>
        @endforeach
    </ul>
</body>
</html>
