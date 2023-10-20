<?php
//Robert Mendez__CI30921905
class Gato {
    private $tablero;
    private $jugadorActual;

    public function __construct() {
        $this->tablero = array(array(0, 0, 0), array(0, 0, 0), array(0, 0, 0));
        $this->jugadorActual = 1;
    }

    public function realizarMovimiento($fila, $columna) {
        if ($this->tablero[$fila][$columna] === 0) {
            $this->tablero[$fila][$columna] = $this->jugadorActual;
            $this->cambiarJugador();
            return true;
        }
        return false;
    }

    private function cambiarJugador() {
        $this->jugadorActual = ($this->jugadorActual === 1) ? 2 : 1;
    }

    public function verificarGanador() {
        // Lógica para verificar el ganador
        for ($i = 0; $i < 3; $i++) {
            if ($this->tablero[$i][0] === $this->jugadorActual && $this->tablero[$i][1] === $this->jugadorActual && $this->tablero[$i][2] === $this->jugadorActual) {
                return $this->jugadorActual;
            }
            if ($this->tablero[0][$i] === $this->jugadorActual && $this->tablero[1][$i] === $this->jugadorActual && $this->tablero[2][$i] === $this->jugadorActual) {
                return $this->jugadorActual;
            }
        }

        if (($this->tablero[0][0] === $this->jugadorActual && $this->tablero[1][1] === $this->jugadorActual && $this->tablero[2][2] === $this->jugadorActual) ||
            ($this->tablero[0][2] === $this->jugadorActual && $this->tablero[1][1] === $this->jugadorActual && $this->tablero[2][0] === $this->jugadorActual)) {
            return $this->jugadorActual;
        }

        return 0;
    }

    public function verificarEmpate() {
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($this->tablero[$i][$j] === 0) {
                    return false;
                }
            }
        }
        return true;
    }

    public function obtenerTablero() {
        return $this->tablero;
    }
}

$gato = new Gato();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fila = (int)$_POST["fila"];
    $columna = (int)$_POST["columna"];

    if ($gato->realizarMovimiento($fila, $columna)) {
        $ganador = $gato->verificarGanador();
        if ($ganador === 1) {
            $mensaje = "¡Jugador 1 (X) gana!";
        } elseif ($ganador === 2) {
            $mensaje = "¡Jugador 2 (O) gana!";
        } elseif ($gato->verificarEmpate()) {
            $mensaje = "¡Empate!";
        }
    } else {
        $mensaje = "Movimiento no válido. Intente de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Juego del Gato</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }

        td {
            width: 50px;
            height: 50px;
            text-align: center;
            vertical-align: middle;
            font-size: 24px;
            border: 1px solid #000;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Juego del Gato</h1>
    <form method="post">
        <table>
            <?php
            $tablero = $gato->obtenerTablero();
            for ($i = 0; $i < 3; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 3; $j++) {
                    echo "<td><button type='submit' name='fila' value='$i' name='columna' value='$j'>" . ($tablero[$i][$j] === 1 ? 'X' : ($tablero[$i][$j] === 2 ? 'O' : '')) . "</button></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <h2><?php echo $mensaje; ?></h2>
</body>
</html>

