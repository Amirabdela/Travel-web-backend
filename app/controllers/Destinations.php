<?php
class Destinations extends Controller {
    private $destinationModel;
    private $packageModel;
    private $hotelModel;

    public function __construct() {
        $this->destinationModel = $this->model('Destination');
        $this->packageModel = $this->model('Package');
        $this->hotelModel = $this->model('Hotel');
    }

    public function index() {
        // Get all destinations with pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $per_page = 9;
        $destinations = $this->destinationModel->getPaginated($page, $per_page);
        $total_destinations = $this->destinationModel->count();
        $total_pages = ceil($total_destinations / $per_page);

        $data = [
            'title' => 'Destinations',
            'destinations' => $destinations,
            'current_page' => $page,
            'total_pages' => $total_pages,
            'per_page' => $per_page
        ];

        $this->view('destinations/index', $data);
    }

    public function show($id) {
        $destination = $this->destinationModel->getDestinationWithDetails($id);
        
        if (!$destination) {
            redirect('destinations');
        }

        // Get all packages and hotels for now
        // Later we can filter them based on location or other criteria
        $packages = $this->packageModel->getPackagesByDestination($id);
        $hotels = $this->hotelModel->getHotelsByDestination($id);

        // Get destination gallery
        $gallery = $this->destinationModel->getDestinationGallery($id);

        // Get destination attractions
        $attractions = $this->destinationModel->getDestinationAttractions($id);

        // Get destination reviews
        $reviews = $this->destinationModel->getDestinationReviews($id);

        $data = [
            'destination' => $destination,
            'packages' => $packages,
            'hotels' => $hotels,
            'gallery' => $gallery,
            'attractions' => $attractions,
            'reviews' => $reviews
        ];

        $this->view('destinations/show', $data);
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = trim($_POST['search']);
            $destinations = $this->destinationModel->searchDestinations($query);
            
            $data = [
                'destinations' => $destinations,
                'query' => $query
            ];

            $this->view('destinations/search', $data);
        } else {
            redirect('destinations');
        }
    }

    public function filter() {
        $region = isset($_GET['region']) ? $_GET['region'] : null;
        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $climate = isset($_GET['climate']) ? $_GET['climate'] : null;
        $best_time = isset($_GET['best_time']) ? $_GET['best_time'] : null;

        $destinations = [];
        
        if ($region) {
            $destinations = $this->destinationModel->getDestinationsByRegion($region);
        } elseif ($type) {
            $destinations = $this->destinationModel->getDestinationsByType($type);
        } elseif ($climate) {
            $destinations = $this->destinationModel->getDestinationsByClimate($climate);
        } elseif ($best_time) {
            $destinations = $this->destinationModel->getDestinationsByBestTime($best_time);
        }

        $data = [
            'destinations' => $destinations,
            'filters' => [
                'region' => $region,
                'type' => $type,
                'climate' => $climate,
                'best_time' => $best_time
            ]
        ];

        $this->view('destinations/filter', $data);
    }

    public function review($id) {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'destination_id' => $id,
                'user_id' => $_SESSION['user_id'],
                'rating' => $_POST['rating'],
                'comment' => $_POST['comment']
            ];

            if ($this->destinationModel->addReview($data)) {
                flash('review_success', 'Your review has been added successfully');
                redirect('destinations/show/' . $id);
            } else {
                flash('review_error', 'Something went wrong with your review', 'alert alert-danger');
                redirect('destinations/show/' . $id);
            }
        } else {
            redirect('destinations/show/' . $id);
        }
    }
} 