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
    <TITLE>Gestionar Renta</title>
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
    Gestionar rentas
    <FORM action="Renta.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar" checked>Eliminar
        </P>
        <P>Numero de Retiro (Si lo requiere): <input type="text" name="num_retiro"></P>
        <P>Fecha Salida: <input type="date" name="fecha_salida"></P>
        <P>Fecha Entrega: <input type="date" name="fecha_entrega"></P>
        <P>Intereses: <input type="text" name="intereses"></P>
        <P>Costo: <input type="text" name="costo"></P>
        <P>Usuario: <input type="text" name="id_usuario"></P>
        <P>Libro: 
            <SELECT name="isbn">
                <OPTION value=""> </OPTION>
                    <?php
                    try {
                        $selec_libro = mysqli_query($conexion, "SELECT ISBN,Titulo FROM libros");
                        while ($option = mysqli_fetch_array($selec_libro)) {
                            echo "<option value='" . $option['ISBN'] . "'>" . $option['Titulo'] . "</option>";
                        }
                    } catch (Exception $e) {}
                    ?>
            </SELECT>
        </P>
        <button type="submit">Realizar Acción</button>
        <P></P>
    </FROM>
    <?PHP
    $consulta = "SELECT renta.Num_Retiro, renta.Fecha_Salida, renta.Fecha_Entrega, renta.Intereses, 
    renta.Costo, renta.Costo_Final, usuario.Nombre AS Usuario, trabajador.Nombre AS Trabajador, libros.Titulo AS Libro
    FROM renta
    INNER JOIN usuario ON renta.Usuario = usuario.ID_Usuario
    INNER JOIN trabajador ON renta.Trabajador = trabajador.Nomina
    INNER JOIN libros ON renta.Libro = libros.ISBN
    ORDER BY renta.Num_Retiro ASC";

    $resultado = mysqli_query($conexion, $consulta);

    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Num_Retiro</th>";
    echo "<th>Fecha_Salida</th>";
    echo "<th>Fecha_Entrega</th>";
    echo "<th>Intereses</th>";
    echo "<th>Costo</th>";
    echo "<th>Costo_Final</th>";
    echo "<th>Usuario</th>";
    echo "<th>Trabajador</th>";
    echo "<th>Libro</th>";
    echo "</tr>";

    while ($columna = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td>" . $columna['Num_Retiro'] . "</td><td>" . $columna['Fecha_Salida'] . "</td><td>" . $columna['Fecha_Entrega'] . "</td><td>" . $columna['Intereses'] . "</td><td>" . $columna['Costo'] . "</td><td>" . $columna['Costo_Final'] . "</td><td>" . $columna['Usuario'] . "</td><td>" . $columna['Trabajador'] . "</td><td>" . $columna['Libro'] . "</td>";
    echo "</tr>";
    }

    echo "</table>";
    ?>
    <P>Detalles de renta</P>
    <?php
    $consulta = "SELECT * FROM VistaRetirosDetalles";
    $resultado = mysqli_query($conexion, $consulta);

    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>Num_Retiro</th>";
    echo "<th>Fecha_Salida</th>";
    echo "<th>Fecha_Entrega</th>";
    echo "<th>Intereses</th>";
    echo "<th>Costo</th>";
    echo "<th>Costo_Final</th>";
    echo "<th>UsuarioNombre</th>";
    echo "<th>UsuarioApellidoP</th>";
    echo "<th>UsuarioApellidoM</th>";
    echo "<th>LibroTitulo</th>";
    echo "<th>Pasillo</th>";
    echo "<th>Fila</th>";
    echo "<th>Edicion</th>";
    echo "</tr>";

    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
    echo "<td>" . $columna['Num_Retiro'] . "</td><td>" . $columna['Fecha_Salida'] . "</td><td>" . $columna['Fecha_Entrega'] . "</td><td>" . $columna['Intereses'] . "</td><td>" . $columna['Costo'] . "</td><td>" . $columna['Costo_Final'] . "</td><td>" . $columna['UsuarioNombre'] . "</td><td>" . $columna['UsuarioApellidoP'] . "</td><td>" . $columna['UsuarioApellidoM'] . "</td><td>" . $columna['LibroTitulo'] . "</td><td>" . $columna['Pasillo'] . "</td><td>" . $columna['Fila'] . "</td><td>" . $columna['Edicion'] . "</td>";
    echo "</tr>";
    }

    echo "</table>";

    mysqli_close($conexion);
    ?>

</BODY>
</HTML>