<?php
class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    // Register user
    public function register() {
        // Check if form is submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif($this->userModel->findByEmail($data['email'])) {
                $data['email_err'] = 'Email is already taken';
            }

            // Validate name
            if(empty($data['first_name'])) {
                $data['first_name_err'] = 'Please enter first name';
            }
            if(empty($data['last_name'])) {
                $data['last_name_err'] = 'Please enter last name';
            }

            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['first_name_err']) && 
               empty($data['last_name_err']) && empty($data['password_err']) && 
               empty($data['confirm_password_err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if($this->userModel->register($data)) {
                    flash('register_success', 'Registration successful! You can now log in.');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    // Login user
    public function login() {
        // Check if form is submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if($this->userModel->findByEmail($data['email'])) {
                // User found
            } else {
                $data['email_err'] = 'No user found';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])) {
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser) {
                    // Create session
                    $_SESSION['user_id'] = $loggedInUser->id;
                    $_SESSION['user_email'] = $loggedInUser->email;
                    $_SESSION['user_name'] = $loggedInUser->first_name;
                    flash('login_success', 'Welcome back, ' . $loggedInUser->first_name . '!');
                    redirect('pages/index');
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    // Logout user
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        flash('logout_success', 'You have been logged out successfully.');
        redirect('users/login');
    }

    // User profile
    public function profile() {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        $user = $this->userModel->getUserWithRole($_SESSION['user_id']);
        $this->view('users/profile', ['user' => $user]);
    }

    // Edit profile
    public function edit() {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'id' => $_SESSION['user_id'],
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => ''
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate name
            if(empty($data['first_name'])) {
                $data['first_name_err'] = 'Please enter first name';
            }
            if(empty($data['last_name'])) {
                $data['last_name_err'] = 'Please enter last name';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['first_name_err']) && 
               empty($data['last_name_err'])) {
                // Update user
                if($this->userModel->updateProfile($data['id'], $data)) {
                    flash('profile_message', 'Profile Updated');
                    redirect('users/profile');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/edit', $data);
            }
        } else {
            // Get existing user
            $user = $this->userModel->getUserWithRole($_SESSION['user_id']);

            // Init data
            $data = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => ''
            ];

            // Load view
            $this->view('users/edit', $data);
        }
    }
} 