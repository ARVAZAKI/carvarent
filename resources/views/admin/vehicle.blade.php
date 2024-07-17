@extends('layouts.app')
@section('title', 'Vehicle')
@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6 class="dark:text-white">Vehicles Table</h6>
                <a href="{{ route('admin.add.vehicle') }}" class="bg-gradient-to-tl from-emerald-500 to-teal-400 text-white px-4 py-1 rounded-lg">Add Vehicle</a>
            </div>
            <div class="flex items-center justify-between px-6 py-3">
                <form action="{{ route('admin.search.vehicle') }}" method="GET" class="mb-4">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search vehicles" class="block w-full pl-12 pr-3 py-2 border-2 border-gray-300 rounded-full focus:outline-none focus:border-emerald-500 text-sm dark:bg-slate-950 dark:border-white/40 dark:text-white" />
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-6a8 8 0 1 0-16 0 8 8 0 0 0 16 0z"></path>
                            </svg>
                        </span>
                    </div>
                </form>
                
            </div>
            <div class="overflow-x-auto">
                <table class="w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="bg-transparent">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Name</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Type</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Vehicle License</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Status</th>
                            <th class="px-6 py-3 font-semibold uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white tracking-wider text-slate-400 opacity-70"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $item)
                        <tr>
                            <td class="px-6 flex py-2 align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <div>
                                    <img src="{{ asset('storage/vehicle/' . $item->image) }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-12 w-12 rounded-xl" alt="user1" />
                                </div>
                                <div class="flex items-center">
                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $item->name }}</h6>
                                </div>
                            </td>
                            <td class="px-6 py-2 align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $item->type }}</p>
                            </td>
                            <td class="px-6 py-2 align-middle text-center border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $item->vehicle_license }}</p>
                            </td>
                            <td class="px-6 py-2 text-center align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $item->status }}</p>
                            </td>
                            <td class="px-6 py-2 align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <a href="{{route('admin.delete.vehicle' , $item->id)}}" class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
