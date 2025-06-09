<?php
class Hotels extends Controller {
    private $hotelModel;
    private $destinationModel;
    private $bookingModel;

    public function __construct() {
        $this->hotelModel = $this->model('Hotel');
        $this->destinationModel = $this->model('Destination');
        $this->bookingModel = $this->model('Booking');
    }

    public function index() {
        // Get all hotels
        $hotels = $this->hotelModel->getAllHotels();
        
        // Get unique hotel types for filter
        $types = $this->hotelModel->getHotelTypes();

        $data = [
            'title' => 'Hotels',
            'hotels' => $hotels,
            'types' => $types
        ];

        $this->view('hotels/index', $data);
    }

    public function show($id) {
        $hotel = $this->hotelModel->getHotelById($id);
        
        if(!$hotel) {
            redirect('hotels');
        }

        $data = [
            'title' => $hotel->name,
            'hotel' => $hotel
        ];

        $this->view('hotels/show', $data);
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = trim($_POST['search']);
            $hotels = $this->hotelModel->searchHotels($query);
            
            $data = [
                'hotels' => $hotels,
                'query' => $query
            ];

            $this->view('hotels/search', $data);
        } else {
            redirect('hotels');
        }
    }

    public function filter() {
        $rating = isset($_GET['rating']) ? (int)$_GET['rating'] : null;
        $price_min = isset($_GET['price_min']) ? (float)$_GET['price_min'] : null;
        $price_max = isset($_GET['price_max']) ? (float)$_GET['price_max'] : null;
        $amenities = isset($_GET['amenities']) ? $_GET['amenities'] : null;

        $hotels = [];
        
        if ($rating) {
            $hotels = $this->hotelModel->getHotelsByRating($rating);
        } elseif ($price_min && $price_max) {
            $hotels = $this->hotelModel->getHotelsByPriceRange($price_min, $price_max);
        } elseif ($amenities) {
            $hotels = $this->hotelModel->getHotelsByAmenities($amenities);
        }

        $data = [
            'hotels' => $hotels,
            'filters' => [
                'rating' => $rating,
                'price_min' => $price_min,
                'price_max' => $price_max,
                'amenities' => $amenities
            ]
        ];

        $this->view('hotels/filter', $data);
    }

    public function review($id) {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'hotel_id' => $id,
                'user_id' => $_SESSION['user_id'],
                'rating' => $_POST['rating'],
                'comment' => $_POST['comment']
            ];

            if ($this->hotelModel->addReview($data)) {
                flash('review_success', 'Your review has been added successfully');
                redirect('hotels/show/' . $id);
            } else {
                flash('review_error', 'Something went wrong with your review', 'alert alert-danger');
                redirect('hotels/show/' . $id);
            }
        } else {
            redirect('hotels/show/' . $id);
        }
    }

    public function book($id) {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process booking
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'hotel_id' => $id,
                'user_id' => $_SESSION['user_id'],
                'room_type' => trim($_POST['room_type']),
                'check_in' => trim($_POST['check_in']),
                'check_out' => trim($_POST['check_out']),
                'guests' => trim($_POST['guests']),
                'room_type_err' => '',
                'check_in_err' => '',
                'check_out_err' => '',
                'guests_err' => ''
            ];

            // Validate room type
            if(empty($data['room_type'])) {
                $data['room_type_err'] = 'Please select a room type';
            }

            // Validate check-in date
            if(empty($data['check_in'])) {
                $data['check_in_err'] = 'Please enter check-in date';
            }

            // Validate check-out date
            if(empty($data['check_out'])) {
                $data['check_out_err'] = 'Please enter check-out date';
            }

            // Validate guests
            if(empty($data['guests'])) {
                $data['guests_err'] = 'Please enter number of guests';
            }

            // Make sure no errors
            if(empty($data['room_type_err']) && empty($data['check_in_err']) && 
               empty($data['check_out_err']) && empty($data['guests_err'])) {
                // Book the hotel
                if($this->hotelModel->bookHotel($data)) {
                    flash('booking_success', 'Hotel booked successfully');
                    redirect('hotels/view/' . $id);
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('hotels/book', $data);
            }
        } else {
            $hotel = $this->hotelModel->getHotelById($id);
            
            if(!$hotel) {
                redirect('hotels');
            }

            $data = [
                'title' => 'Book ' . $hotel->name,
                'hotel' => $hotel,
                'room_type' => '',
                'check_in' => '',
                'check_out' => '',
                'guests' => '',
                'room_type_err' => '',
                'check_in_err' => '',
                'check_out_err' => '',
                'guests_err' => ''
            ];

            $this->view('hotels/book', $data);
        }
    }
} 