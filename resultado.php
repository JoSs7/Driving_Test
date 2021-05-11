<html>
    <head><title>Resultado</title></head>
    <body>
        <h3>Resultado del examen</h3>
<?php
    session_start();
    include "funciones.php";
    $usuario = $_SESSION['nombre'];    //Nombre de usuario pasado por sesión
    date_default_timezone_set('Europe/Madrid');
    $fecha = date('Y-m-d'); //Obtenemos la fecha actual
    $hora = date("H:i:s"); //Obtenemos la hora actual

    echo "Alumno: ".$usuario."<br>";
    echo "Fecha de realización del examen: ".$fecha."<br>Hora de realización del examen: ".$hora;

    //Recuperamos los parámetros de la sesion (Strings) y los pasamos a arrays
    $uno = explode("-", $_SESSION['uno']);
    $dos = explode("-", $_SESSION['dos']);
    $tres = explode("-", $_SESSION['tres']);
    $cuatro = explode("-", $_SESSION['cuatro']);
    $cinco = explode("-", $_SESSION['cinco']);
    $seis = explode("-", $_SESSION['seis']);
    $siete = explode("-", $_SESSION['siete']);
    $ocho = explode("-", $_SESSION['ocho']);
    $nueve = explode("-", $_SESSION['nueve']);
    $diez = explode("-", $_SESSION['diez']);

    //Creamos un array en el que en cada posición habrá un array de respuestas
    $respuestas = array($uno, $dos, $tres, $cuatro, $cinco, $seis, $siete, $ocho, $nueve, $diez);    //Array de arrays

    $nota = 10;
    $i = 1;
    foreach ($respuestas as $respuesta){    //Recorremos el array de arrays
        $nota = $nota - (1.25 * corregirPregunta($respuesta, "0".$i));  //Corregimos cada pregunta pasándo cada array de respuestas y el id
        $i++;
    }
    if ($nota < 0){    //Puede dar menor que 0 si fallas mucho
        $nota = 0;
    }
    if ($nota >= 5){    //Si has aprobado
        echo "<h3>Nota:</h3>";
        echo "<h1 style=color:"."green;"."margin-left:"."".">".$nota."</h1>";
        echo "<h3>¡Enhorabuena, has aprobado! :)</h3>";
    } else {    //Si has suspendido
        echo "<h3>Nota:</h3>";
        echo "<h1 style=color:"."red;"."margin-left:"."".">".$nota."</h1>";
        echo "<h3>¡Qué pena, has suspendido! :(</h3>";
    }

    //Imprimimos el resumen de las respuestas
    $i = 1;
    echo "<h4>Resumen de tus respuestas:</h4>";
    foreach ($respuestas as $respuesta){    //Recorremos el array $respuestas; si hemos acertado, imprime pregunta en verde, si no, en rojo
        if (corregirPregunta($respuesta, "0".$i) == 0){ echo "<h4 style=color:"."green;"."margin-left:"."".">".pregunta("0".$i)."</h4>"; }
        else {echo "<h4 style=color:"."red;"."margin-left:"."".">".pregunta("0".$i)."</h4>";}
        echo implode("<br>", $respuesta);
        $i++;
    }

    //Añadimos el idUsuario, la nota y la fecha a la base de datos
    if (aniadirNota(usuario($usuario), $nota, $fecha, $hora) == true){
        echo"<h5>Usuario, nota y fecha añadidos a base de datos</h5>";
    } else {
        echo"<h5>Usuario, nota y fecha no han sido añadidos a base de datos</h5>";
    }
?>
        <a href="index.php">Volver a Login</a>
    </body>
</html>
