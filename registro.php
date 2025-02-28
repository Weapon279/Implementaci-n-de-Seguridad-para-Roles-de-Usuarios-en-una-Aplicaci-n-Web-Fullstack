<?php
session_start();
require_once 'aute.php';

// Redirect to dashboard if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message = '';
$success_message = '';

// Process registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = 'Por favor, completa todos los campos';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Las contraseñas no coinciden';
    } else {
        // Register user
        $result = registerUser($name, $email, $password);
        
        if ($result['success']) {
            $success_message = 'Usuario registrado correctamente. <a href="index.php">Iniciar sesión</a>';
        } else {
            $error_message = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <h1>Registro de Usuario</h1>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php else: ?>
                <form method="POST" action="registro.php">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn">Registrarse</button>
                </form>
            <?php endif; ?>
            <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>

