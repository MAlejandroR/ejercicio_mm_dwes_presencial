<?php


class Plantilla
{


    /**
     * @return stringformulario con los 4 select para las jugadas
     */
    public static function mostrarFormularioJugada(): string
    {
        $colores = Constantes::COLORES;
        $selectores = ""; //quitamos el warning inicializanso
        for ($n = 0; $n < 4; $n++) {
            $selectores .= "\n<select onchange='cambia_color($n)' name='combinacion$n' id='combinacion$n'>\n";
            foreach ($colores as $color) {
                $selectores .= "<option class ='$color' value='$color'>$color</option>\n";
            }
            $selectores .= "</select>\n";
        }
        return $selectores;
    }

    /**
     * @param array $arrayColores
     * @return string La clave
     */

    public static function mostrarClave(array $arrayColores): string
    {
        $htmlClave = "<div class='jugada'>";
        foreach ($arrayColores as $color)
            $htmlClave .= "<span class='Color  $color'>$color</span>";
        $htmlClave .= "</div >";
        return $htmlClave;

    }

    /**
     * @param array $jugada
     * @return string
     * Tengo todas las jugadas en la variable de sesión
     * La última que tenga es la actual
     */
    public static function mostrarJugadas(): string
    {
        //Obtenemos las jugadas de la variable de sesión
        //Muy importante tener claro que tenemos un array indexado de jugadas serializadas


        $htmlJugadas="No hay jugadas actualmente";
        $jugadas = self::obtenerJugadas();


        $htmlJugadas= sizeof($jugadas)>0 ? self::obtenerDescripcionJugadas($jugadas) : $htmlJugadas;

        return $htmlJugadas;
    }

    /**
     * @param array $jugadas
     * @return array obtiene todas las jugadas
     */
    private static function obtenerJugadas(): array
    {
        $jugadas =[]; //Por defecto no hay jugadas
        $jugadasSerializadas = $_SESSION['jugadas']??[];

        foreach ($jugadasSerializadas as $jugadaSerializada) {
            $jugadas[] = unserialize($jugadaSerializada);
        }
        $jugadas = array_reverse($jugadas);
        return $jugadas;
    }


    /**
     * @return string todas las jugadas
     *
     */
    public static function mostrarTodasJugadas(): string
    {
        $jugadas = self::obtenerJugadas();
        $msj = "";
        foreach ($jugadas as $numJugada => $jugada) {
            $jugada = Jugada::objeto($jugada);
            $colores = $jugada->getColoresJugada();
            $msj .= "<br /><br /><h2>Valor de la jugada $numJugada :</h2><br /> $colores<br />";
        }
        return $msj;

    }

    /**
     * @param array $jugadas
     * @return string
     */
    private static function obtenerDescripcionJugadas(array $jugadas): string
    {
        $numeroJugadaActual = sizeof($jugadas);

        $coloresActual = $jugadas[0]->getColoresAcertados();
        $posicionesActual = $jugadas[0]->getPosicionesAcertadas();

        //Anotaciones de la jugada actual
        $htmlJugadas = "<h3>Jugada actual $numeroJugadaActual </h3>";

        $htmlJugadas .= "<h3>Resultado : $coloresActual Colores y $posicionesActual posiciones </h3>";

        //Anotaciones de todas las jugadas
        foreach ($jugadas as $numeroJugada => $jugada) {
            $jugada = Jugada::objeto($jugada);
            $htmlJugadas .= "<div class='jugada'>";
            $htmlJugadas .= "<h3 class=titulo jugadaNumero>Jugada $numeroJugada   </h3>\n";
            $htmlJugadas .= "<span class='jugadaRedondeles'>";
            for ($n = 0; $n < $jugada->getPosicionesAcertadas(); $n++)
                $htmlJugadas .= "<span class='negro '>$n</span>\n";
            for ($n = $jugada->getPosicionesAcertadas(); $n < $jugada->getColoresAcertados(); $n++)
                $htmlJugadas .= "<span class='blanco'>$n</span>\n";
            $htmlJugadas .= "</span>";
            $htmlJugadas .= "<span class='jugadaColores'>";
            foreach ($jugada->getJugada() as $color)
                $htmlJugadas .= "<span class='Color_small  $color'>$color[0]</span>\n";
            $htmlJugadas .= "</span>\n\n";
            $htmlJugadas .= "</div>\n\n";
        }

//
        return $htmlJugadas;
    }


}