<?php
class Newsletter extends Controller {
    private $newsletterModel;

    public function __construct() {
        $this->newsletterModel = $this->model('Newsletter');
    }

    public function subscribe() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Invalid email format';
            } elseif ($this->newsletterModel->isSubscribed($data['email'])) {
                $data['email_err'] = 'Email already subscribed';
            }

            // Make sure no errors
            if (empty($data['email_err'])) {
                if ($this->newsletterModel->subscribe($data['email'])) {
                    flash('newsletter_message', 'Successfully subscribed to newsletter');
                    redirect('');
                } else {
                    die('Something went wrong');
                }
            } else {
                flash('newsletter_error', $data['email_err'], 'alert alert-danger');
                redirect('');
            }
        } else {
            redirect('');
        }
    }

    public function unsubscribe() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Invalid email format';
            } elseif (!$this->newsletterModel->isSubscribed($data['email'])) {
                $data['email_err'] = 'Email not subscribed';
            }

            // Make sure no errors
            if (empty($data['email_err'])) {
                if ($this->newsletterModel->unsubscribe($data['email'])) {
                    flash('newsletter_message', 'Successfully unsubscribed from newsletter');
                    redirect('');
                } else {
                    die('Something went wrong');
                }
            } else {
                flash('newsletter_error', $data['email_err'], 'alert alert-danger');
                redirect('');
            }
        } else {
            redirect('');
        }
    }

    public function list() {
        if (!isAdmin()) {
            redirect('');
        }

        $subscribers = $this->newsletterModel->getAllSubscribers();
        $data = [
            'subscribers' => $subscribers
        ];
        $this->view('newsletter/list', $data);
    }
} 