@extends('layouts.app')

@section('title', 'Frequently Asked Questions (FAQs) | InvoiceMaker Help Center')
@section('meta_description', 'Got questions about InvoiceMaker? Find quick answers on free invoicing, editing templates, private browser storage, and PDF exports.')

@section('content')
<div x-data="faqApp()" class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-8 pb-20 sm:pt-12 sm:pb-28 overflow-hidden">

        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white">
                Frequently Asked Questions
            </h1>
            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                Have a question about Invoice Maker? Find simple answers below.
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

            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

                <aside class="w-full lg:w-72 shrink-0 lg:sticky lg:top-28 space-y-8 select-none">
                    
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text"
                               x-model="searchQuery"
                               placeholder="Search questions..."
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:bg-white focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden transition-all">
                        <button type="button" 
                                x-show="searchQuery.length > 0" 
                                @click="searchQuery = ''"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-700">
                            &times;
                        </button>
                    </div>

                    <div class="space-y-1">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider px-3 pb-2">
                            Topics
                        </div>
                        <template x-for="category in categories" :key="category.id">
                            <button type="button"
                                    @click="selectedCategory = category.id; searchQuery = ''"
                                    :class="selectedCategory === category.id && !searchQuery
                                        ? 'border-l-2 border-[#2A373D] text-slate-900 font-bold bg-slate-50/70' 
                                        : 'border-l-2 border-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-50/40 font-medium'"
                                    class="w-full text-left px-3.5 py-2.5 rounded-r-lg text-sm transition-all flex items-center justify-between cursor-pointer">
                                <span x-text="category.name"></span>
                                <span class="text-xs px-2 py-0.5 rounded-full"
                                      :class="selectedCategory === category.id && !searchQuery ? 'bg-slate-200 text-slate-900 font-bold' : 'text-slate-400'"
                                      x-text="getCategoryCount(category.id)"></span>
                            </button>
                        </template>
                    </div>

                    <div class="border-t border-slate-100 pt-6 space-y-3">
                        <h3 class="text-sm font-bold text-slate-900">
                            Still have questions?
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            If you didn't find your answer, feel free to reach out to our team anytime.
                        </p>
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center w-full py-2.5 px-4 rounded-xl border border-slate-300 text-xs font-bold text-slate-800 hover:bg-slate-50 transition-colors">
                            Contact Support
                        </a>
                    </div>

                </aside>


                <main class="flex-1 min-w-0 w-full space-y-12">

                    <div x-show="searchQuery.length > 0" class="flex items-center justify-between pb-3 border-b border-slate-200">
                        <div class="text-sm text-slate-600">
                            Showing results for <span class="font-bold text-slate-900">"<span x-text="searchQuery"></span>"</span>
                        </div>
                        <button type="button" @click="searchQuery = ''" class="text-xs font-semibold text-rose-600 hover:underline">
                            Clear search
                        </button>
                    </div>

                    <div class="divide-y divide-slate-200 border-t border-b border-slate-200" x-show="filteredItemsCount > 0">
                        <template x-for="item in filteredItems" :key="item.id">
                            <div class="py-4 sm:py-5 transition-colors">
                                <button type="button"
                                        @click="toggle(item.id)"
                                        class="w-full flex items-center justify-between text-left gap-4 cursor-pointer group focus:outline-hidden">
                                    <span class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-slate-700 leading-snug"
                                          x-text="item.question"></span>
                                    
                                    <span class="w-7 h-7 rounded-full flex items-center justify-center text-slate-400 group-hover:text-slate-800 group-hover:bg-slate-100 shrink-0 text-xl font-light transition-all">
                                        <span x-show="!isOpen(item.id)">+</span>
                                        <span x-show="isOpen(item.id)">&minus;</span>
                                    </span>
                                </button>

                                <div x-show="isOpen(item.id)"
                                     x-collapse
                                     class="pt-3.5 pr-8 text-slate-600 text-sm sm:text-base leading-relaxed"
                                     x-html="item.answer">
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="filteredItemsCount === 0" class="text-center py-16 space-y-3">
                        <div class="text-slate-400 text-4xl font-light">&empty;</div>
                        <h3 class="text-lg font-bold text-slate-900">No matching questions found</h3>
                        <p class="text-sm text-slate-500 max-w-sm mx-auto">
                            We couldn't find any questions matching your query. Try a different keyword or contact us.
                        </p>
                        <div class="pt-2">
                            <button type="button" @click="searchQuery = ''; selectedCategory = 'all'" class="text-sm font-bold text-[#2A373D] underline">
                                Reset filters
                            </button>
                        </div>
                    </div>

                </main>

            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function faqApp() {
        return {
            searchQuery: '',
            selectedCategory: 'all',
            openItems: [1], // First item open by default

            categories: [
                { id: 'all', name: 'All Topics' },
                { id: 'getting-started', name: 'Getting Started' },
                { id: 'creating-templates', name: 'Creating & Templates' },
                { id: 'download-sharing', name: 'Downloading & Sharing' },
                { id: 'privacy-storage', name: 'Privacy & Storage' },
                { id: 'support', name: 'Support' }
            ],

            items: [
                {
                    id: 1,
                    category: 'getting-started',
                    question: 'Is Invoice Maker completely free?',
                    answer: 'Yes! InvoiceMaker.tech is completely free. You can use our ready-made templates or create your own invoice without paying a fee. There are no paid plans or subscriptions.'
                },
                {
                    id: 2,
                    category: 'getting-started',
                    question: 'Do I need to create an account?',
                    answer: 'No. You do not need to sign up or log in. Open the website and start making your invoice.'
                },
                {
                    id: 3,
                    category: 'creating-templates',
                    question: 'How do I create an invoice?',
                    answer: 'Choose a template or start with a blank page. Add your business details, your customer’s details, and the products or services you are billing for. Check the information, then download your finished invoice.'
                },
                {
                    id: 4,
                    category: 'creating-templates',
                    question: 'Can I edit the ready-made templates?',
                    answer: 'Yes. Our templates are starting points for your invoice. Replace the sample information with your own details and use the available editing options to make it fit your needs.'
                },
                {
                    id: 5,
                    category: 'creating-templates',
                    question: 'Can I create an invoice from scratch?',
                    answer: 'Yes. Choose the custom invoice option to start with a blank page. Use the available tools to add and arrange your invoice content.'
                },
                {
                    id: 6,
                    category: 'download-sharing',
                    question: 'How do I download my invoice?',
                    answer: 'When your invoice is ready, use the download option to save it as a PDF. The file will be saved to your device. You can usually find it in your Downloads folder unless you choose another location.'
                },
                {
                    id: 7,
                    category: 'privacy-storage',
                    question: 'Are my invoice details stored on your servers?',
                    answer: 'No. Your invoice details are processed in your browser, on your device. We do not send them to our servers or store copies in a database. Read our <a href="{{ route("privacy") }}" class="underline font-semibold hover:text-slate-900">Privacy Policy</a> for separate information about website traffic tools and browser storage.'
                },
                {
                    id: 8,
                    category: 'privacy-storage',
                    question: 'Will my invoice stay saved if I refresh the page?',
                    answer: 'Yes. Your current invoice draft stays in your browser when you refresh the page. This is not a permanent backup, so download your finished invoice to keep a copy.'
                },
                {
                    id: 9,
                    category: 'privacy-storage',
                    question: 'How do I delete my saved draft?',
                    answer: 'Open your browser settings and clear the site data for InvoiceMaker.tech. The steps may be listed under “Site data” or “Cookies and site data.” This removes the browser’s saved draft but does not delete invoices you have already downloaded.'
                },
                {
                    id: 10,
                    category: 'privacy-storage',
                    question: 'Can I recover a lost invoice?',
                    answer: 'We cannot recover a lost draft because we do not keep a copy on our servers. If you already downloaded the invoice, check your Downloads folder or the location where you saved it. Keep copies of important invoices in a safe place.'
                },
                {
                    id: 11,
                    category: 'download-sharing',
                    question: 'How can I send the downloaded invoice to my client?',
                    answer: 'Download the invoice, then attach the PDF to an email or send it through a messaging app you use with your client. Check the file and the recipient’s details before sending it.'
                },
                {
                    id: 12,
                    category: 'support',
                    question: 'How can I contact support?',
                    answer: 'You can email us at <a href="mailto:help@invoicemaker.tech" class="underline font-semibold hover:text-slate-900">help@invoicemaker.tech</a> with questions, feedback, or details of a problem. Please explain what happened and which browser you were using. Avoid including private customer or payment details unless they are needed to explain the issue.'
                },
                {
                    id: 13,
                    category: 'download-sharing',
                    question: 'Can I download invoices as PDF and PNG?',
                    answer: 'Yes! You can easily toggle between PDF and PNG formats with a single click before downloading your finished invoice.'
                },
                {
                    id: 14,
                    category: 'creating-templates',
                    question: 'How do I customize my invoice with a logo and currency?',
                    answer: 'Simply click "+ Add Your Logo" to upload your brand image, choose your preferred currency (USD, PKR, INR, EUR, GBP, AED, etc.) from the dropdown, and customize line items and taxes.'
                },
                {
                    id: 15,
                    category: 'privacy-storage',
                    question: 'Is my financial and client data secure?',
                    answer: 'Yes, absolutely! All invoice rendering and calculations happen locally inside your browser session (client-side). None of your clients\' information or financial records are sent to or stored on our servers.'
                }
            ],

            toggle(id) {
                if (this.openItems.includes(id)) {
                    this.openItems = this.openItems.filter(item => item !== id);
                } else {
                    this.openItems.push(id);
                }
            },

            isOpen(id) {
                return this.openItems.includes(id);
            },

            getCategoryCount(categoryId) {
                if (categoryId === 'all') return this.items.length;
                return this.items.filter(item => item.category === categoryId).length;
            },

            get filteredItems() {
                const q = this.searchQuery.trim().toLowerCase();
                return this.items.filter(item => {
                    const matchesCategory = (this.selectedCategory === 'all' || item.category === this.selectedCategory);
                    if (!q) return matchesCategory;

                    const matchesQuery = item.question.toLowerCase().includes(q) || 
                                         item.answer.toLowerCase().includes(q);
                    return matchesCategory && matchesQuery;
                });
            },

            get filteredItemsCount() {
                return this.filteredItems.length;
            },

            get activeCategories() {
                const cats = this.categories.filter(c => c.id !== 'all');
                return cats.filter(cat => this.getCategoryItems(cat.id).length > 0);
            },

            getCategoryItems(categoryId) {
                return this.filteredItems.filter(item => item.category === categoryId);
            }
        };
    }
</script>
@endpush
