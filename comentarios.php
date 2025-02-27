<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    
</body>
</html>

<?php
include_once("./admin/dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $message = $_POST['message'];


    try {
        // Preparar la consulta SQL usando prepared statements
        $stmt = $conn->prepare("INSERT INTO contacto (correo, mensaje) VALUES (:email, :message)");
        // Vincular parámetros
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        // Ejecutar la consulta
        $stmt->execute();

        if($stmt){
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Mensaje enviado con éxito',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(function(){
                        window.location.href = 'index.html'; // Redirige después de la alerta
                    }, 1500);
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al enviar el mensaje',
                    text: 'Por favor, inténtelo de nuevo.',
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout(function(){
                    window.location.href = 'index.html'; // Redirige después de la alerta
                }, 1500);
              </script>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>