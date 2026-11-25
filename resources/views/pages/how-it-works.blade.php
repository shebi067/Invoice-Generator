@extends('layouts.app')

@section('title', 'How It Works | Create Free Online Invoices in 3 Easy Steps')
@section('meta_description', 'See how InvoiceMaker works! Pick a template or start from scratch, customize your billing details, and download instant PDFs for free.')
@section('canonical', route('how-it-works'))

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        [
            '@type' => 'Question',
            'name' => 'Is InvoiceMaker.tech free?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Yes. The default editor, templates, and custom invoice builder are free to use.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Do I need to sign up?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'No. You can create and download an invoice without making an account.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Can I edit a template?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Yes. Choose a template, select Customize, and replace the example details.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Can I send the invoice directly from the website?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Download the invoice as a PDF or PNG, then share the file through your own email or messaging app.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Can I accept payments on this website?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'No. The website helps you create an invoice. Your customer pays you using the payment method you agree on with them.',
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div x-data="howItWorksApp()" x-init="initScrollSpy()" class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-8 pb-20 sm:pt-12 sm:pb-28 overflow-hidden">
        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                How It Works
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                Create an invoice online for free with InvoiceMaker.tech. Start with the default editor, choose a ready-made template, or build your own invoice from a blank page. Add your details, check the total, and download your finished invoice. No account is needed.
            </p>
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



                <main class="flex-1 min-w-0 text-slate-700 leading-relaxed text-base">


                    <section id="choose-how-to-start" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-6">
                            Choose How You Want to Start
                        </h2>


                        <div id="default-editor" class="scroll-mt-28 mb-12">
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight mb-3">
                                Use the default invoice editor
                            </h3>
                            <p class="text-slate-700 leading-relaxed mb-4">
                                The default editor is the quickest way to begin. Open the homepage and fill in the invoice form. You can add your logo, business details, customer details, items, dates, and payment information in one place.
                            </p>


                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/how-it-works/how_it_works_editor.webp') }}" type="image/webp">
                                    <img
                                        src="{{ asset('images/how-it-works/how_it_works_editor.png') }}"
                                        alt="Default invoice editor with fields for business details, line items, totals, and download options."
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>

                            <p class="mt-4">
                                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 font-semibold text-[#2A373D] underline hover:text-slate-950">
                                    Create an Invoice
                                </a>
                            </p>
                        </div>


                        <div id="choose-template" class="scroll-mt-28 mb-12 pt-6 border-t border-slate-100">
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight mb-3">
                                Choose a free template
                            </h3>
                            <p class="text-slate-700 leading-relaxed mb-4">
                                Want a different look? Open Free Invoice Templates and browse the available designs: Everyday, Studio, Standard, Mint, Blue Line, Flow, Silver, and Aqua. Select Customize on the design you like. Click the invoice fields to replace the example details with your own.
                            </p>


                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/how-it-works/how_it_works_templates.webp') }}" type="image/webp">
                                    <img
                                        src="{{ asset('images/how-it-works/how_it_works_templates.png') }}"
                                        alt="Invoice template gallery showing designs with Customize buttons."
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>

                            <p class="mt-4">
                                <a href="{{ route('templates') }}" class="inline-flex items-center gap-1.5 font-semibold text-[#2A373D] underline hover:text-slate-950">
                                    Browse Templates
                                </a>
                            </p>
                        </div>


                        <div id="build-your-layout" class="scroll-mt-28 mb-6 pt-6 border-t border-slate-100">
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight mb-3">
                                Build your own layout
                            </h3>
                            <p class="text-slate-700 leading-relaxed mb-4">
                                Want to choose where everything goes? Open Customize Your Own Invoice. Start with a blank page and use + Add Boxes to add the parts you need. You can add a logo, company name, date, invoice number, text, item bar, notes, terms, and checkout totals. Arrange the boxes to create your layout.
                            </p>


                            <div class="my-6 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm bg-slate-50">
                                <picture>
                                    <source srcset="{{ asset('images/how-it-works/how_it_works_builder.webp') }}" type="image/webp">
                                    <img
                                        src="{{ asset('images/how-it-works/how_it_works_builder.png') }}"
                                        alt="Blank invoice builder with the Add Boxes panel for arranging invoice elements."
                                        class="w-full h-auto object-cover block"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </picture>
                            </div>

                            <p class="mt-4">
                                <a href="{{ route('invoice.builder') }}" class="inline-flex items-center gap-1.5 font-semibold text-[#2A373D] underline hover:text-slate-950">
                                    Build a Custom Invoice
                                </a>
                            </p>
                        </div>
                    </section>


                    <section id="add-details" class="scroll-mt-28 mb-14 pt-8 border-t border-slate-200">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Add Your Invoice Details
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Start with your name or business name and the customer's name. Add your invoice number, issue date, due date, and a clear description of each product or service. Enter the quantity and rate for each item.
                            </p>
                            <p>
                                In the default editor, use + Line Item if you need more rows. You can also add notes or payment terms. Select the currency that matches the amounts you are entering. Changing the currency label does not convert your prices, so check the numbers yourself.
                            </p>
                        </div>
                    </section>


                    <section id="check-amounts" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Check the Amounts
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Review the subtotal and total before downloading. If they apply to your invoice, add tax, a discount, shipping, or an amount already paid. Check that the balance due matches what your customer still owes.
                            </p>
                            <p>
                                Only enter an amount in Amount Paid when you have actually received it. Creating an invoice on this site does not collect a payment from your customer.
                            </p>
                        </div>
                    </section>


                    <section id="download-and-share" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            Download and Share
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                Choose PDF or PNG, then select Download Invoice. You can also use Print Invoice. Open the downloaded file and check that the names, dates, items, and amounts look right.
                            </p>
                            <p>
                                You can then share the file with your customer using your usual email or messaging app. Keep a copy for your records.
                            </p>
                        </div>
                    </section>


                    <section id="about-your-draft" class="scroll-mt-28 mb-14">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                            A Note About Your Draft
                        </h2>
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            <p>
                                The invoice you are editing may stay in your browser after a page refresh. It is not an online account or a permanent backup. Download the finished invoice and save it somewhere you can find it again.
                            </p>
                        </div>
                    </section>


                    <section id="faqs" class="scroll-mt-28 mb-14 pt-8 border-t border-slate-200">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-6">
                            Frequently Asked Questions
                        </h2>
                        <div class="space-y-6 text-slate-700 leading-relaxed">
                            <div>
                                <h3 class="font-bold text-slate-900 text-lg mb-1">
                                    Is InvoiceMaker.tech free?
                                </h3>
                                <p class="text-slate-600">
                                    Yes. The default editor, templates, and custom invoice builder are free to use.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-900 text-lg mb-1">
                                    Do I need to sign up?
                                </h3>
                                <p class="text-slate-600">
                                    No. You can create and download an invoice without making an account.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-900 text-lg mb-1">
                                    Can I edit a template?
                                </h3>
                                <p class="text-slate-600">
                                    Yes. Choose a template, select Customize, and replace the example details.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-900 text-lg mb-1">
                                    Can I send the invoice directly from the website?
                                </h3>
                                <p class="text-slate-600">
                                    Download the invoice as a PDF or PNG, then share the file through your own email or messaging app.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-900 text-lg mb-1">
                                    Can I accept payments on this website?
                                </h3>
                                <p class="text-slate-600">
                                    No. The website helps you create an invoice. Your customer pays you using the payment method you agree on with them.
                                </p>
                            </div>
                        </div>
                    </section>


                    <div class="pt-8 border-t border-slate-200 text-slate-800 font-medium">
                        <p>
                            Ready to create your first invoice? Start with the <a href="{{ route('home') }}" class="font-semibold text-[#2A373D] underline hover:text-slate-950">default editor</a>, explore <a href="{{ route('templates') }}" class="font-semibold text-[#2A373D] underline hover:text-slate-950">free templates</a>, or <a href="{{ route('invoice.builder') }}" class="font-semibold text-[#2A373D] underline hover:text-slate-950">build your own layout</a>.
                        </p>
                    </div>

                </main>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function howItWorksApp() {
        return {
            mobileTocOpen: false,
            activeSection: 'choose-how-to-start',
            sections: [
                { id: 'choose-how-to-start', label: 'Choose How to Start', shortLabel: 'Start' },
                { id: 'default-editor', label: 'Default Invoice Editor', shortLabel: 'Editor' },
                { id: 'choose-template', label: 'Choose a Free Template', shortLabel: 'Templates' },
                { id: 'build-your-layout', label: 'Build Your Own Layout', shortLabel: 'Builder' },
                { id: 'add-details', label: 'Add Invoice Details', shortLabel: 'Details' },
                { id: 'check-amounts', label: 'Check the Amounts', shortLabel: 'Amounts' },
                { id: 'download-and-share', label: 'Download and Share', shortLabel: 'Download' },
                { id: 'about-your-draft', label: 'A Note About Your Draft', shortLabel: 'Draft' },
                { id: 'faqs', label: 'Frequently Asked Questions', shortLabel: 'FAQs' }
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






