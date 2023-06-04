<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculadora</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    function calcular()
    {
        $string = implode($_SESSION['numeros']);

        $inputString = $string;

        // Formar un array de números
        $numbers = preg_split('/\+|\-|\×|\÷/', $inputString);

        // Formar un array de operadores
        $operators = preg_split('/[0-9]|\./', $inputString, -1, PREG_SPLIT_NO_EMPTY);

        // Realizar las divisiones
        $divide = array_search('÷', $operators);
        while ($divide !== false) {
            $numbers[$divide] = $numbers[$divide + 1] == '0' ? 0: $numbers[$divide] / $numbers[$divide + 1];
            array_splice($numbers, $divide + 1, 1);
            array_splice($operators, $divide, 1);
            $divide = array_search('÷', $operators);
        }

        // Realizar las multiplicaciones
        $multiply = array_search('×', $operators);
        while ($multiply !== false) {
            $numbers[$multiply] = $numbers[$multiply] * $numbers[$multiply + 1];
            array_splice($numbers, $multiply + 1, 1);
            array_splice($operators, $multiply, 1);
            $multiply = array_search('×', $operators);
        }




        // Realizar las sumas y restas
        $result = $numbers[0];
        for ($i = 1; $i < count($numbers); $i++) {
            $operator = $operators[$i - 1];
            $operand = (float)$numbers[$i];
            if ($operator === '+') {
                $result += $operand;
            } else if ($operator === '-') {
                $result -= $operand;
            }
        }

        return $result;
    }
    ?>
    <?php


    $resultado = (float) 0;

    if (!isset($_SESSION['numeros'])) {
        $_SESSION['numeros'] = [];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();



        if (isset($_POST['numero'])) {
            $numero = $_POST['numero'];
            if ($numero == 'clear') {
                $_SESSION['numeros'] = [];
            } else if ($numero == 'resultado') {
                $resultado = calcular();
            } else if($numero == 'delate'){
                array_pop($_SESSION['numeros']);
            } else {
                array_push($_SESSION['numeros'], $numero);
            }
        }
    }

    ?>
    <form method="POST">
        <div class="container">
            <div class="calc-body">
                <div class="calc-screen">
                    <div class="calc-operation"><?php echo implode($_SESSION['numeros'])?> </div>
                    <div class="calc-typed"><?php print_r(round($resultado , 3 , PHP_ROUND_HALF_UP)); ?><span class="blink-me">_</span></div>
                </div>
                <div class="calc-button-row">
                    <div class="none"></div>
                    <button type="submit" name="numero" value="clear">
                        <div class="button c">C</div>
                    </button>
                    <button type="submit" name="numero" value="delate">
                        <div class="button c" style="color:orange;">D</div>
                    </button>
                    <button type="submit" name="numero" value="÷">
                        <div class="button l">÷</div>
                    </button>
                </div>
                <div class="calc-button-row">
                    <button type="submit" name="numero" value="7">
                        <div class="button">7</div>
                    </button>
                    <button type="submit" name="numero" value="8">
                        <div class="button">8</div>
                    </button>
                    <button type="submit" name="numero" value="9">
                        <div class="button">9</div>
                    </button>
                    <button type="submit" name="numero" value="×">
                        <div class="button l">×</div>
                    </button>
                </div>
                <div class="calc-button-row">
                    <button type="submit" name="numero" value="4">
                        <div class="button">4</div>
                    </button>
                    <button type="submit" name="numero" value="5">
                        <div class="button">5</div>
                    </button>
                    <button type="submit" name="numero" value="6">
                        <div class="button">6</div>
                    </button>
                    <button type="submit" name="numero" value="-">
                        <div class="button l">-</div>
                    </button>
                </div>
                <div class="calc-button-row">
                    <button type="submit" name="numero" value="1">
                        <div class="button">1</div>
                    </button>

                    <button type="submit" name="numero" value="2">
                        <div class="button">2</div>
                    </button>
                    <button type="submit" name="numero" value="3">
                        <div class="button">3</div>
                    </button>
                    <button type="submit" name="numero" value="+">
                        <div class="button l">+</div>
                    </button>
                </div>
                <div class="calc-button-row">
                    <button type="submit" name="numero" value=".">
                        <div class="button">.</div>
                    </button>
                    <button type="submit" name="numero" value="0">
                        <div class="button">0</div>
                    </button>

                    <div class="none"></div>

                    <button type="submit" name="numero" value="resultado">
                        <div class="button l">=</div>
                    </button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>