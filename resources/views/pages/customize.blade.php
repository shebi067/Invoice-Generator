@extends('layouts.app')

@section('title', 'Customize ' . $templateName . ' - Free Online Invoice Maker')
@section('meta_description', 'Customize the ' . $templateName . ' template with your logo, business details, line items, and download clean PDF and PNG invoices instantly.')

@section('content')
<div x-data="invoiceCustomizeApp('{{ $template }}')" x-init="initData()" class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">



        <div class="w-full max-w-4xl mx-auto mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                    Customize <span style="color: #2A373D;">{{ $templateName }}</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">
                    Click any field below to edit text, numbers, logo, and taxes. Download your finished invoice in PDF or PNG.
                </p>
            </div>
            <div>
                <a href="{{ route('templates') }}"
                   class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 px-4 py-2 rounded-full shadow-2xs transition-all">
                    <span>Change Template</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start justify-center">


            <div class="w-full lg:max-w-4xl bg-white rounded-lg shadow-sm border border-slate-200/90 invoice-printable-card transition-all overflow-hidden"
                 id="invoice-sheet"
                 :class="currentTemplate === 'minimal' ? 'p-0' : (currentTemplate === 'classic' ? 'p-3 sm:p-5' : 'p-6 sm:p-10')">

                @if($template === 'modern')
                    @include('templates.modern')
                @elseif($template === 'freelancer')
                    @include('templates.freelancer')
                @elseif($template === 'classic')
                    @include('templates.classic')
                @elseif($template === 'minimal')
                    @include('templates.minimal')
                @elseif($template === 'corporate')
                    @include('templates.corporate')
                @elseif($template === 'wave')
                    @include('templates.wave')
                @elseif($template === 'simple')
                    @include('templates.simple')
                @elseif($template === 'signature')
                    @include('templates.signature')
                @else
                    @include('templates.modern')
                @endif

            </div>


         <div class="no-print w-full lg:w-72 space-y-4">

                <div class="space-y-3">


                    <div class="bg-white border border-slate-300 rounded-full p-1 flex items-center justify-between shadow-2xs hover:border-[#2A373D] transition-all">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500 pl-3 pr-2 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" style="color: #2A373D;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Format
                        </span>
                        <div class="flex items-center gap-1">
                            <button type="button"
                                    @click="downloadFormat = 'pdf'"
                                    :style="downloadFormat === 'pdf' ? 'background-color: #2A373D; color: white;' : ''"
                                    :class="downloadFormat === 'pdf' ? 'shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                                    class="py-1 px-3.5 rounded-full text-xs transition-all cursor-pointer">
                                PDF
                            </button>
                            <button type="button"
                                    @click="downloadFormat = 'png'"
                                    :style="downloadFormat === 'png' ? 'background-color: #2A373D; color: white;' : ''"
                                    :class="downloadFormat === 'png' ? 'shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                                    class="py-1 px-3.5 rounded-full text-xs transition-all cursor-pointer">
                                PNG
                            </button>
                        </div>
                    </div>


                    <button type="button"
                            @click="downloadInvoice()"
                            :disabled="isGenerating"
                            style="background-color: #2A373D;"
                            class="w-full hover:brightness-110 active:scale-[0.99] text-white py-3 px-6 rounded-full font-bold text-sm flex items-center justify-center gap-2 shadow-sm transition-all disabled:opacity-75 disabled:cursor-wait cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span x-text="isGenerating ? 'Generating File...' : 'Download Invoice'">Download Invoice</span>
                    </button>


                    <button type="button"
                            @click="printInvoice()"
                            :disabled="isPrinting"
                            class="w-full bg-white hover:bg-slate-50 active:scale-[0.99] text-slate-700 py-3 px-6 rounded-full font-semibold text-sm flex items-center justify-center gap-2 border border-slate-300 shadow-2xs transition-all disabled:opacity-75 disabled:cursor-wait cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span x-text="isPrinting ? 'Preparing Print...' : 'Print Invoice'">Print Invoice</span>
                    </button>
                </div>

                <div class="space-y-2.5">

                    <div class="relative"
                         x-data="{ openCurrency: false }"
                         @click.outside="openCurrency = false"
                         @keydown.escape.window="openCurrency = false">


                        <button type="button"
                                @click="openCurrency = !openCurrency"
                                :class="openCurrency ? 'border-[#2A373D] ring-2 ring-[#2A373D]/10' : 'border-slate-300 hover:border-[#2A373D]'"
                                class="w-full bg-white border rounded-full px-4 py-2.5 flex items-center justify-between shadow-2xs transition-all cursor-pointer select-none">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#2A373D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Currency</span>
                            </span>
                            <div class="flex items-center gap-1.5 text-right font-bold text-xs sm:text-sm text-[#2A373D]">
                                <span x-text="currencyLabel"></span>
                                <svg class="w-3.5 h-3.5 text-slate-500 transition-transform duration-200"
                                     :class="openCurrency ? 'rotate-180 text-[#2A373D]' : 'rotate-0'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div x-show="openCurrency"
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute left-0 right-0 mt-2 z-50 max-h-72 overflow-y-auto bg-white border border-slate-200/90 rounded-2xl shadow-[0_12px_32px_rgba(42,55,61,0.16)] p-1.5 space-y-0.5">
                            <template x-for="curr in currencies" :key="curr.value">
                                <button type="button"
                                        @click="invoice.currency = curr.value; openCurrency = false"
                                        :class="invoice.currency === curr.value
                                            ? 'bg-[#2A373D] text-white font-bold shadow-xs'
                                            : 'text-slate-700 hover:bg-slate-100/90 hover:text-slate-900 font-medium'"
                                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm transition-all text-left cursor-pointer">
                                    <span x-text="curr.label"></span>
                                    <svg x-show="invoice.currency === curr.value"
                                         class="w-4 h-4 text-white shrink-0"
                                         fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </div>
                    <a href="{{ route('templates') }}"
                       class="block bg-slate-100 hover:bg-slate-200 border border-slate-200/80 rounded-full py-2 px-4 text-center text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                        &larr; Choose Another Template
                    </a>
                    <a href="{{ route('home') }}"
                       class="block bg-slate-100 hover:bg-slate-200 border border-slate-200/80 rounded-full py-2 px-4 text-center text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                        Go to Default Invoice &rarr;
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function invoiceCustomizeApp(templateName) {
        return {
            currentTemplate: templateName,
            downloadFormat: 'pdf',
            isGenerating: false,
            isPrinting: false,
            isExporting: false,
            activeError: null,
            showDiscount: false,
            showShipping: false,
            get isGeneratingPdf() {
                return this.isGenerating;
            },
            currencies: [
                { value: '$', label: 'USD ($)' },
                { value: 'Rs. ', label: 'PKR (Rs.)' },
                { value: '₹', label: 'INR (₹)' },
                { value: '€', label: 'EUR (€)' },
                { value: '£', label: 'GBP (£)' },
                { value: 'AED ', label: 'AED (د.إ)' },
                { value: 'CAD $', label: 'CAD ($)' },
                { value: 'AUD $', label: 'AUD ($)' },
            ],
            get currencyLabel() {
                const found = this.currencies.find(c => c.value === this.invoice.currency);
                return found ? found.label : (this.invoice.currency || 'USD ($)');
            },
            invoice: {
                title: 'INVOICE',
                number: '1024',
                date: new Date().toISOString().split('T')[0],
                paymentTerms: 'Payment due within 14 days',
                dueDate: '',
                poNumber: '',
                currency: '$',
                logo: '',
                companyName: 'CAVEIN ARCHITECTS',
                sender: '123 Anywhere St., Any City\n+123 456 7890\nwww.reallygreatsite.com',
                billTo: 'Really Great Company\n123 Client St., Suite 400',
                shipTo: '',
                bankName: 'Really Great Bank',
                accountName: 'Avery Davis',
                accountNumber: '123-456-7890',
                paymentInfo: '',
                paymentMethod: 'Bank Transfer / Cash',
                senderPhone: '+1 (555) 019-2834',
                senderEmail: 'billing@company.com',
                senderLocation: 'New York, USA',
                footerNote: 'Ship Cargo Worldwide — Fast, Reliable & Professional Cargo & Logistics Services.',
                items: [
                    { description: 'Concept Architectural Planning & Blueprint Draft', quantity: 1, rate: 2400 },
                    { description: '3D CAD Modeling & Structural Design Phase', quantity: 1, rate: 1600 }
                ],
                notes: 'Thank you for your business. Please remit payment via bank transfer.',
                terms: 'Payment is due within 14 days of invoice date.',
                taxRate: 10,
                discount: 0,
                shipping: 0,
                amountPaid: 0
            },

            initData() {
                let hasLoadedDraft = false;
                try {
                    const saved = localStorage.getItem('invoice_template_draft_' + this.currentTemplate);
                    if (saved) {
                        const data = JSON.parse(saved);
                        if (data && typeof data === 'object') {
                            this.invoice = Object.assign({}, this.invoice, data);
                            if (data.downloadFormat !== undefined) this.downloadFormat = data.downloadFormat;
                            hasLoadedDraft = true;
                        }
                    }
                } catch (e) {
                    console.error('Error restoring template draft:', e);
                }

                if (!hasLoadedDraft) {
                    this.loadTemplateDefaults();
                }

                if (!this.invoice.dueDate) {
                    const d = new Date();
                    d.setDate(d.getDate() + 14);
                    this.invoice.dueDate = d.toISOString().split('T')[0];
                }

                this.$watch('invoice', () => {
                    this.saveToStorage();
                    if (this.activeError && !this.isFieldInvalid(this.activeError)) {
                        this.activeError = null;
                    }
                }, { deep: true });

                this.$watch('downloadFormat', () => this.saveToStorage());

                const autoSave = () => this.saveToStorage();
                window.addEventListener('input', autoSave);
                window.addEventListener('change', autoSave);
                window.addEventListener('beforeunload', autoSave);

                window.addEventListener('keydown', (e) => {
                    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'p') {
                        e.preventDefault();
                        this.printInvoice();
                    }
                });
            },

            loadTemplateDefaults() {
                if (this.currentTemplate === 'freelancer') {
                    this.invoice.items = [
                        { description: 'Brand Identity Design & Visual Concept Exploration', quantity: 20, rate: 85 },
                        { description: 'Responsive Web UI/UX Design System & Prototyping', quantity: 15, rate: 95 }
                    ];
                    this.invoice.sender = 'Avery Davis\n123 Anywhere St., Any City\nhello@averydavis.design';
                    this.invoice.billTo = 'Really Great Company\n123 Client St., Suite 400';
                } else if (this.currentTemplate === 'classic') {
                    this.invoice.items = [
                        { description: 'Annual Corporate Advisory & Compliance Services', quantity: 1, rate: 1850 },
                        { description: 'Quarterly Financial Statement Audit & Filing', quantity: 1, rate: 950 }
                    ];
                    this.invoice.billTo = 'Alexander Pierce\n742 Evergreen Terrace\nSpringfield, OR 97477';
                } else if (this.currentTemplate === 'minimal') {
                    this.invoice.items = [
                        { description: 'International Ocean Freight Shipping (40ft Container)', quantity: 2, rate: 1250 },
                        { description: 'Customs Clearance & Documentation Processing', quantity: 1, rate: 350 }
                    ];
                    this.invoice.billTo = 'Paul Limpet\n(509) 555-0125\nwww.shipcargo.com';
                } else if (this.currentTemplate === 'corporate') {
                    this.invoice.companyName = 'Acme Global Corporation';
                    this.invoice.sender = '100 Business Parkway\nSuite 300, New York, NY 10001\nPhone: (212) 555-0199\nWebsite: acmecorp.com';
                    this.invoice.billTo = 'Jane Anderson\nGlobal Retail Solutions\n500 Market St, Suite 12\nSan Francisco, CA 94105\nPhone: (415) 555-0144';
                    this.invoice.shipTo = 'Jane Anderson\nGlobal Retail Warehouse 4\n800 Harbor Blvd, Dock 9\nOakland, CA 94607';
                    this.invoice.items = [
                        { description: 'Enterprise Software License (Annual Tier 1)', quantity: 15, rate: 150 },
                        { description: 'Hardware Terminal Interface Units Model ABC', quantity: 1, rate: 75 }
                    ];
                    this.invoice.taxRate = 6.875;
                    this.invoice.shipping = 0;
                    this.invoice.notes = '1. Total payment due in 30 days.\n2. Please include the invoice number on your check.';
                } else if (this.currentTemplate === 'wave') {
                    this.invoice.title = 'INVOICE';
                    this.invoice.number = '000001';
                    this.invoice.sender = 'Olivia Wilson\n123 Anywhere St., Any City\nhello@reallygreatsite.com';
                    this.invoice.billTo = 'Studio Shodwe\n123 Anywhere St., Any City\nhello@reallygreatsite.com';
                    this.invoice.items = [
                        { description: 'Brand Logo Design Exploration', quantity: 1, rate: 500 },
                        { description: 'Event Display Banner (2x6m)', quantity: 2, rate: 45 },
                        { description: 'Promotional Poster Series (1x2m)', quantity: 3, rate: 55 }
                    ];
                    this.invoice.paymentMethod = 'Cash / Bank Transfer';
                    this.invoice.notes = 'Thank you for choosing us!';
                } else if (this.currentTemplate === 'simple') {
                    this.invoice.companyName = 'Metro Service Specialists';
                    this.invoice.sender = '742 Evergreen Terrace\nSpringfield, OR 97477\nPhone: (555) 000-0000';
                    this.invoice.billTo = 'Robert Davis\nDavis Consulting Group\n1200 Commercial Way\nSpringfield, OR 97477\nPhone: (555) 123-4567';
                    this.invoice.items = [
                        { description: 'Professional Consultation Service Fee', quantity: 1, rate: 200 },
                        { description: 'Technical Labor & On-Site Diagnostics (5 hrs)', quantity: 1, rate: 375 },
                        { description: 'New Client Promotional Discount Voucher', quantity: 1, rate: -50 }
                    ];
                } else if (this.currentTemplate === 'signature') {
                    this.invoice.title = 'INVOICE';
                    this.invoice.sender = 'John Smith\n123 Main Street, Anytown, USA\njohnsmith@example.com';
                    this.invoice.billTo = 'Jane Doe\n456 Elm Street, Anycity, USA\njanedoe@example.com';
                    this.invoice.items = [
                        { description: 'Full Stack Web Platform Design & Development', quantity: 1, rate: 800 },
                        { description: 'SEO & Content Writing Strategy Package', quantity: 4, rate: 50 },
                        { description: 'Social Media Campaign Management Phase 1', quantity: 1, rate: 300 },
                        { description: 'Brand Graphics & Marketing Collateral Design', quantity: 2, rate: 150 },
                        { description: 'Search Engine Optimization Technical Audit', quantity: 1, rate: 500 }
                    ];
                }
            },

            saveToStorage() {
                try {
                    localStorage.setItem('invoice_template_draft_' + this.currentTemplate, JSON.stringify({
                        ...this.invoice,
                        downloadFormat: this.downloadFormat
                    }));
                } catch (e) {}
            },

            addItem() {
                this.invoice.items.push({
                    description: '',
                    quantity: 1,
                    rate: 0
                });
                this.saveToStorage();
            },

            removeItem(index) {
                if (this.invoice.items.length > 1) {
                    this.invoice.items.splice(index, 1);
                } else {
                    this.invoice.items[0] = { description: '', quantity: 1, rate: 0 };
                }
                this.saveToStorage();
            },

            get subtotal() {
                return this.invoice.items.reduce((sum, item) => {
                    const qty = Number(item.quantity) || 0;
                    const rate = Number(item.rate) || 0;
                    return sum + (qty * rate);
                }, 0);
            },

            get taxAmount() {
                const rate = Number(this.invoice.taxRate) || 0;
                return (this.subtotal * rate) / 100;
            },

            get totalAmount() {
                const discount = (this.showDiscount || Number(this.invoice.discount) > 0) ? (Number(this.invoice.discount) || 0) : 0;
                const shipping = (this.showShipping || Number(this.invoice.shipping) > 0) ? (Number(this.invoice.shipping) || 0) : 0;
                return Math.max(0, this.subtotal + this.taxAmount + shipping - discount);
            },

            get balanceDue() {
                const paid = Number(this.invoice.amountPaid) || 0;
                return Math.max(0, this.totalAmount - paid);
            },

            formatNumber(num) {
                const n = Number(num) || 0;
                return n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            },

            toggleTaxMode() {
                if (this.invoice.taxRate === 0) {
                    this.invoice.taxRate = 10;
                } else if (this.invoice.taxRate === 10) {
                    this.invoice.taxRate = 16;
                } else {
                    this.invoice.taxRate = 0;
                }
            },

            handleLogoUpload(e) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.invoice.logo = event.target.result;
                    if (this.activeError === 'logo') {
                        this.activeError = null;
                    }
                };
                reader.readAsDataURL(file);
            },

            removeLogo() {
                this.invoice.logo = '';
            },

            isFieldInvalid(key) {
                if (!key) return false;
                if (key === 'billTo') return !this.invoice.billTo || !this.invoice.billTo.trim();
                if (key === 'date') return !this.invoice.date;
                if (key === 'title') return !this.invoice.title || !this.invoice.title.trim();
                if (key === 'number') return !this.invoice.number || !this.invoice.number.trim();
                if (key.startsWith('item_desc_')) {
                    const i = parseInt(key.replace('item_desc_', ''), 10);
                    const itm = this.invoice.items[i];
                    return !itm || !itm.description || !itm.description.trim();
                }
                if (key.startsWith('item_qty_')) {
                    const i = parseInt(key.replace('item_qty_', ''), 10);
                    const itm = this.invoice.items[i];
                    return !itm || !itm.quantity || Number(itm.quantity) <= 0;
                }
                if (key.startsWith('item_rate_')) {
                    const i = parseInt(key.replace('item_rate_', ''), 10);
                    const itm = this.invoice.items[i];
                    return !itm || !itm.rate || Number(itm.rate) <= 0;
                }
                return false;
            },

            getFirstError() {
                if (!this.invoice.billTo || !this.invoice.billTo.trim()) {
                    return 'billTo';
                }
                if (!this.invoice.date) {
                    return 'date';
                }
                if (!this.invoice.title || !this.invoice.title.trim()) {
                    return 'title';
                }
                if (!this.invoice.number || !this.invoice.number.trim()) {
                    return 'number';
                }
                if (!this.invoice.items || this.invoice.items.length === 0) {
                    return 'item_desc_0';
                }
                for (let i = 0; i < this.invoice.items.length; i++) {
                    const item = this.invoice.items[i];
                    if (!item.description || !item.description.trim()) {
                        return 'item_desc_' + i;
                    }
                    if (!item.quantity || Number(item.quantity) <= 0) {
                        return 'item_qty_' + i;
                    }
                    if (!item.rate || Number(item.rate) <= 0) {
                        return 'item_rate_' + i;
                    }
                }
                return null;
            },

            validateBeforeAction() {
                const err = this.getFirstError();
                this.activeError = err;

                if (err) {
                    this.$nextTick(() => {
                        const errorElem = document.querySelector('.error-highlight');
                        if (errorElem) {
                            errorElem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            if (typeof errorElem.focus === 'function') {
                                errorElem.focus();
                            }
                        }
                    });
                    return false;
                }
                return true;
            },

            prepareInvoiceClone(clonedDoc) {
                const sheet = clonedDoc.getElementById('invoice-sheet');
                if (!sheet) return;

                sheet.querySelectorAll('.no-print, button, input[type="file"]').forEach(el => el.remove());
                sheet.querySelectorAll('[x-show*="activeError"]').forEach(el => el.remove());

                sheet.style.border = 'none';
                sheet.style.boxShadow = 'none';
                sheet.style.borderRadius = '0';
                sheet.style.width = '800px';
                sheet.style.maxWidth = '800px';
                sheet.style.margin = '0 auto';
                sheet.style.backgroundColor = '#ffffff';

                const waveRoot = sheet.querySelector('.wave-template-container');
                if (waveRoot) {
                    waveRoot.style.width = '100%';
                    waveRoot.style.position = 'relative';
                }
                sheet.querySelectorAll('.flow-wave-decor, .flow-wave-decor svg').forEach(el => {
                    el.style.width = '100%';
                    el.style.minWidth = '100%';
                    el.style.left = '0px';
                    el.style.right = '0px';
                    el.style.bottom = '0px';
                });

                sheet.querySelectorAll('input').forEach(input => {
                    const span = clonedDoc.createElement('span');
                    span.textContent = input.value || input.placeholder || '';
                    span.style.cssText = window.getComputedStyle(input).cssText;
                    span.style.border = 'none';
                    span.style.outline = 'none';
                    span.style.background = 'transparent';
                    span.style.display = 'inline-block';
                    input.parentNode.replaceChild(span, input);
                });

                sheet.querySelectorAll('textarea').forEach(textarea => {
                    const div = clonedDoc.createElement('div');
                    div.textContent = textarea.value || textarea.placeholder || '';
                    div.style.cssText = window.getComputedStyle(textarea).cssText;
                    div.style.border = 'none';
                    div.style.outline = 'none';
                    div.style.background = 'transparent';
                    div.style.whiteSpace = 'pre-wrap';
                    textarea.parentNode.replaceChild(div, textarea);
                });
            },

            generateInvoiceCanvas() {
                const element = document.getElementById('invoice-sheet');
                return html2canvas(element, {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    windowWidth: 1024,
                    onclone: (clonedDoc) => {
                        this.prepareInvoiceClone(clonedDoc);
                    }
                });
            },

            printInvoice() {
                if (!this.validateBeforeAction()) {
                    return;
                }

                this.isPrinting = true;

                this.generateInvoiceCanvas().then(canvas => {
                    const imgData = canvas.toDataURL('image/png');

                    let iframe = document.getElementById('invoice-print-frame');
                    if (iframe) {
                        iframe.remove();
                    }

                    iframe = document.createElement('iframe');
                    iframe.id = 'invoice-print-frame';
                    iframe.style.position = 'fixed';
                    iframe.style.right = '0';
                    iframe.style.bottom = '0';
                    iframe.style.width = '0';
                    iframe.style.height = '0';
                    iframe.style.border = '0';
                    iframe.style.zIndex = '-9999';
                    document.body.appendChild(iframe);

                    const doc = iframe.contentWindow.document;
                    doc.open();
                    doc.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title></title>
                            <style>
                                @page {
                                    size: A4 portrait;
                                    margin: 0 !important;
                                }
                                * {
                                    box-sizing: border-box;
                                }
                                html, body {
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    background: #ffffff !important;
                                    -webkit-print-color-adjust: exact !important;
                                    print-color-adjust: exact !important;
                                }
                                .print-wrapper {
                                    width: 100%;
                                    padding: 10mm 12mm;
                                    display: flex;
                                    justify-content: center;
                                    align-items: flex-start;
                                    box-sizing: border-box;
                                }
                                img {
                                    width: 100%;
                                    max-width: 800px;
                                    height: auto;
                                    display: block;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="print-wrapper">
                                <img id="print-doc-img" src="${imgData}" alt="Invoice" />
                            </div>
                        </body>
                        </html>
                    `);
                    doc.close();

                    const img = doc.getElementById('print-doc-img');
                    const triggerPrint = () => {
                        this.isPrinting = false;
                        setTimeout(() => {
                            try {
                                iframe.contentWindow.focus();
                                iframe.contentWindow.print();
                            } catch (e) {
                                console.error('Print trigger error:', e);
                                window.print();
                            }
                        }, 150);
                    };

                    if (img && img.complete) {
                        triggerPrint();
                    } else if (img) {
                        img.onload = triggerPrint;
                    } else {
                        triggerPrint();
                    }
                }).catch(err => {
                    console.error('Print generation error:', err);
                    this.isPrinting = false;
                    window.print();
                });
            },

            downloadInvoice() {
                if (this.downloadFormat === 'png') {
                    this.downloadPng();
                } else {
                    this.downloadPdf();
                }
            },

            downloadPdf() {
                if (!this.validateBeforeAction()) {
                    return;
                }

                this.isGenerating = true;
                const invoiceNumber = this.invoice.number || 'invoice';

                this.generateInvoiceCanvas().then(canvas => {
                    const imgData = canvas.toDataURL('image/jpeg', 0.98);
                    const jsPDFConstructor = (window.jspdf && window.jspdf.jsPDF) ? window.jspdf.jsPDF : (window.jsPDF || null);

                    if (jsPDFConstructor) {
                        const pdf = new jsPDFConstructor({
                            orientation: 'portrait',
                            unit: 'mm',
                            format: 'a4'
                        });

                        const pageWidth = 210;
                        const pageHeight = 297;
                        const imgWidth = pageWidth;
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;

                        let heightLeft = imgHeight;
                        let position = 0;

                        pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight, undefined, 'FAST');
                        heightLeft -= pageHeight;

                        while (heightLeft > 5) {
                            position = heightLeft - imgHeight;
                            pdf.addPage();
                            pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight, undefined, 'FAST');
                            heightLeft -= pageHeight;
                        }

                        pdf.save(`invoice-${invoiceNumber}.pdf`);
                        this.isGenerating = false;
                    } else {
                        throw new Error('jsPDF library not available');
                    }
                }).catch((err) => {
                    console.error('PDF generation error:', err);
                    this.isGenerating = false;
                    alert('PDF download failed. Please use PNG download or Print button.');
                });
            },

            downloadPng() {
                if (!this.validateBeforeAction()) {
                    return;
                }

                this.isGenerating = true;
                const invoiceNumber = this.invoice.number || 'invoice';

                this.generateInvoiceCanvas().then(canvas => {
                    const link = document.createElement('a');
                    link.download = `invoice-${invoiceNumber}.png`;
                    link.href = canvas.toDataURL('image/png');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    this.isGenerating = false;
                }).catch((err) => {
                    console.error('PNG error:', err);
                    this.isGenerating = false;
                    alert('PNG download failed. Please try again.');
                });
            }
        };
    }
</script>
@endpush

