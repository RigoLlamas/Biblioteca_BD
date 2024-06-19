<?php
session_start();

if (!isset($_SESSION['conexion'])) {
    header("Location: Inicio_de_sesion.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$contraseña = $_SESSION['contraseña'];

$conexion = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conexion, "biblioteca");

$consulta_puesto = "SELECT Puesto FROM trabajador WHERE Usuario = ?";
$stmt = mysqli_prepare($conexion, $consulta_puesto);
mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $puesto);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>

<HTML>
<HEAD>
    <TITLE>Menú</TITLE>
</HEAD>
<BODY>
    Menú
    <UL>
        <LI><A href="Formularios/Formulario_libro.php">Gestionar Libros</A></LI>
        <LI><A href="Formularios/Formulario_usuario.php">Gestionar Usuarios</A></LI>
        <LI><A href="Formularios/Formulario_renta.php">Gestionar Renta</A></LI>

        <?php
        if ($puesto == 1) {
            echo '<LI><A href="Formularios/Formulario_trabajador.php">Gestionar Trabajadores</A></LI>';
            echo '<LI><A href="Formularios/Formulario_puesto.php">Gestionar Puestos</A></LI>';
        }
        ?>

        <LI><A href="Formularios/Formulario_otro.php">Otros</A></LI>
    </UL>
    <?php
    if ($puesto == 1) {
        $consulta = "SELECT * FROM Actualiza";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            echo "<table border='2'>";
            echo "<tr>";
            echo "<th>NumMov</th>";
            echo "<th>Fecha</th>";
            echo "<th>Trabajador</th>";
            echo "<th>Libro</th>";
            echo "</tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['NumMov'] . "</td>";
                echo "<td>" . $fila['Fecha'] . "</td>";
                echo "<td>" . $fila['Trabajador'] . "</td>";
                echo "<td>" . $fila['Libro'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            mysqli_free_result($resultado);
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }
        mysqli_close($conexion);
    }
?>

</BODY>
</HTML>
