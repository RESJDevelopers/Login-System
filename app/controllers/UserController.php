<?php
class UserController extends Controller {
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
            header("Location: " . $this->base_url . "auth/login");
            exit;
        }
        $this->view('user/dashboard');
    }

    public function profile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . $this->base_url . "auth/login");
            exit;
        }

        $userModel = $this->model('User');
        $user = $userModel->getUserById($_SESSION['user_id']);

        $this->view('user/profile', ['user' => $user]);
    }

    public function updateProfile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . $this->base_url . "auth/login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_SESSION['user_id'];
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);

            // Validaciones
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Formato de correo inválido";
                exit;
            }

            if (!preg_match("/^[0-9]{8}$/", $phone)) {
                echo "El teléfono debe tener 8 dígitos";
                exit;
            }

            // Verificar si el nuevo correo ya está en uso por otro usuario
            $userModel = $this->model('User');
            if ($userModel->emailExists($email, $user_id)) {
                echo "El correo ya está en uso por otro usuario";
                exit;
            }

            // Actualizar el perfil del usuario
            $userModel->updateProfile($user_id, $first_name, $last_name, $email, $phone);
            echo "Perfil actualizado exitosamente";
        }
    }
}