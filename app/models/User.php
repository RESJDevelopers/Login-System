<?php
class User extends Model {
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $result = $this->query($sql, [$username]);
        return $result->fetch_assoc();
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $result = $this->query($sql, [$id]);
        return $result->fetch_assoc();
    }
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = $this->query($sql, [$email]);
        return $result->fetch_assoc();
    }
    

    public function userExists($email, $username) {
        $sql = "SELECT id FROM users WHERE email = ? OR username = ?";
        $result = $this->query($sql, [$email, $username]);
        return $result->num_rows > 0;
    }

    public function emailExists($email, $id) {
        $sql = "SELECT id FROM users WHERE email = ? AND id != ?";
        $result = $this->query($sql, [$email, $id]);
        return $result->num_rows > 0;
    }

    public function registerUser($first_name, $last_name, $email, $phone, $username, $password, $role_id) {
        $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [$first_name, $last_name, $email, $phone, $username, $password, $role_id];
        return $this->query($sql, $params);
    }
    

    public function updateProfile($id, $first_name, $last_name, $email, $phone) {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?";
        return $this->query($sql, [$first_name, $last_name, $email, $phone, $id]);
    }
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function updateUserRole($user_id, $role_id) {
        $sql = "UPDATE users SET role_id = ? WHERE id = ?";
        $params = [$role_id, $user_id];
        return $this->query($sql, $params);
    }
    public function searchUsers($query) {
        $sql = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ?";
        $likeQuery = "%$query%";
        $params = [$likeQuery, $likeQuery];
        $result = $this->query($sql, $params);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}