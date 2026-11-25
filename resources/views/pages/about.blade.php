@extends('layouts.app')

@section('title', 'About InvoiceMaker | Simple, Free & Private Online Billing')
@section('meta_description', 'Discover InvoiceMaker—the 100% free, simple, and private online invoicing tool built for freelancers and small business owners.')

@section('content')
<div x-data="aboutPageApp()" x-init="initScrollSpy()" class="w-full selection:bg-slate-800 selection:text-white">


    <div class="relative bg-[#2A373D] text-white pt-8 pb-20 sm:pt-12 sm:pb-28 overflow-hidden">


        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">

            <span class="sr-only">About Our Mission</span>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white">
                About Us
            </h1>
            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">

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


            <div class="md:hidden sticky top-20 z-30 bg-white/95 backdrop-blur-md border-b border-slate-200 pb-3 mb-10 overflow-x-auto flex gap-4 text-xs font-medium no-scrollbar">
                <template x-for="item in sections" :key="item.id">
                    <button type="button"
                            @click="scrollTo(item.id)"
                            :class="activeSection === item.id ? 'text-slate-950 font-bold border-b-2 border-rose-400 pb-1' : 'text-slate-500 hover:text-slate-800 pb-1'"
                            class="whitespace-nowrap transition-all cursor-pointer">
                        <span x-text="item.shortLabel"></span>
                    </button>
                </template>
            </div>

            <div class="flex flex-col md:flex-row gap-12 lg:gap-20 items-start">
                <aside class="hidden md:block w-64 lg:w-72 shrink-0 sticky top-28 select-none">
                    <div class="space-y-6">
                        <nav class="space-y-5">
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
                                    <div :class="activeSection === item.id ? 'w-full h-[1.5px] bg-rose-400/90 mt-2.5' : 'w-0 h-[1.5px] bg-transparent mt-2.5'"
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





                <main class="flex-1 min-w-0 space-y-16 sm:space-y-20 leading-relaxed text-[15px] sm:text-base text-slate-600">




                    <section id="about-invoice-maker" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            About Invoice Maker
                        </h2>
                        <h3 class="text-lg sm:text-xl font-semibold text-slate-800">
                            Simple invoices. Completely free.
                        </h3>
                        <p class="text-base sm:text-lg text-slate-700 leading-relaxed">
                            <strong class="text-slate-900 font-semibold">InvoiceMaker.tech</strong> lets you make invoices online without needing software. Pick a made template and change it or start from a blank page and build your own design. There is no need for an account no subscription and no payment all.
                        </p>
                    </section>

                    <hr class="border-slate-100">




                    <section id="why-we-built" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Why We Built Invoice Maker?
                        </h2>
                        <p class="text-base text-slate-600 leading-relaxed">
                            Creating an invoice should not be hard. You should not need design skills or expensive tools to make an invoice for your customers.
                        </p>
                        <p class="text-base text-slate-600 leading-relaxed">
                            We built Invoice Maker to give you "assistance", a way to add your details list your products or services and download an invoice that is ready to send.
                        </p>
                    </section>

                    <hr class="border-slate-100">




                    <section id="two-ways" class="scroll-mt-28 space-y-6">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Two Ways to Create Your Invoice
                        </h2>

                        <div class="space-y-6 pt-1">
                            <div class="space-y-2">
                                <h3 class="text-lg font-bold text-slate-900">
                                    Start with a template
                                </h3>
                                <p class="text-base text-slate-600 leading-relaxed">
                                    Pick a free invoice template add your information and make it fit your style.
                                </p>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-lg font-bold text-slate-900">
                                    Create your design
                                </h3>
                                <p class="text-base text-slate-600 leading-relaxed">
                                    Begin with a blank page and arrange your invoice any way you like.
                                </p>
                            </div>

                            <p class="text-base font-medium text-slate-800 pt-2">
                                Both choices are completely free.
                            </p>
                        </div>
                    </section>

                    <hr class="border-slate-100">




                    <section id="made-for-your-work" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Made for Your Work
                        </h2>
                        <p class="text-base text-slate-600 leading-relaxed">
                            Invoice Maker is built for freelancers, small business owners and service providers. Whether you are billing for a project selling a product or charging for your time you can create an invoice that matches your work.
                        </p>
                    </section>

                    <hr class="border-slate-100">



                    <section id="stays-on-device" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Your Invoice Stays on Your Device
                        </h2>
                        <p class="text-base text-slate-600 leading-relaxed">
                            Your invoice information is processed in your browser. We do not send it to our servers. Save copies in a database.
                        </p>
                        <p class="text-base text-slate-600 leading-relaxed">
                            Your current draft stays in your browser when you refresh the page. To keep a copy download your invoice.
                        </p>
                        <p class="text-base text-slate-600 leading-relaxed">
                            You can read our <a href="{{ route('privacy') }}" class="text-slate-900 font-semibold underline underline-offset-4 hover:text-slate-600">Privacy Policy</a> to learn more, about how storage and website traffic work.
                        </p>
                    </section>

                    <hr class="border-slate-100">



                    <section id="our-goal" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Our Goal
                        </h2>
                        <p class="text-base text-slate-600 leading-relaxed">
                            Our goal is simple: make invoice creation easy, flexible and free. Spend time on paperwork and more time doing the work that matters to you.
                        </p>
                        <p class="text-base sm:text-lg font-bold text-slate-900 pt-2">
                            Choose a template or start from scratch—your next invoice starts here.
                        </p>
                    </section>

                </main>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function aboutPageApp() {
        return {
            activeSection: 'about-invoice-maker',
            sections: [
                { id: 'about-invoice-maker', label: 'About Invoice Maker', shortLabel: 'About' },
                { id: 'why-we-built', label: 'Why We Built Invoice Maker?', shortLabel: 'Why We Built' },
                { id: 'two-ways', label: 'Two Ways to Create Your Invoice', shortLabel: 'Two Ways' },
                { id: 'made-for-your-work', label: 'Made for Your Work', shortLabel: 'Your Work' },
                { id: 'stays-on-device', label: 'Your Invoice Stays on Your Device', shortLabel: 'Device Storage' },
                { id: 'our-goal', label: 'Our Goal', shortLabel: 'Our Goal' },
            ],

            scrollTo(id) {
                this.activeSection = id;
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
