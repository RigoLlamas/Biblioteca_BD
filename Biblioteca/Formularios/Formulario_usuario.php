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
    <TITLE>Gestionar Usuario</title>
</HEAD>
<BODY>
    Menú
    <UL>
        <LI><A href="Formulario_libro.php">Gestionar Libros</A></LI>
        <LI><A href="Formulario_usuario.php">Gestionar Usuarios</A></LI>
        <LI><A href="Formulario_renta.php">Gestionar Renta</A></LI>

        <?php
        if ($puesto == 1) {
            echo '<LI><A href="Formulario_trabajador.php">Gestionar Trabajadores</A></LI>';
            echo '<LI><A href="Formulario_puesto.php">Gestionar Puestos</A></LI>';
        }
        mysqli_close($conexion);
        $conexion = mysqli_connect("localhost", $usuario, $contraseña);
        $db = mysqli_select_db($conexion, "biblioteca");
        ?>

        <LI><A href="Formulario_otro.php">Otros</A></LI>
    </UL>
    
    Gestionar Usuario
    <FORM ACTION="Usuario.php" METHOD="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar">Eliminar
        </P>
        <P>ID Usuario (Si lo requiere): <INPUT TYPE="text" NAME="id_usuario"></P>
        <P>Nombre: <INPUT TYPE="text" NAME="nombre"></P>
        <P>Apellido Paterno: <INPUT TYPE="text" NAME="apep"></P>
        <P>Apellido Materno: <INPUT TYPE="text" NAME="apem"></P>
        <P>Domicilio: <INPUT TYPE="text" NAME="domicilio"></P>
        <P>Telefono: <INPUT TYPE="text" NAME="telefono"></P>
        <P>Correo: <INPUT TYPE="text" NAME="correo"></P>
        <button type="submit">Realizar Acción</button>
        <P></P>
    </FORM>
    <?php
    $consulta = "SELECT ID_Usuario, Nombre, ApeP, ApeM, Domicilio, Telefono, Correo FROM usuario ORDER BY ID_Usuario ASC";
    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>ID_Usuario</th>";
    echo "<th>Nombre</th>";
    echo "<th>ApeP</th>";
    echo "<th>ApeM</th>";
    echo "<th>Domicilio</th>";
    echo "<th>Telefono</th>";
    echo "<th>Correo</th>";
    echo "</tr>";
    
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['ID_Usuario'] . "</td><td>" . $columna['Nombre'] . "</td><td>" . $columna['ApeP'] . "</td><td>" . $columna['ApeM'] . "</td><td>" . $columna['Domicilio'] . "</td><td>" . $columna['Telefono'] . "</td><td>" . $columna['Correo'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    mysqli_close($conexion);
?>
</BODY>
</HTML>