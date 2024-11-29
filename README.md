# Sistema de Login con Roles

Este proyecto es un sistema de login que permite a los usuarios registrarse e iniciar sesión con roles específicos. Utiliza PHP para la lógica del servidor y opcionalmente Docker para la contenedorización.

## Requisitos

- PHP 7.4 o superior
- MySQL
- Docker (opcional, pero recomendado para despliegue)
- XAMPP (si prefieres no usar Docker)

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu_usuario/login_system.git
    cd login_system
    ```

2. Configura la base de datos:
    - Crea una base de datos en MySQL.
    - Importa el archivo `database.sql` para crear las tablas necesarias.

3. Configura el archivo `config.php`:
    - Actualiza las credenciales de la base de datos según tu configuración.

    ```php
    <?php
    $base_url = '/login_system/';
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nombre_de_tu_base_de_datos";
    
    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }
    ?>
    ```

## Uso

1. Inicia el servidor web (si estás usando Docker, inicia los contenedores correspondientes o usa XAMPP si prefieres).
2. Accede al sistema a través del navegador usando la URL configurada en `$base_url`.

### Endpoints

- `/auth/login` - Página de inicio de sesión
- `/auth/register` - Página de registro
- `/user/dashboard` - Dashboard del usuario
- `/admin/dashboard` - Dashboard del administrador
- `/auth/logout` - Cerrar sesión

## Características

- **Registro y Login:** Permite a los usuarios registrarse e iniciar sesión con roles específicos.
- **Roles:** Redirige a los usuarios a diferentes dashboards según su rol.
- **Validación Dinámica:** Verificación de disponibilidad de nombre de usuario y correo electrónico mediante AJAX.
- **Gestión de Roles:** Los administradores pueden ver, buscar y actualizar los roles de los usuarios desde el dashboard de administración.
- **Búsqueda Dinámica:** Funcionalidad de búsqueda dinámica de usuarios en el dashboard de administración utilizando jQuery.

## Docker

Para facilitar el despliegue, puedes usar Docker:

1. Construye la imagen de Docker:
    ```bash
    docker build -t login_system .
    ```

2. Ejecuta el contenedor:
    ```bash
    docker run -d -p 80:80 --name login_system_container login_system
    ```

## JavaScript

El archivo `public/js/scripts.js` contiene la lógica para las validaciones dinámicas y la gestión de eventos de los formularios de login y registro, así como la búsqueda dinámica en el dashboard de administración.

## Estilos CSS

- `public/css/admin_dashboard.css`: Contiene los estilos específicos para el dashboard de administración.

## Contribución

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva_funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Añade nueva funcionalidad'`).
4. Sube tus cambios (`git push origin feature/nueva_funcionalidad`).
5. Crea un nuevo Pull Request.

## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo `LICENSE` para más detalles.
