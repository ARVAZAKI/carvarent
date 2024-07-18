@extends('layouts.app')
@section('title', 'Return Booking')
@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6 class="dark:text-white">Return Booking</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    <form method="POST" action="{{ route('admin.return.booking.post', $booking->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="distance_traveled" class="block text-sm font-medium text-slate-700 dark:text-white">Distance Traveled</label>
                            <input type="number" id="distance_traveled" name="distance_traveled" placeholder="Kilometers" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                        </div>
                        <div class="mb-4">
                            <label for="return_date" class="block text-sm font-medium text-slate-700 dark:text-white">Return Date</label>
                            <input type="date" id="return_date" name="return_date" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                        </div>
                        <div class="mb-4 flex justify-end">
                            <button type="submit" class="bg-gradient-to-tl from-emerald-500 to-teal-400 text-white px-4 py-2 rounded-lg">Return</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
