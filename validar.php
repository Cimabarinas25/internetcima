<?php
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    die();
}

// Incluir la conexión a la base de datos
include("db.php");

// Verificar si los datos del formulario están presentes
if (
    !isset($_POST['PagosInternet']) || 
    !isset($_POST['Clientes']) || 
    !isset($_POST['Tickets']) || 
    !isset($_POST['Tráfico']) || 
    !isset($_POST['repeatTráfico'])
) {
    header('Location: index.php');
    die();
}

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "db_cima") or die(mysqli_error($conexion));

// Sanear los datos de entrada
$PagosInterne = mysqli_real_escape_string($conexion, $_POST['PagosInternet']);
$Clientes = mysqli_real_escape_string($conexion, $_POST['Clientes']);
$Tickets = mysqli_real_escape_string($conexion, $_POST['Tickets']);
$Trafico = mysqli_real_escape_string($conexion, $_POST['Trafico']);

// Verificar si las contraseñas coinciden
if ($password !== $repeatPassword) {
    die('Las contraseñas no coinciden.');
}

// Encriptar la contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Definir otros valores
$tipo = 'user'; // Tipo de usuario
$apellido = 'Unknown'; // Valor por defecto
$fecha_creacion = date("Y-m-d H:i:s"); // Fecha de creación

// Insertar los datos en la tabla 'nuevo'
$query_nuevo = "INSERT INTO nuevo (PagosInternet, Clientes, Tickets, Trafico) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_nuevo = mysqli_prepare($conexion, $query_nuevo);
mysqli_stmt_bind_param($stmt_nuevo, 'ssssssss', $PagosInternet, $Clientes, $Tickets, $Trafico,);
mysqli_stmt_execute($stmt_nuevo);

// Insertar los datos en la tabla 'usuarios'
$query_usuarios = "INSERT INTO usuarios (PagosInternet, Clientes, Tickets, Trafico) 
                   VALUES (?, ?, ?)";
$stmt_usuarios = mysqli_prepare($conexion, $query_usuarios);
mysqli_stmt_bind_param($stmt_usuarios, 'sss', $tipo, $passwordHash, $fecha_creacion);
mysqli_stmt_execute($stmt_usuarios);

// Cerrar las conexiones
mysqli_stmt_close($stmt_nuevo);
mysqli_stmt_close($stmt_usuarios);
mysqli_close($conexion);

// Redirigir al usuario después de registrarse
header('Location: index.php');
exit();
?>
