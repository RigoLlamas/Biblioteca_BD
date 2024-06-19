<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $genero = $_POST['genero'];
    $nomgenero = $_POST['nomgenero'];

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");

    switch ($accion) {
        case 'agregar':
            $consulta = "INSERT INTO Genero (Nom_Genero) VALUES ('$nomgenero')";
            break;
        case 'modificar':
            $consulta = "UPDATE Genero SET Nom_Genero = '$nomgenero' WHERE ID_Genero = '$genero'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Genero WHERE ID_Genero = '$genero'";
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