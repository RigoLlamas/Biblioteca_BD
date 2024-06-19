<?php
session_start();
if (!isset($_SESSION['conexion'])) {
    header("Location: Inicio_de_sesion.php");
    exit();
}
$usuario = $_SESSION['usuario'];
$contraseña = $_SESSION['contraseña'];
$conexion = mysqli_connect("localhost", $usuario, $contraseña);
$db = mysqli_select_db($conexion, "biblioteca");
?>

<HTML>
<HEAD>
    <TITLE>Menú Administrador</title>
</HEAD>
<BODY>
    Menú de Administrador
    <UL>
    <LI><A HREF="Formulario_libro.php">Gestionar Libros</A></LI>
        <LI><A HREF="Formulario_usuario.php">Gestionar Usuarios</A></LI>
        <LI><A HREF="Formulario_renta.php">Gestionar Renta</A></LI>
        <LI><A HREF="Formulario_trabajador.php">Gestionar Trabajadores</A></LI>
        <LI><A HREF="Formulario_puesto.php">Gestionar Puestos</A></LI>
        <LI><A HREF="Formulario_otro.php">Otros</A></LI>
    </UL>
    
    Gestionar Puesto
    <FORM action="Puesto.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar">Eliminar
        </P>
        <P>ID Puesto: <input type="text" name="puesto"></P>
        <P>Nombre Puesto: <input type="text" name="nompuesto"></P>
        <button type="submit">Realizar Acción</button>
    </FORM>
    <?php
    $consulta = "SELECT Puesto, NomPuesto AS Nombre FROM puesto ORDER BY Puesto ASC";
    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Puesto</th>";
    echo "<th>Nombre</th>";
    echo "</tr>";
    
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['Puesto'] . "</td><td>" . $columna['Nombre'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    mysqli_close($conexion);
?>
</BODY>
</HTML>