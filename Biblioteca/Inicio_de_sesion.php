<?php
session_start();

if ($_POST) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    try {
        $conexion = mysqli_connect("localhost", "root", "");
        if (!$conexion) {
            throw new Exception("Error al conectar a la base de datos");
        }

        $db = mysqli_select_db($conexion, "biblioteca");
        if (!$db) {
            throw new Exception("Error al seleccionar la base de datos");
        }

        $consulta = "SELECT Puesto FROM trabajador WHERE trabajador.Usuario = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $puesto);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        $conexion = mysqli_connect("localhost", $usuario, $contraseña);

        if ($conexion) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['contraseña'] = $contraseña;
            header("Location: Biblioteca_Menu_Admin.php");
        } else {
            echo "Usuario no registrado, verifique su usuario y contraseña";
        }
    } catch (Exception $e) {
        echo "Usuario no registrado, verifique su usuario y contraseña";
    }
}
?>
<HTML>
<HEAD>
    <TITLE>Inicio de Sesión</TITLE>
</HEAD>
<BODY>
<FORM action="Inicio_de_sesion.php" method="POST">
    <P>Usuario: <input type="text" name="usuario"></P>
    <P>Contraseña: <input type="password" name="contraseña"></P>
    <P><input type="submit" value="Aceptar"></P>
</FORM>
</BODY>
</HTML>