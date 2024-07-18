<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportBooking implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::with(['vehicle', 'approvers', 'usage', 'driver', 'admin'])->get();
    }

    /**
     * Map the data for each row.
     *
     * @param mixed $booking
     * @return array
     */
    public function map($booking): array
    {
        return [
            $booking->id,
            optional($booking->vehicle)->name,
            $booking->approvers->pluck('name')->join(', '),
            optional($booking->driver)->name,
            optional($booking->admin)->name,
            $booking->status,
            $booking->start_date,
            $booking->end_date,
            optional($booking->usage)->return_date,
            optional($booking->usage)->distance_traveled,
        ];
    }

    /**
     * Define the headings for the columns.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Booking ID',
            'Vehicle Name',
            'Approvers',
            'Driver Name',
            'Admin Name',
            'Booking Status',
            'Start Date',
            'End Date',
            'Return Date',
            'Distance Traveled (KM)',
        ];
    }
}
