<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Free Online Invoice Maker | Create & Download PDFs Fast')</title>
    <meta name="description" content="@yield('meta_description', 'Create professional invoices in seconds with InvoiceMaker. 100% free, no sign-up needed. Customize & download instant PDFs today!')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('title', 'Free Online Invoice Maker | Create & Download PDFs Fast')">
    <meta property="og:description" content="@yield('meta_description', 'Create professional invoices in seconds with InvoiceMaker. 100% free, no sign-up needed. Customize & download instant PDFs today!')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="InvoiceMaker">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('canonical', url()->current())">
    <meta name="twitter:title" content="@yield('title', 'Free Online Invoice Maker | Create & Download PDFs Fast')">
    <meta name="twitter:description" content="@yield('meta_description', 'Create professional invoices in seconds with InvoiceMaker. 100% free, no sign-up needed. Customize & download instant PDFs today!')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => url('/') . '/#organization',
                'name' => 'InvoiceMaker',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '/#website',
                'url' => url('/'),
                'name' => 'InvoiceMaker',
                'description' => '100% Free Online Invoice Maker & PDF Generator',
                'publisher' => [
                    '@id' => url('/') . '/#organization',
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @yield('structured_data')

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="preload" as="image" href="{{ asset('images/logo.png') }}" fetchpriority="high">
    <link rel="preload" href="{{ asset('fonts/limerick-serial-regular.ttf') }}" as="font" type="font/ttf" crossorigin>

    @vite(['resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&family=JetBrains+Mono:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&family=JetBrains+Mono:wght@400;500&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&family=JetBrains+Mono:wght@400;500&display=swap">
    </noscript>

    <style>
        @font-face {
            font-family: 'Limerick Serial';
            src: url('{{ asset("fonts/limerick-serial-regular.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        body {
            font-family: 'Limerick Serial', 'Instrument Sans', 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        }</style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Limerick Serial"', '"Instrument Sans"', '"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e', // User's requested light green
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        } </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* Hide native spinner arrows on numeric inputs */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Print styles: hide non-printable UI, boxes, and optimize page format */
        @media print {
            html, body {
                background: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print, header, footer, .btn-group, .editor-controls, .alert-box, [x-cloak] {
                display: none !important;
            }
            main, .min-h-screen, .max-w-7xl, .mx-auto {
                padding: 0 !important;
                margin: 0 auto !important;
                background: #ffffff !important;
            }
            .invoice-printable-card {
                box-shadow: none !important;
                border: none !important;
                width: 100% !important;
                max-width: 800px !important;
                margin: 0 auto !important;
                padding: 10mm 12mm !important;
            }
            .invoice-printable-card input,
            .invoice-printable-card textarea,
            .invoice-printable-card select {
                border: none !important;
                border-color: transparent !important;
                background-color: transparent !important;
                box-shadow: none !important;
                outline: none !important;
                resize: none !important;
            }
            .invoice-printable-card input::placeholder,
            .invoice-printable-card textarea::placeholder {
                color: transparent !important;
                opacity: 0 !important;
            }
            .invoice-printable-card input::-webkit-calendar-picker-indicator,
            .invoice-printable-card input::-webkit-inner-spin-button,
            .invoice-printable-card input::-webkit-outer-spin-button {
                display: none !important;
                -webkit-appearance: none !important;
                margin: 0 !important;
            }
            .invoice-printable-card input[type=number] {
                -moz-appearance: textfield;
            }
            .invoice-printable-card .logo-box-border,
            .invoice-printable-card .tax-box-border {
                border: none !important;
                box-shadow: none !important;
            }
            .error-highlight, [x-show*="activeError"] {
                border-color: transparent !important;
                box-shadow: none !important;
                display: none !important;
            }
            @page {
                margin: 0 !important;
                size: A4 portrait;
            }
        }


        .is-exporting .no-print,
        .is-exporting .export-hide {
            display: none !important;
        }


        .btn-green-light {
            background-color: #2A373D;
            color: #ffffff;
            transition: all 0.2s ease-in-out;
        }
        .btn-green-light:hover {
            background-color: #1e272b;
            box-shadow: 0 4px 14px 0 rgba(42, 55, 61, 0.3);
            transform: translateY(-1px);
        }
        .btn-green-light:active {
            transform: translateY(0);
        }

        .btn-green-outline {
            border: 1.5px solid #2A373D;
            color: #2A373D;
            background-color: #ffffff;
            transition: all 0.2s ease-in-out;
        }
        .btn-green-outline:hover {
            background-color: #f1f5f9;
            border-color: #1e272b;
            color: #1e272b;
        }


        .navbar-capsule {
            transition: max-width 0.45s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.35s ease,
                        padding 0.3s ease;
        }
        .navbar-inner-capsule {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-slate-50 text-slate-800 antialiased font-sans">


    @php
        $isHomePage = request()->routeIs('home');
        $isDarkTopPage = request()->routeIs('how-it-works') ||
                         request()->routeIs('privacy') ||
                         request()->routeIs('templates*') ||
                         request()->routeIs('about') ||
                         request()->routeIs('contact') ||
                         request()->routeIs('faqs') ||
                         request()->routeIs('invoice.builder') ||
                         request()->routeIs('blog*');
    @endphp

    @if($isDarkTopPage)
        <header class="no-print relative z-50 w-full bg-[#2A373D] pt-3 sm:pt-4 pb-2"
                x-data="{ mobileMenuOpen: false }">
            <div class="max-w-4xl mx-auto px-3 sm:px-6">
                <div class="bg-white/90 backdrop-blur-xl border border-white/80 rounded-full flex items-center justify-between px-3.5 py-2 sm:px-5 sm:py-2.5 shadow-[0_8px_30px_rgb(0,0,0,0.08)]">

                    <a href="{{ route('home') }}" class="flex items-center gap-3 sm:gap-3.5 group shrink-0 select-none">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="InvoiceMaker logo"
                             width="36"
                             height="36"
                             fetchpriority="high"
                             class="w-8 h-8 sm:w-9 sm:h-9 object-contain group-hover:scale-105 transition-transform drop-shadow-xs">
                        <span class="text-base sm:text-lg font-bold tracking-tight text-slate-900 group-hover:text-slate-600 transition-colors whitespace-nowrap">
                            invoicemaker
                        </span>
                    </a>

                    <nav class="hidden md:flex items-center gap-1 sm:gap-2 whitespace-nowrap mx-2">
                        <a href="{{ route('templates') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('templates*') ? 'text-slate-950 font-bold bg-slate-100/80' : 'text-slate-600 hover:text-slate-950' }}">Templates</a>
                        <a href="{{ route('how-it-works') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('how-it-works') ? 'text-slate-950 font-bold bg-slate-100/80' : 'text-slate-600 hover:text-slate-950' }}">How it Works</a>
                        <a href="{{ route('blog') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('blog*') ? 'text-slate-950 font-bold bg-slate-100/80' : 'text-slate-600 hover:text-slate-950' }}">Blogs</a>
                        <a href="{{ route('about') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-slate-950 font-bold bg-slate-100/80' : 'text-slate-600 hover:text-slate-950' }}">About</a>
                        <a href="{{ route('privacy') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors {{ request()->routeIs('privacy') ? 'text-slate-950 font-bold bg-slate-100/80' : 'text-slate-600 hover:text-slate-950' }}">Privacy</a>
                    </nav>

                    <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
                        <a href="{{ route('invoice.builder') }}"
                           style="background-color: #2A373D;"
                           class="hover:brightness-110 text-white px-5 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-semibold inline-flex items-center gap-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <span>Create</span>
                        </a>

                        <button type="button"
                                @click="mobileMenuOpen = !mobileMenuOpen"
                                class="md:hidden p-1.5 rounded-full text-slate-600 hover:text-slate-950 hover:bg-slate-100 focus:outline-hidden"
                                aria-label="Toggle menu">
                            <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div x-show="mobileMenuOpen"
                     x-cloak
                     @click.away="mobileMenuOpen = false"
                     class="md:hidden mt-2 bg-white/95 backdrop-blur-xl border border-white/80 shadow-xl rounded-2xl p-4 space-y-1.5 transition-all">
                    <a href="{{ route('templates') }}" class="block px-3 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('templates*') ? 'bg-slate-100 text-slate-950 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Templates</a>
                    <a href="{{ route('how-it-works') }}" class="block px-3 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('how-it-works') ? 'bg-slate-100 text-slate-950 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">How it Works</a>
                    <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('blog*') ? 'bg-slate-100 text-slate-950 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Blogs</a>
                    <a href="{{ route('about') }}" class="block px-3 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('about') ? 'bg-slate-100 text-slate-950 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">About</a>
                    <a href="{{ route('privacy') }}" class="block px-3 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('privacy') ? 'bg-slate-100 text-slate-950 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">Privacy</a>
                </div>
            </div>
        </header>
    @elseif($isHomePage)
        <header class="no-print sticky top-3 sm:top-4 navbar-capsule z-50 px-3 sm:px-6 w-full mx-auto"
                x-data="{
                    scrolled: false,
                    isHovered: false,
                    mobileMenuOpen: false,
                    isDesktop: window.innerWidth >= 768,
                    isHome: true,
                    get isCompact() {
                        return this.isHome && this.isDesktop && this.scrolled && !this.isHovered;
                    }
                }"
                x-init="
                    window.addEventListener('resize', () => { isDesktop = window.innerWidth >= 768 });
                    window.addEventListener('scroll', () => {
                        scrolled = (window.pageYOffset || document.documentElement.scrollTop) > 40;
                    }, { passive: true });
                    scrolled = (window.pageYOffset || document.documentElement.scrollTop) > 40;
                "
                @mouseenter="isHovered = true"
                @mouseleave="isHovered = false"
                :class="isCompact ? 'max-w-[260px]' : 'max-w-4xl'">

            <div class="navbar-inner-capsule bg-white/90 backdrop-blur-xl border border-white/80 rounded-full flex items-center overflow-hidden transition-all duration-400"
                 :class="isCompact
                     ? 'justify-center px-6 py-2.5 sm:px-7 sm:py-2.5 shadow-[0_12px_32px_rgba(0,0,0,0.14)] cursor-pointer ring-1 ring-slate-900/5'
                     : 'justify-between px-3.5 py-2 sm:px-5 sm:py-2.5 shadow-[0_8px_30px_rgb(0,0,0,0.08)]'">

                <a href="{{ route('home') }}" class="flex items-center gap-3 sm:gap-3.5 group shrink-0 select-none">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="InvoiceMaker logo"
                         width="36"
                         height="36"
                         fetchpriority="high"
                         class="w-8 h-8 sm:w-9 sm:h-9 object-contain group-hover:scale-105 transition-transform drop-shadow-xs">
                    <span class="text-base sm:text-lg font-bold tracking-tight text-slate-900 group-hover:text-slate-600 transition-colors whitespace-nowrap">
                        invoicemaker
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-1 sm:gap-2 whitespace-nowrap transition-all duration-300"
                     :class="isCompact
                         ? 'opacity-0 max-w-0 pointer-events-none scale-95 overflow-hidden m-0 p-0'
                         : 'opacity-100 max-w-xl pointer-events-auto scale-100 delay-75 mx-2'">
                    <a href="{{ route('templates') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">Templates</a>
                    <a href="{{ route('how-it-works') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">How it Works</a>
                    <a href="{{ route('blog') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">Blogs</a>
                    <a href="{{ route('about') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">About</a>
                    <a href="{{ route('privacy') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">Privacy</a>
                </nav>

                <div class="flex items-center gap-2 shrink-0 whitespace-nowrap transition-all duration-300"
                     :class="isCompact
                         ? 'opacity-0 max-w-0 pointer-events-none scale-95 overflow-hidden m-0 p-0'
                         : 'opacity-100 max-w-xs pointer-events-auto scale-100 delay-75'">
                    <a href="{{ route('invoice.builder') }}"
                       style="background-color: #2A373D;"
                       class="hover:brightness-110 text-white px-5 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-semibold inline-flex items-center gap-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <span>Create</span>
                    </a>

                    <button type="button"
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="md:hidden p-1.5 rounded-full text-slate-600 hover:text-slate-950 hover:bg-slate-100 focus:outline-hidden"
                            aria-label="Toggle menu">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileMenuOpen"
                 x-cloak
                 @click.away="mobileMenuOpen = false"
                 class="md:hidden mt-2 bg-white/95 backdrop-blur-xl border border-white/80 shadow-xl rounded-2xl p-4 space-y-1.5 transition-all">
                <a href="{{ route('templates') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Templates</a>
                <a href="{{ route('how-it-works') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">How it Works</a>
                <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Blogs</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">About</a>
                <a href="{{ route('privacy') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Privacy</a>
            </div>
        </header>
    @else
        <header class="no-print relative z-50 w-full bg-white pt-4 pb-2"
                x-data="{ mobileMenuOpen: false }">
            <div class="max-w-4xl mx-auto px-3 sm:px-6">
                <div class="bg-white border border-slate-300 sm:border-slate-400/80 rounded-full flex items-center justify-between px-3.5 py-2 sm:px-5 sm:py-2.5 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 sm:gap-3.5 group shrink-0 select-none">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="InvoiceMaker logo"
                             width="36"
                             height="36"
                             fetchpriority="high"
                             class="w-8 h-8 sm:w-9 sm:h-9 object-contain group-hover:scale-105 transition-transform drop-shadow-xs">
                        <span class="text-base sm:text-lg font-bold tracking-tight text-slate-900 group-hover:text-slate-600 transition-colors whitespace-nowrap">
                            invoicemaker
                        </span>
                    </a>

                    <nav class="hidden md:flex items-center gap-1 sm:gap-2 whitespace-nowrap mx-2">
                        <a href="{{ route('templates') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">Templates</a>
                        <a href="{{ route('how-it-works') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">How it Works</a>
                        <a href="{{ route('blog') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">Blogs</a>
                        <a href="{{ route('about') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">About</a>
                        <a href="{{ route('privacy') }}" class="px-3 py-1 rounded-full text-xs sm:text-sm font-medium transition-colors text-slate-600 hover:text-slate-950">Privacy</a>
                    </nav>

                    <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
                        <a href="{{ route('invoice.builder') }}"
                           style="background-color: #2A373D;"
                           class="hover:brightness-110 text-white px-5 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-semibold inline-flex items-center gap-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <span>Create</span>
                        </a>

                        <button type="button"
                                @click="mobileMenuOpen = !mobileMenuOpen"
                                class="md:hidden p-1.5 rounded-full text-slate-600 hover:text-slate-950 hover:bg-slate-100 focus:outline-hidden"
                                aria-label="Toggle menu">
                            <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div x-show="mobileMenuOpen"
                     x-cloak
                     @click.away="mobileMenuOpen = false"
                     class="md:hidden mt-2 bg-white/95 backdrop-blur-xl border border-slate-300 sm:border-slate-400/80 shadow-xl rounded-2xl p-4 space-y-1.5 transition-all">
                    <a href="{{ route('templates') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Templates</a>
                    <a href="{{ route('how-it-works') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">How it Works</a>
                    <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Blogs</a>
                    <a href="{{ route('about') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">About</a>
                    <a href="{{ route('privacy') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50">Privacy</a>
                </div>
            </div>
        </header>
    @endif

    @if(session('success'))
        <div class="no-print max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-brand-50 border border-brand-300 text-brand-900 px-4 py-3 rounded-xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-brand-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="no-print bg-white border-t border-slate-200 text-slate-600 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-8">

                <div class="lg:col-span-2 space-y-3.5">
                    <a href="{{ route('home') }}" class="inline-block group">
                        <span class="text-2xl font-extrabold tracking-tight text-slate-900 group-hover:text-slate-600 transition-colors">
                            invoicemaker
                        </span>
                    </a>

                    <p class="text-sm text-slate-500 leading-relaxed max-w-sm">
                        Create invoices online for free—edit a ready-made template or design your own from scratch.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:col-span-3 gap-8 sm:gap-10">

                    <div>
                        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-4">
                            Quick Links
                        </h3>
                        <ul class="space-y-2.5 text-sm">
                            <li>
                                <a href="{{ route('templates') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Free Templates
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('how-it-works') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    How It Works
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Create Invoice
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('invoice.builder') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Build your custom invoice
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blog') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-4">
                            Templates
                        </h3>
                        <ul class="space-y-2.5 text-sm">
                            <li>
                                <a href="{{ route('templates.customize', 'modern') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Everyday
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('templates.customize', 'classic') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Standard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('templates.customize', 'freelancer') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Studio
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('templates.customize', 'wave') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Mint
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-4">
                            Company
                        </h3>
                        <ul class="space-y-2.5 text-sm">
                            <li>
                                <a href="{{ route('about') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Contact us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('privacy') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('faqs') }}" class="text-slate-600 hover:text-slate-950 transition-colors">
                                    FAQs
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6">
                <div class="select-none">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="InvoiceMaker brand mark"
                         loading="lazy"
                         width="144"
                         height="144"
                         class="h-24 w-auto sm:h-32 md:h-36 object-contain drop-shadow-sm opacity-95 hover:opacity-100 transition-opacity">
                </div>

                <div class="text-left sm:text-right space-y-1 text-xs text-slate-600">
                    <p class="font-medium text-slate-600">
                        InvoiceMaker &copy; {{ date('Y') }}
                    </p>
                    <div class="flex items-center gap-3 text-slate-600">
                        <a href="{{ route('about') }}" class="hover:text-slate-950 transition-colors">About</a>
                        <span>&bull;</span>
                        <a href="{{ route('privacy') }}" class="hover:text-slate-950 transition-colors">Privacy</a>
                        <span>&bull;</span>
                        <a href="{{ route('contact') }}" class="hover:text-slate-950 transition-colors">Contact</a>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    @stack('scripts')
</body>
</html>
