<?php
/*
 * Base Controller
 * Loads the models and views
 */
class Controller {
    // Load model
    public function model($model) {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            // Start output buffering
            ob_start();
            
            // Extract data to make variables available in view
            extract($data);
            
            // Include the view file
            require_once '../app/views/' . $view . '.php';
            
            // Get the contents of the buffer
            $content = ob_get_clean();
            
            // Include the layout
            require_once '../app/views/inc/layout.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
} 