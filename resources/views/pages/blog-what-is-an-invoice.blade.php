@extends('layouts.app')

@section('title', 'What Is an Invoice? A Complete Beginner\'s Guide | InvoiceMaker')
@section('meta_description', 'What is an invoice? Read our simple beginner\'s guide to learn how invoices work, key elements to include, and how to get paid faster.')
@section('canonical', url('/blog/what-is-an-invoice'))
@section('og_type', 'article')
@section('og_image', asset('images/blog/blog_2_cover.webp'))

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => 'What Is an Invoice? A Complete Beginner\'s Guide',
    'description' => 'What is an invoice? Read our simple beginner\'s guide to learn how invoices work, key elements to include, and how to get paid faster.',
    'image' => asset('images/blog/blog_2_cover.webp'),
    'author' => [
        '@type' => 'Organization',
        'name' => 'InvoiceMaker Team',
        'url' => url('/'),
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'InvoiceMaker',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('images/logo.png'),
        ],
    ],
    'datePublished' => '2026-10-21',
    'dateModified' => '2026-10-21',
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => url('/blog/what-is-an-invoice'),
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div x-data="blogPostApp()" x-init="initScrollSpy()" class="w-full selection:bg-slate-800 selection:text-white">


    <div class="relative bg-[#2A373D] text-white pt-8 pb-20 sm:pt-12 sm:pb-28 overflow-hidden">

        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <nav class="flex items-center justify-center space-x-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="text-slate-500">/</span>
                <a href="{{ route('blog') }}" class="hover:text-white transition-colors">Blog</a>
                <span class="text-slate-500">/</span>
                <span class="text-slate-200 truncate max-w-xs sm:max-w-md">What Is an Invoice?</span>
            </nav>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                What Is an Invoice? A Simple Guide for Beginners
            </h1>

            <div class="mt-5 flex items-center justify-center space-x-4 text-xs sm:text-sm text-slate-300">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    October 21, 2026
                </span>
                <span class="text-slate-500">•</span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    4 min read
                </span>
                <span class="text-slate-500">•</span>
                <span>By InvoiceMaker Team</span>
            </div>
        </div>





        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
            <svg class="relative block w-full h-10 sm:h-14 md:h-20 text-white" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,45 C320,115 520,10 880,75 C1120,115 1320,50 1440,40 L1440,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>




    <div class="bg-white text-slate-700 py-12 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">




            <div class="md:hidden">


                <div class="fixed left-0 top-36 z-40">
                    <button type="button"
                            @click="mobileTocOpen = true"
                            x-show="!mobileTocOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="-translate-x-full opacity-0"
                            x-transition:enter-end="translate-x-0 opacity-100"
                            class="bg-[#2A373D] text-white pl-2.5 pr-3 py-2 rounded-r-xl shadow-lg border-y border-r border-white/20 flex items-center gap-1.5 cursor-pointer text-xs font-semibold select-none hover:bg-slate-900 transition-colors">
                        <svg class="w-4 h-4 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16"></path>
                        </svg>
                        <span class="text-[11px] font-bold text-slate-100 tracking-wide">Contents</span>
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>



                <div x-show="mobileTocOpen"
                     @click="mobileTocOpen = false"
                     x-transition:enter="transition-opacity ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] z-50"></div>



                <div x-show="mobileTocOpen"
                     x-transition:enter="transition ease-out duration-250"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     class="fixed left-0 top-24 bottom-auto max-h-[70vh] w-64 max-w-[80vw] bg-white rounded-r-2xl shadow-2xl border-y border-r border-slate-200 z-50 flex flex-col overflow-hidden">

                    <div class="px-4 py-3 bg-[#2A373D] text-white flex items-center justify-between border-b border-slate-700">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16"></path>
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-100">Table of Contents</span>
                        </div>
                        <button type="button"
                                @click="mobileTocOpen = false"
                                class="w-7 h-7 rounded-lg bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <nav class="p-3 overflow-y-auto space-y-1 divide-y divide-slate-100 text-sm">
                        <template x-for="item in sections" :key="item.id">
                            <button type="button"
                                    @click="scrollTo(item.id)"
                                    :class="activeSection === item.id ? 'bg-slate-100 text-slate-950 font-bold border-l-2 border-rose-400 pl-2.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 pl-2'"
                                    class="w-full text-left py-2 pr-2 rounded-r-lg text-xs leading-snug transition-colors flex items-center justify-between">
                                <span x-text="item.label" class="line-clamp-2"></span>
                                <span x-show="activeSection === item.id" class="w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0 ml-2"></span>
                            </button>
                        </template>
                    </nav>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-12 lg:gap-16 items-start">

                <aside class="hidden md:block w-64 lg:w-72 shrink-0 sticky top-28 select-none">
                    <div class="space-y-6">
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Table of Contents
                        </div>

                        <nav class="space-y-4">
                            <template x-for="item in sections" :key="item.id">
                                <div class="group">
                                    <a :href="'#' + item.id"
                                       @click.prevent="scrollTo(item.id)"
                                       :class="activeSection === item.id
                                           ? 'text-slate-950 font-bold'
                                           : 'text-slate-600 hover:text-slate-900 font-medium'"
                                       class="block text-sm transition-colors leading-snug cursor-pointer">
                                        <span x-text="item.label"></span>
                                    </a>
                                    <div :class="activeSection === item.id ? 'w-full h-[1.5px] bg-rose-400/90 mt-2' : 'w-0 h-[1.5px] bg-transparent mt-2'"
                                         class="transition-all duration-300"></div>
                                </div>
                            </template>
                        </nav>

                        <div class="pt-6 border-t border-slate-100 text-xs text-slate-500">
                            <span>Have questions?</span>
                            <a href="mailto:help@invoicemaker.tech" class="block font-semibold text-[#2A373D] hover:underline mt-1">
                                help@invoicemaker.tech
                            </a>
                        </div>
                    </div>
                </aside>


                <main class="flex-1 min-w-0">

                    <div class="mb-10 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                        <picture>
                            <source srcset="{{ asset('images/blog/blog_2_cover.webp') }}" type="image/webp">
                            <img
                                src="{{ asset('images/blog/blog_2_cover.png') }}"
                                alt="Person holding an invoice beside a calculator under the heading “What Is an Invoice.”"
                                class="w-full h-auto object-cover block"
                                loading="eager"
                                fetchpriority="high"
                            >
                        </picture>
                    </div>

                    <div class="text-base sm:text-lg text-slate-700 leading-relaxed space-y-4 mb-12">
                        <p>
                            You finish a job for a client. They like your work and say, “Please send me an invoice.”
                        </p>
                        <p>
                            If you are new to freelancing or running a small business, you may wonder what to send. Should it be a message, a bill, or a full page of details?
                        </p>
                        <p>
                            An invoice gives your customer a clear record of what you are charging for. This guide explains what it means, what to include, and how to make your first one.
                        </p>
                    </div>

                    <section id="what-is-an-invoice" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            What Is an Invoice?
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                An invoice is a document that a seller sends to a customer to request payment for goods or services. It explains the charges and usually tells the customer when and how to pay.
                            </p>
                            <p>
                                For example, imagine you design a logo for a bakery for an agreed price of USD 150. Your invoice identifies you and the bakery, describes the logo design, and shows the amount owed.
                            </p>
                            <p>
                                It can be a printed page or a digital file. The format matters less than making the details clear.
                            </p>
                            <p class="text-sm text-slate-500 pt-2">
                                Source: <a href="https://business.gov.au/finance/payments-and-invoicing/how-to-invoice" target="_blank" rel="noopener noreferrer" class="font-medium text-[#2A373D] underline hover:text-slate-950">business.gov.au — How to invoice</a>.
                            </p>
                        </div>
                    </section>

                    <section id="who-uses-invoices" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Who Uses Invoices?
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Invoices are useful for people who sell products or provide services. A web developer may invoice for a website. A tutor may invoice for lessons. A repair business may list labour and replacement parts.
                            </p>
                            <p>
                                You do not need a large team to use one. Even a single project can involve several details that are easy to forget.
                            </p>
                            <p>
                                Think of a photographer who offers a photo session, extra editing, and printed photos. Listing each charge separately helps the customer understand the final amount.
                            </p>
                        </div>
                    </section>

                    <section id="why-useful" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Why Is an Invoice Useful?
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                A message saying “Please pay me 200” leaves questions open. What is the payment for? Which project does it cover? Is anything still unpaid?
                            </p>

                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/blog/blog_2_image_2.webp') }}" type="image/webp">
                                    <img
                                        src="{{ asset('images/blog/blog_2_image_2.png') }}"
                                        alt="Paper invoice beside a laptop displaying an invoice layout on a sunlit desk."
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>

                            <p>
                                A clear invoice puts those answers together. It gives you and your customer the same reference when discussing a payment.
                            </p>
                            <p>
                                It also helps with your own organisation. If you save each invoice with a clear filename, you can find the right document without searching through long conversations.
                            </p>
                            <p>
                                For example, “INV-014-Bakery-Logo.pdf” tells you much more than “document-final-new.pdf.”
                            </p>
                        </div>
                    </section>

                    <section id="what-to-include" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            What Should You Include?
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                <a href="{{ route('blog.post') }}" class="font-medium text-[#2A373D] underline hover:text-slate-950">See how to create an invoice online for free.</a>
                            </p>
                            <p>
                                Use this practical checklist when preparing an invoice. Local rules may require extra details.
                            </p>

                            <div class="overflow-x-auto my-6">
                                <table class="w-full text-left text-sm border-collapse rounded-xl overflow-hidden border border-slate-200">
                                    <thead class="bg-slate-100 text-slate-700 font-semibold uppercase text-xs tracking-wider">
                                        <tr>
                                            <th class="py-3 px-4 border-b border-slate-200 w-1/3">Detail</th>
                                            <th class="py-3 px-4 border-b border-slate-200">What to enter</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-600 bg-white">
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Your details</td>
                                            <td class="py-3 px-4">Your name or business name and contact information</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Customer details</td>
                                            <td class="py-3 px-4">The person or business being charged</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Invoice number</td>
                                            <td class="py-3 px-4">A unique reference, such as INV-014</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Dates</td>
                                            <td class="py-3 px-4">The issue date and agreed payment deadline</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Items or services</td>
                                            <td class="py-3 px-4">A clear description of each charge</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Quantity and price</td>
                                            <td class="py-3 px-4">How many items or hours, and the rate</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Adjustments</td>
                                            <td class="py-3 px-4">Any applicable tax, agreed discount, or other charge</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Total and balance</td>
                                            <td class="py-3 px-4">The full amount and what remains unpaid</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Payment instructions</td>
                                            <td class="py-3 px-4">How the customer should pay</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p>
                                A logo can help your invoice look familiar, but it does not replace the details above. Check your local tax authority’s requirements before using an invoice for official business records.
                            </p>
                            <p class="text-sm text-slate-500 pt-2">
                                Sources: <a href="https://business.gov.au/finance/payments-and-invoicing/how-to-invoice" target="_blank" rel="noopener noreferrer" class="font-medium text-[#2A373D] underline hover:text-slate-950">business.gov.au</a> and <a href="https://www.xero.com/guides/invoicing/" target="_blank" rel="noopener noreferrer" class="font-medium text-[#2A373D] underline hover:text-slate-950">Xero’s invoicing guide</a>. These sources include Australian rules; the checklist above is general guidance for readers worldwide.
                            </p>
                        </div>
                    </section>

                    <section id="invoice-example" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            A Simple Invoice Example
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Suppose you create social media content for a small shop. You agree to charge USD 30 for each post design and USD 40 for writing captions.
                            </p>
                            <p>
                                Your invoice could show:
                            </p>

                            <div class="overflow-x-auto my-6">
                                <table class="w-full text-left text-sm border-collapse rounded-xl overflow-hidden border border-slate-200">
                                    <thead class="bg-slate-100 text-slate-700 font-semibold uppercase text-xs tracking-wider">
                                        <tr>
                                            <th class="py-3 px-4 border-b border-slate-200">Service</th>
                                            <th class="py-3 px-4 border-b border-slate-200 text-center">Quantity</th>
                                            <th class="py-3 px-4 border-b border-slate-200 text-right">Rate</th>
                                            <th class="py-3 px-4 border-b border-slate-200 text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-600 bg-white">
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Social media post design</td>
                                            <td class="py-3 px-4 text-center">4</td>
                                            <td class="py-3 px-4 text-right">USD 30</td>
                                            <td class="py-3 px-4 text-right font-medium">USD 120</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Caption writing package</td>
                                            <td class="py-3 px-4 text-center">1</td>
                                            <td class="py-3 px-4 text-right">USD 40</td>
                                            <td class="py-3 px-4 text-right font-medium">USD 40</td>
                                        </tr>
                                        <tr class="bg-slate-50 font-semibold text-slate-900">
                                            <td colspan="3" class="py-3 px-4 text-right border-t border-slate-200">Total</td>
                                            <td class="py-3 px-4 text-right border-t border-slate-200">USD 160</td>
                                        </tr>
                                        <tr class="text-slate-600">
                                            <td colspan="3" class="py-3 px-4 text-right">Payment already received</td>
                                            <td class="py-3 px-4 text-right">USD 60</td>
                                        </tr>
                                        <tr class="bg-slate-100 font-bold text-slate-900">
                                            <td colspan="3" class="py-3 px-4 text-right border-t border-slate-300">Balance due</td>
                                            <td class="py-3 px-4 text-right border-t border-slate-300">USD 100</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p class="text-sm text-slate-600">
                                This example has no tax, shipping charge, or discount.
                            </p>
                            <p>
                                The total is USD 160. Because the client has already paid USD 60, the remaining balance is USD 100. Only record a payment as received after checking that it actually arrived.
                            </p>
                            <p>
                                Notice how the descriptions explain the work. “Four social media post designs” is easier to understand than “online services.”
                            </p>
                        </div>
                    </section>

                    <section id="difference" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Invoice, Receipt, and Quote: What Is the Difference?
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                These documents have different jobs.
                            </p>

                            <div class="overflow-x-auto my-6">
                                <table class="w-full text-left text-sm border-collapse rounded-xl overflow-hidden border border-slate-200">
                                    <thead class="bg-slate-100 text-slate-700 font-semibold uppercase text-xs tracking-wider">
                                        <tr>
                                            <th class="py-3 px-4 border-b border-slate-200 w-1/4">Document</th>
                                            <th class="py-3 px-4 border-b border-slate-200 w-1/3">Main purpose</th>
                                            <th class="py-3 px-4 border-b border-slate-200">Simple example</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-600 bg-white">
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Quote</td>
                                            <td class="py-3 px-4">Sets out a proposed price and scope</td>
                                            <td class="py-3 px-4 italic">“I can design your logo for USD 150.”</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Invoice</td>
                                            <td class="py-3 px-4">Requests payment</td>
                                            <td class="py-3 px-4 italic">“USD 150 is due for the logo design.”</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Receipt</td>
                                            <td class="py-3 px-4">Confirms payment received</td>
                                            <td class="py-3 px-4 italic">“Your USD 150 payment has been received.”</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p>
                                An unpaid invoice does not prove that a customer has paid. A document may serve more than one purpose when it clearly records the relevant details, but do not assume every invoice is a receipt.
                            </p>
                            <p class="text-sm text-slate-500 pt-2">
                                Sources: <a href="https://www.xero.com/guides/invoicing/" target="_blank" rel="noopener noreferrer" class="font-medium text-[#2A373D] underline hover:text-slate-950">Xero</a> and <a href="https://business.gov.au/finance/payments-and-invoicing/prepare-quotes" target="_blank" rel="noopener noreferrer" class="font-medium text-[#2A373D] underline hover:text-slate-950">business.gov.au — Prepare quotes</a>.
                            </p>
                        </div>
                    </section>

                    <section id="agree-on-payment" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Agree on Payment Before You Start
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Discuss the price, work included, and payment schedule with your customer before beginning a project.
                            </p>

                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/blog/blog_2_image_3.webp') }}" type="image/webp">
                                    <img
                                        src="{{ asset('images/blog/blog_2_image_3.png') }}"
                                        alt="Blank invoice layout with a pen and paper clip on a light desk."
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>

                            <p>
                                For a small design job, you might agree on payment when the work is complete. For a larger project, you might agree on a deposit and later payments at specific stages.
                            </p>
                            <p>
                                Your invoice should reflect that agreement. Avoid surprising the customer with a new fee or a payment deadline you never discussed.
                            </p>
                            <p>
                                Write dates clearly. “5 November 2026” is easier for an international client to understand than “05/11/2026,” which people may read differently.
                            </p>
                        </div>
                    </section>

                    <section id="common-mistakes" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Common Mistakes to Avoid
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Before sending your invoice, read it as if you were the customer.
                            </p>
                            <p>
                                Is the customer’s name correct? Can they tell what each charge covers? Is the currency clear? Have you removed sample names and prices from the template?
                            </p>
                            <p>
                                Check the arithmetic, too. A neat design cannot fix an incorrect total.
                            </p>
                            <p>
                                Keep invoice references organised. For your own tracking, you could use INV-001, INV-002, and INV-003, while following any numbering rules that apply to your business.
                            </p>
                            <p>
                                Finally, open the downloaded file. Make sure nothing is cut off, and the text is easy to read.
                            </p>
                        </div>
                    </section>

                    <section id="create-free-invoice" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Create Your First Invoice for Free
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                <a href="{{ route('home') }}" class="font-medium text-[#2A373D] underline hover:text-slate-950">InvoiceMaker.tech</a> lets you create an invoice using the default editor, choose a pre-made template, or start with a blank page in the <a href="{{ route('invoice.builder') }}" class="font-medium text-[#2A373D] underline hover:text-slate-950">custom invoice builder</a>.
                            </p>
                            <p>
                                Add your details, describe the work, review the amounts, and download your invoice as a PDF or PNG. You can also print it. Then share the downloaded file with your customer through your preferred channel.
                            </p>
                            <p>
                                Keep your own copy of every finished invoice. A draft that stays in your browser after a refresh should not be treated as a permanent backup.
                            </p>
                            <p class="text-slate-900 font-medium pt-2">
                                Ready to begin? Open InvoiceMaker.tech, choose your layout, and turn your project details into a clear invoice your customer can understand.
                            </p>
                        </div>
                    </section>

                    <div class="pt-8 border-t border-slate-100 text-center">
                        <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#2A373D] hover:underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to all Blog Articles
                        </a>
                    </div>

                </main>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function blogPostApp() {
        return {
            mobileTocOpen: false,
            activeSection: 'what-is-an-invoice',
            sections: [
                { id: 'what-is-an-invoice', label: 'What Is an Invoice?', shortLabel: 'Overview' },
                { id: 'who-uses-invoices', label: 'Who Uses Invoices?', shortLabel: 'Users' },
                { id: 'why-useful', label: 'Why Is an Invoice Useful?', shortLabel: 'Benefits' },
                { id: 'what-to-include', label: 'What Should You Include?', shortLabel: 'Checklist' },
                { id: 'invoice-example', label: 'A Simple Invoice Example', shortLabel: 'Example' },
                { id: 'difference', label: 'Invoice, Receipt & Quote', shortLabel: 'Difference' },
                { id: 'agree-on-payment', label: 'Agree on Payment Terms', shortLabel: 'Payment' },
                { id: 'common-mistakes', label: 'Common Mistakes to Avoid', shortLabel: 'Mistakes' },
                { id: 'create-free-invoice', label: 'Create First Invoice Free', shortLabel: 'Get Started' }
            ],

            scrollTo(id) {
                this.activeSection = id;
                this.mobileTocOpen = false;
                const element = document.getElementById(id);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            },

            initScrollSpy() {
                if (!('IntersectionObserver' in window)) return;

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.activeSection = entry.target.id;
                        }
                    });
                }, {
                    rootMargin: '-20% 0px -65% 0px',
                    threshold: 0
                });

                this.$nextTick(() => {
                    this.sections.forEach(item => {
                        const el = document.getElementById(item.id);
                        if (el) observer.observe(el);
                    });
                });
            }
        };
    }
</script>
@endpush
