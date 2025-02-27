<?php
include '../admin/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]); // Asegurar que el ID es un número entero

    try {
        $stmt = $conn->prepare("DELETE FROM mensajes_radio WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Redirigir de vuelta a la página principal después de eliminar
            header("Location: https://fuentedevidaradio.net/mensajes_radio/mgs_82jd9x.php");
            exit();
        } else {
            header("Location: https://fuentedevidaradio.net/mensajes_radio/mgs_82jd9x.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
} else {
    header("Location: mgs_82jd9x.php");
    exit();
}
?>
