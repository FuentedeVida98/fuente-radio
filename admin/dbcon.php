<?php

DEFINE('servername', 'localhost');
DEFINE('username', 'fuentederadio');
DEFINE('password', 'RteamRADIO93@007**2**2');
DEFINE('db', 'fuentederadio_data');

try {
  //  CREACIÓN DE LA CONEXIÓN CON PDO //
  $conn = new PDO("mysql:host=".servername.";dbname=".db, username, password);

  // CONFIGURACIÓN DEL MANEJO DE ERRORES CON PDO  //
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //  CONFIGURANDO EL CONJUNTO DE CARACTERES A USAR EN LA CONEXIÓN //
  $conn->exec("SET NAMES 'utf8'");
} catch (PDOException $error) {
  echo "Error al conectar a la base de datos: ".$error->getMessage();
  exit;
}

?>