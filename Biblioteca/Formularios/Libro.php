<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];

    $accion = $_POST['accion'];
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $pasillo = $_POST['pasillo'];
    $fila = $_POST['fila'];
    $edicion = $_POST['edicion'];
    $editorial = $_POST['editorial'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero']; 
    $ejemplares = $_POST['ejemplares']; 

    $conexion = mysqli_connect("localhost", $usuario, $contraseña);
    $db = mysqli_select_db($conexion, "biblioteca");
    switch($accion){
        case 'agregar':
            $consulta = "INSERT INTO Libros (ISBN, Titulo, Pasillo, Fila, Edicion, Editorial, Autor, Genero, Ejemplares) 
            VALUES ('$isbn', '$titulo', '$pasillo', '$fila', '$edicion' ,'$editorial', '$autor', '$genero', '$ejemplares')";
            break;      
        case 'modificar':
            $consulta = "UPDATE Libros SET Titulo = '$titulo', Pasillo = '$pasillo', Fila = '$fila', Edicion = '$edicion', Editorial = '$editorial',
            Autor = '$autor', Genero = '$genero', Ejemplares = '$ejemplares' 
            WHERE ISBN = '$isbn'";
            break;
        case 'eliminar':
            $consulta = "DELETE FROM Actualiza WHERE Libro = '$isbn'";
            mysqli_query($conexion, $consulta);
            $consulta = "DELETE FROM Libros WHERE ISBN = '$isbn'";break;
            break; 
        default:
            die("Acción desconocida");
            break; 
    }

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    header("Location: Formulario_libro.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>