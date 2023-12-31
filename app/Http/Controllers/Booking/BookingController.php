<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Services\Booking\BookingService;
use App\Models\BookingRow;
use Illuminate\Http\Request;

class BookingController extends Controller
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

    public function getHomePage()
    {
        $bookings_info = $this->bookingService->getBookingInfo();
        $booking_dates = $this->bookingService->getBookingDates();

        return view('front.main_page',compact('bookings_info','booking_dates'));
    }

    /**
     * @param CreateBookingRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|null
     */
    public function createBookingRow(CreateBookingRequest  $request)
    {
        $request->validated();
        return $this->bookingService->setBookingRow($request);
    }

    /**
     * @param BookingRow $bookingRow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyBookingRow(BookingRow $bookingRow) {
        return $this->bookingService->deleteBookingRow($bookingRow);
    }
}
