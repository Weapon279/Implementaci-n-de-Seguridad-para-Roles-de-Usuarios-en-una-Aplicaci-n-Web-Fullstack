<?php
session_start();
require_once 'aute.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user = getUserById($user_id);

// Check if user is admin
if ($user['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Get all users
$users = getAllUsers();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sistema de Autenticación</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>Panel de Administración</h1>
            <div class="user-info">
                <span class="role-badge admin">Admin</span>
                <span class="username"><?php echo htmlspecialchars($user['name']); ?></span>
                <a href="dashboard.php" class="btn">Dashboard</a>
                <a href="cerrar.php" class="btn btn-logout">Cerrar Sesión</a>
            </div>
        </header>
        
        <div class="admin-content">
            <h2>Usuarios Registrados</h2>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo $u['id']; ?></td>
                        <td><?php echo htmlspecialchars($u['name']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td>
                            <span class="role-badge <?php echo $u['role'] === 'admin' ? 'admin' : 'user'; ?>">
                                <?php echo ucfirst($u['role']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

