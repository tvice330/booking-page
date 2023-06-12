<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Services\Booking\BookingService;
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

    /**
     * @param Request $request
     * @return null
     */
    public function getBookingDates(Request  $request)
    {
        return $this->bookingService->getBookingDates($request);
    }

    /**
     * @param CreateBookingRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|null
     */
    public function createBookingRow(CreateBookingRequest  $request)
    {
        return $this->bookingService->setBookingRow($request);
    }
}
