<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Http\Services\Booking\BookingService;
use App\Models\BookingRow;
use Illuminate\Http\Request;

class BookingManageController extends Controller
{
    /**
     * @var BookingService
     */
    private $bookingService;

    /**
     * @param BookingService $bookingService
     */
    public function __construct(
        BookingService $bookingService
    )
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request  $request)
    {
        return $this->bookingService->getBookingApplications($request);
    }

    /**
     * @param BookingRow $bookingRow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptBookingRow(BookingRow $bookingRow) {
        return $this->bookingService->acceptBookingRow($bookingRow);
    }

    /**
     * @param BookingRow $bookingRow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyBookingRow(BookingRow $bookingRow) {
        return $this->bookingService->deleteBookingRow($bookingRow);
    }
}
