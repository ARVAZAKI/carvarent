@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="flex flex-wrap -mx-3 min-h-screen">
    <div class="flex-none w-full max-w-full px-3">
        <div class="my-4 relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <div class="p-4 sm:p-6 md:p-8">
                        <h1>Vehicle Usage</h1>
                        {!! $chart->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
