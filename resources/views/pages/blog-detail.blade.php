@extends('layouts.app')

@section('title', 'How to Create an Invoice Online for Free - Step-by-Step Guide')
@section('meta_description', 'Learn how to create a professional invoice online for free with InvoiceMaker.tech. Step-by-step guide from choosing a template to downloading a PDF without signing up.')
@section('canonical', url('/blog/how-to-create-an-invoice-online-for-free'))
@section('og_type', 'article')
@section('og_image', asset('images/blog/blog_1_cover.webp'))

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => 'How to Create an Invoice Online for Free',
    'description' => 'Learn how to create a professional invoice online for free with InvoiceMaker.tech. Step-by-step guide from choosing a template to downloading a PDF without signing up.',
    'image' => asset('images/blog/blog_1_cover.webp'),
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
        '@id' => url('/blog/how-to-create-an-invoice-online-for-free'),
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
                <span class="text-slate-200 truncate max-w-xs sm:max-w-md">How to Create an Invoice Online for Free</span>
            </nav>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                How to Create an Invoice Online for Free
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
                    5 min read
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
                            <source srcset="{{ asset('images/blog/blog_1_cover.webp') }}" type="image/webp">
                            <img 
                                src="{{ asset('images/blog/blog_1_cover.png') }}" 
                                alt="Invoice illustration beside the title “How to Create an Invoice Online for Free.”" 
                                class="w-full h-auto object-cover block"
                                loading="eager"
                                fetchpriority="high"
                            >
                        </picture>
                    </div>

                    <div class="text-base sm:text-lg text-slate-700 leading-relaxed space-y-4 mb-12">
                        <p>
                            Creating an invoice should not be a difficult part of your work. Whether you design websites, sell products, or provide a local service, you need a clear document that tells your customer what they are paying for.
                        </p>
                        <p>
                            With <a href="{{ route('home') }}" class="font-medium text-[#2A373D] underline hover:text-slate-950">InvoiceMaker.tech</a>, you can create an invoice online for free. Start with the default invoice, choose a ready-made template, or build your own layout from a blank page. You do not need an account or a paid subscription. This guide walks you through the process, from choosing a layout to downloading your finished invoice.
                        </p>
                    </div>

                    <section id="before-you-start" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Before You Start
                        </h2>
                        <p class="text-slate-700 mb-4 leading-relaxed">
                            <strong class="text-red-500 font-bold">Note:</strong> Invoice details can vary by country. For a helpful example of what to include, see this <a href="https://business.gov.au/finance/payments-and-invoicing/how-to-invoice" target="_blank" rel="noopener noreferrer" class="font-medium text-[#2A373D] underline hover:text-slate-950">government guide to invoicing</a>. Check your own country’s rules before adding tax details.
                        </p>
                        <p class="text-slate-700 mb-4 leading-relaxed">
                            Keep your business and customer information ready. You will also need a list of the products or services you are charging for. A useful starting checklist includes:
                        </p>
                        <ul class="space-y-2.5 text-slate-700 text-base mb-4">
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 mt-2.5 flex-shrink-0"></span>
                                <span>Your name or business name and contact details.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 mt-2.5 flex-shrink-0"></span>
                                <span>Your customer’s billing details.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 mt-2.5 flex-shrink-0"></span>
                                <span>A unique invoice number.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 mt-2.5 flex-shrink-0"></span>
                                <span>The invoice date and agreed payment due date.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 mt-2.5 flex-shrink-0"></span>
                                <span>Item descriptions, quantities, and prices.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 mt-2.5 flex-shrink-0"></span>
                                <span>Payment instructions.</span>
                            </li>
                        </ul>
                        <p class="text-slate-600 leading-relaxed">
                            If your customer gave you a purchase order number, keep that ready too. Having these details together makes the process easier and helps you avoid missing information.
                        </p>
                    </section>

                    <section id="step-1" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            1. Choose How You Want to Start
                        </h2>

                        <p class="text-slate-700 leading-relaxed mb-4">
                            InvoiceMaker.tech gives you three ways to create an invoice:
                        </p>

                        <div class="space-y-4 mb-6 text-slate-700 leading-relaxed">
                            <p>
                                <strong>Use the default invoice.</strong> The homepage has an invoice form where you can enter your details straight away. This is a useful option when you want a straightforward layout.
                            </p>
                            <p>
                                <strong>Choose a ready-made template.</strong> Open <a href="{{ route('templates') }}" class="font-medium text-[#2A373D] underline hover:text-slate-950">Templates</a> from the navigation menu or select Free Invoice Templates beside the default invoice. The gallery includes Everyday, Studio, Standard, Mint, Blue Line, Flow, Silver, and Aqua. Select Customize on the design you want to use and replace the sample content with your own information.
                            </p>
                            <p>
                                <strong>Build your own invoice.</strong> Choose Customize Your Invoice to start with a blank page. This option gives you more control over the layout.
                            </p>
                            <p class="text-slate-600">
                                For the main steps below, we will use the default invoice form.
                            </p>
                        </div>

                        <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                            <picture>
                                <source srcset="{{ asset('images/blog/blog_1_image_2.webp') }}" type="image/webp">
                                <img 
                                    src="{{ asset('images/blog/blog_1_image_2.png') }}" 
                                    alt="Free invoice template gallery with Everyday and Studio designs and Customize buttons." 
                                    class="w-full h-auto object-cover block"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>
                        </div>
                    </section>

                    <section id="step-2" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            2. Add Your Business and Customer Details
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                In the "Who is this from?" field, enter your business name or your own name, followed by useful contact details. Under Bill To, add the customer’s name and billing details. Use Ship To when a separate delivery address is relevant.
                            </p>
                            <p>
                                You can also select "Add Your Logo" to include your business logo. Keep it clear and reasonably sized so the invoice remains easy to read.
                            </p>
                            <p>
                                <strong class="text-red-500 font-bold">Note:</strong> If you start from a ready-made template, review every sample field carefully. Ensure no example company names, dummy addresses, or placeholder bank details remain in the finished invoice.
                            </p>
                        </div>
                    </section>

                    <section id="step-3" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            3. Set the Invoice Number and Dates
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Enter a unique invoice number in the field beside the number sign. A simple format such as <code class="px-2 py-0.5 bg-slate-100 rounded text-slate-800 font-mono text-sm">INV-001</code> can make your files easier to recognise.
                            </p>
                            <p>
                                Set the Date to the correct invoice date. Then enter the Due Date based on your agreement with the customer. Use Payment Terms to explain the agreed timing of payment. If relevant, add the customer’s purchase order reference under PO Number.
                            </p>
                            <p>
                                Do not leave example dates unchanged. Check the dates together so they describe the payment schedule you actually agreed on.
                            </p>
                        </div>
                    </section>

                    <section id="step-4" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            4. Choose the Currency
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Open the Currency menu beside the invoice and choose the currency agreed with your customer.
                            </p>
                            <p>
                                Check this before entering all your prices. A currency symbol alone can sometimes be unclear, especially when working with customers in other countries.
                            </p>
                            <p>
                                <strong class="text-red-500 font-bold">Note:</strong> Selecting a currency modifies the billing symbol; it does not automatically convert prices via live exchange rates. Enter the exact agreed amounts for your intended currency, then check the currency shown in the downloaded file.
                            </p>
                        </div>
                    </section>

                    <section id="step-5" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            5. Add Your Products or Services
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                In the item table, enter a description, quantity, and rate. Use "+ Line Item" to add another row.
                            </p>
                            <p>
                                Write descriptions that explain the work clearly. Instead of “Design work,” you could write “Homepage design for a five-page business website.”
                            </p>
                            <p class="font-medium text-slate-900">
                                For example:
                            </p>

                            <div class="overflow-x-auto my-4">
                                <table class="w-full text-left text-sm border-collapse rounded-xl overflow-hidden border border-slate-200">
                                    <thead class="bg-slate-100 text-slate-700 font-semibold uppercase text-xs tracking-wider">
                                        <tr>
                                            <th class="py-3 px-4 border-b border-slate-200">Item</th>
                                            <th class="py-3 px-4 border-b border-slate-200 text-center">Quantity</th>
                                            <th class="py-3 px-4 border-b border-slate-200 text-right">Rate</th>
                                            <th class="py-3 px-4 border-b border-slate-200 text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-600 bg-white">
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Website page design</td>
                                            <td class="py-3 px-4 text-center">3</td>
                                            <td class="py-3 px-4 text-right">$100</td>
                                            <td class="py-3 px-4 text-right font-medium">$300</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 font-medium text-slate-800">Website content upload</td>
                                            <td class="py-3 px-4 text-center">1</td>
                                            <td class="py-3 px-4 text-right">$50</td>
                                            <td class="py-3 px-4 text-right font-medium">$50</td>
                                        </tr>
                                        <tr class="bg-slate-50 font-semibold text-slate-900">
                                            <td colspan="3" class="py-3 px-4 text-right border-t border-slate-200">Subtotal</td>
                                            <td class="py-3 px-4 text-right border-t border-slate-200">$350</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p class="text-sm text-slate-600">
                                This example uses USD and does not include tax, discounts, shipping, or earlier payments. Check each displayed amount against the quantity and rate. Remove any sample or unused rows before downloading.
                            </p>
                        </div>
                    </section>

                    <section id="step-6" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            6. Review Adjustments and the Balance
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                The default invoice includes Tax, Discount, Shipping, and Amount Paid options. Use only the adjustments that apply to your transaction.
                            </p>
                            <p>
                                Check your applicable tax requirements separately rather than copying a sample rate from a template.
                            </p>
                            <p>
                                If the customer already paid part of the bill, enter that payment under Amount Paid. For example, a $350 total with $100 already paid leaves a $250 balance. Recording an amount here does not collect money or confirm a bank transfer. Enter only payments you have checked. Review the subtotal, adjustments, total, and Balance Due together.
                            </p>

                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/blog/blog_1_image_3.webp') }}" type="image/webp">
                                    <img 
                                        src="{{ asset('images/blog/blog_1_image_3.png') }}" 
                                        alt="Online invoice editor with business details, item prices, totals, and PDF or PNG download options." 
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>
                        </div>
                    </section>

                    <section id="step-7" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            7. Add Notes and Payment Instructions
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Use Notes for helpful information about the order or project. Use Terms for agreed payment instructions or other relevant conditions. Keep the wording short and clear.
                            </p>
                            <p class="italic text-slate-800 my-2 pl-4 border-l-2 border-slate-300">
                                “Please include invoice number INV-001 with your payment.”
                            </p>
                            <p>
                                <strong class="text-red-500 font-bold">Note:</strong> If you include bank details, check them carefully. Never add passwords, card PINs, or one-time security codes. Make sure the instructions match what you agreed with your customer. Avoid adding new charges or conditions without discussing them first.
                            </p>
                        </div>
                    </section>

                    <section id="step-8" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            8. Check and Download Your Invoice
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Before downloading, review the invoice from top to bottom. Check names, contact details, dates, descriptions, amounts, and payment instructions. Look for missing text and sample information.
                            </p>
                            <p>
                                Under Format, choose PDF or PNG, then select Download Invoice. You can also use Print Invoice if you need a printed copy.
                            </p>
                            <p>
                                Open the downloaded file and check that everything is readable. Give it a clear name, such as <code class="px-2 py-0.5 bg-slate-100 rounded text-slate-800 font-mono text-sm">INV-001-ClientName.pdf</code>. You can then attach it to an email or send it through your usual messaging app.
                            </p>
                        </div>
                    </section>

                    <section id="custom-builder" class="scroll-mt-28 mb-14 pt-8 border-t border-slate-200">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Want to Create Your Own Layout?
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Open <a href="{{ route('invoice.builder') }}" class="font-medium text-[#2A373D] underline hover:text-slate-950">Customize Your Own Invoice</a> and use the Add Boxes panel. Available elements include Logo, Company Name, Date, Invoice Number, Text, Address, Item Bar, Notes, Terms, and Checkout / Totals.
                            </p>
                            <p>
                                Add the elements you need and arrange them on the page. Keep related information together, leave space between sections, and make the total easy to find. The custom builder also shows currency, PDF/PNG, print, and download controls.
                            </p>

                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/blog/blog_1_image_4.webp') }}" type="image/webp">
                                    <img 
                                        src="{{ asset('images/blog/blog_1_image_4.png') }}" 
                                        alt="Blank invoice builder with an Add Boxes panel for adding text, logos, item rows, and totals." 
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>
                        </div>
                    </section>

                    <section id="backup-tips" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-3">
                            Keep a Copy of Your Finished Invoice
                        </h2>
                        <p class="text-slate-700 leading-relaxed mb-4">
                            Your current draft stays in your browser when you refresh the page. However, browser storage is not a permanent backup. Download important invoices and keep them in a folder you can find later.
                        </p>
                        <p class="text-slate-700 leading-relaxed">
                            Invoice details are processed on your device rather than stored in a website database, so we cannot recover a lost draft for you.
                        </p>
                        <p class="text-slate-900 font-medium mt-4">
                            Ready to begin? Open InvoiceMaker.tech, choose your starting layout, and create your next invoice for free.
                        </p>
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
            activeSection: 'before-you-start',
            sections: [
                { id: 'before-you-start', label: 'Before You Start', shortLabel: 'Checklist' },
                { id: 'step-1', label: '1. Choose How to Start', shortLabel: 'Step 1' },
                { id: 'step-2', label: '2. Business & Customer Details', shortLabel: 'Step 2' },
                { id: 'step-3', label: '3. Invoice Number & Dates', shortLabel: 'Step 3' },
                { id: 'step-4', label: '4. Choose Currency', shortLabel: 'Step 4' },
                { id: 'step-5', label: '5. Products or Services', shortLabel: 'Step 5' },
                { id: 'step-6', label: '6. Adjustments & Balance', shortLabel: 'Step 6' },
                { id: 'step-7', label: '7. Notes & Terms', shortLabel: 'Step 7' },
                { id: 'step-8', label: '8. Check and Download', shortLabel: 'Step 8' },
                { id: 'custom-builder', label: 'Create Custom Layout', shortLabel: 'Builder' },
                { id: 'backup-tips', label: 'Saving & Backup Tips', shortLabel: 'Backups' }
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
