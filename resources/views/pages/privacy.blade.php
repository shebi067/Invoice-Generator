@extends('layouts.app')

@section('title', 'Privacy Policy | Secure Local Browser Storage - InvoiceMaker')
@section('meta_description', 'Read the InvoiceMaker Privacy Policy. Learn how we protect your billing data using secure, private browser storage with zero tracking.')

@section('content')
<div x-data="privacyPolicyApp()" x-init="initScrollSpy()" class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-8 pb-20 sm:pt-12 sm:pb-28 overflow-hidden">

        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="sr-only">Privacy &amp; Policy</span>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white">
                Privacy Policy
            </h1>
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

                    <div class="space-y-5">
                        <p class="text-base sm:text-lg text-slate-800 leading-relaxed font-normal">
                            Welcome to <strong>InvoiceMaker.tech</strong>. We want you to know how our website deals with your information. This Privacy Policy tells you what remains on your device what data our website services might get and what options you have.
                        </p>
                        <p class="text-slate-600 leading-relaxed">
                            InvoiceMaker.tech is run by <strong>[owner or business name and location]</strong>. If you have a privacy question you can contact us at <a href="mailto:help@invoicemaker.tech" class="text-[#2A373D] font-semibold underline hover:text-slate-950">help@invoicemaker.tech</a>.
                        </p>
                    </div>

                    <hr class="border-slate-100">

                    <section id="what-our-website-does" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            What Our Website Does
                        </h2>

                        <p>
                            InvoiceMaker.tech is a free online invoice maker.
                        </p>

                        <p>
                            You can pick a ready‑made template. Modify it to match your needs. You can start from a blank page and build your own invoice.
                        </p>

                        <p>
                            You do not have to create an account sign in or buy a subscription. We do not ask for card details to use the invoice maker.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="information-in-invoice" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Information You Put in an Invoice
                        </h2>

                        <p>
                            When making an invoice you may enter:
                        </p>

                        <ul class="space-y-3 pl-1">
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Your name or business name.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Your customer’s name.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Addresses, phone numbers and email addresses.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>A business logo.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Item names and descriptions.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Prices, taxes, discounts and totals.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Invoice dates and payment instructions.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-slate-400 font-bold mt-1">&bull;</span>
                                <span>Notes or other details.</span>
                            </li>
                        </ul>

                        <p>
                            This information is processed in your browser on your device. We do not send your invoice details to our servers. We do not store copies of your invoices in a database (<strong>Zero Data Storage</strong>). This applies to both template‑based invoices and invoices made from a page.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="how-invoice-saved" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            How Your Current Invoice Is Saved
                        </h2>

                        <p>
                            Your browser stores the invoice you are currently editing. This keeps your work when you refresh the page.
                        </p>

                        <p>
                            The storage lives on your device. It is not in an account on our website.
                        </p>

                        <p>
                            A saved draft is not a backup. Browser settings clearing site data or device changes may delete it. Do not rely on the saved draft as your copy of an important invoice.
                        </p>

                        <p>
                            Because we do not keep your draft on our servers we cannot recover it for you if it is lost.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="removing-saved-draft" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Removing Your Saved Draft
                        </h2>

                        <p>
                            You can delete your saved draft by opening your browser settings and clearing the site data for InvoiceMaker.tech.
                        </p>

                        <p>
                            The exact steps depend on your browser. Look for settings named &ldquo;Site data,&rdquo; &ldquo;Cookies and site data,&rdquo; or &ldquo;Website data.&rdquo;
                        </p>

                        <p>
                            Clearing site data may also delete saved settings for our website.
                        </p>

                        <p>
                            If you use a shared or public device clear the site data when you finish. This stops the person using that browser from seeing your draft.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="downloaded-files" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Downloaded Invoice Files
                        </h2>

                        <p>
                            When you download an invoice the file is saved to the location you choose or your browser chooses. Clearing our website’s browser storage does not delete downloaded files. You must delete those files separately if you no longer need them.
                        </p>

                        <p>
                            If your device uses a backup or synced folder your downloaded invoice may be copied by that service. Its privacy rules and your settings control that process.
                        </p>

                        <p>
                            If you share an invoice with someone that person receives the information inside it.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="traffic-analytics" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Website Traffic and Analytics
                        </h2>

                        <p>
                            We use Google Analytics to see how visitors use our website.
                        </p>

                        <p>
                            For example traffic reports help us see which pages are useful and which parts of the website need improvement.
                        </p>

                        <p>
                            Our analytics setup collects data about how many visitors arrives, from which country etc.
                        </p>

                        <p>
                            The information is kept for Visual Experience for a site owner.
                        </p>

                        <p>
                            We do not send invoice contents to the analytics provider. The analytics setup must be set up to exclude invoice fields and other private invoice details.
                        </p>

                        <p class="font-medium text-slate-700">
                            Cause we care for our Beloved User&rsquo;s Privacy.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="cookies-storage" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Cookies and Similar Storage
                        </h2>

                        <p>
                            Cookies are pieces of information that a website can place in your browser. Websites can also use kinds of browser storage.
                        </p>

                        <p>
                            Our invoice maker uses browser storage to remember your draft.
                        </p>

                        <p>
                            When we need your permission we will ask before we enable tracking. You can change your choices at <strong>[location of cookie or privacy settings]</strong>.
                        </p>

                        <p>
                            You can also manage storage through your browser. If you block storage your draft might not be saved.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="website-hosting" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Website Hosting
                        </h2>

                        <p>
                            Our website uses Hostinger to keep its pages available. The hosting provider also offers us SSL protection.
                        </p>

                        <p>
                            Depending on the hosting setup technical information may include an IP address, request time or error details. Only the information confirmed for our setup should be listed here.
                        </p>

                        <p>
                            These records are separate from the information you type into an invoice.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="advertising" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Advertising
                        </h2>

                        <p>
                            We do not show advertisements when the site first launches.
                        </p>

                        <p>
                            We may add ads later to help support the website while keeping the invoice tools free.
                        </p>

                        <p>
                            Before advertising starts we will update this policy to name the services involved and explain their use of information, cookies and other tracking tools.
                        </p>

                        <p>
                            We will also explain the choices to you and request permission where needed.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="emails-you-send" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Emails You Send Us
                        </h2>

                        <p>
                            If you email us we receive your email address, your message and any attachments.
                        </p>

                        <p>
                            We use this information to answer questions solve problems and handle privacy requests. Our email service, (hostinger email service) processes these messages.
                        </p>

                        <p>
                            Please avoid sending invoices or private customer details when a short explanation will do.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="privacy-rights" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Your Privacy Rights
                        </h2>

                        <p>
                            Depending on where you live you may have privacy rights over information held about you.
                        </p>

                        <p>
                            These can include asking to see it correct it delete it or limit how it is used. You may also be able to object to uses or withdraw permission you previously gave concerning privacy.
                        </p>

                        <p>
                            Email us to make a request. We may need information to confirm your identity.
                        </p>

                        <p>
                            We cannot delete a draft stored only in your browser. You can remove it using your browser settings.
                        </p>

                        <p>
                            You may also contact your privacy authority with a complaint.
                        </p>
                    </section>


                    <hr class="border-slate-100">


                    <section id="updates-contact" class="scroll-mt-28 space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Policy Updates and Contact
                        </h2>

                        <p>
                            We may update this page when our tools, providers or information practices change. The date at the top will show the update.
                        </p>

                        <div class="space-y-1.5 pt-2">
                            <p class="font-bold text-slate-900">
                                For privacy questions or requests contact:
                            </p>
                            <p class="font-bold text-slate-800">
                                invoicemaker.tech
                            </p>
                            <p>
                                <strong>Email:</strong> <a href="mailto:help@invoicemaker.tech" class="text-[#2A373D] font-semibold underline hover:text-slate-950">help@invoicemaker.tech</a>
                            </p>
                        </div>
                    </section>

                </main>

            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function privacyPolicyApp() {
        return {
            mobileTocOpen: false,
            activeSection: 'what-our-website-does',
            sections: [
                { id: 'what-our-website-does', label: 'What Our Website Does', shortLabel: 'What We Do' },
                { id: 'information-in-invoice', label: 'Information You Put in an Invoice', shortLabel: 'Invoice Info' },
                { id: 'how-invoice-saved', label: 'How Your Current Invoice Is Saved', shortLabel: 'Saving Drafts' },
                { id: 'removing-saved-draft', label: 'Removing Your Saved Draft', shortLabel: 'Remove Draft' },
                { id: 'downloaded-files', label: 'Downloaded Invoice Files', shortLabel: 'Downloaded Files' },
                { id: 'traffic-analytics', label: 'Website Traffic and Analytics', shortLabel: 'Analytics' },
                { id: 'cookies-storage', label: 'Cookies and Similar Storage', shortLabel: 'Cookies' },
                { id: 'website-hosting', label: 'Website Hosting', shortLabel: 'Hosting' },
                { id: 'advertising', label: 'Advertising', shortLabel: 'Ads' },
                { id: 'emails-you-send', label: 'Emails You Send Us', shortLabel: 'Emails' },
                { id: 'privacy-rights', label: 'Your Privacy Rights', shortLabel: 'Your Rights' },
                { id: 'updates-contact', label: 'Policy Updates and Contact', shortLabel: 'Contact' },
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
