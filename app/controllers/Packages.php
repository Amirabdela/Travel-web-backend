<?php
class Packages extends Controller {
    private $packageModel;
    private $destinationModel;
    private $bookingModel;

    public function __construct() {
        $this->packageModel = $this->model('Package');
        $this->destinationModel = $this->model('Destination');
        $this->bookingModel = $this->model('Booking');
    }

    public function index() {
        // Get all packages
        $packages = $this->packageModel->getAllPackages();
        
        // Get unique package types for filter
        $types = $this->packageModel->getPackageTypes();

        $data = [
            'title' => 'Travel Packages',
            'packages' => $packages,
            'types' => $types
        ];

        $this->view('packages/index', $data);
    }

    public function show($id) {
        $package = $this->packageModel->getPackageById($id);
        
        if(!$package) {
            redirect('packages');
        }

        $data = [
            'title' => $package->title,
            'package' => $package
        ];

        $this->view('packages/show', $data);
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = trim($_POST['search']);
            $packages = $this->packageModel->searchPackages($query);
            
            $data = [
                'packages' => $packages,
                'query' => $query
            ];

            $this->view('packages/search', $data);
        } else {
            redirect('packages');
        }
    }

    public function filter() {
        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $price_min = isset($_GET['price_min']) ? (float)$_GET['price_min'] : null;
        $price_max = isset($_GET['price_max']) ? (float)$_GET['price_max'] : null;
        $duration = isset($_GET['duration']) ? (int)$_GET['duration'] : null;

        $packages = [];
        
        if ($type) {
            $packages = $this->packageModel->getPackagesByType($type);
        } elseif ($price_min && $price_max) {
            $packages = $this->packageModel->getPackagesByPriceRange($price_min, $price_max);
        } elseif ($duration) {
            $packages = $this->packageModel->getPackagesByDuration($duration);
        }

        $data = [
            'packages' => $packages,
            'filters' => [
                'type' => $type,
                'price_min' => $price_min,
                'price_max' => $price_max,
                'duration' => $duration
            ]
        ];

        $this->view('packages/filter', $data);
    }

    public function book($id) {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process booking
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'package_id' => $id,
                'user_id' => $_SESSION['user_id'],
                'start_date' => trim($_POST['start_date']),
                'guests' => trim($_POST['guests']),
                'special_requests' => trim($_POST['special_requests']),
                'start_date_err' => '',
                'guests_err' => ''
            ];

            // Validate start date
            if(empty($data['start_date'])) {
                $data['start_date_err'] = 'Please select a start date';
            }

            // Validate guests
            if(empty($data['guests'])) {
                $data['guests_err'] = 'Please enter number of guests';
            }

            // Make sure no errors
            if(empty($data['start_date_err']) && empty($data['guests_err'])) {
                // Book the package
                if($this->packageModel->bookPackage($data)) {
                    flash('booking_success', 'Package booked successfully');
                    redirect('packages/show/' . $id);
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('packages/book', $data);
            }
        } else {
            $package = $this->packageModel->getPackageById($id);
            
            if(!$package) {
                redirect('packages');
            }

            $data = [
                'title' => 'Book ' . $package->name,
                'package' => $package,
                'start_date' => '',
                'guests' => '',
                'special_requests' => '',
                'start_date_err' => '',
                'guests_err' => ''
            ];

            $this->view('packages/book', $data);
        }
    }
} 