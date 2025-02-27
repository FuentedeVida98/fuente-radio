<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header('Content-type: text/html; charset=utf-8');

include_once("./admin/dbcon.php");

$nombre = $_GET['nombre'];
$comentario = $_GET['comentario'];

    $stmt = $conn->prepare("INSERT INTO comentarios_radio (nombre, comentario) VALUES (:nombre, :comentario)");
    // Vincular parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':comentario', $comentario);
    // Ejecutar la consulta
    $stmt->execute();

    if($stmt){
        $array = true;
    }else{
        $array = false;
    }

    echo json_encode($array, true);


?>