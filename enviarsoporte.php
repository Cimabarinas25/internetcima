<?php
// Incluir la biblioteca PHPMailer
require 'PHPMailer.php';

// Función para enviar el correo de soporte técnico
function enviarCorreoSoporte($nombre, $email, $mensaje) {
    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Configurar los detalles del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tu_usuario_smtp';
    $mail->Password = 'tu_contraseña_smtp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurar los detalles del correo
    $mail->setFrom('cimaprueba6@gmail.com', 'Soporte Técnico');
    $mail->addAddress('cimaprueba6@gmail.com', 'Equipo de Soporte');
    $mail->Subject = 'Nuevo mensaje de soporte técnico';
    $mail->Body = "Nombre: $nombre\nCorreo electrónico: $email\n\nMensaje:\n$mensaje";

    // Enviar el correo
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

// Ejemplo de uso
$nombre = 'Juan Pérez';
$email = 'juan.perez@example.com';
$mensaje = 'Hola, tengo un problema con mi cuenta. ¿Pueden ayudarme?';

if (enviarCorreoSoporte($nombre, $email, $mensaje)) {
    echo 'El mensaje de soporte técnico se ha enviado correctamente.';
} else {
    echo 'Hubo un error al enviar el mensaje de soporte técnico.';
}