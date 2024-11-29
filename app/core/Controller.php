<?php
class Controller {
    protected $base_url;

    public function __construct() {
        require 'config.php';
        $this->base_url = $base_url;
    }

    public function view($view, $data = []) {
        if (file_exists('app/views/' . $view . '.php')) {
            $data['base_url'] = $this->base_url;
            extract($data);
            $viewPath = 'app/views/' . $view . '.php';
            require_once 'app/views/layout.php';
        } else {
            echo "Vista $view no encontrada.";
        }
    }

    public function model($model) {
        if (file_exists('app/models/' . $model . '.php')) {
            require_once 'app/models/' . $model . '.php';
            return new $model();
        } else {
            echo "Modelo $model no encontrado.";
        }
    }
}