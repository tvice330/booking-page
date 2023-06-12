<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Seeder;

class BookingStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_names = [
                [
                    'status_name' => 'Очікує підтвердження',
                ],
                [
                    'status_name' => 'Успішно',
                ],
            ];

        foreach ($status_names as $status)
        BookingStatus::updateOrcreate($status,$status);
    }
}
