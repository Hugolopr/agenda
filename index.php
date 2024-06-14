<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #909090;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"]{
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            color: #000000;
        }
        input[type="submit"] {
            background-color: #FFFF00;
            color: #000000 ;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2 align="Center ">Agenda de Hugo</h2>
        <form action="#" method="post">
            <input type="text" name="NOMBRE" placeholder="Nombre">
            <input type="text" name="APELLIDOS" placeholder="Apellidos">
            <input type="text" name="DOMICILIO" placeholder="Domicilio">
            <input type="int" name="TECASA" placeholder="TECASA">
            <input type="int" name="CEL" placeholder="CEL">
            <input type="date" name="NACIMIENTO" placeholder="Fecha de Nacimiento">
            <input type="email" name="CORREO" placeholder="Correo Electrónico">
            <input type="submit" name="registro" value="Guardar">
        </form>

        <form action="#" method="post">
            <input type="text" name="busqueda" placeholder="Buscar por nombre">
            <input type="submit" name="buscar" value="Buscar">
        </form>

        <form action="#" method="post">
            <input type="submit" name="MOSTRAR" value="Mostrar Todos los Registros">
        </form>

        <?php
        $servidor = "localhost";
        $usuario = "root";
        $clave = "";
        $baseDeDatos = "AGENDA";
        $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

        if (!$enlace) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        if (isset($_POST['registro'])) {
            $NOMBRE = $_POST['NOMBRE'];
            $APELLIDOS = $_POST['APELLIDOS'];
            $DOMICILIO = $_POST['DOMICILIO'];
            $TECASA = $_POST['TECASA'];
            $CEL = $_POST['CEL'];
            $NACIMIENTO = $_POST['NACIMIENTO'];
            $CORREO = $_POST['CORREO'];

            $insertarDatos = "INSERT INTO AGENDA (NOMBRE, APELLIDOS, DOMICILIO, TECASA, CEL, NACIMIENTO, CORREO) VALUES ('$NOMBRE', '$APELLIDOS', '$DOMICILIO', '$TECASA', '$CEL', '$NACIMIENTO', '$CORREO')";

            if (mysqli_query($enlace, $insertarDatos)) {
                echo "Nuevo registro creado exitosamente";
            } else {
                echo "Error: " . $insertarDatos . "<br>" . mysqli_error($enlace);
            }
        }

        if (isset($_POST['buscar'])) {
            $busqueda = $_POST['busqueda'];
            $query = "SELECT * FROM AGENDA WHERE NOMBRE LIKE '%$busqueda%'";
            $result = mysqli_query($enlace, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Nombre: " . $row['NOMBRE'] . "<br>";
                    echo "Apellidos: " . $row['APELLIDOS'] . "<br>";
                    echo "Domicilio: " . $row["DOMICILIO"] . "<br>";
                    echo "Tel. ". $row["TECASA"] . "<br>";
                    echo "Cel. ". $row["CEL"] . "<br>";
                    echo "Nacimiento: ". $row["NACIMIENTO"] . "<br>";
                    echo "Correo: ". $row["CORREO"] . "<br><br>";
                }
            } else {
                echo "NO SE ENCONTRARON REGISTROS CON ESE NOMBRE";
            }
        }

        if (isset($_POST['MOSTRAR'])) {
            $query = "SELECT * FROM AGENDA";
            $result = mysqli_query($enlace, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Nombre: " . $row['NOMBRE'] . "<br>";
                    echo "Apellidos: " . $row['APELLIDOS'] . "<br>";
                    echo "Domicilio: " . $row["DOMICILIO"] . "<br>";
                    echo "Tel. ". $row["TECASA"] . "<br>";
                    echo "Cel. ". $row["CEL"] . "<br>";
                    echo "Nacimiento: ". $row["NACIMIENTO"] . "<br>";
                    echo "Correo: ". $row["CORREO"] . "<br><br>";
                }
            } else {
                echo "No hay registros en la agenda.";
            }
        }

        mysqli_close($enlace);
        ?>
    </div>
</body>
</html>
