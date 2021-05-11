<?php
    session_start();
    include "funciones.php";

    echo "<br><h3>El usuario ".$_SESSION['nombre']." ya ha realizado el examen</h3>";
    echo "<h3>".hayNota(usuario($_SESSION['nombre']))."</h3>";
?>
<html>
    <head></head>
    <body>
        <br><a href="index.php">Volver a Login</a>
    </body>
</html>