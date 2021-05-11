<?php

    function comprobarUsuario($user,$pass){    //Comprobamos usuario y clave de la base de datos
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $c=false;
        $sql=$conn->prepare("SELECT pass FROM usuarios WHERE nombre = ?");
        $sql->bind_param("s", $user);
        $sql->execute();
        $row=$sql->bind_result($row);
        $sql->fetch();
        if(password_verify($pass,$row)){
            $c = true;
        }
        $sql->close();
        $conn->close();
        return $c;
    }

    function usuario($nombre){    //Seleccionar idUsuario de la tabla usuarios pasando el nombre
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $id = "";
        $sql=$conn->prepare("SELECT idUsuario FROM usuarios WHERE nombre = ?");
        $sql->bind_param("s", $nombre);
        $sql->execute();
        $row=$sql->bind_result($row);
        $sql->fetch();
        $id = $row;
        $sql->close();
        $conn->close();
        return $id;
    }

    function pregunta($id){    //Seleccionar pregunta pasándole el id
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $pregunta="";
        $sql=$conn->prepare("SELECT pregunta FROM examen WHERE idPregunta = ?");
        $sql->bind_param("s", $id);
        $sql->execute();
        $row=$sql->bind_result($row);
        $sql->fetch();
        $pregunta = $row;
        $sql->close();
        $conn->close();
        return $pregunta;
    }

    function preguntaRepintada($id, $numero){    //Seleccionar pregunta repintada pasándole el id
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $pregunta="";
        $sql=$conn->prepare("SELECT pregunta FROM examen WHERE idPregunta = ?");
        $sql->bind_param("s", $id);
        $sql->execute();
        $row=$sql->bind_result($row);
        $sql->fetch();
        $pregunta = $row;
        $sql->close();
        $conn->close();
        return "<p style=color:"."red;"."margin-left:"."".">".$numero.$pregunta."</p>";
    }

    function imprimirPreguntas(){    //Imprimimos las preguntas y respuestas de la base de datos
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $sql = "SELECT pregunta FROM examen";
        $datos = mysqli_query($conn, $sql);
        $numeroResultados = mysqli_num_rows($datos);
        if ($numeroResultados > 0){
            $i = 1;
            while ($resultado = mysqli_fetch_assoc($datos)){
                echo "<h4>".$i." ".$resultado['pregunta']."</h4>";
                imprimirRespuestas($resultado['pregunta'], $i);    //LLamamos a imprimirPreguntas()
                $i++;
            }
        }
    }

    function imprimirRespuestas($pregunta, $name){    //Lo usamos dentro de imprimirPreguntas() para imprimir las respuestas de cada pregunta
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $sql = "SELECT opcion1, opcion2, opcion3, opcion4 FROM examen WHERE pregunta = '$pregunta'";
        $datos = mysqli_query($conn, $sql);
        $numeroResultados = mysqli_num_rows($datos);
        $i = 1;
        if ($numeroResultados > 0){
            while ($resultado = mysqli_fetch_assoc($datos)){
                echo "<input type='checkbox' name='p".$name."[]' value='".$resultado['opcion1']."'>".$resultado['opcion1']."<br>
                <input type='checkbox' name='p".$name."[]' value='".$resultado['opcion2']."'>".$resultado['opcion2']."<br>
                <input type='checkbox' name='p".$name."[]' value='".$resultado['opcion3']."'>".$resultado['opcion3']."<br>
                <input type='checkbox' name='p".$name."[]' value='".$resultado['opcion4']."'>".$resultado['opcion4']."<br>";
                $i++;
            }
        }
    }

    function imprimirRespuestasCheckeadas($pregunta, $name, $post){    //Imprimir respuestas checkeadas pasándo el idPregunta, nombre y valor del $_POST
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $sql = "SELECT opcion1, opcion2, opcion3, opcion4 FROM examen WHERE idPregunta = '$pregunta'";
        $datos = mysqli_query($conn, $sql);
        $numeroResultados = mysqli_num_rows($datos);
        if ($numeroResultados > 0){
            while ($resultado = mysqli_fetch_assoc($datos)){ 
                foreach ($resultado as $res){
                        if (in_array($res, $post)){                          
                            echo "<input type='checkbox' name='p".$name."[]' value='".$res."' checked>".$res."<br>";
                        } else {
                            echo "<input type='checkbox' name='p".$name."[]' value='".$res."'>".$res."<br>";
                        }
                    }
                }
            }
            echo "<br>";
        }

    function corregirPregunta($array, $id){    //Corregir pregunta (Enviamos 0 o 1 dependiendo si están bien o mal las respuestas)
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $sql = "SELECT respuesta1, respuesta2, respuesta3, respuesta4 FROM examen WHERE idPregunta = '$id'";
        $datos = mysqli_query($conn, $sql);
        $numeroResultados = mysqli_num_rows($datos);
        $valor = 1;
        if ($numeroResultados > 0){
            while ($resultado = mysqli_fetch_assoc($datos)){
                $nuevoArray = array_filter($resultado);
                if (implode("",$array) == implode("",$nuevoArray)){    //Paso los arrays a string y los comparo
                    $valor = 0;    //Si son iguales es que están bien todas las respuestas y devuelvo 0
                } else {
                    $valor = 1;    // //Si son distintos es que alguna respuesta está mal y devuelvo 1
                }
            }              
        }
        return $valor;
    }  

    function aniadirNota($usuario, $nota, $fecha, $hora){    //Añadir id, nota, fecha y hora a la tabla notas
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $c=false;
        $sql = "INSERT INTO notas VALUES ('$usuario', '$nota', '$fecha', '$hora')";
        if ($conn->query($sql)===true){
            $c = true;
        }
        $conn->close();
        return $c;
    }

    function hayNota($id){    //Seleccionar nota, fecha y hora de la tabla notas pasando el idUsuario
        $conn = mysqli_connect("localhost", "user", "user", "examen");
        if($conn->connect_error){$conn->close();$conn=null;echo "error";}
        $cadena = "";
        $sql = "SELECT nota, fecha, hora FROM notas WHERE idUsuario = '$id'";
        $datos = mysqli_query($conn, $sql);
        $numeroResultados = mysqli_num_rows($datos);
        if ($numeroResultados > 0){
            while ($resultado = mysqli_fetch_assoc($datos)){
                $cadena = "Nota obtenida: ".$resultado['nota']."<br><br>Fecha de realicación del examen: ".$resultado['fecha']."<br>Hora de realización del examen: ".$resultado['hora'];
            }
        }
        return $cadena;
    }
?>