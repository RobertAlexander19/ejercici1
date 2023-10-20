<?php
//Robert Mendez__CI30921905
class EnteroMuyLargo {
    private $entero = array(); // Arreglo para almacenar dígitos del número

    public function entrada($numero) {
        // Convierte el número en una cadena y almacena cada dígito en el arreglo
        $this->entero = str_split(strval($numero));
    }

    public function salida() {
        // Convierte el arreglo de dígitos en una cadena y muestra el número
        return implode('', $this->entero);
    }

    public function esCero() {
        // Comprueba si todos los dígitos son cero
        return array_sum($this->entero) == 0;
    }

    public function suma($otroEntero) {
        // Realiza la suma con otro número EnteroMuyLargo y devuelve un nuevo objeto
        $resultado = new EnteroMuyLargo();
        $carry = 0;

        for ($i = max(count($this->entero), count($otroEntero->entero)) - 1; $i >= 0; $i--) {
            $digit1 = isset($this->entero[$i]) ? intval($this->entero[$i]) : 0;
            $digit2 = isset($otroEntero->entero[$i]) ? intval($otroEntero->entero[$i]) : 0;
            $sum = $digit1 + $digit2 + $carry;
            $carry = floor($sum / 10);
            $resultado->entero[] = $sum % 10;
        }

        if ($carry > 0) {
            $resultado->entero[] = $carry;
        }

        return $resultado;
    }

    public function resta($otroEntero) {
        // Realiza la resta con otro número EnteroMuyLargo y devuelve un nuevo objeto
        $resultado = new EnteroMuyLargo();
        $borrow = 0;

        for ($i = max(count($this->entero), count($otroEntero->entero)) - 1; $i >= 0; $i--) {
            $digit1 = isset($this->entero[$i]) ? intval($this->entero[$i]) : 0;
            $digit2 = isset($otroEntero->entero[$i]) ? intval($otroEntero->entero[$i]) : 0;
            $digit1 -= $borrow;

            if ($digit1 < $digit2) {
                $borrow = 1;
                $digit1 += 10;
            } else {
                $borrow = 0;
            }

            $resultado->entero[] = $digit1 - $digit2;
        }

        // Elimina los ceros no significativos
        while (end($resultado->entero) == 0) {
            array_pop($resultado->entero);
        }

        return $resultado;
    }

    public function multiplica($otroEntero) {
        // Realiza la multiplicación con otro número EnteroMuyLargo y devuelve un nuevo objeto
        $resultado = new EnteroMuyLargo();
        $num1 = $this->salida();
        $num2 = $otroEntero->salida();
        $multiplicacion = bcmul($num1, $num2);
        $resultado->entrada($multiplicacion);
        return $resultado;
    }

    public function divide($otroEntero) {
        // Realiza la división con otro número EnteroMuyLargo y devuelve un nuevo objeto
        $resultado = new EnteroMuyLargo();
        $num1 = $this->salida();
        $num2 = $otroEntero->salida();
        if (bccomp($num2, "0") === 0) {
            echo "Error: división por cero.";
            return null;
        }
        $division = bcdiv($num1, $num2, 0);
        $resultado->entrada($division);
        return $resultado;
    }

    public function modulo($otroEntero) {
        // Calcula el módulo con otro número EnteroMuyLargo y devuelve un nuevo objeto
        $resultado = new EnteroMuyLargo();
        $num1 = $this->salida();
        $num2 = $otroEntero->salida();
        if (bccomp($num2, "0") === 0) {
            echo "Error: cálculo de módulo por cero.";
            return null;
        }
        $modulo = bcmod($num1, $num2);
        $resultado->entrada($modulo);
        return $resultado;
    }

    public function esIgualQue($otroEntero) {
        // Comprueba si el número es igual al otro número EnteroMuyLargo
        return $this->salida() === $otroEntero->salida();
    }

    public function esDiferenteQue($otroEntero) {
        // Comprueba si el número es diferente del otro número EnteroMuyLargo
        return $this->salida() !== $otroEntero->salida();
    }

    public function esMayorQue($otroEntero) {
        // Comprueba si el número es mayor que el otro número EnteroMuyLargo
        return bccomp($this->salida(), $otroEntero->salida()) === 1;
    }

    public function esMenorQue($otroEntero) {
        // Comprueba si el número es menor que el otro número EnteroMuyLargo
        return bccomp($this->salida(), $otroEntero->salida()) === -1;
    }

    public function esMayorOIgualQue($otroEntero) {
        // Comprueba si el número es mayor o igual que el otro número EnteroMuyLargo
        return bccomp($this->salida(), $otroEntero->salida()) >= 0;
    }

    public function esMenorOIgualQue($otroEntero) {
        // Comprueba si el número es menor o igual que el otro número EnteroMuyLargo
        return bccomp($this->salida(), $otroEntero->salida()) <= 0;
    }
}

// Ejemplo de uso:
$entero1 = new EnteroMuyLargo();
$entero2 = new EnteroMuyLargo();

$entero1->entrada("1234567890123456789012345678901234567890");
$entero2->entrada("9876543210987654321098765432109876543210");

echo "Entero 1: " . $entero1->salida() . "<br>";
echo "Entero 2: " . $entero2->salida() . "<br>";

$suma = $entero1->suma($entero2);
echo "Suma: " . $suma->salida() . "<br>";

$resta = $entero1->resta($entero2);
echo "Resta: " . $resta->salida() . "<br>";

$multiplicacion = $entero1->multiplica($entero2);
echo "Multiplicación: " . $multiplicacion->salida() . "<br>";

$division = $entero1->divide($entero2);
echo "División: " . $division->salida() . "<br>";

$modulo = $entero1->modulo($entero2);
echo "Módulo: " . $modulo->salida() . "<br>";

echo "¿Es igual que Entero 2? " . ($entero1->esIgualQue($entero2) ? "Sí" : "No") . "<br>";
echo "¿Es diferente que Entero 2? " . ($entero1->esDiferenteQue($entero2) ? "Sí" : "No") . "<br>";
echo "¿Es mayor que Entero 2? " . ($entero1->esMayorQue($entero2) ? "Sí" : "No") . "<br>";
echo "¿Es menor que Entero 2? " . ($entero1->esMenorQue($entero2) ? "Sí" : "No") . "<br>";
echo "¿Es mayor o igual que Entero 2? " . ($entero1->esMayorOIgualQue($entero2) ? "Sí" : "No") . "<br>";
echo "¿Es menor o igual que Entero 2? " . ($entero1->esMenorOIgualQue($entero2) ? "Sí" : "No") . "<br>";
?>