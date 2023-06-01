<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php

    session_start();


    function res($valor)
    {
        session_reset();
        $_SESSION = null;
        return $valor = null;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['numero'])) {

            $valor = $_POST['numero'];
            if (!isset($_SESSION['valores'])) {
                $_SESSION['valores'] = (array) [];
            }
            $_SESSION['valores'][] = $valor;
        } else if (isset($_POST['operacion'])) {
            $valor = $_POST['operacion'];
            if (!isset($_SESSION['valores'])) {
                $_SESSION['valores'] = (array) [];
            }
            $valor = match ($valor) {
                "resultado" => res($valor),
            };
            $_SESSION['valores'][] = $valor;
        }
    }

    // Imprimir los valores del array
    if (isset($_SESSION['valores'])) {
        $valores = $_SESSION['valores'];
        /* echo implode($valores); */
        $datos = [];
        $numero = '';

        foreach ($_SESSION['valores'] as $data) {
            if (is_numeric($data)) {
                $numero .= $data;
            } else {
                if (!empty($numero)) {
                    $datos[] = (int) $numero;
                    $numero = '';
                }
            }
        }

        if (!empty($numero)) {
            $datos[] = (int) $numero;
        }

        $string = implode($_SESSION['valores']);


        $string = str_replace(' ', '', $string);
        $string = strrev($string);


        $operadores = ['*', '/', '+', '-'];


        $resultado = (float)$string;
        $i = 1;

        echo strrev($string)." =\n";

        while ($i < strlen($string)) {
            $operador = $string[$i];
            $numero = '';

            while ($i < strlen($string) && !in_array($string[$i + 1], $operadores)) {
                $numero .= $string[$i + 1];
                $i++;
            }
            switch ($operador) {
                case '*':
                    $resultado *= (float)$numero;
                    break;
                case '/':
                    if ((float)$numero != 0) {
                        $resultado /= (float)$numero;
                    } else {
                        $resultado = NAN;
                    }
                    break;
                case '+':
                    $resultado += (float)$numero;
                    break;
                case '-':
                    $resultado -= (float)$numero;
                    break;
            }

            $i++;
        }

        
    }


    ?>

    <form method="POST">
        <button type="submit" name="numero" value="1">1</button>
        <button type="submit" name="numero" value="2">2</button>
        <button type="submit" name="numero" value="3">3</button><br>
        <button type="submit" name="numero" value="4">4</button>
        <button type="submit" name="numero" value="5">5</button>
        <button type="submit" name="numero" value="6">6</button><br>
        <button type="submit" name="numero" value="7">7</button>
        <button type="submit" name="numero" value="8">8</button>
        <button type="submit" name="numero" value="9">9</button><br>
        <button type="submit" name="operacion" value="resultado">x</button>
        <button type="submit" name="numero" value="+">+</button>
        <button type="submit" name="numero" value="-">-</button>
        <button type="submit" name="numero" value="*">*</button>
        <button type="submit" name="numero" value="/">/</button>
    </form>
    <?php
        echo $resultado;

    ?>
</body>

</html>

<!-- Posible solucion -->


<!-- <?php
    
    $cad = '22-15+2+2/2*5';
    $op = ['+','-','*','/'];
    
    
    
    $pattern = '/[' . preg_quote('+-*/', '/') . ']/';
    $splt=  preg_split($pattern, $cad, -1, PREG_SPLIT_NO_EMPTY);
    $op = preg_split('/[0-9]+/', $cad, -1, PREG_SPLIT_NO_EMPTY);
    $result = preg_split($pattern, $cad);
    
    $res_op = (float) $result[0];
    
    for($i = 0; $i<count($op); $i++ ){

        $res_op = match($op[$i]){
            '+' => $res_op += $result[$i + 1],
            '-' => $res_op -= $result[$i + 1],
            '*' => $res_op *= $result[$i + 1],
            '/' => $res_op /= $result[$i + 1],
            default => null,
        };
    };
    
    print_r($res_op);
 
   
    
?> -->





