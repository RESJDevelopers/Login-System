<?php
class Role extends Model {
    public function getRoles() {
        $sql = "SELECT * FROM roles";
        $result = $this->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRoleById($id) {
        $sql = "SELECT * FROM roles WHERE id = ?";
        $result = $this->query($sql, [$id]);
        return $result->fetch_assoc();
    }
}