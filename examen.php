<?php
    session_start();
    include "funciones.php";
?>
<html>
    <head><title>Examen</title></head>
    <body>
        <h2>Examen de conducir</h2>
        <h4>Usuario examinándose: <?php echo $_SESSION['nombre']?></h4>
        <p>Nota: Cada pregunta tiene mínimo una respuesta correcta y máximo cuatro respuestas correctas</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {    //Si ya se ha enviado $_POST (Si no es la primera entrada)
                    $cadena ="";
                    //Si no se ha establecido ninguna respuesta
                    if (!isset($_POST['p1']) || !isset($_POST['p2']) || !isset($_POST['p3']) || !isset($_POST['p4']) || !isset($_POST['p5'])
                    || !isset($_POST['p6']) ||!isset($_POST['p7']) ||!isset($_POST['p8']) ||!isset($_POST['p9']) ||!isset($_POST['p10'])){
                        $cadena = "<p style=color:"."red;"."margin-left:"."".">Debes contestar a todas las preguntas</p>";
                        echo $cadena;
                    } else {    //Si se establecen todas las respuestas, pasamos cada valor $_POST(arrays) a String y lo mandamos por sesión (No podía pasar un array por sesión)
                        $uno = implode("-", $_POST['p1']);
                        $_SESSION['uno'] = $uno;
                
                        $dos = implode("-", $_POST['p2']);
                        $_SESSION['dos'] = $dos;

                        $tres = implode("-", $_POST['p3']);
                        $_SESSION['tres'] = $tres;

                        $cuatro = implode("-", $_POST['p4']);
                        $_SESSION['cuatro'] = $cuatro;

                        $cinco = implode("-", $_POST['p5']);
                        $_SESSION['cinco'] = $cinco;

                        $seis = implode("-", $_POST['p6']);
                        $_SESSION['seis'] = $seis;

                        $siete = implode("-", $_POST['p7']);
                        $_SESSION['siete'] = $siete;

                        $siete = implode("-", $_POST['p7']);
                        $_SESSION['siete'] = $siete;

                        $ocho = implode("-", $_POST['p8']);
                        $_SESSION['ocho'] = $ocho;

                        $nueve = implode("-", $_POST['p9']);
                        $_SESSION['nueve'] = $nueve;

                        $diez = implode("-", $_POST['p10']);
                        $_SESSION['diez'] = $diez;

                        //Nos vamos a resultado.php donde se corrige el examen
                        header("Location: resultado.php"); 
            }
            //Si la cadena no está vacía, es que hay un error y repintamos
            if ($cadena != ""){
                        //Por cada pregunta, se repinta si no está checkeada o se imprime checkeada
                        if (!isset($_POST['p1'])){
                            echo preguntaRepintada("01", "1.");    //Pregunta repintada en rojo
                            imprimirRespuestas(pregunta("01"), 1); //Respuestas vacías
                        } else {
                            echo "<h4>1.".pregunta("01")."</h4>";  //Pregunta sin repintar
                            imprimirRespuestasCheckeadas("01", 1, $_POST['p1']);  //Respuestas checkeadas
                        }
                        if (!isset($_POST['p2'])){
                            echo preguntaRepintada("02","2.");
                            imprimirRespuestas(pregunta("02"), 2);
                        } else {
                            echo "<h4>2.".pregunta("02")."</h4>";
                            imprimirRespuestasCheckeadas("02", 2, $_POST['p2']);
                        }
                        if (!isset($_POST['p3'])){
                            echo preguntaRepintada("03","3.");
                            imprimirRespuestas(pregunta("03"), 3);
                        } else {
                            echo "<h4>3.".pregunta("03")."</h4>";
                            imprimirRespuestasCheckeadas("03", 3, $_POST['p3']);
                        }
                        if (!isset($_POST['p4'])){
                            echo preguntaRepintada("04","4.");
                            imprimirRespuestas(pregunta("04"), 4);
                        } else {
                            echo "<h4>4.".pregunta("04")."</h4>";
                            imprimirRespuestasCheckeadas("04", 4, $_POST['p4']);
                        }
                        if (!isset($_POST['p5'])){
                            echo preguntaRepintada("05","5.");
                            imprimirRespuestas(pregunta("05"), 5);
                        } else {
                            echo "<h4>5.".pregunta("05","5.")."</h4>";
                            imprimirRespuestasCheckeadas("05", 5, $_POST['p5']);
                        }
                        if (!isset($_POST['p6'])){
                            echo preguntaRepintada("06","6.");
                            imprimirRespuestas(pregunta("06"), 6);
                        } else {
                            echo "<h4>6.".pregunta("06","6.")."</h4>";
                            imprimirRespuestasCheckeadas("06", 6, $_POST['p6']);
                        }
                        if (!isset($_POST['p7'])){
                            echo preguntaRepintada("07","7.");
                            imprimirRespuestas(pregunta("07"), 7);
                        } else {
                            echo "<h4>7.".pregunta("07","7.")."</h4>";
                            imprimirRespuestasCheckeadas("07", 7, $_POST['p7']);
                        }
                        if (!isset($_POST['p8'])){
                            echo preguntaRepintada("08","8.");
                            imprimirRespuestas(pregunta("08"), 8);
                        } else {
                            echo "<h4>8.".pregunta("08","8.")."</h4>";
                            imprimirRespuestasCheckeadas("08", 8, $_POST['p8']);
                        }
                        if (!isset($_POST['p9'])){
                            echo preguntaRepintada("09","9.");
                            imprimirRespuestas(pregunta("09"), 9);
                        } else {
                            echo "<h4>9.".pregunta("09","9.")."</h4>";
                            imprimirRespuestasCheckeadas("09", 9, $_POST['p9']);
                        }
                        if (!isset($_POST['p10'])){
                            echo preguntaRepintada("010","10.");
                            imprimirRespuestas(pregunta("010"), 10);
                        } else {
                            echo "<h4>20.".pregunta("010","10.")."</h4>";
                            imprimirRespuestasCheckeadas("010", 10, $_POST['p10']);
                        }
                    }
                } else {
                    //Si es la primera entrada (Si no se ha enviado el parámetro $_POST)
                    imprimirPreguntas();
                }
            ?>
            <br><input type="submit" value="Corregir examen">
        </form>
    </body>
</html>
