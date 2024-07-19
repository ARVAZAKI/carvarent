@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="flex flex-wrap -mx-3 min-h-screen">
    <div class="flex-none w-full max-w-full px-3">
        <div class="my-4 relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6 class="dark:text-white">Detail Booking, id: {{ $booking->id }}</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <div class="p-4 sm:p-6 md:p-8">
                        <div class="flex flex-col md:flex-row items-center mb-4">
                            <img src="{{ asset('storage/vehicle/' . $booking->vehicle->image) }}" class="h-32 w-32 object-cover rounded-lg md:mr-6" alt="foto kendaraan">
                            <div class="mt-4 md:mt-0">
                                <p class="text-lg font-semibold">Vehicle Name: {{ $booking->vehicle->name }}</p>
                                <p class="text-md text-gray-600">Vehicle License: {{ $booking->vehicle->vehicle_license }}</p>
                            </div>
                        </div>
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-lg font-semibold">Tenant: {{ $booking->tenant_name }}</p>
                            </div>
                            <div>
                                <p class="text-lg font-semibold">Driver: {{ $booking->driver->name }}</p>
                                <p class="text-md text-gray-600">License Number: {{ $booking->driver->license_number }}</p>
                            </div>
                            <div>
                                <p class="text-lg font-semibold">Admin: {{ $booking->admin->name }}</p>
                            </div>
                            <div>
                              <p class="text-lg font-semibold">Approvers: </p>
                              @foreach ($booking->approvers as $item)
                              <p class="text-md text-gray-600">Name: {{ $item->name }}</p>
                              @endforeach
                            </div>
                            <div>
                            <p class="text-lg font-semibold">Start Date: {{ $booking->start_date }}</p>
                            <p class="text-lg font-semibold">End Date: {{ $booking->end_date }}</p>
                            <p class="text-lg font-semibold">Return Date: {{ $booking->usage->return_date }}</p>
                              <p class="text-lg font-semibold">Distance Traveled: {{ $booking->usage->distance_traveled }} KM</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
