<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $registro = $_POST['registro'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");

    switch ($accion) {
        case 'agregar':
            $consulta = "INSERT INTO Autor (Nombre, Apellido) VALUES ('$nombre', '$apellido')";
            break;
        case 'modificar':
            $consulta = "UPDATE Autor SET Nombre = '$nombre', Apellido = '$apellido' WHERE Registro = '$registro'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Autor WHERE Registro = '$registro'";
            break;
        default:
            die("Acción desconocida");
            break;
    }
    
    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    header("Location: Formulario_otro.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>