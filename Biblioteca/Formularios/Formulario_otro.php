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
    <TITLE>Otros</title>
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
    
    Gestionar Editorial
    <FORM action="Editorial.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar">Eliminar
        </P>
        <P>ID Editorial (Si lo requiere): <input type="text" name="editorial"></P>
        <P>Nombre Editorial: <input type="text" name="nomeditorial"></P>
        <button type="submit">Realizar Acción</button>
    </FORM>
    <?php
    $consulta = "SELECT ID_Editorial AS Editorial, Nom_Editorial AS Nombre FROM editorial ORDER BY ID_Editorial ASC";
    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Editorial</th>";
    echo "<th>Nombre</th>";
    echo "</tr>";
    
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['Editorial'] . "</td><td>" . $columna['Nombre'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    ?>
    <P></P>
    Gestionar Genero
    <FORM action="Genero.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar">Eliminar
        </P>
        <P>ID Genero (Si lo requiere): <input type="text" name="genero"></P>
        <P>Nombre Genero: <input type="text" name="nomgenero"></P>
        <button type="submit">Realizar Acción</button>
    </FORM>
    <?php
    $consulta = "SELECT ID_Genero AS Genero, Nom_Genero AS Nombre FROM Genero  ORDER BY ID_Genero ASC";
    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Genero</th>";
    echo "<th>Nombre</th>";
    echo "</tr>";
    
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['Genero'] . "</td><td>" . $columna['Nombre'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    ?>
    <P></P>
    Gestionar Autor
    <FORM action="Autor.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar">Eliminar
        </P>
        <P>Registro (Si lo requiere): <input type="text" name="registro"></P>
        <P>Nombre: <input type="text" name="nombre"></P>
        <P>Apellido: <input type="text" name="apellido"></P>
        <button type="submit">Realizar Acción</button>
    </FORM>
    <?php
    $consulta = "SELECT Registro, Nombre, Apellido FROM autor ORDER BY Registro ASC";
    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Registro</th>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "</tr>";
    
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['Registro'] . "</td><td>" . $columna['Nombre'] . "</td><td>" . $columna['Apellido'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    ?>
</BODY>
</HTML>