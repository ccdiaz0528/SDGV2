<!-- filepath: c:\laragon\www\SDGV2\resources\views\emails\nuevacuenta.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Cuenta</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f5f5f5; color:#333;">
    <table align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <tr>
            <td align="center" style="padding: 20px; background-color: #ffffff;">
                {{ config('app.name') }}
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #000; font-size: 24px; margin: 0 0 10px;">Bienvenido, {{ $cliente->nombre }}!</h1>
                <p style="font-size: 16px; line-height: 1.5; margin: 0 0 20px;">
                    Tu cuenta se ha creado exitosamente. Gracias por registrarte.
                </p>
                <p style="font-size: 16px; line-height: 1.5; margin: 0 0 20px;">
                    Ahora ya puedes acceder a nuestras funcionalidades y comenzar a gestionar tu información de forma sencilla y segura.
                </p>
                <p style="text-align: center; margin: 30px 0;">
                    <a href="{{ url('/home') }}" style="display: inline-block; padding: 10px 20px; background-color: #000; color: #fff; text-decoration: none; border-radius: 4px; font-size: 16px;">Acceder a SDGV</a>
                </p>
                <p style="font-size: 14px; color: #777; margin: 0;">
                    Saludos cordiales,<br>
                    El equipo de SDGV
                </p>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 10px; background-color: #ffffff;">
                <p style="font-size: 12px; color: #777; margin:0;">© 2025 SDGV. Todos los derechos reservados.</p>
            </td>
        </tr>
    </table>
</body>
</html>
