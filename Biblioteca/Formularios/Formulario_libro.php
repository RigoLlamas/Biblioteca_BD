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
//mysqli_stmt_close($stmt);
?>

<HTML>
<HEAD>
    <TITLE>Gestionar Libro</title>
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
    Gestionar libro
    <FORM action="Libro.php" method="post">
        <P>Accion: 
            <input type="radio" name="accion" value="agregar" checked>Agregar
            <input type="radio" name="accion" value="modificar">Modificar
            <input type="radio" name="accion" value="eliminar" checked>Eliminar
        </P>
        <P>ISBN: <input type="text" name="isbn"></P>
        <P>Titulo: <input type="text" name="titulo"></P>
        <P>Pasillo: <input type="text" name="pasillo"></P>
        <P>Fila: <input type="text" name="fila"></P>
        <P>Edicion: <input type="text" name="edicion"></P>
        <P>Editorial: 
            <SELECT name="editorial">
                <OPTION value=""> </OPTION>
                <?php
                try {
                    $selec_editorial = mysqli_query($conexion, "SELECT ID_Editorial, Nom_Editorial FROM editorial");
                    while ($option = mysqli_fetch_array($selec_editorial)) {
                        echo "<option value='" . $option['ID_Editorial'] . "'>" . $option['Nom_Editorial'] . "</option>";
                    }
                } catch (Exception $e) {}
                ?>
            </SELECT>
        </P>
        <P>Autor: 
            <SELECT name="autor">
                <OPTION value=""> </OPTION>
                <?php
                try {
                    $selec_autor = mysqli_query($conexion, "SELECT Registro, Nombre, Apellido FROM autor");
                    while ($option = mysqli_fetch_array($selec_autor)) {
                        echo "<option value='" . $option['Registro'] . "'>" . $option['Nombre'] . " " . $option['Apellido'] . "</option>";
                    }
                } catch (Exception $e) {}
                ?>
            </SELECT>
        </P>
        <P>Genero: 
            <SELECT name="genero">
                <OPTION value=""> </OPTION>
                <?php
                try {
                    $selec_genero = mysqli_query($conexion, "SELECT ID_Genero, Nom_Genero FROM genero");
                    while ($option = mysqli_fetch_array($selec_genero)) {
                        echo "<option value='" . $option['ID_Genero'] . "'>" . $option['Nom_Genero'] . "</option>";
                    }
                } catch (Exception $e) {}
                ?>
            </SELECT>
        </P>
        <P>Ejemplares: <input type="text" name="ejemplares"></P>
        <button type="submit">Realizar Acción</button>
        <P></P>
    </FORM>
    <?PHP
    $consulta = "SELECT libros.ISBN, libros.Titulo, libros.Pasillo, libros.Fila, libros.Edicion, 
    editorial.Nom_Editorial AS Editorial, autor.Nombre AS Autor, 
    autor.Apellido AS AutorApellido, genero.Nom_Genero AS Genero, libros.Ejemplares
    FROM libros
    INNER JOIN editorial ON libros.Editorial = editorial.ID_Editorial
    INNER JOIN autor ON libros.Autor = autor.Registro
    INNER JOIN genero ON libros.Genero = genero.ID_Genero
    ORDER BY libros.ISBN ASC";

    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>ISBN</th>";
    echo "<th>Título</th>";
    echo "<th>Pasillo</th>";
    echo "<th>Fila</th>";
    echo "<th>Edición</th>";
    echo "<th>Editorial</th>";
    echo "<th>Autor</th>";
    echo "<th>Género</th>";
    echo "<th>Ejemplares</th>";
    echo "</tr>";
        
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['ISBN'] . "</td><td>" . $columna['Titulo'] . "</td><td>" . $columna['Pasillo'] . "</td><td>" . $columna['Fila'] . "</td><td>" . $columna['Edicion'] . "</td><td>" . $columna['Editorial'] . "</td><td>" . $columna['Autor'] . "</td><td>" . $columna['Genero'] . "</td><td>" . $columna['Ejemplares'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    ?>
    <P>Libos detalles</P>
    <?php
    $consulta = "SELECT * FROM VistaLibrosDetalles";
    $resultado = mysqli_query($conexion, $consulta);
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>ISBN</th>";
    echo "<th>Titulo</th>";
    echo "<th>Pasillo</th>";
    echo "<th>Fila</th>";
    echo "<th>Edicion</th>";
    echo "<th>Nombre_Autor</th>";
    echo "<th>Apellido_Autor</th>";
    echo "<th>Editorial</th>";
    echo "<th>Genero</th>";
    echo "</tr>";
    
    while ($columna = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $columna['ISBN'] . "</td>";
        echo "<td>" . $columna['Titulo'] . "</td>";
        echo "<td>" . $columna['Pasillo'] . "</td>";
        echo "<td>" . $columna['Fila'] . "</td>";
        echo "<td>" . $columna['Edicion'] . "</td>";
        echo "<td>" . $columna['Nombre_Autor'] . "</td>";
        echo "<td>" . $columna['Apellido_Autor'] . "</td>";
        echo "<td>" . $columna['Editorial'] . "</td>";
        echo "<td>" . $columna['Genero'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    mysqli_close($conexion);
    ?>
</BODY>
</HTML>