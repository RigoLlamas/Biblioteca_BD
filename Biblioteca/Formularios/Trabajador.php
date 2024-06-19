<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $nomina = $_POST['nomina'];
    $nombre = $_POST['nombre'];
    $apep = $_POST['apep'];
    $apem = $_POST['apem'];
    $puesto = $_POST['puesto'];
    $trabajador = $_POST['trabajador'];
    $contraseña = $_POST['contrasena'];
    $hash_contrasena = password_hash($contraseña, PASSWORD_DEFAULT);

    $conexion = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($conexion, "biblioteca");

    switch ($accion) {
        case 'agregar':
            // Crear el usuario
            $consulta = "CREATE USER '$trabajador'@'localhost' IDENTIFIED BY '$contraseña'";
            mysqli_query($conexion, $consulta);
        
            // Otorgar privilegios
            if ($puesto == '1') {
                $consulta = "GRANT ALL PRIVILEGES ON *.* TO '$trabajador'@'localhost' WITH GRANT OPTION";
            } else {
                $tablas = ["Usuario", "Renta", "Libros", "Autor", "Editorial", "Genero", "Trabajador", "Puesto", "VistaRetirosDetalles", "VistaLibrosDetalles"];
                $tablas_str = implode(", ", array_map(function ($tabla) {
                    return "Biblioteca.$tabla";
                }, $tablas));
        
                $consulta = "GRANT SELECT, INSERT, UPDATE, DELETE ON $tablas_str TO '$trabajador'@'localhost'";
            }
            mysqli_query($conexion, $consulta);
        
            // Actualizar privilegios
            $consulta = "FLUSH PRIVILEGES";
            mysqli_query($conexion, $consulta);
        
            // Insertar en la tabla Trabajador
            $consulta = "INSERT INTO Trabajador (Nomina, Nombre, ApeP, ApeM, Puesto, Usuario, Contrasena) 
                         VALUES ('$nomina', '$nombre', '$apep', '$apem', '$puesto', '$trabajador', '$hash_contrasena')";
            mysqli_query($conexion, $consulta);
            break;
        
        
        case 'modificar':
            $consulta = "SELECT Usuario FROM Trabajador WHERE Nomina = '$nomina'";
            $resultado = mysqli_query($conexion, $consulta);
            $usuario_actual = mysqli_fetch_assoc($resultado);
            $antiguo_usuario = $usuario_actual['Usuario'];
            $consulta = "UPDATE Trabajador SET Nombre = '$nombre', ApeP = '$apep', ApeM = '$apem', 
                         Puesto = '$puesto', Usuario = '$trabajador'  WHERE Nomina = '$nomina'";
            mysqli_query($conexion, $consulta);
            try{
                if ($antiguo_usuario != $trabajador) {
                    $consulta = "RENAME USER '$antiguo_usuario'@'localhost' TO '$trabajador'@'localhost'";
                    mysqli_query($conexion, $consulta);
                }
                if ($puesto == '1' && $antiguo_usuario != $trabajador) {
                    $consulta = "GRANT ALL PRIVILEGES ON *.* TO '$trabajador'@'localhost' WITH GRANT OPTION";
                    mysqli_query($conexion, $consulta);

                    $consulta = "FLUSH PRIVILEGES";
                    mysqli_query($conexion, $consulta);
                }
            }catch (Exception $e){}
            break;
            case 'eliminar':
                $consulta = "SELECT Usuario FROM Trabajador WHERE Nomina = '$nomina'";
                $resultado = mysqli_query($conexion, $consulta);
                $fila = mysqli_fetch_assoc($resultado);
                $trabajador = $fila['Usuario'];
                $consulta = "DELETE FROM Trabajador WHERE Nomina = '$nomina'";
                mysqli_query($conexion, $consulta);
                try {
                    $consulta = "DROP USER '$trabajador'@'localhost'";
                    mysqli_query($conexion, $consulta);
                } catch (Exception $e) {
                }
                break;            
        default:
            die("Acción desconocida");
            break;
    }

    mysqli_close($conexion);
    header("Location: Formulario_trabajador.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>