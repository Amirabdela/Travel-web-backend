<?php
class Pages extends Controller {
    public function __construct() {
        // Load models if needed
    }

    public function index() {
        $data = [
            'title' => 'Welcome to Travel Habesha',
            'description' => 'Your trusted partner for unforgettable travel experiences in Ethiopia'
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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Contact Us',
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'message' => trim($_POST['message']),
                'name_err' => '',
                'email_err' => '',
                'subject_err' => '',
                'message_err' => ''
            ];

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
            if(empty($data['name_err']) && empty($data['email_err']) && 
               empty($data['subject_err']) && empty($data['message_err'])) {
                // Send email
                $to = 'contact@travelhabesha.com';
                $subject = 'Contact Form: ' . $data['subject'];
                $message = "Name: " . $data['name'] . "\n";
                $message .= "Email: " . $data['email'] . "\n\n";
                $message .= "Message:\n" . $data['message'];
                $headers = 'From: ' . $data['email'];

                if(mail($to, $subject, $message, $headers)) {
                    flash('contact_success', 'Your message has been sent successfully');
                    redirect('pages/contact');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('pages/contact', $data);
            }
        } else {
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

            $this->view('pages/contact', $data);
        }
    }

    public function destination() {
        $data = [
            'title' => 'Destinations',
            'description' => 'Explore our amazing destinations in Ethiopia'
        ];

        $this->view('pages/destination', $data);
    }
} 