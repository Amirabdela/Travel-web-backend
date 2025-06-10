<?php// Sample test case using PHPUnit
public function testBookingCreation() {
$_POST = [
'booking_type' => 'hotel',
'item_id' => 1,
'start_date' => '2023-12-01',
'end_date' => '2023-12-10'
];

$controller = new Bookings();
$controller->create();

$this->assertNotEmpty($this->bookingModel->getLastBooking());
}?>