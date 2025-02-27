<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="elrecurso/logo_radio.png" />
    <link rel="stylesheet" href="elrecurso/index.css">
    <script src="https://kit.fontawesome.com/96abc3538c.js" crossorigin="anonymous"></script>
    <title>Radio Mensajes</title>
</head> 
<body>
    <header class="header">
        <div class="logos">
            <img src="elrecurso/logo_radio.png" alt="">
        </div>
        <div class="logo">
            <i class="fa-solid fa-microphone-lines"></i> FUENTE DE VIDA RADIO
        </div>
    </header>

    <main>
        <div class="cards">
            <?php
            include '../admin/dbcon.php';

            $registrosPorPagina = 6;
            $paginaActual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($paginaActual - 1) * $registrosPorPagina;

            try {
                $stmtTotal = $conn->query("SELECT COUNT(*) AS total FROM mensajes_radio");
                $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

                $stmt = $conn->prepare("SELECT id, nombre, email, fecha_envio, mensaje FROM mensajes_radio ORDER BY fecha_envio DESC LIMIT :offset, :limit");
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindValue(':limit', $registrosPorPagina, PDO::PARAM_INT);
                $stmt->execute();
                $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($mensajes && count($mensajes) > 0) {
                    foreach ($mensajes as $mensaje) {
                        echo "
                        <div class='card'>
                            <div class='card_header'>
                                    <button type='button' class='delete' onclick='confirmDelete(" . htmlspecialchars($mensaje['id']) . ")' style='border: none; background: none; cursor: pointer;'>
                                        <i class='fa-solid fa-trash-can'></i>
                                    </button>
                                </form>
                                <img src='elrecurso/logo_radio.png' alt='Logo Radio'>
                            </div>
                            <div class='info'>
                                <p class='nombre'>" . htmlspecialchars($mensaje['nombre']) . "</p>
                                <p class='correo'>" . htmlspecialchars($mensaje['email']) . "</p>
                                <p class='fecha'>" . date('d/m/Y', strtotime($mensaje['fecha_envio'])) . "</p>
                            </div>
                            <div class='card_body'>
                                <p>" . htmlspecialchars($mensaje['mensaje']) . "</p>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "<p>No hay mensajes disponibles en este momento.</p>";
                }
            } catch (PDOException $e) {
                echo "<p>Error al cargar los mensajes: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            ?>
        </div>

        <!-- Paginación -->
        <div class="compaginacion">
            <?php
            // Calcular el total de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

            // Enlace a la página anterior
            if ($paginaActual > 1) {
                echo '<a href="?pagina=' . ($paginaActual - 1) . '"><i class="fa-solid fa-arrow-left"></i> Anterior</a>';
            }

            // Enlace a la página siguiente
            if ($paginaActual < $totalPaginas) {
                echo '<a href="?pagina=' . ($paginaActual + 1) . '">Siguiente <i class="fa-solid fa-arrow-right"></i></a>';
            }
            ?>
        </div>
    </main>

    <footer></footer>
        
    <script src="elrecurso/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "¿Estás seguro de Eliminar?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Crear un formulario y enviarlo manualmente
                    let form = document.createElement("form");
                    form.method = "POST";
                    form.action = "delete_message.php";

                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "id";
                    input.value = id;

                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>
