<?php
// Comprobamos si el usuario y la contraseña son correctos (en este caso, simplemente asumimos que son correctos)
if ($_POST['username'] == 'Admin' && $_POST['password'] == 'BibEmp') {
    // Iniciamos una sesión y guardamos el nombre de usuario
    session_start();
    $_SESSION['username'] = $_POST['username'];
    // Redirigimos al usuario a la página principal
    header('Location: main.php');
    exit;
} else {
    // Si el usuario y la contraseña no son correctos, guardamos un mensaje de error en una variable
    $mensaje = "Usuario o contraseña son incorrectos.";
    // Redirigimos al usuario de vuelta a la página de inicio de sesión, pasando el mensaje de error como parámetro GET
    header('Location: index.php?mensaje=' . urlencode($mensaje));
    exit;
}
?>