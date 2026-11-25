@extends('layouts.app')

@section('title', '404 - Page Not Found | InvoiceMaker')
@section('meta_description', 'The page you are looking for could not be found on InvoiceMaker.tech.')
@section('meta_robots', 'noindex, follow')

@section('content')
<div class="w-full bg-white flex flex-col items-center justify-center py-20 sm:py-28 px-4 sm:px-6">
    <div class="max-w-md mx-auto text-center">
        <h1 class="text-7xl sm:text-9xl md:text-[10rem] font-black tracking-tight text-[#2A373D] leading-none select-none">
            404</h1>

        <h2 class="mt-4 text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
            Page Not Found</h2>

        <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
            Sorry, we couldn’t find the page you’re looking for. It might have been moved or doesn’t exist anymore.</p>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('home') }}"
               style="background-color: #2A373D;"
               class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 rounded-full text-sm font-semibold text-white hover:brightness-110 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-sm">
                Visit Homepage
            </a>
            <a href="{{ route('templates') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 rounded-full text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                Browse Templates
            </a>
        </div>
    </div>
</div>
@endsection
