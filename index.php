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


    function res($valor){
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
            
            
        }else if(isset($_POST['operacion'])){
            $valor = $_POST['operacion'];
            if (!isset($_SESSION['valores'])) {
                $_SESSION['valores'] = (array) [];  
            }
            match($valor){
                "resultado" => res($valor),
            };
            $_SESSION['valores'][] = $valor;
        }


        
    }

    // Imprimir los valores del array
    if (isset($_SESSION['valores'])) {
        $valores = $_SESSION['valores'];
        echo implode(", ", $valores);
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
        <button type="submit" name="operacion" value="resultado">=</button>
        <button type="submit" name="operacion" value="+">+</button>
        <button type="submit" name="operacion" value="-">-</button>
        <button type="submit" name="operacion" value="*">*</button>
        <button type="submit" name="operacion" value="/">/</button>
    </form>
    <?php


    ?>
</body>

</html>