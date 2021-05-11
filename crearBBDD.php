    <!--Creación de la base de datos, usuario, tablas, privilegios e inserción de datos-->
    <?php
        if($conn = mysqli_connect("localhost", "root", "")){    //Nos conectamos
            echo "<p>Conectado</p>";
        };

        if($conn->connect_error){$conn->close();$conn=null;echo("Error de conexion");}


        //Creamos la base de datos
        if($conn->query("CREATE DATABASE IF NOT EXISTS Examen")){    
            echo"<p>DataBase Examen creada</p><br>";
        }else{
            echo"<p>DataBase Examen no creada</p><br>";
        }


        //Creamos usuario
        if ($conn->query("CREATE USER IF NOT EXISTS 'user'@'localhost' IDENTIFIED BY 'user'")){    
            echo"<p>Usuario user creado</p><br>";
        }else{
            echo"<p>Usuario user no creado</p><br>";
        }


        //Creamos la tabla usuarios
        if($conn->query("CREATE TABLE Examen.usuarios(  
            idUsuario VARCHAR (60) PRIMARY KEY NOT NULL,
            nombre VARCHAR (60),
            pass VARCHAR (60))")){
                echo"<p>Tabla usuarios creada</p><br>";
        }else{
                echo"<p>Tabla usuarios no creada</p><br>";
        }


        //Creamos la tabla examen
        if($conn->query("CREATE TABLE Examen.examen(  
            idPregunta VARCHAR (60) NOT NULL,
            pregunta VARCHAR (99),
            opcion1 VARCHAR (99),
            opcion2 VARCHAR (99),
            opcion3 VARCHAR (99),
            opcion4 VARCHAR (99),
            respuesta1 VARCHAR (99),
            respuesta2 VARCHAR (99),
            respuesta3 VARCHAR (99),
            respuesta4 VARCHAR (99))")){
            echo"<p>Tabla examen creada</p><br>";
        }else{
            echo"<p>Tabla examen no creada</p><br>";
        }

        //Creamos la tabla notas
        if($conn->query("CREATE TABLE Examen.notas(  
            idUsuario VARCHAR (60) NOT NULL UNIQUE,
            nota VARCHAR (60),
            fecha DATE,
            hora TIME)")){
                echo"<p>Tabla notas creada</p><br>";
        }else{
                echo"<p>Tabla notas no creada</p><br>";
        }

        //Asignamos la foreign key (foreign key idUsuario de la tabla notas asignado a primary key idUuario de la tabla usuarios)
        if ($conn->query("ALTER TABLE Examen.notas
        ADD FOREIGN KEY (idUsuario) REFERENCES Examen.usuarios(idUsuario)")){
                echo "<p>foreign key id de la tabla notas asignado a primary key id de la tabla usuarios</p>";
        }else{
            echo "No se ha asignado la foreign key";
        }


        //Otorgamos privilegios al usuario user en tabla usuarios
        if($conn->query("GRANT SELECT,INSERT ON Examen.usuarios TO 'user'@'localhost'")){
            echo "<p>"."Privilegios otorgados a usuario user sobre la tabla usuarios"."</p>";
        }else{
            echo "<p>"."Privilegios no otorgados a usuario user sobre la tabla usuarios"."</p>";
        }


        //Otorgamos privilegios al usuario user en tabla examen
        if($conn->query("GRANT SELECT,INSERT ON Examen.examen TO 'user'@'localhost'")){
            echo "<p>"."Privilegios otorgados a usuario user sobre la tabla examen"."</p>";
        }else{
            echo "<p>"."Privilegios no otorgados a usuario user sobre la tabla examen"."</p>";
        }

        //Otorgamos privilegios al usuario user en tabla notas
        if($conn->query("GRANT SELECT,INSERT ON Examen.notas TO 'user'@'localhost'")){
            echo "<p>"."Privilegios otorgados a usuario user sobre la tabla notas"."</p>";
        }else{
            echo "<p>"."Privilegios no otorgados a usuario user sobre la tabla notas"."</p>";
        }


        //Preguntas con sus opciones y respuestas

        //Pregunta 1
        $p1="¿Qué se debe hacer antes de arrancar el coche?";

        $o11="Colocarte bien posicionado.";
        $o12="Ajustarse todos los espejos.";
        $o13="Abrocharte el cinturón.";
        $o14="No hace falta hacer nada si no quieres.";

        $r11="Colocarte bien posicionado.";
        $r12="Ajustarse todos los espejos.";
        $r13="Abrocharte el cinturón.";

        //Pregunta 2
        $p2="¿En una intersección, qué se debe hacer?";

        $o21="Mirar bien a los dos lados.";
        $o22="Mirar solo hacia la izquierda.";
        $o23="Mirar solo hacia la derecha.";
        $o24="No hace falta mirar hacia ningún lado.";

        $r21="Mirar bien a los dos lados.";

        //Pregunta 3
        $p3="¿En caso de accidente, qué se debe hacer?";

        $o31="No se debe hacer nada.";
        $o32="Llamar al servicio de urgencias o a la policía en cuanto se pueda.";
        $o33="Analizar los daños para decidir cómo actuar de manera correcta.";
        $o34="Ninguna de las respuestas ateriores es correcta.";

        $r31="Llamar al servicio de urgencias o a la policía en cuanto se pueda.";
        $r32="Analizar los daños para decidir cómo actuar de manera correcta.";

        //Pregunta 4
        $p4="¿Cuándo se deben encender las luces cortas?";

        $o41="Nunca";
        $o42="Cuando ya se ha ido el sol.";
        $o43="Cuando se está poniendo el sol.";
        $o44="Siempre deben de estar encendidas.";

        $r41="Cuando se está poniendo el sol.";

        //Pregunta 5
        $p5="¿Cuando hay niebla, qué luces debemos tener encendidas?";

        $o51="Ninguna.";
        $o52="Las cortas.";
        $o53="Las largas.";
        $o54="Las de posición solamente.";

        $r51="Las cortas.";

        //Pregunta 6
        $p6="¿Cuando vamos a entrar en una rotonda, qué debemos hacer?";

        $o61="Ceder el paso en caso de que venga otro vehículo.";
        $o62="No ceder el paso nunca.";
        $o63="Ceder el paso solo en caso de que venga una moto.";
        $o64="En caso de que no venga ningún vehículo, no hace falta parar.";

        $r61="Ceder el paso en caso de que venga otro vehículo.";
        $r62="En caso de que no venga ningún vehículo, no hace falta parar.";


        //Pregunta 7
        $p7="¿Puedes pisar una línea contínua?";

        $o71="No, en ningun caso.";
        $o72="Si, en cualquier caso.";
        $o73="Solo en caso de emergencia.";
        $o74="Solo en caso de que tenga sueño.";

        $r71="Solo en caso de emergencia.";


        //Pregunta 8
        $p8="¿Qué debemos hacer cuando nos encontramos una señal de Stop?";

        $o81="Parar siempre.";
        $o82="No hace falta parar.";
        $o83="Si no viene ningún vehículo, no hace falta parar.";
        $o84="No hay que parar en ningún caso.";

        $r81="Parar siempre.";

        //Pregunta 9
        $p9="¿En caso de avería, qué se debe hacer?";

        $o91="Poner los cuatro intermitentes al parar.";
        $o92="Parar el vehículo en el arcén.";
        $o93="Ponernos el chaleco reflectante antes de salir del vehículo.";
        $o94="Poner los triángulos cuanto antes.";
        

        $r91="Poner los cuatro intermitentes al parar.";
        $r92="Parar el vehículo en el arcén.";
        $r93="Ponernos el chaleco reflectante antes de salir del vehículo.";
        $r94="Poner los triángulos cuanto antes.";

        //Pregunta 10
        $p10="¿Qué debemos hacer cuando vamos a incorporarnos a otro carril?";

        $o101="Poner el intermitente en dirección al carril al que vamos a incorporarnos.";
        $o102="Poner el intermitente en dirección contraria al carril al que vamos a incorporarnos.";
        $o103="No debemos hacer nada.";
        $o104="Debemos poner los cuatro intermitentes.";
        

        $r101="Poner el intermitente en dirección al carril al que vamos a incorporarnos.";


        //Contraseñas:
        $hash=password_hash("jose1",PASSWORD_DEFAULT);    //Encriptamos cada contraseña
        $hash1=password_hash("ana1",PASSWORD_DEFAULT);
        $hash2=password_hash("carlos1",PASSWORD_DEFAULT);
        $hash3=password_hash("maria1",PASSWORD_DEFAULT);

        //Inserción de usuarios
        if ($conn->query("INSERT INTO Examen.usuarios VALUES ('001', 'jose', '$hash')")
            && $conn->query("INSERT INTO Examen.usuarios VALUES ('002', 'ana', '$hash1')")
            && $conn->query("INSERT INTO Examen.usuarios VALUES ('003', 'carlos', '$hash2')")
            && $conn->query("INSERT INTO Examen.usuarios VALUES ('004', 'maria', '$hash3')")){
                echo "<p>"."Usuarios creados e insertados en la tabla usuarios"."</p>";
        }else{
            echo "Usuarios no creadas";
        }


        //Inserción de preguntas y respuestas en la tabla examen
        if ($conn->query("INSERT INTO Examen.examen VALUES ('01', '$p1', '$o11', '$o12', '$o13', '$o14', '$r11', '$r12', '$r13', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('02', '$p2', '$o21', '$o22', '$o23', '$o24', '$r21', '', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('03', '$p3', '$o31', '$o32', '$o33', '$o34', '$r31', '$r32', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('04', '$p4', '$o41', '$o42', '$o43', '$o44', '$r41', '', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('05', '$p5', '$o51', '$o52', '$o53', '$o54', '$r51', '', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('06', '$p6', '$o61', '$o62', '$o63', '$o64', '$r61', '$r62', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('07', '$p7', '$o71', '$o72', '$o73', '$o74', '$r71', '', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('08', '$p8', '$o81', '$o82', '$o83', '$o84', '$r81', '', '', '')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('09', '$p9', '$o91', '$o92', '$o93', '$o94', '$r91', '$r92', '$r93', '$r94')")
            && $conn->query("INSERT INTO Examen.examen VALUES ('010', '$p10', '$o101', '$o102', '$o103', '$o104', '$r101', '', '', '')")){
                echo "Preguntas y respuestas creadas e insertadas en la tabla examen";
        }else{
            echo "Preguntas y respuestas no creadas";
        }
        
        $conn->close();
    ?>