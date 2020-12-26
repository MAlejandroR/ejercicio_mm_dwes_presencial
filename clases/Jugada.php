<?php


class Jugada
{

    private $jugada = [];
    private $posicionesAcertadas=0;
    private $coloresAcertados=0;

    /**
     * Jugada constructor.Crea una jugada (4 colores que el usuario a ejegido)
     */
    public function __construct(){
        for ($n = 0; $n < 4; $n++) {
            $this->jugada[] = $_POST["combinacion" . $n];
        }
        $this->coloresAcertados=0;
        $this->posicionesAcertadas=0;
    }


    /**
     * @param $clave
     * compara la clave con la jugada
     * Anota el resultado que son los colores acertados y de ellos cuantos
     * Están en la posiciòn correcta
     */
    public function comparaJugada($clave){
        foreach ($this->jugada  as $posicion=>$color) {
            if ($color == $clave[$posicion])
                $this->posicionesAcertadas++;
        }
        //quitamos duplicados
        $jugada = array_unique($this->jugada);
        foreach ($jugada as $color)
        if (in_array($color, $clave))
            $this->coloresAcertados++;
    }

    /**
     * @return array la jugada (colores)
     */
    public function getJugada():array{
        return $this->jugada;
    }

    /**
     * @return int
     */
    public function getPosicionesAcertadas(): int
    {
        return $this->posicionesAcertadas;
    }

    /**
     * @return int
     */
    public function getColoresAcertados(): int
    {
        return $this->coloresAcertados;
    }

    /**
     * @return string Los colores de la jugada para incluirlos en html
     */
    public function getColoresJugada(): string
    {
        $msj = "";
        foreach ($this->jugada as $color)
            $msj .= "<div class='Color $color'>$color</div>";
        return $msj;
    }
    public static function objeto(Jugada $objetoJugada):Jugada    {
        return $objetoJugada;
    }




}