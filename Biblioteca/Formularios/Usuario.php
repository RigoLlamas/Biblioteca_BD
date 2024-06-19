<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apep = $_POST['apep'];
    $apem = $_POST['apem'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");

    switch ($accion) {
        case 'agregar':
            $consulta = "INSERT INTO Usuario (ID_Usuario, Nombre, ApeP, ApeM, Domicilio, Telefono, Correo) 
            VALUES ('$id_usuario', '$nombre', '$apep', '$apem', '$domicilio', '$telefono', '$correo')";
            break;
        case 'modificar':
            $consulta = "UPDATE Usuario SET Nombre = '$nombre', ApeP = '$apep', ApeM = '$apem', 
            Domicilio = '$domicilio', Telefono = '$telefono', Correo = '$correo' WHERE ID_Usuario = '$id_usuario'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Usuario WHERE ID_Usuario = '$id_usuario'";
            break;
        default:
            die("Acción desconocida");
            break;
    }

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    header("Location: Formulario_usuario.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>
