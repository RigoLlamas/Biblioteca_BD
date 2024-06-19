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
    <TITLE>Formulario Trabajador</title>
</HEAD>
<BODY>
    Menú
    <UL>
    <LI><A HREF="Formulario_libro.php">Gestionar Libros</A></LI>
        <LI><A HREF="Formulario_usuario.php">Gestionar Usuarios</A></LI>
        <LI><A HREF="Formulario_renta.php">Gestionar Renta</A></LI>
        <LI><A HREF="Formulario_trabajador.php">Gestionar Trabajadores</A></LI>
        <LI><A HREF="Formulario_puesto.php">Gestionar Puestos</A></LI>
        <LI><A HREF="Formulario_otro.php">Otros</A></LI>
    </UL>
    
    Gestionar Usuario
    <FORM action="Trabajador.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar" checked>Eliminar
        </P>
        <P>Nómina (Si lo requiere): <input type="text" name="nomina"></P>
        <P>Nombre: <input type="text" name="nombre"></P>
        <P>Apellido Paterno: <input type="text" name="apep"></P>
        <P>Apellido Materno: <input type="text" name="apem"></P>
        <P>Puesto: 
        <SELECT name="puesto">
                <OPTION value=""> </OPTION>
                    <?php
                    try {
                        $selec_puesto = mysqli_query($conexion, "SELECT Puesto,NomPuesto FROM puesto");
                        while ($option = mysqli_fetch_array($selec_puesto)) {
                            echo "<option value='" . $option['Puesto'] . "'>" . $option['NomPuesto'] . "</option>";
                        }
                    } catch (Exception $e) {}
                    ?>
            </SELECT>
        </P>
        <P>Usuario: <input type="text" name="trabajador"></P>
        <P>Contraseña: <input type="password" name="contrasena"></P>
        <button type="submit">Realizar Acción</button>
        <P></P>
    </FORM>
    <?php
    $consulta = "SELECT trabajador.Nomina, trabajador.Nombre, trabajador.ApeP, trabajador.ApeM,
     puesto.NomPuesto AS Puesto, trabajador.Usuario, trabajador.Contrasena AS Contraseña
    FROM trabajador
    INNER JOIN puesto ON trabajador.Puesto = puesto.Puesto
    ORDER BY trabajador.Nomina ASC";

    $resultado = mysqli_query($conexion, $consulta);

    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Nomina</th>";
    echo "<th>Nombre</th>";
    echo "<th>ApeP</th>";
    echo "<th>ApeM</th>";
    echo "<th>Puesto</th>";
    echo "<th>Usuario</th>";
    echo "<th>Contrasena</th>";
    echo "</tr>";

    while ($columnaUsuario = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td>" . $columnaUsuario['Nomina'] . "</td><td>" . $columnaUsuario['Nombre'] . "</td><td>" . $columnaUsuario['ApeP'] . "</td><td>" . $columnaUsuario['ApeM'] . "</td><td>" . $columnaUsuario['Puesto'] . "</td><td>" . $columnaUsuario['Usuario'] . "</td><td>" . $columnaUsuario['Contraseña'] ."</td>";
    echo "</tr>";
    }

    echo "</table>";
    
    mysqli_close($conexion);
?>
</BODY>
</HTML>