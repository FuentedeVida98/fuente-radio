<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envío de Mensaje</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// Incluir la conexión a la base de datos
include '../admin/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar el campo honeypot (debe estar vacío)
    if (!empty($_POST['honeypot'])) {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Solicitud rechazada',
                    text: 'Se detectó actividad sospechosa.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.href = 'https://fuentedevidaradio.net/index.html';
                });
            </script>
        ";
        exit;
    }

    // Verificar si se recibió el token de reCAPTCHA
    if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
        echo "
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Verificación requerida',
                    text: 'Por favor, completa el reCAPTCHA.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.href = 'https://fuentedevidaradio.net/index.html';
                });
            </script>
        ";
        exit;
    }

    // Validar reCAPTCHA con Google
    $recaptcha_secret = "6Lf34MkqAAAAAC9J92EqRdVqyW-YuXXUVJ7sTW41"; // Reemplaza con tu clave secreta
    $recaptcha_response = $_POST["g-recaptcha-response"];
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        "secret" => $recaptcha_secret,
        "response" => $recaptcha_response,
        "remoteip" => $_SERVER["REMOTE_ADDR"]
    ];

    $options = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded",
            "method" => "POST",
            "content" => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $responseKeys = json_decode($result, true);

    if (!$responseKeys["success"]) {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Verificación fallida',
                    text: 'No se pudo verificar el reCAPTCHA.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.href = 'https://fuentedevidaradio.net/index.html';
                });
            </script>
        ";
        exit;
    }

    // Verificar si se recibieron los datos necesarios
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $message = isset($_POST['message']) ? trim($_POST['message']) : null;

    if ($nombre && $message) {
        try {
            // Preparar la consulta de inserción
            $stmt = $conn->prepare("INSERT INTO mensajes_radio (nombre, email, mensaje, fecha_envio) VALUES (:nombre, :email, :mensaje, NOW())");

            // Vincular los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mensaje', $message);

            // Ejecutar la consulta
            $stmt->execute();

            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Mensaje enviado con éxito!',
                        text: 'Gracias por tu mensaje.',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.href = 'https://fuentedevidaradio.net/index.html';
                    });
                </script>
            ";
        } catch (PDOException $e) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al enviar tu mensaje.',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.href = 'https://fuentedevidaradio.net/index.html';
                    });
                </script>
            ";
        }
    } else {
        echo "
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos obligatorios',
                    text: 'Por favor, completa todos los campos.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.href = 'https://fuentedevidaradio.net/index.html';
                });
            </script>
        ";
    }
} else {
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Solicitud inválida',
                text: 'No se pudo procesar tu solicitud.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = 'https://fuentedevidaradio.net/index.html';
            });
        </script>
    ";
}
?>

</body>
</html>
