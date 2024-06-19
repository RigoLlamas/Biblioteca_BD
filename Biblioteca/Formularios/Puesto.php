<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $puesto = $_POST['puesto'];
    $nompuesto = $_POST['nompuesto'];

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");

    switch ($accion) {
        case 'agregar':
            $consulta = "INSERT INTO Puesto (NomPuesto) VALUES ('$nompuesto')";
            break;
        case 'modificar':
            $consulta = "UPDATE Puesto SET NomPuesto = '$nompuesto' WHERE Puesto = '$puesto'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Puesto WHERE Puesto = '$puesto'";
            break;
        default:
            die("Acción desconocida");
            break;
    }
    
    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    header("Location: Formulario_puesto.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>