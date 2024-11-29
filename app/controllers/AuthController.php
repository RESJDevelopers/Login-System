<?php
class AuthController extends Controller {
    public function login() {
        $this->view('auth/login');
    }

    public function register() {
        $this->view('auth/register');
    }

    public function handleLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            $userModel = $this->model('User');
            $user = $userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_id'] = $user['role_id'];

                echo json_encode([
                    'status' => 'success',
                    'role_id' => $_SESSION['role_id']
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Usuario o contraseña incorrectos.'
                ]);
            }
            exit;
        }
    }

    public function handleRegister() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            // Validaciones
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Formato de correo inválido";
                exit;
            }

            if (!preg_match("/^[0-9]{8}$/", $phone)) {
                echo "El teléfono debe tener 8 dígitos";
                exit;
            }

            if ($password !== $confirm_password) {
                echo "Las contraseñas no coinciden";
                exit;
            }

            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Verificar si el usuario o el correo ya existen
            $userModel = $this->model('User');
            if ($userModel->userExists($email, $username)) {
                echo "El correo o usuario ya están en uso";
                exit;
            }

            // Insertar el nuevo usuario con el rol de 'usuario'
            $userModel->registerUser($first_name, $last_name, $email, $phone, $username, $hashed_password, 2);
            echo "Registro exitoso";
        }
    }

    public function checkUsername() {
        if (isset($_GET['username'])) {
            $username = trim($_GET['username']);
            $userModel = $this->model('User');
            if ($userModel->getUserByUsername($username)) {
                echo "Nombre de usuario no disponible";
            } else {
                echo "Nombre de usuario disponible";
            }
        }
    }

    public function checkEmail() {
        if (isset($_GET['email'])) {
            $email = trim($_GET['email']);
            $userModel = $this->model('User');
            if ($userModel->getUserByEmail($email)) {
                echo "Correo electrónico no disponible";
            } else {
                echo "Correo electrónico disponible";
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . $this->base_url . "auth/login");
        exit;
    }
}