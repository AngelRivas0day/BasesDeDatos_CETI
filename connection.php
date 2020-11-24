<?php
function connection(){
    // borren estos comentarios y cambien nombres hahah
    // los tqm
    $user = "root";
    $passwd = "password";
    $server = "localhost";
    $db = "CETI";
    // Si usamos mysqli_connect en lugar de mysql_connect
    // tenemos que poner un cuarto parámetro que es la base de datos
    // que eremos usar, en mi caso se llama CETI, así a secas
    $conn = mysqli_connect($server, $user, $passwd, $db) or die ("No se pudo establecer una conexión con la base de datos");

    return $conn;
}
 ?>
