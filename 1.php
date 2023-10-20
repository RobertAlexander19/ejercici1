<?php
//Robert Mendez__CI30921905
class Rectangulo {
    private $longitud;
    private $ancho;

    public function __construct($longitud = 1, $ancho = 1) {
        $this->setLongitud($longitud);
        $this->setAncho($ancho);
    }

    public function calcularPerimetro() {
        return 2 * ($this->longitud + $this->ancho);
    }

    public function calcularArea() {
        return $this->longitud * $this->ancho;
    }

    public function setLongitud($longitud) {
        if (is_float($longitud) && $longitud > 0.0 && $longitud < 20.0) {
            $this->longitud = $longitud;
        } else {
            echo "La longitud no es válida. Debe ser un número en punto flotante mayor que 0.0 y menor que 20.0.";
        }
    }

    public function getLongitud() {
        return $this->longitud;
    }

    public function setAncho($ancho) {
        if (is_float($ancho) && $ancho > 0.0 && $ancho < 20.0) {
            $this->ancho = $ancho;
        } else {
            echo "El ancho no es válido. Debe ser un número en punto flotante mayor que 0.0 y menor que 20.0.";
        }
    }

    public function getAncho() {
        return $this->ancho;
    }
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $longitud = floatval($_POST['longitud']);
    $ancho = floatval($_POST['ancho']);
    $miRectangulo = new Rectangulo();
    $miRectangulo->setLongitud($longitud);
    $miRectangulo->setAncho($ancho);
} else {
    $miRectangulo = new Rectangulo();
}

$perimetro = $miRectangulo->calcularPerimetro();
$area = $miRectangulo->calcularArea();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Rectángulo</title>
</head>
<body>
    <h1>Calculadora de Rectángulo</h1>
    <form method="POST">
        <label for="longitud">Longitud:</label>
        <input type="text" name="longitud" id="longitud" value="<?php echo $miRectangulo->getLongitud(); ?>"><br>
        <label for="ancho">Ancho:</label>
        <input type="text" name="ancho" id="ancho" value="<?php echo $miRectangulo->getAncho(); ?>"><br>
        <input type="submit" value="Calcular">
    </form>
    <br>
    <p>Longitud: <?php echo $miRectangulo->getLongitud(); ?></p>
    <p>Ancho: <?php echo $miRectangulo->getAncho(); ?></p>
    <p>Perímetro: <?php echo $perimetro; ?></p>
    <p>Área: <?php echo $area; ?></p>
</body>
</html>
