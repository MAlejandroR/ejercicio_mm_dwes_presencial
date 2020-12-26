<?php

session_start();


spl_autoload_register(function ($clase) {
    require("clases/$clase.php");
});

ini_set("display_errors", true);
error_reporting(E_ALL);


$clave = Clave::getClave();


//Leo el parámetro que me marca cuantas posiciones he acertado
//Si este valor es 4 es que lo he acertado, si no es que estoy aquí
//Porque ya he realizado el número de intentos máximos
$pos = $_GET['pos'];


//Me quedo con la jugada realizada (número de jugadas que es el tamaño del array)
$jugadas = sizeof($_SESSION['jugadas']) - 1;

//Muestro el mensaje
if ($pos == 4)
    $htmlResultado = "<h1>FELICIDADES ADIVINASTE LA CLAVE en " . ($jugadas + 1) . " JUGADAS<h1>";
else
    $htmlResultado = "<h1>DEMASIADOS INTENTOS.... PRUEBA DE NUVEO<h1>";

$clave = Clave::getColoresClave();
//Por curiosidad muestro las jugadas y la clave
$htmlResultado.="<h2>Valor de la clave: </h2> $clave <br />";

$htmlResultado .= Plantilla::mostrarTodasJugadas();



echo "<div id = 'final'>$htmlResultado</div>";

//       header("Refresh:8;URL=index.php");
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="css/estilo.css" type="text/css">
    </head>
    <body>
    </body>
</html>
