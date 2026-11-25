@extends('layouts.app')

@section('title', 'InvoiceMaker Blog | Invoicing Guides, Tips & Freelance Insights')
@section('meta_description', 'Read the InvoiceMaker Blog for practical guides, freelancing tips, small business accounting insights, and faster billing strategies.')

@section('content')
<div class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-8 pb-20 sm:pt-12 sm:pb-28 overflow-hidden">


        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white">
                Blog
            </h1>

        </div>



        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
            <svg class="relative block w-full h-10 sm:h-14 md:h-20 text-white" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,45 C320,115 520,10 880,75 C1120,115 1320,50 1440,40 L1440,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>



    <div class="bg-white text-slate-700 py-12 lg:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                    Latest Articles
                </h2>
                <span class="text-xs sm:text-sm font-medium text-slate-500">3 articles</span>
            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <article class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col">
                    <a href="{{ route('blog.invoice-vs-receipt') }}" class="block relative aspect-video sm:aspect-[16/10] overflow-hidden bg-slate-100 border-b border-slate-100">
                        <picture>
                            <source srcset="{{ asset('images/blog/blog_3_cover.webp') }}" type="image/webp">
                            <img
                                src="{{ asset('images/blog/blog_3_cover.png') }}"
                                alt="Invoice vs Receipt: Key differences illustrated with pending invoice and paid receipt."
                                class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300 ease-out"
                                loading="lazy"
                                decoding="async"
                            >
                        </picture>
                    </a>

                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    October 28, 2026
                                </span>
                                <span>•</span>
                                <span>5 min read</span>
                            </div>

                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-slate-700 transition-colors leading-snug tracking-tight mb-2.5">
                                <a href="{{ route('blog.invoice-vs-receipt') }}">
                                    Invoice vs Receipt: Key Differences Explained
                                </a>
                            </h3>

                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                                Learn the fundamental differences between an invoice and a receipt. Understand when to send which document, what to include, and tax rules.
                            </p>
                        </div>
                    </div>
                </article>



                <article class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col">


                    <a href="{{ route('blog.what-is-an-invoice') }}" class="block relative aspect-video sm:aspect-[16/10] overflow-hidden bg-slate-100 border-b border-slate-100">
                        <picture>
                            <source srcset="{{ asset('images/blog/blog_2_cover.webp') }}" type="image/webp">
                            <img
                                src="{{ asset('images/blog/blog_2_cover.png') }}"
                                alt="Person holding an invoice beside a calculator under the heading “What Is an Invoice.”"
                                class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300 ease-out"
                                loading="lazy"
                                decoding="async"
                            >
                        </picture>
                    </a>



                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>


                            <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    October 21, 2026
                                </span>
                                <span>•</span>
                                <span>4 min read</span>
                            </div>



                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-slate-700 transition-colors leading-snug tracking-tight mb-2.5">
                                <a href="{{ route('blog.what-is-an-invoice') }}">
                                    What Is an Invoice? A Simple Guide for Beginners
                                </a>
                            </h3>



                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                                Learn what an invoice is, what to include, and how it differs from a receipt or quote. See a simple example and create your own invoice for free.
                            </p>
                        </div>
                    </div>
                </article>



                <article class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col">


                    <a href="{{ route('blog.post') }}" class="block relative aspect-video sm:aspect-[16/10] overflow-hidden bg-slate-100 border-b border-slate-100">
                        <picture>
                            <source srcset="{{ asset('images/blog/blog_1_cover.webp') }}" type="image/webp">
                            <img
                                src="{{ asset('images/blog/blog_1_cover.png') }}"
                                alt="Invoice illustration beside the title “How to Create an Invoice Online for Free.”"
                                class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300 ease-out"
                                loading="lazy"
                                decoding="async"
                            >
                        </picture>
                    </a>



                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>



                            <div class="flex items-center gap-3 text-xs text-slate-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    October 21, 2026
                                </span>
                                <span>•</span>
                                <span>5 min read</span>
                            </div>



                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-slate-700 transition-colors leading-snug tracking-tight mb-2.5">
                                <a href="{{ route('blog.post') }}">
                                    How to Create an Invoice Online for Free
                                </a>
                            </h3>



                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                                Learn how to easily create professional invoices online with InvoiceMaker.tech. Follow our complete step-by-step guide with checklists, templates, and best practices.
                            </p>
                        </div>
                    </div>
                </article>

            </div>

        </div>
    </div>

</div>
@endsection
