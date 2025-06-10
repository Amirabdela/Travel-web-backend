<?php
class Pages extends Controller {
    private $destinationModel;

    public function __construct() {
        $this->destinationModel = $this->model('Destination');
    }

    public function index() {
        // Get featured destinations
        $featuredDestinations = $this->destinationModel->getFeaturedDestinations(3);

        $data = [
            'title' => 'Welcome to Travel Habesha',
            'featuredDestinations' => $featuredDestinations
        ];

        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About Us',
            'description' => 'Learn more about Travel Habesha and our mission'
        ];

        $this->view('pages/about', $data);
    }

    public function contact() {
         $userData = null;
          $contactModel = $this->model('Contact');
    $userModel = $this->model('User');
    
    $data = [
        'title' => 'Contact Us',
        'name' => '',
        'email' => '',
        'subject' => '',
        'message' => '',
        'name_err' => '',
        'email_err' => '',
        'subject_err' => '',
        'message_err' => ''
    ];
    
    // If user is logged in, get their data
        if(isLoggedIn()) {
        $userData = $userModel->getUserById($_SESSION['user_id']);
        if($userData) {
            $data['name'] = $userData->full_name ?? $userData->name;
            $data['email'] = $userData->email;
        }
    }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['name'] = trim($_POST['name'] ?? '');
            $data['email'] = trim($_POST['email'] ?? '');
            $data['subject'] = trim($_POST['subject'] ?? '');
            $data['message'] = trim($_POST['message'] ?? '');

            // Validate name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter your name';
            }

            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
            }

            // Validate subject
            if(empty($data['subject'])) {
                $data['subject_err'] = 'Please enter a subject';
            }

            // Validate message
            if(empty($data['message'])) {
                $data['message_err'] = 'Please enter your message';
            }

            // Make sure no errors
          if(empty($data['name_err']) && empty($data['email_err']) && empty($data['message_err'])) {
            if($contactModel->addMessage(
                $data['name'],
                $data['email'],
                $data['message'],
                $data['subject']
            )) {
                flash('contact_success', 'Your message has been sent successfully!');
                redirect('pages/contact');
            } else {
                die('Something went wrong');
            }
        }
    }
                // Load view with errors
                $this->view('pages/contact', $data);
            
       
    }

    public function destination() {
        $data = [
            'title' => 'Destinations',
            'description' => 'Explore our amazing destinations in Ethiopia'
        ];

        $this->view('pages/destination', $data);
    }
} 