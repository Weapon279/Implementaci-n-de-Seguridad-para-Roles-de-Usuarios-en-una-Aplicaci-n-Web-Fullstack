<?php
require_once 'conexion.php';

/**
 * Register a new user
 */
function registerUser($name, $email, $password) {
    global $pdo;
    
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        return ['success' => false, 'message' => 'El email ya está registrado'];
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Default role is 'user'
    $role = 'user';
    
    // If this is the first user, make them an admin
    $check = $pdo->query("SELECT COUNT(*) FROM users");
    if ($check->fetchColumn() == 0) {
        $role = 'admin';
    }
    
    // Insert user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$name, $email, $hashed_password, $role]);
    
    if ($result) {
        return ['success' => true, 'message' => 'Usuario registrado correctamente'];
    } else {
        return ['success' => false, 'message' => 'Error al registrar el usuario'];
    }
}

/**
 * Login user
 */
function loginUser($email, $password) {
    global $pdo;
    
    // Get user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if (!$user) {
        return ['success' => false, 'message' => 'Email o contraseña incorrectos'];
    }
    
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Start session
        $_SESSION['user_id'] = $user['id'];
        
        return [
            'success' => true, 
            'message' => 'Inicio de sesión exitoso',
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ];
    } else {
        return ['success' => false, 'message' => 'Email o contraseña incorrectos'];
    }
}

/**
 * Get user by ID
 */
function getUserById($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Get all users (for admin)
 */
function getAllUsers() {
    global $pdo;
    
    $stmt = $pdo->query("SELECT id, name, email, role FROM users");
    return $stmt->fetchAll();
}

