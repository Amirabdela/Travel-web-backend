<?php
class Controller {
    // Load model
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }

    // Load helper
    public function helper($helper) {
        require_once '../app/helpers/' . $helper . '.php';
    }

    // Redirect
    public function redirect($url) {
        header('Location: ' . URLROOT . '/' . $url);
    }

    // Set session message
    public function setMessage($name, $message) {
        $_SESSION[$name] = $message;
    }

    // Get session message
    public function getMessage($name) {
        if(isset($_SESSION[$name])) {
            $message = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $message;
        }
        return false;
    }
} 