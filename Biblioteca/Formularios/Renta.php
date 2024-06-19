<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $num_retiro = $_POST['num_retiro'];
    $fecha_salida = $_POST['fecha_salida'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $intereses = $_POST['intereses'];
    $costo = $_POST['costo'];
    $id_usuario = $_POST['id_usuario'];
    $isbn = $_POST['isbn'];

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");

    $consulta = "SELECT Nomina FROM Trabajador WHERE Usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);
    $nomina = mysqli_fetch_assoc($resultado)['Nomina'];

    switch ($accion) {
        case 'agregar':
            $costo_final = $costo * $intereses;
            $consulta = "INSERT INTO Renta (Fecha_Salida, Fecha_Entrega, Intereses, Costo, Costo_Final, Usuario, Trabajador, Libro) 
            VALUES ('$fecha_salida', '$fecha_entrega', '$intereses', '$costo', '$costo_final', '$id_usuario', '$nomina', '$isbn')";
            break;
        case 'modificar':
            $costo_final = $costo * $intereses;
            $consulta = "UPDATE Renta SET Fecha_Salida = '$fecha_salida', Fecha_Entrega = '$fecha_entrega', Intereses = '$intereses', 
            Costo = '$costo', Costo_Final = '$costo_final', Usuario = '$id_usuario', Trabajador = '$nomina', Libro = '$isbn' 
            WHERE Num_Retiro = '$num_retiro'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Renta WHERE Num_Retiro = '$num_retiro'";
            break;
        default:
            die("Acción desconocida");
            break;
    }

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    header("Location: Formulario_renta.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>
