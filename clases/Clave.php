<?php


class Clave
{


    /**
     * @return array 4 colores diferentes de la lista de colores disponibles
     */
    static private function generaClave(): array
    {
        $clave = [];
        $colores = Constantes::COLORES;
        $pos = array_rand($colores, 4);

        for ($n = 0; $n < 4; $n++) {
            $clave[] = $colores[$pos[$n]];
        }

        return $clave;
    }

    /**
     * @return array la clave
     * Si la clave existe en variable de sesión, la retorna, si no
     * genera una nueva y la guarda en variable de sesión
     */
    static public function getClave():array
   {
       $clave=[];
        if (isset($_SESSION['clave']))
            $clave= $_SESSION['clave'];
        else {
            $clave= self::generaClave();
            $_SESSION['clave']=$clave;
        }
        return $clave;
    }

    /**
     * @return string
     * Retorna los colores de la clave
     */
    static public function getColoresClave():string
    {
        $msj = "";
        foreach (Clave::getClave() as $color)
            $msj .= "<div class='Color $color'>$color</div>";
        return $msj;
    }



}