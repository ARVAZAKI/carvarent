@extends('layouts.app')
@section('title', 'Add Booking')
@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6 class="dark:text-white">Add Booking</h6>
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
                    <form method="POST" action="{{route('admin.store.booking')}}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-white">Tenant Name</label>
                            <input type="text" id="name" name="tenant_name" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                        </div>
                        <div class="mb-4">
                            <label for="vehicle_id" class="block text-sm font-medium text-slate-700 dark:text-white">Vehicle</label>
                            <select id="vehicle_id" name="vehicle_id" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                                <option value="">Choose Vehicle</option>
                              @foreach ($vehicles as $vehicle)
                              <option value="{{$vehicle->id}}">{{ $vehicle->vehicle_license }} - {{ $vehicle->name }}</option>
                              @endforeach
                              </select>
                        </div>
                        <div class="mb-4">
                            <label for="driver_id" class="block text-sm font-medium text-slate-700 dark:text-white">Driver</label>
                            <select id="driver_id" name="driver_id" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                                <option value="">Choose Driver</option>
                                @foreach ($drivers as $driver)
                                <option value="{{$driver->id}}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="approver_1" class="block text-sm font-medium text-slate-700 dark:text-white">Approver 1</label>
                            <select id="approver_1" name="approver_1" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                                <option value="">Choose Approver</option>
                              @foreach ($approvers as $approver)
                              <option value="{{$approver->id}}">{{ $approver->name }}</option>
                              @endforeach
                              </select>
                        </div>
                        <div class="mb-4">
                            <label for="approver_2" class="block text-sm font-medium text-slate-700 dark:text-white">Approver 2</label>
                            <select id="approver_2" name="approver_2" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                                <option value="">Choose Approver</option>
                                @foreach ($approvers as $approver)
                              <option value="{{$approver->id}}">{{ $approver->name }}</option>
                              @endforeach
                            </select>
                        </div>
                       
                        <div class="mb-4">
                              <label for="start_date" class="block text-sm font-medium text-slate-700 dark:text-white">Start Date</label>
                              <input type="date" id="start_date" name="start_date" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                          </div>
                        <div class="mb-4">
                              <label for="end_date" class="block text-sm font-medium text-slate-700 dark:text-white">End Date</label>
                              <input type="date" id="end_date" name="end_date" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500">
                          </div>
                        <div class="mb-4 flex justify-end">
                            <button type="submit" class="bg-gradient-to-tl from-emerald-500 to-teal-400 text-white px-4 py-2 rounded-lg">Add Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const approver1 = document.getElementById('approver_1');
    const approver2 = document.getElementById('approver_2');

    approver1.addEventListener('change', function () {
        const approver2Options = Array.from(approver2.options);
        approver2Options.forEach(option => {
            option.style.display = 'block';
        });

        if (approver1.value !== "") {
            const selectedValue = approver1.value;
            approver2Options.forEach(option => {
                if (option.value === selectedValue) {
                    option.style.display = 'none';
                }
            });
        }
    });

    approver2.addEventListener('change', function () {
        const approver1Options = Array.from(approver1.options);
        approver1Options.forEach(option => {
            option.style.display = 'block';
        });

        if (approver2.value !== "") {
            const selectedValue = approver2.value;
            approver1Options.forEach(option => {
                if (option.value === selectedValue) {
                    option.style.display = 'none';
                }
            });
        }
    });
});
</script>
@endsection
