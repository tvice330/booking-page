<?php

namespace App\Http\Services\Booking;

use App\Models\BookingRow;
use App\Models\BookingStatus;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class BookingService
{
    public function getBookingApplications(Request $request)
    {
        if ($request->ajax()) {
            $model = BookingRow::query()->select(
                'booking_rows.id',
                'booking_rows.arrival_date',
                'booking_rows.departure_date',
                'booking_statuses.status_name'
                )
                ->join('booking_statuses', function ($join) {
                    $join->on('booking_rows.status_id', '=', 'booking_statuses.id');
                });

            return Datatables::of($model)
                ->filter(function ($query) use ($request) {
                    if (!empty($request->get('search'))) {
                        $query->where(function($instance) use($request){
                            $search = $request->get('search');
                            $instance->orWhere('bocking_rows.id', 'LIKE', "%$search%")
                                ->orWhere('bocking_rows.arrival_date', 'LIKE', "%$search%")
                                ->orWhere('bocking_rows.departure_date', 'LIKE', "%$search%")
                                ->orWhere('booking_statuses.status_name', 'LIKE', "%$search%");
                        });
                    }
                    if ($request->has('filter_region') && $request->get('filter_region')) {
                        $query->where('shelters.region_id', $request->get('filter_region'));
                    }
                    if ($request->has('filter_category') && $request->get('filter_category')) {
                        $query->where('shelters.category_id', $request->get('filter_category'));
                    }
                })
                ->addIndexColumn()
                ->editColumn('arrival_date', function($row) {
                    return Carbon::parse($row->arrival_date)->translatedFormat('d F Y') ?? '-';
                })
                ->editColumn('departure_date', function($row) {
                    return Carbon::parse($row->departure_date)->translatedFormat('d F Y') ?? '-';
                })
                ->addColumn('actions', function($row) {
                    return view('admin.booking.actions', compact("row"))->render();
                })
                ->rawColumns(['actions'])
                ->order(function ($query) use ($request){
                    $columnName = $request->input('columns.'.$request->input('order.0.column').'.data');
                    $query->orderBy($columnName, $request->input('order.0.dir'));
                })
                ->make(true);
        }

        return view('admin.booking.index');
    }

    public function getBookingInfo()
    {
        return BookingRow::query()->select(
            'booking_rows.id',
            'booking_rows.arrival_date',
            'booking_rows.departure_date',
            'booking_statuses.status_name'
        )
            ->join('booking_statuses', function ($join) {
                $join->on('booking_rows.status_id', '=', 'booking_statuses.id');
            })->orderBy('arrival_date','ASC')->get();
    }
    public function getBookingDates() {
        $filled_all_booking_dates = [];
        $booking_dates = BookingRow::query()
            ->select('arrival_date','departure_date')
            ->whereDate('arrival_date','>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('arrival_date','ASC')
            ->get();

        foreach ($booking_dates as $dates) {
            $filled_all_booking_dates = array_merge($filled_all_booking_dates, $this->fillDepartureDays($dates));
        }

        return $this->fillAvailableDates(Carbon::now()->format('Y-m-d'),Carbon::now()->endOfYear()->format('Y-m-d') ,$filled_all_booking_dates);
    }

    public function setBookingRow($request) {
        $response = [
            'errors' => [
                'system' => [__('Помилка на сервері')]
            ],
        ];

        $data = $request->safe()->all();

        $data['status_id'] = $this->getStatusId(false);

        try {

            if (BookingRow::create($data)) {
                $response = ['success' => 'Запис на бронювання створенно, очікуйте підтвердження адміністратора'];
                return redirect()->back()->with($response);
            }
        }
        catch (\Exception $exception) {
            Log::error('BookingRow; Error: '.$exception->getMessage());
            return response()->json($response, 500);
        }
    }

    public function acceptBookingRow(BookingRow $bookingRow)
    {
        BookingRow::query()
            ->where('id','=', $bookingRow)
            ->update(['status_id' => BookingStatus::query()
                ->where('status_name','=',$this->getStatusId(true))
                ->first()->id]);

        $response = ['success' => 'Запис на бронювання видаленно'];
        return redirect()->back()->with($response);
    }

    public function deleteBookingRow(BookingRow $bookingRow)
    {
        BookingRow::query()
            ->where('id','=', $bookingRow)
            ->delete();

        $response = ['success' => 'Запис на бронювання видаленно'];
        return redirect()->back()->with($response);
    }

    private function fillDepartureDays(object $dates)
    {
        $filled_dates = [];

        $begin_date = Carbon::parse($dates->arrival_date);
        $end_date = Carbon::parse($dates->departure_date);

        if (Carbon::parse($begin_date)->diffInDays($end_date) > 0) {
            $interval = new CarbonInterval('P1D');
            $dateRange = new CarbonPeriod($begin_date, $interval, $end_date);

            foreach ($dateRange as $date)
            {
                $filled_dates[] = $date->format('Y-m-d');
            }
        }

        return $filled_dates;
    }

    private function fillAvailableDates(string $start_date,string $endDates,array $filled_dates)
    {
        $available_dates = [];
        $filled_dates = array_values($filled_dates);
        $begin_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($endDates);

        if (Carbon::parse($begin_date)->diffInDays($end_date) > 0) {
            $interval = new CarbonInterval('P1D');
            $dateRange = new CarbonPeriod($begin_date, $interval, $end_date);

            foreach ($dateRange as $date)
            {
                if (!in_array($date->format('Y-m-d'),$filled_dates)){
                $available_dates[] = $date->format('Y-m-d');
                }

            }
        }

        return $available_dates;
    }

    private function getStatusId(bool $success)
    {
        return BookingStatus::query()
            ->where('status_name','=',$success === true ? BookingStatus::SUCCESS_STATUS : BookingStatus::PENDING_STATUS)
            ->first()->id;
    }

}
