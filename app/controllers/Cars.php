<?php
class Cars extends Controller {
    private $carModel;

    public function __construct() {
        $this->carModel = $this->model('Car');
    }

    public function index() {
        // Get all cars
        $cars = $this->carModel->getAllCars();
        
        // Get unique car types for filter
        $types = $this->carModel->getCarTypes();

        $data = [
            'title' => 'Rental Cars',
            'cars' => $cars,
            'types' => $types
        ];

        $this->view('cars/index', $data);
    }

    public function show($id) {
        $car = $this->carModel->getCarById($id);
        
        if(!$car) {
            redirect('cars');
        }

        $data = [
            'title' => $car->model,
            'car' => $car
        ];

        $this->view('cars/show', $data);
    }

    public function book($id) {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process booking
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'car_id' => $id,
                'user_id' => $_SESSION['user_id'],
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'start_date_err' => '',
                'end_date_err' => ''
            ];

            // Validate dates
            if(empty($data['start_date'])) {
                $data['start_date_err'] = 'Please enter start date';
            }
            if(empty($data['end_date'])) {
                $data['end_date_err'] = 'Please enter end date';
            }

            // Make sure no errors
            if(empty($data['start_date_err']) && empty($data['end_date_err'])) {
                // Book the car
                if($this->carModel->bookCar($data)) {
                    flash('booking_success', 'Car booked successfully');
                    redirect('cars/show/' . $id);
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('cars/book', $data);
            }
        } else {
            $car = $this->carModel->getCarById($id);
            
            if(!$car) {
                redirect('cars');
            }

            $data = [
                'title' => 'Book ' . $car->model,
                'car' => $car,
                'start_date' => '',
                'end_date' => '',
                'start_date_err' => '',
                'end_date_err' => ''
            ];

            $this->view('cars/book', $data);
        }
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = trim($_POST['search']);
            $cars = $this->carModel->searchCars($query);
            
            $data = [
                'cars' => $cars,
                'query' => $query
            ];

            $this->view('cars/search', $data);
        } else {
            redirect('cars');
        }
    }

    public function filter() {
        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $price_min = isset($_GET['price_min']) ? (float)$_GET['price_min'] : null;
        $price_max = isset($_GET['price_max']) ? (float)$_GET['price_max'] : null;

        $cars = [];
        
        if ($type) {
            $cars = $this->carModel->getCarsByType($type);
        } elseif ($price_min && $price_max) {
            $cars = $this->carModel->getCarsByPriceRange($price_min, $price_max);
        }

        $data = [
            'cars' => $cars,
            'filters' => [
                'type' => $type,
                'price_min' => $price_min,
                'price_max' => $price_max
            ]
        ];

        $this->view('cars/filter', $data);
    }
} 