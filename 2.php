<?php
//Robert Mendez__CI30921905
class Rectangulo {
    private $x1;
    private $y1;
    private $x2;
    private $y2;
    private $x3;
    private $y3;
    private $x4;
    private $y4;

    public function __construct($x1, $y1, $x2, $y2, $x3, $y3, $x4, $y4) {
        $this->establecer($x1, $y1, $x2, $y2, $x3, $y3, $x4, $y4);
    }

    public function establecer($x1, $y1, $x2, $y2, $x3, $y3, $x4, $y4) {
        // Verificar que todas las coordenadas estén en el primer cuadrante y dentro de los límites.
        if ($x1 >= 0.0 && $x1 <= 20.0 && $y1 >= 0.0 && $y1 <= 20.0 &&
            $x2 >= 0.0 && $x2 <= 20.0 && $y2 >= 0.0 && $y2 <= 20.0 &&
            $x3 >= 0.0 && $x3 <= 20.0 && $y3 >= 0.0 && $y3 <= 20.0 &&
            $x4 >= 0.0 && $x4 <= 20.0 && $y4 >= 0.0 && $y4 <= 20.0) {
            // Verificar si las coordenadas forman un rectángulo.
            if ($this->esRectangulo($x1, $y1, $x2, $y2, $x3, $y3, $x4, $y4)) {
                $this->x1 = $x1;
                $this->y1 = $y1;
                $this->x2 = $x2;
                $this->y2 = $y2;
                $this->x3 = $x3;
                $this->y3 = $y3;
                $this->x4 = $x4;
                $this->y4 = $y4;
            } else {
                echo "Las coordenadas no forman un rectángulo válido.";
            }
        } else {
            echo "Las coordenadas deben estar en el primer cuadrante y dentro de los límites.";
        }
    }

    private function esRectangulo($x1, $y1, $x2, $y2, $x3, $y3, $x4, $y4) {
        $lados = array();
        $lados[] = $this->calcularDistancia($x1, $y1, $x2, $y2);
        $lados[] = $this->calcularDistancia($x2, $y2, $x3, $y3);
        $lados[] = $this->calcularDistancia($x3, $y3, $x4, $y4);
        $lados[] = $this->calcularDistancia($x4, $y4, $x1, $y1);
        sort($lados); // Ordenar los lados de menor a mayor longitud.
        return ($lados[0] === $lados[1]) && ($lados[2] === $lados[3]);
    }

    private function calcularDistancia($x1, $y1, $x2, $y2) {
        return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
    }

    public function calcularLongitud() {
        return max($this->calcularDistancia($this->x1, $this->y1, $this->x2, $this->y2), $this->calcularDistancia($this->x2, $this->y2, $this->x3, $this->y3));
    }

    public function calcularAncho() {
        return min($this->calcularDistancia($this->x1, $this->y1, $this->x2, $this->y2), $this->calcularDistancia($this->x2, $this->y2, $this->x3, $this->y3));
    }

    public function calcularPerimetro() {
        return 2 * ($this->calcularLongitud() + $this->calcularAncho());
    }

    public function calcularArea() {
        return $this->calcularLongitud() * $this->calcularAncho();
    }

    public function esCuadrado() {
        return $this->calcularLongitud() == $this->calcularAncho();
    }
}
$miRectangulo = new Rectangulo(1.0, 2.0, 4.0, 2.0, 4.0, 6.0, 1.0, 6.0);

echo "Longitud: " . $miRectangulo->calcularLongitud() . "<br>";
echo "Ancho: " . $miRectangulo->calcularAncho() . "<br>";
echo "Perímetro: " . $miRectangulo->calcularPerimetro() . "<br>";
echo "Área: " . $miRectangulo->calcularArea() . "<br>";
echo "¿Es un cuadrado? " . ($miRectangulo->esCuadrado() ? "Sí" : "No") . "<br>";
?>