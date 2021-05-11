<?php
    session_start();
    include "funciones.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    //Si se ha enviado $_POST
        if (isset($_POST['nombre']) && ($_POST['nombre']) != "" && isset($_POST['pass']) && ($_POST['pass']) != ""){    //Si se ha establecido usuario y pass
            if (comprobarUsuario($_POST['nombre'], $_POST['pass']) == true){    //Comprobamos usuario y pass
                if (hayNota(usuario($_POST['nombre'])) != ""){    //Comprobamos en la base de datos si ese usuario ya ha hecho el examen
                    $_SESSION['nombre'] = $_POST['nombre'];
                    header("Location: nota.php");    //Recuperamos el examen
                } else {
                    $_SESSION['nombre'] = $_POST['nombre'];
                    header("Location: examen.php");    //Vamos a hacer el examen
                }        
            } else{
                echo "<p style=color:"."red;"."margin-left:"."".">Usuario o contraseña incorrectos</p>";
            }
        } else {
            echo "<p style=color:"."red;"."margin-left:"."".">Debes poner un nombre de usuario y contraseña</p>";
        }
    }
?>

<html>
    <head>
    </head>
    <body>
        <h3>Examen de conducir</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            Nombre: <input type="text" name="nombre"><br><br>
            Contraseña: <input type="pass" name="pass"><br><br>
            <input type="submit" action="examen.php" value="Empezar examen">
        </form>
    </body>
</html>