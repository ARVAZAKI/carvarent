@extends('layouts.app')
@section('title', 'dashboard')
@section('content')
<div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
          <div class="my-4 relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                  <h6 class="dark:text-white">Pending Bookings Table</h6>
              </div>
              <div class="flex-auto px-0 pt-0 pb-2">
                  <div class="p-0 overflow-x-auto">
                      <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                          <thead class="align-bottom">
                              <tr>
                                  <th class="px-6 py-3 font-bold text-left uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Name</th>
                                  <th class="px-6 py-3 font-bold text-left uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Vehicle</th>
                                  <th class="px-6 py-3 font-bold text-center uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white text-xxs tracking-wider text-slate-400 opacity-70">Vehicle License</th>
                                  <th class="px-6 py-3 font-semibold uppercase align-middle border-b border-solid dark:border-white/40 dark:text-white tracking-wider text-slate-400 opacity-70"></th>
                              </tr>
                          </thead>
                          <tbody>
                          </thead>
                          <tbody>
                              @foreach ($bookings as $p)
                              <tr>
                                  <td class="px-6 flex py-2 align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                      <div class="flex items-center">
                                          <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $p->tenant_name }}</h6>
                                      </div>
                                  </td>
                                  <td class="px-6 py-2 align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                      <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $p->vehicle->name }}</p>
                                  </td>
                                  <td class="px-6 py-2 align-middle text-center border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                      <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">{{ $p->vehicle->vehicle_license }}</p>
                                  </td>
                                  <td class="px-6 py-2 align-middle border-b border-solid dark:border-white/40 whitespace-nowrap shadow-transparent">
                                      <a href="{{route('approver.detail.booking', $p->id)}}" class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">Detail</a>
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