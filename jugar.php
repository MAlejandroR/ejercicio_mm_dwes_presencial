<!--
RF1 Mostramos la pantalla según estilo (Opciones, Información, Jugada)
RF1.1 Mostrar opciones en Opciones
RF1.2 Mostrar menú de jugada
RF1.3 Mostrar información jugada
RF1 Generamos una clave y la guardamos en sesión  (usa un var_dump para verificar su funcionamiento )
RF2 Botón de reiniciar la clave (guardándola en sesión) (usa un var_dump para verificar su funcionamiento)
RF3 Leer jugada
RF4 evaluar jugada y obtener resultado (posiciones y colores=
RF6 Mostrar / ocular clave
RF7 Mostrar Jugadas
RF7.1 Mostrar Jugada actual
RF7.2 Mostrar Jugadas anteriores ordenadas


-->

<?php

session_start();


spl_autoload_register(function ($clase) {
    require("clases/$clase.php");
});

ini_set("display_errors", true);
error_reporting(E_ALL);

$colores = Constantes::COLORES;

$clave = Clave::getClave();

$msj = "<h3 class=titulo1>Sección de información varia</h3>";
$opcion = $_POST['submit'] ?? null;
$textoBotonMostrarOcultarClave = "Mostrar Clave";
switch ($opcion) {
    case "Reiniciar":
        session_destroy();
        header("Location:jugar.php");
        exit;
    case "Jugar":
        $jugada = new Jugada();
        $jugada->comparaJugada($clave);
        $_SESSION['jugadas'][] = serialize($jugada);
        $msj =
        $msj = Plantilla::mostrarJugadas();
        $pos  = $jugada->getPosicionesAcertadas();
        var_dump($pos);
        if ((sizeof($_SESSION['jugadas']) === 14) || ($pos === 4)) {
            header("Location:finJuego.php?pos=$pos");
            exit();
        }
        break;
    case "Mostrar Clave":
        $textoBotonMostrarOcultarClave = "Ocultar Clave";
        $msj .= "<h1>Clave Actual</h1>";
        $msj .= Plantilla::mostrarClave($clave);
        break;
    case "Ocultar Clave":
        $textoBotonMostrarOcultarClave = "Mostrar Clave";
        $msj .= Plantilla::mostrarJugadas();
        break;

}



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/mm/css/estilo.css" type="text/css"/>
    <script type="text/javascript">
        function cambia_color(numero) {
            color = document.getElementById("combinacion" + numero).value;
            elemento = document.getElementById("combinacion" + numero);
            elemento.className = color;
        }
    </script>
</head>
<body>
<div class="contenedor">
    <div class="jugar">
        <fieldset class="opciones">
            <legend>Opciones de juego</legend>
            <form action="jugar.php" method="POST">
                <input type="submit" value="<?= $textoBotonMostrarOcultarClave ?>" name="submit"/>
                <input type="submit" value="Reiniciar" name="submit"/>
            </form>

        </fieldset>
        <fieldset class="menu">
            <legend>Menú juego</legend>
            <form action="jugar.php" method="POST">
                <?= Plantilla::mostrarFormularioJugada() ?>
                <input type="submit" value="Jugar" name="submit">
            </form>
        </fieldset>
    </div>

    <fieldset class="jugadas">
        <legend>Información de jugadas</legend>
        <?= $msj ?? null ?>
    </fieldset>
</div>
</body>

</body>
</html>



