<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $editorial = $_POST['editorial'];
    $nomeditorial = $_POST['nomeditorial'];

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");

    switch ($accion) {
        case 'agregar':
            $consulta = "INSERT INTO Editorial (Nom_Editorial) VALUES ('$nomeditorial')";
            break;
        case 'modificar':
            $consulta = "UPDATE Editorial SET Nom_Editorial = '$nomeditorial' WHERE ID_Editorial = '$editorial'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Editorial WHERE ID_Editorial = '$editorial'";
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