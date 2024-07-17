@extends('layouts.app')
@section('title', 'Driver')
@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6 class="dark:text-white">Drivers Table</h6>
                <a href="{{route('admin.add.driver')}}" class="bg-gradient-to-tl from-emerald-500 to-teal-400 text-white px-4 py-1 rounded-lg">Add Driver</a>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Driver Name</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Licence Number</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $item)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div>
                                            <img src="data:image/png;base64,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" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $item->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $item->license_number }}</p>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $item->status }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                    <a href="{{ route('admin.delete.driver', $item->id) }}" class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
