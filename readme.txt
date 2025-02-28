# Sistema de Autenticación PHP con Roles de Usuario

Este proyecto implementa un sistema de autenticación completo con PHP y MySQL, que incluye roles de usuario (administrador y usuario normal), protección de rutas y un panel de administración.

## Características

- Registro e inicio de sesión de usuarios
- Encriptación de contraseñas con password_hash()
- Manejo de sesiones PHP
- Roles de usuario (administrador y usuario normal)
- Protección de rutas según el rol del usuario
- Panel de administración para ver todos los usuarios
- Interfaz responsiva con CSS moderno

## Estructura del Proyecto

- `index.php` - Página de inicio de sesión
- `registro.php` - Formulario de registro
- `dashboard.php` - Panel de usuario (protegido)
- `admin.php` - Panel de administración (solo para administradores)
- `cerrar.php` - Cierre de sesión
- `conexion.php` - Configuración de la base de datos
- `aute.php` - Funciones de autenticación
- `estilo.css` - Estilos CSS

## Instalación

1. Clonar el repositorio o descargar los archivos
2. Crear una base de datos MySQL
3. Importar el archivo `database.sql` para crear la estructura de la base de datos
4. Configurar los datos de conexión en `config.php`
5. Acceder a la aplicación a través de un servidor web con PHP

## Uso

1. El primer usuario registrado automáticamente se convierte en administrador
2. Los usuarios normales solo pueden ver su propio perfil
3. Los administradores pueden ver la lista de todos los usuarios registrados

## Seguridad

- Las contraseñas se almacenan encriptadas usando password_hash()
- Se utilizan consultas preparadas para prevenir inyección SQL
- Se validan los datos de entrada tanto en el cliente como en el servidor
- Se protegen las rutas según el rol del usuario

## Tecnologías Utilizadas

- PHP 7.4+
- MySQL
- HTML5
- CSS3
- PDO para conexión a la base de datos

