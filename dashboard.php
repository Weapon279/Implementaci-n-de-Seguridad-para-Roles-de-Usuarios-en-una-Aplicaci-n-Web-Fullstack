<?php
session_start();
require_once 'aute.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user = getUserById($user_id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Autenticación</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>Panel de Usuario</h1>
            <div class="user-info">
                <span class="role-badge <?php echo $user['role'] === 'admin' ? 'admin' : 'user'; ?>">
                    <?php echo ucfirst($user['role']); ?>
                </span>
                <span class="username"><?php echo htmlspecialchars($user['name']); ?></span>
                <a href="cerrar.php" class="btn btn-logout">Cerrar Sesión</a>
            </div>
        </header>
        
        <div class="dashboard-content">
            <div class="welcome-section">
                <h2>Bienvenido, <?php echo htmlspecialchars($user['name']); ?>!</h2>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            
            <?php if ($user['role'] === 'admin'): ?>
                <div class="admin-actions">
                    <h3>Acciones de Administrador</h3>
                    <a href="admin.php" class="btn">Ver todos los usuarios</a>
                </div>
            <?php else: ?>
                <div class="user-profile">
                    <h3>Tu Perfil</h3>
                    <p>Eres un Usuario.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

