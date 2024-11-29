<?php
class AdminController extends Controller {
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
            header("Location: " . $this->base_url . "auth/login");
            exit;
        }
        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();
        $this->view('admin/dashboard', ['users' => $users]);
    }

    public function updateRole() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
            header("Location: " . $this->base_url . "auth/login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = trim($_POST['user_id']);
            $role_id = trim($_POST['role_id']);

            $userModel = $this->model('User');
            $userModel->updateUserRole($user_id, $role_id);
            header("Location: " . $this->base_url . "admin/dashboard");
            exit;
        }
    }

    public function searchUsers() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
            header("Location: " . $this->base_url . "auth/login");
            exit;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
            $query = trim($_GET['query']);
            $userModel = $this->model('User');
            $users = $userModel->searchUsers($query);
            echo json_encode($users);
            exit;
        }
    }
    
}