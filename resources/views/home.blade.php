@extends('layouts.app')

@section('title', 'Free Online Invoice Maker | Create & Download PDFs Fast')
@section('meta_description', 'Create professional invoices in seconds with InvoiceMaker. 100% free, no sign-up needed. Customize & download instant PDFs today!')
@section('canonical', route('home'))

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebApplication',
    'name' => 'InvoiceMaker - Free Online Invoice Maker',
    'url' => route('home'),
    'applicationCategory' => 'BusinessApplication',
    'operatingSystem' => 'All',
    'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
    'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'USD',
    ],
    'description' => 'Create professional invoices in seconds with InvoiceMaker. 100% free, no sign-up needed. Customize & download instant PDFs today!',
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div x-data="invoiceApp()" x-init="initData()" class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="w-full max-w-4xl mx-auto mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Invoice&nbsp;&nbsp;Maker</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-700">Create professional invoices with our online platform for free</p>
            <p class="mt-2 text-sm sm:text-base text-slate-700">Designed to meet the needs of freelancers, small businesses, and service providers, our generator makes it simple to produce clean billing receipts, send them directly to clients, and accept payments online. Download your finished documents as PDFs for convenient sharing and effortless record keeping.</p>
            <p class="mt-2 text-sm sm:text-base text-slate-700">Choose from ready-made designer templates or build a custom layout tailored to your brand.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start justify-center">
            <div class="w-full lg:max-w-4xl bg-white rounded-lg shadow-sm border border-slate-200/90 p-6 sm:p-10 invoice-printable-card transition-all" id="invoice-sheet">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-6 pb-6">
                    <div class="w-full sm:w-auto min-w-[180px] max-w-[280px]">
                            <template x-if="invoice.logo">
                            <div class="relative group inline-block max-w-full">


                                <div class="logo-box-border p-1 rounded-md border border-slate-200/90 bg-white shadow-2xs hover:border-[#2A373D] transition-all flex items-center justify-center">
                                    <img :src="invoice.logo"
                                         alt="Company Logo"
                                         class="max-h-32 max-w-[240px] w-auto h-auto object-contain block transition-transform group-hover:scale-[1.01]"
                                         id="invoice-logo-img">
                                </div>
                                <div class="no-print absolute -top-2.5 -right-2.5 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                    <label for="invoice_logo_change" class="cursor-pointer bg-[#2A373D] hover:brightness-110 text-white rounded-full p-1.5 shadow-md transition-colors" title="Change Logo">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                        <input type="file" id="invoice_logo_change" aria-label="Change Company Logo" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                                    </label>
                                    <button type="button"
                                            @click="removeLogo()"
                                            class="bg-rose-500 hover:bg-rose-600 text-white rounded-full p-1.5 shadow-md transition-colors"
                                            title="Remove Logo"
                                            aria-label="Remove Company Logo">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="!invoice.logo">
                            <div>
                                <label for="invoice_logo_upload" class="cursor-pointer w-48 h-24 border rounded-md bg-slate-50/60 hover:bg-slate-100 flex items-center justify-center text-slate-700 text-sm font-medium transition-colors border-dashed"
                                       :class="activeError === 'logo' ? 'border-rose-500 bg-rose-50/40 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-lg leading-none">+</span>
                                        <span>Add Your Logo</span>
                                    </div>
                                    <input type="file" id="invoice_logo_upload" aria-label="Upload Company Logo" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                                </label>
                                <div x-show="activeError === 'logo'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>(Please fill this section)</span>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="w-full sm:w-auto sm:text-right space-y-3">
                        <div class="inline-block sm:text-right">
                            <input type="text"
                                   id="invoice_title"
                                   aria-label="Invoice Title"
                                   x-model="invoice.title"
                                   class="text-3xl sm:text-4xl font-extrabold uppercase tracking-tight text-slate-800 text-left sm:text-right w-full sm:w-64 border rounded-md px-3 py-1.5 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden transition-all placeholder:text-slate-500"
                                   :class="activeError === 'title' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'"
                                   placeholder="INVOICE">
                            <div x-show="activeError === 'title'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 text-left sm:text-right flex sm:justify-end items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>(Please fill this section)</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-start sm:justify-end gap-2">
                                <label for="invoice_number" class="text-sm font-semibold text-slate-700 cursor-pointer">#</label>
                                <input type="text"
                                       id="invoice_number"
                                       aria-label="Invoice Number"
                                       x-model="invoice.number"
                                       class="w-36 text-right border rounded-md px-3 py-1.5 text-sm font-medium text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden transition-all placeholder:text-slate-500"
                                       :class="activeError === 'number' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'"
                                       placeholder="2">
                            </div>
                            <div x-show="activeError === 'number'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 text-left sm:text-right flex sm:justify-end items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>(Please fill this section)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-2 pb-6 grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    <div class="md:col-span-7 space-y-5">
                        <div>
                            <label for="invoice_sender" class="block text-xs font-semibold text-slate-700 mb-1.5 cursor-pointer">From</label>
                            <textarea id="invoice_sender"
                                      aria-label="Who is this from (Sender details)"
                                      x-model="invoice.sender"
                                      rows="3"
                                      placeholder="Who is this from?"
                                      class="w-full border rounded-md p-3 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500 transition-all"
                                      :class="activeError === 'sender' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'"></textarea>
                            <div x-show="activeError === 'sender'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>(Please fill this section)</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="invoice_bill_to" class="block text-xs font-semibold text-slate-700 mb-1.5 cursor-pointer">Bill To</label>
                                <textarea id="invoice_bill_to"
                                          aria-label="Who is this to (Bill To details)"
                                          x-model="invoice.billTo"
                                          rows="3"
                                          placeholder="Who is this to?"
                                          class="w-full border rounded-md p-2.5 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500 transition-all"
                                          :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'"></textarea>
                                <div x-show="activeError === 'billTo'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>(Please fill this section)</span>
                                </div>
                            </div>

                            <div>
                                <label for="invoice_ship_to" class="block text-xs font-semibold text-slate-700 mb-1.5 cursor-pointer">Ship To</label>
                                <textarea id="invoice_ship_to"
                                          aria-label="Ship to details (optional)"
                                          x-model="invoice.shipTo"
                                          rows="3"
                                          placeholder="(optional)"
                                          class="w-full border border-slate-300 rounded-md p-2.5 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="md:col-span-5 space-y-2.5 text-xs sm:text-sm">
                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <label for="invoice_date" class="text-slate-700 font-medium whitespace-nowrap cursor-pointer">Date</label>
                                <input type="date"
                                       id="invoice_date"
                                       aria-label="Invoice Date"
                                       x-model="invoice.date"
                                       class="w-44 text-right border rounded-md px-3 py-1.5 text-xs sm:text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden bg-transparent transition-all"
                                       :class="activeError === 'date' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'">
                            </div>
                            <div x-show="activeError === 'date'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 text-right flex justify-end items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>(Please fill this section)</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <label for="invoice_payment_terms" class="text-slate-700 font-medium whitespace-nowrap cursor-pointer">Payment Terms</label>
                            <input type="text"
                                   id="invoice_payment_terms"
                                   aria-label="Payment Terms"
                                   x-model="invoice.paymentTerms"
                                   placeholder="(optional)"
                                   class="w-44 text-right border border-slate-300 rounded-md px-3 py-1.5 text-xs sm:text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500">
                        </div>
                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <label for="invoice_due_date" class="text-slate-700 font-medium whitespace-nowrap cursor-pointer">Due Date</label>
                                <input type="date"
                                       id="invoice_due_date"
                                       aria-label="Due Date"
                                       x-model="invoice.dueDate"
                                       class="w-44 text-right border rounded-md px-3 py-1.5 text-xs sm:text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden bg-transparent transition-all"
                                       :class="activeError === 'dueDate' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'">
                            </div>
                            <div x-show="activeError === 'dueDate'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 text-right flex justify-end items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>(Please fill this section)</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <label for="invoice_po_number" class="text-slate-700 font-medium whitespace-nowrap cursor-pointer">PO Number</label>
                            <input type="text"
                                   id="invoice_po_number"
                                   aria-label="Purchase Order Number"
                                   x-model="invoice.poNumber"
                                   placeholder="(optional)"
                                   class="w-44 text-right border border-slate-300 rounded-md px-3 py-1.5 text-xs sm:text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500">
                        </div>

                    </div>

                </div>
                <div class="pt-4 pb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#131924] text-white rounded-t-md text-xs sm:text-sm font-semibold">
                                    <th class="py-2.5 px-4 rounded-tl-md w-7/12">Item</th>
                                    <th class="py-2.5 px-3 text-right w-2/12">Quantity</th>
                                    <th class="py-2.5 px-3 text-right w-2/12">Rate</th>
                                    <th class="py-2.5 px-4 text-right rounded-tr-md w-2/12">Amount</th>
                                    <th class="no-print py-2.5 px-2 w-1/12 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                <template x-for="(item, index) in invoice.items" :key="index">
                                    <tr class="group hover:bg-slate-50/50">
                                        <td class="py-2 px-2 align-top">
                                            <input type="text"
                                                   x-model="item.description"
                                                   aria-label="Description of item or service"
                                                   placeholder="Description of item/service..."
                                                   class="w-full border rounded-md px-3 py-2 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500 transition-all"
                                                   :class="activeError === ('item_desc_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'">
                                            <div x-show="activeError === ('item_desc_' + index)" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span>(Please fill this section)</span>
                                            </div>
                                        </td>
                                        <td class="py-2 px-2 text-right align-top">
                                            <input type="text"
                                                   inputmode="decimal"
                                                   x-model="item.quantity"
                                                   aria-label="Item quantity"
                                                   @keydown="filterNumericInput($event, true)"
                                                   @focus="$event.target.select()"
                                                   @input="handleQtyInput($event, item)"
                                                   @blur="handleQtyBlur($event, item)"
                                                   placeholder="0"
                                                   class="w-20 text-right border rounded-md px-2.5 py-2 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden transition-all placeholder:text-slate-500"
                                                   :class="activeError === ('item_qty_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'">
                                            <div x-show="activeError === ('item_qty_' + index)" x-cloak class="no-print text-rose-600 text-[11px] font-semibold mt-1 text-right">
                                                (Please fill this section)
                                            </div>
                                        </td>
                                        <td class="py-2 px-2 text-right align-top">
                                            <div class="relative inline-block w-28">
                                                <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center text-slate-600 text-xs sm:text-sm" x-text="invoice.currency"></span>
                                                <input type="text"
                                                       inputmode="decimal"
                                                       x-model="item.rate"
                                                       aria-label="Item rate"
                                                       @keydown="filterNumericInput($event, true)"
                                                       @focus="$event.target.select()"
                                                       @input="handleRateInput($event, item)"
                                                       @blur="handleRateBlur($event, item)"
                                                       placeholder="0"
                                                       class="w-full text-right border rounded-md pl-6 pr-2.5 py-2 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden transition-all placeholder:text-slate-500"
                                                       :class="activeError === ('item_rate_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : 'border-slate-300'">
                                            </div>
                                            <div x-show="activeError === ('item_rate_' + index)" x-cloak class="no-print text-rose-600 text-[11px] font-semibold mt-1 text-right">
                                                (Please fill this section)
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 text-right font-medium text-slate-800 align-top pt-3.5">
                                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                                        </td>
                                        <td class="no-print py-2 px-1 text-center align-top pt-2.5">
                                            <button type="button"
                                                    @click="removeItem(index)"
                                                    aria-label="Remove item row"
                                                    class="text-slate-900 hover:text-rose-600 hover:bg-slate-100 transition-all p-1.5 rounded-md inline-flex items-center justify-center cursor-pointer"
                                                    title="Delete / Clear row">
                                                <svg class="w-4 h-4 text-slate-900 hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="no-print mt-2">
                        <button type="button"
                                @click="addItem()"
                                style="color: #2A373D;"
                                class="w-full sm:w-auto px-5 py-2 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-300 font-semibold text-xs sm:text-sm transition-colors inline-flex items-center justify-center gap-1.5">
                            <span class="text-base font-bold leading-none">+</span>
                            <span>Line Item</span>
                        </button>
                    </div>
                </div>
                <div class="pt-4 pb-4 border-t border-slate-200 grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                    <div class="md:col-span-7 space-y-5">
                        <div>
                            <label for="invoice_notes" class="block text-xs font-semibold text-slate-700 mb-1.5 cursor-pointer">Notes <span class="text-slate-500 font-normal">(optional)</span></label>
                            <textarea id="invoice_notes"
                                      aria-label="Notes (optional)"
                                      x-model="invoice.notes"
                                      rows="3"
                                      placeholder="(optional) Notes - any relevant information not already covered"
                                      class="w-full border border-slate-300 rounded-md p-2.5 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500"></textarea>
                        </div>
                        <div>
                            <label for="invoice_terms" class="block text-xs font-semibold text-slate-700 mb-1.5 cursor-pointer">Terms <span class="text-slate-500 font-normal">(optional)</span></label>
                            <textarea id="invoice_terms"
                                      aria-label="Terms and conditions (optional)"
                                      x-model="invoice.terms"
                                      rows="3"
                                      placeholder="(optional) Terms and conditions - late fees, payment methods, delivery schedule"
                                      class="w-full border border-slate-300 rounded-md p-2.5 text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500"></textarea>
                        </div>
                    </div>
                    <div class="md:col-span-5 space-y-3 text-xs sm:text-sm">
                        <div class="flex items-center justify-between py-1 text-slate-700">
                            <span class="font-medium">Subtotal</span>
                            <span class="font-medium text-slate-900">
                                <span x-text="invoice.currency"></span><span x-text="formatNumber(subtotal)"></span>
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-1 text-slate-700">
                            <label for="invoice_tax_rate" class="font-medium cursor-pointer">Tax</label>
                            <div class="flex items-center gap-2">
                                <div class="tax-box-border flex items-center border border-slate-300 rounded-md overflow-hidden bg-white">
                                    <input type="number"
                                           id="invoice_tax_rate"
                                           aria-label="Tax rate percentage"
                                           x-model.number="invoice.taxRate"
                                           min="0"
                                           step="0.5"
                                           class="w-14 text-center py-1 text-xs sm:text-sm text-slate-800 focus:outline-hidden">
                                    <span class="px-2 text-slate-600 bg-slate-50 border-l border-slate-200 text-xs">%</span>
                                </div>
                                <button type="button"
                                        @click="toggleTaxMode()"
                                        aria-label="Toggle tax calculation mode"
                                        class="no-print text-slate-500 hover:text-slate-700 p-1"
                                        title="Toggle percentage / flat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="no-print flex items-center gap-4 text-xs font-semibold py-1">
                            <button type="button"
                                    @click="showDiscount = !showDiscount"
                                    style="color: #2A373D;"
                                    class="hover:underline flex items-center gap-1 font-semibold">
                                <span x-text="showDiscount ? '- Remove Discount' : '+ Discount'"></span>
                            </button>
                            <button type="button"
                                    @click="showShipping = !showShipping"
                                    style="color: #2A373D;"
                                    class="hover:underline flex items-center gap-1 font-semibold">
                                <span x-text="showShipping ? '- Remove Shipping' : '+ Shipping'"></span>
                            </button>
                        </div>
                        <div x-show="showDiscount" x-cloak class="flex items-center justify-between py-1 text-slate-700">
                            <label for="invoice_discount" class="font-medium cursor-pointer" style="color: #2A373D;">Discount:</label>
                            <div class="flex items-center gap-1">
                                <span class="text-xs text-slate-600" x-text="invoice.currency"></span>
                                <input type="text"
                                       id="invoice_discount"
                                       aria-label="Discount amount"
                                       inputmode="decimal"
                                       x-model="invoice.discount"
                                       @keydown="filterNumericInput($event, true)"
                                       @focus="$event.target.select()"
                                       @input="invoice.discount = cleanNumberString($event.target.value, true)"
                                       @blur="if (!invoice.discount || invoice.discount === '' || invoice.discount === '.') invoice.discount = 0"
                                       placeholder="0"
                                       class="w-20 text-right border border-slate-300 rounded-md px-2 py-1 text-xs text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500">
                            </div>
                        </div>
                        <div x-show="showShipping" x-cloak class="flex items-center justify-between py-1 text-slate-700">
                            <label for="invoice_shipping" class="font-medium cursor-pointer" style="color: #2A373D;">Shipping:</label>
                            <div class="flex items-center gap-1">
                                <span class="text-xs text-slate-600" x-text="invoice.currency"></span>
                                <input type="text"
                                       id="invoice_shipping"
                                       aria-label="Shipping amount"
                                       inputmode="decimal"
                                       x-model="invoice.shipping"
                                       @keydown="filterNumericInput($event, true)"
                                       @focus="$event.target.select()"
                                       @input="invoice.shipping = cleanNumberString($event.target.value, true)"
                                       @blur="if (!invoice.shipping || invoice.shipping === '' || invoice.shipping === '.') invoice.shipping = 0"
                                       placeholder="0"
                                       class="w-20 text-right border border-slate-300 rounded-md px-2 py-1 text-xs text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500">
                            </div>
                        </div>
                        <div class="border-t border-slate-300 my-2"></div>
                        <div class="flex items-center justify-between py-1 text-slate-800">
                            <span class="font-bold">Total</span>
                            <span class="font-bold text-slate-900">
                                <span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span>
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-1 text-slate-700">
                            <label for="invoice_amount_paid" class="font-medium cursor-pointer">Amount Paid</label>
                            <div class="relative inline-block w-28">
                                <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center text-slate-600 text-xs sm:text-sm" x-text="invoice.currency"></span>
                                <input type="text"
                                       id="invoice_amount_paid"
                                       aria-label="Amount Paid"
                                       inputmode="decimal"
                                       x-model="invoice.amountPaid"
                                       @keydown="filterNumericInput($event, true)"
                                       @focus="$event.target.select()"
                                       @input="invoice.amountPaid = cleanNumberString($event.target.value, true)"
                                       @blur="if (!invoice.amountPaid || invoice.amountPaid === '' || invoice.amountPaid === '.') invoice.amountPaid = 0"
                                       placeholder="0"
                                       class="w-full text-right border border-slate-300 rounded-md pl-6 pr-2.5 py-1 text-xs sm:text-sm text-slate-800 focus:border-[#2A373D] focus:ring-1 focus:ring-[#2A373D] focus:outline-hidden placeholder:text-slate-500">
                            </div>
                        </div>
                        <div class="border-t-2 border-slate-800 my-2"></div>
                        <div class="flex items-center justify-between py-2 text-slate-900">
                            <span class="text-base sm:text-lg font-black tracking-tight">Balance Due</span>
                            <span class="text-base sm:text-lg font-black tracking-tight">
                                <span x-text="invoice.currency"></span><span x-text="formatNumber(balanceDue)"></span>
                            </span>
                        </div>

                    </div>

                </div>

            </div>
            <div class="no-print w-full lg:w-72 space-y-4">

                <div class="space-y-3">

                    <div class="bg-white border border-slate-300 rounded-full p-1 flex items-center justify-between shadow-2xs hover:border-[#2A373D] transition-all">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-600 pl-3 pr-2 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" style="color: #2A373D;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Format
                        </span>
                        <div class="flex items-center gap-1">
                            <button type="button"
                                    @click="downloadFormat = 'pdf'"
                                    aria-label="Download format PDF"
                                    :style="downloadFormat === 'pdf' ? 'background-color: #2A373D; color: white;' : ''"
                                    :class="downloadFormat === 'pdf' ? 'shadow-xs font-bold' : 'text-slate-700 hover:text-slate-950 font-semibold'"
                                    class="py-1 px-3.5 rounded-full text-xs transition-all cursor-pointer">
                                PDF
                            </button>
                            <button type="button"
                                    @click="downloadFormat = 'png'"
                                    aria-label="Download format PNG"
                                    :style="downloadFormat === 'png' ? 'background-color: #2A373D; color: white;' : ''"
                                    :class="downloadFormat === 'png' ? 'shadow-xs font-bold' : 'text-slate-700 hover:text-slate-950 font-semibold'"
                                    class="py-1 px-3.5 rounded-full text-xs transition-all cursor-pointer">
                                PNG
                            </button>
                        </div>
                    </div>

                    <button type="button"
                            @click="downloadInvoice()"
                            :disabled="isGenerating"
                            aria-label="Download Invoice"
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
                            aria-label="Print Invoice"
                            class="w-full bg-white hover:bg-slate-50 active:scale-[0.99] text-slate-800 py-3 px-6 rounded-full font-semibold text-sm flex items-center justify-center gap-2 border border-slate-300 shadow-2xs transition-all disabled:opacity-75 disabled:cursor-wait cursor-pointer">
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
                                aria-label="Select currency"
                                :class="openCurrency ? 'border-[#2A373D] ring-2 ring-[#2A373D]/10' : 'border-slate-300 hover:border-[#2A373D]'"
                                class="w-full bg-white border rounded-full px-4 py-2.5 flex items-center justify-between shadow-2xs transition-all cursor-pointer select-none">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#2A373D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Currency</span>
                            </span>
                            <div class="flex items-center gap-1.5 text-right font-bold text-xs sm:text-sm text-[#2A373D]">
                                <span x-text="currencyLabel"></span>
                                <svg class="w-3.5 h-3.5 text-slate-600 transition-transform duration-200"
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

                    <button type="button"
                            @click="clearInvoice()"
                            aria-label="Clear all invoice fields"
                            class="w-full bg-white hover:bg-rose-50/60 border border-slate-300 hover:border-rose-300 text-slate-700 hover:text-rose-600 rounded-full py-2 px-4 flex items-center justify-center gap-1.5 text-xs font-bold transition-all shadow-2xs hover:shadow-xs cursor-pointer group">
                        <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Clear Invoice</span>
                    </button>

                    <a href="{{ route('templates') }}"
                       class="block bg-slate-100 hover:bg-slate-200 border border-slate-200/80 rounded-full py-2 px-4 text-center text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                        Free Invoice Templates &rarr;
                    </a>
                    <a href="{{ route('invoice.builder') }}"
                       class="block bg-slate-100 hover:bg-slate-200 border border-slate-200/80 rounded-full py-2 px-4 text-center text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                        Customize Your Invoice &rarr;
                    </a>
                </div>

            </div>

        </div>

        <section class="no-print mt-20 max-w-2xl mx-auto"
                 x-data="{
                     openFaqs: [],
                     toggle(id) {
                         if (this.openFaqs.includes(id)) {
                             this.openFaqs = this.openFaqs.filter(x => x !== id);
                         } else {
                             this.openFaqs.push(id);
                         }
                     },
                     isOpen(id) {
                         return this.openFaqs.includes(id);
                     }
                 }">
            <div class="text-center mb-10">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    FAQ
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600">
                    Get quick answers to your questions.
                </p>
            </div>

            <div class="space-y-4">
                <div class="relative">
                    <button type="button"
                            @click="toggle(0)"
                            style="background-color: #2A373D;"
                            class="relative z-20 text-white font-medium text-sm sm:text-base py-3 sm:py-3.5 px-6 rounded-2xl sm:rounded-3xl hover:brightness-110 active:scale-[0.99] transition-all text-left cursor-pointer inline-flex items-center gap-3 shadow-sm">
                        <span>Is Invoice Maker completely free?</span>
                        <span class="sr-only">How does InvoiceMaker work and is it free?</span>
                        <svg class="w-4 h-4 text-white/70 transition-transform duration-300 shrink-0"
                             :class="isOpen(0) ? 'rotate-45 text-white' : 'rotate-0'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <div x-show="isOpen(0)" 
                         x-cloak 
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-5 scale-[0.98]"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
                         class="relative z-10 -mt-3.5 sm:-mt-4 max-w-2xl bg-white border border-slate-100 shadow-[0_12px_36px_rgba(0,0,0,0.08)] rounded-3xl pt-7 pb-5 px-5 sm:pt-8 sm:pb-6 sm:px-7 text-slate-700 text-sm sm:text-base leading-relaxed">
                        Yes! InvoiceMaker.tech is completely free. You can use our ready-made templates or create your own billing document without paying a fee. There are no paid plans or subscriptions.
                    </div>
                </div>

                <div class="relative">
                    <button type="button"
                            @click="toggle(1)"
                            style="background-color: #2A373D;"
                            class="relative z-20 text-white font-medium text-sm sm:text-base py-3 sm:py-3.5 px-6 rounded-2xl sm:rounded-3xl hover:brightness-110 active:scale-[0.99] transition-all text-left cursor-pointer inline-flex items-center gap-3 shadow-sm">
                        <span>Do I need to create an account?</span>
                        <svg class="w-4 h-4 text-white/70 transition-transform duration-300 shrink-0"
                             :class="isOpen(1) ? 'rotate-45 text-white' : 'rotate-0'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <div x-show="isOpen(1)" 
                         x-cloak 
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-5 scale-[0.98]"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
                         class="relative z-10 -mt-3.5 sm:-mt-4 max-w-2xl bg-white border border-slate-100 shadow-[0_12px_36px_rgba(0,0,0,0.08)] rounded-3xl pt-7 pb-5 px-5 sm:pt-8 sm:pb-6 sm:px-7 text-slate-700 text-sm sm:text-base leading-relaxed">
                        No. You do not need to sign up or log in. Open the website and start preparing your receipt immediately.
                    </div>
                </div>

                <div class="relative">
                    <button type="button"
                            @click="toggle(2)"
                            style="background-color: #2A373D;"
                            class="relative z-20 text-white font-medium text-sm sm:text-base py-3 sm:py-3.5 px-6 rounded-2xl sm:rounded-3xl hover:brightness-110 active:scale-[0.99] transition-all text-left cursor-pointer inline-flex items-center gap-3 shadow-sm">
                        <span>How do I create an invoice?</span>
                        <svg class="w-4 h-4 text-white/70 transition-transform duration-300 shrink-0"
                             :class="isOpen(2) ? 'rotate-45 text-white' : 'rotate-0'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <div x-show="isOpen(2)" 
                         x-cloak 
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-5 scale-[0.98]"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
                         class="relative z-10 -mt-3.5 sm:-mt-4 max-w-2xl bg-white border border-slate-100 shadow-[0_12px_36px_rgba(0,0,0,0.08)] rounded-3xl pt-7 pb-5 px-5 sm:pt-8 sm:pb-6 sm:px-7 text-slate-700 text-sm sm:text-base leading-relaxed">
                        Choose a template or start with a blank page. Add your business details, your customer’s details, and the products or services you are billing for. Check the information, then download your finished invoice.
                    </div>
                </div>

                <div class="relative">
                    <button type="button"
                            @click="toggle(3)"
                            style="background-color: #2A373D;"
                            class="relative z-20 text-white font-medium text-sm sm:text-base py-3 sm:py-3.5 px-6 rounded-2xl sm:rounded-3xl hover:brightness-110 active:scale-[0.99] transition-all text-left cursor-pointer inline-flex items-center gap-3 shadow-sm">
                        <span>Can I edit the ready-made templates?</span>
                        <svg class="w-4 h-4 text-white/70 transition-transform duration-300 shrink-0"
                             :class="isOpen(3) ? 'rotate-45 text-white' : 'rotate-0'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <div x-show="isOpen(3)" 
                         x-cloak 
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-5 scale-[0.98]"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
                         class="relative z-10 -mt-3.5 sm:-mt-4 max-w-2xl bg-white border border-slate-100 shadow-[0_12px_36px_rgba(0,0,0,0.08)] rounded-3xl pt-7 pb-5 px-5 sm:pt-8 sm:pb-6 sm:px-7 text-slate-700 text-sm sm:text-base leading-relaxed">
                        Yes. Our templates are starting points for your billing. Replace the sample information with your own details and use the available editing options to make it fit your needs.
                    </div>
                </div>

                <div class="relative">
                    <button type="button"
                            @click="toggle(4)"
                            style="background-color: #2A373D;"
                            class="relative z-20 text-white font-medium text-sm sm:text-base py-3 sm:py-3.5 px-6 rounded-2xl sm:rounded-3xl hover:brightness-110 active:scale-[0.99] transition-all text-left cursor-pointer inline-flex items-center gap-3 shadow-sm">
                        <span>Are my invoice details stored on your servers?</span>
                        <svg class="w-4 h-4 text-white/70 transition-transform duration-300 shrink-0"
                             :class="isOpen(4) ? 'rotate-45 text-white' : 'rotate-0'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <div x-show="isOpen(4)" 
                         x-cloak 
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-5 scale-[0.98]"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
                         class="relative z-10 -mt-3.5 sm:-mt-4 max-w-2xl bg-white border border-slate-100 shadow-[0_12px_36px_rgba(0,0,0,0.08)] rounded-3xl pt-7 pb-5 px-5 sm:pt-8 sm:pb-6 sm:px-7 text-slate-700 text-sm sm:text-base leading-relaxed">
                        No. Your billing details are processed in your browser, on your device. We do not send them to our servers or store copies in a database.
                    </div>
                </div>

                <div class="relative">
                    <button type="button"
                            @click="toggle(5)"
                            style="background-color: #2A373D;"
                            class="relative z-20 text-white font-medium text-sm sm:text-base py-3 sm:py-3.5 px-6 rounded-2xl sm:rounded-3xl hover:brightness-110 active:scale-[0.99] transition-all text-left cursor-pointer inline-flex items-center gap-3 shadow-sm">
                        <span>How do I download my invoice?</span>
                        <svg class="w-4 h-4 text-white/70 transition-transform duration-300 shrink-0"
                             :class="isOpen(5) ? 'rotate-45 text-white' : 'rotate-0'"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <div x-show="isOpen(5)" 
                         x-cloak 
                         x-transition:enter="transition-all ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-5 scale-[0.98]"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-4 scale-[0.98]"
                         class="relative z-10 -mt-3.5 sm:-mt-4 max-w-2xl bg-white border border-slate-100 shadow-[0_12px_36px_rgba(0,0,0,0.08)] rounded-3xl pt-7 pb-5 px-5 sm:pt-8 sm:pb-6 sm:px-7 text-slate-700 text-sm sm:text-base leading-relaxed">
                        When your invoice is ready, use the download option to save it as a PDF or PNG. The file will be saved directly to your device's Downloads folder.
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center gap-3 pt-8">
                <a href="{{ route('faqs') }}"
                   class="bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold px-6 py-2.5 rounded-full text-xs sm:text-sm transition-colors shadow-2xs border border-slate-200">
                    Read all FAQ
                </a>
                <a href="{{ route('contact') }}"
                   style="background-color: #2A373D;"
                   class="hover:brightness-110 text-white font-semibold px-6 py-2.5 rounded-full text-xs sm:text-sm transition-all shadow-xs">
                    Contact Us
                </a>
            </div>
        </section>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function invoiceApp() {
        return {
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
            getDefaultInvoice() {
                return {
                    title: 'INVOICE',
                    number: '2',
                    date: new Date().toISOString().split('T')[0],
                    paymentTerms: '',
                    dueDate: '',
                    poNumber: '',
                    currency: '$',
                    logo: '',
                    sender: '',
                    billTo: '',
                    shipTo: '',
                    items: [
                        { description: '', quantity: 1, rate: 0 }
                    ],
                    notes: '',
                    terms: '',
                    taxRate: 0,
                    discount: 0,
                    shipping: 0,
                    amountPaid: 0
                };
            },
            invoice: {
                title: 'INVOICE',
                number: '2',
                date: new Date().toISOString().split('T')[0],
                paymentTerms: '',
                dueDate: '',
                poNumber: '',
                currency: '$',
                logo: '',
                sender: '',
                billTo: '',
                shipTo: '',
                items: [
                    { description: '', quantity: 1, rate: 0 }
                ],
                notes: '',
                terms: '',
                taxRate: 0,
                discount: 0,
                shipping: 0,
                amountPaid: 0
            },

            clearInvoice() {
                if (confirm('Are you sure you want to clear this invoice and start a new one?')) {
                    localStorage.removeItem('invoice_generator_draft');
                    this.invoice = this.getDefaultInvoice();
                    this.showDiscount = false;
                    this.showShipping = false;
                    this.activeError = null;
                    this.saveToStorage();
                }
            },

            filterNumericInput(event, allowDecimal = true) {
                const key = event.key;
                if (['Backspace', 'Tab', 'Enter', 'Escape', 'Delete', 'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown', 'Home', 'End'].includes(key)) {
                    return;
                }
                if (event.ctrlKey || event.metaKey) {
                    return;
                }
                if (allowDecimal && key === '.') {
                    if (event.target.value.includes('.')) {
                        event.preventDefault();
                    }
                    return;
                }
                if (!/^[0-9]$/.test(key)) {
                    event.preventDefault();
                }
            },

            cleanNumberString(val, allowDecimal = true) {
                if (val === null || val === undefined) return '0';
                let s = String(val);
                s = allowDecimal ? s.replace(/[^0-9.]/g, '') : s.replace(/[^0-9]/g, '');
                if (allowDecimal) {
                    const parts = s.split('.');
                    if (parts.length > 2) {
                        s = parts[0] + '.' + parts.slice(1).join('');
                    }
                }
                if (/^0[0-9]+/.test(s)) {
                    s = s.replace(/^0+/, '');
                    if (s === '') s = '0';
                }
                return s;
            },

            handleRateInput(event, item) {
                const cleaned = this.cleanNumberString(event.target.value, true);
                event.target.value = cleaned;
                item.rate = cleaned;
            },

            handleRateBlur(event, item) {
                if (item.rate === '' || item.rate === '.' || item.rate === null || item.rate === undefined) {
                    item.rate = 0;
                    event.target.value = '0';
                }
            },

            handleQtyInput(event, item) {
                const cleaned = this.cleanNumberString(event.target.value, true);
                event.target.value = cleaned;
                item.quantity = cleaned;
            },

            handleQtyBlur(event, item) {
                if (item.quantity === '' || item.quantity === '.' || item.quantity === null || item.quantity === undefined) {
                    item.quantity = 0;
                    event.target.value = '0';
                }
            },

            initData() {
                try {
                    const saved = localStorage.getItem('invoice_generator_draft');
                    if (saved) {
                        const data = JSON.parse(saved);
                        if (data && typeof data === 'object') {
                            this.invoice = Object.assign({}, this.invoice, data);
                            if (data.showDiscount !== undefined) this.showDiscount = data.showDiscount;
                            if (data.showShipping !== undefined) this.showShipping = data.showShipping;
                            if (data.downloadFormat !== undefined) this.downloadFormat = data.downloadFormat;
                        }
                    }
                } catch (e) {
                    console.error('Error restoring draft:', e);
                }

                this.$watch('invoice', () => {
                    this.saveToStorage();
                    if (this.activeError && !this.isFieldInvalid(this.activeError)) {
                        this.activeError = null;
                    }
                }, { deep: true });
                this.$watch('showDiscount', () => this.saveToStorage());
                this.$watch('showShipping', () => this.saveToStorage());
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

            saveToStorage() {
                try {
                    localStorage.setItem('invoice_generator_draft', JSON.stringify({
                        ...this.invoice,
                        showDiscount: this.showDiscount,
                        showShipping: this.showShipping,
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
                const discount = this.showDiscount ? (Number(this.invoice.discount) || 0) : 0;
                const shipping = this.showShipping ? (Number(this.invoice.shipping) || 0) : 0;
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
                this.saveToStorage();
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
                    this.saveToStorage();
                };
                reader.readAsDataURL(file);
            },

            removeLogo() {
                this.invoice.logo = '';
                this.saveToStorage();
            },

            isFieldInvalid(key) {
                if (!key) return false;
                if (key === 'logo') return !this.invoice.logo;
                if (key === 'sender') return !this.invoice.sender || !this.invoice.sender.trim();
                if (key === 'billTo') return !this.invoice.billTo || !this.invoice.billTo.trim();
                if (key === 'date') return !this.invoice.date;
                if (key === 'dueDate') return !this.invoice.dueDate;
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
                if (!this.invoice.logo) {
                    return 'logo';
                }
                if (!this.invoice.sender || !this.invoice.sender.trim()) {
                    return 'sender';
                }
                if (!this.invoice.billTo || !this.invoice.billTo.trim()) {
                    return 'billTo';
                }
                if (!this.invoice.date) {
                    return 'date';
                }
                if (!this.invoice.dueDate) {
                    return 'dueDate';
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
                sheet.querySelectorAll('.no-print, button').forEach(el => el.remove());
                sheet.querySelectorAll('[x-show*="activeError"]').forEach(el => el.remove());
                sheet.style.border = 'none';
                sheet.style.boxShadow = 'none';
                sheet.style.borderRadius = '0';
                sheet.style.width = '800px';
                sheet.style.maxWidth = '800px';
                sheet.style.margin = '0 auto';
                sheet.style.padding = '32px 36px';
                sheet.style.backgroundColor = '#ffffff';
                const logoContainer = sheet.querySelector('.logo-box-border');
                if (logoContainer) {
                    logoContainer.style.border = 'none';
                    logoContainer.style.boxShadow = 'none';
                    logoContainer.style.padding = '0';
                }

                const titleInput = sheet.querySelector('input[x-model="invoice.title"]');
                if (titleInput) {
                    const div = clonedDoc.createElement('div');
                    div.textContent = this.invoice.title || 'INVOICE';
                    div.style.fontSize = '32px';
                    div.style.fontWeight = '800';
                    div.style.letterSpacing = '-0.025em';
                    div.style.textTransform = 'uppercase';
                    div.style.color = '#1e293b';
                    div.style.textAlign = 'right';
                    div.style.lineHeight = '1.2';
                    titleInput.parentNode.replaceChild(div, titleInput);
                }
                const numInput = sheet.querySelector('input[x-model="invoice.number"]');
                if (numInput) {
                    const span = clonedDoc.createElement('span');
                    span.textContent = this.invoice.number || '2';
                    span.style.fontSize = '15px';
                    span.style.fontWeight = '600';
                    span.style.color = '#1e293b';
                    numInput.parentNode.replaceChild(span, numInput);
                }
                const senderTextarea = sheet.querySelector('textarea[x-model="invoice.sender"]');
                if (senderTextarea) {
                    const div = clonedDoc.createElement('div');
                    div.textContent = this.invoice.sender || '';
                    div.style.whiteSpace = 'pre-wrap';
                    div.style.fontSize = '14px';
                    div.style.color = '#1e293b';
                    div.style.lineHeight = '1.5';
                    senderTextarea.parentNode.replaceChild(div, senderTextarea);
                }
                const billToTextarea = sheet.querySelector('textarea[x-model="invoice.billTo"]');
                if (billToTextarea) {
                    const div = clonedDoc.createElement('div');
                    div.textContent = this.invoice.billTo || '';
                    div.style.whiteSpace = 'pre-wrap';
                    div.style.fontSize = '14px';
                    div.style.color = '#1e293b';
                    div.style.lineHeight = '1.5';
                    billToTextarea.parentNode.replaceChild(div, billToTextarea);
                }
                const shipToTextarea = sheet.querySelector('textarea[x-model="invoice.shipTo"]');
                if (shipToTextarea) {
                    const val = (this.invoice.shipTo || '').trim();
                    const shipToContainer = shipToTextarea.closest('[class*="grid"] > div') || shipToTextarea.parentNode;
                    if (!val && shipToContainer) {
                        shipToContainer.remove();
                    } else if (shipToContainer) {
                        const div = clonedDoc.createElement('div');
                        div.textContent = val;
                        div.style.whiteSpace = 'pre-wrap';
                        div.style.fontSize = '14px';
                        div.style.color = '#1e293b';
                        div.style.lineHeight = '1.5';
                        shipToTextarea.parentNode.replaceChild(div, shipToTextarea);
                    }
                }
                const dateInput = sheet.querySelector('input[x-model="invoice.date"]');
                if (dateInput) {
                    const span = clonedDoc.createElement('span');
                    span.textContent = this.invoice.date || '';
                    span.style.fontSize = '14px';
                    span.style.fontWeight = '500';
                    span.style.color = '#1e293b';
                    span.style.textAlign = 'right';
                    dateInput.parentNode.replaceChild(span, dateInput);
                }
                const dueDateInput = sheet.querySelector('input[x-model="invoice.dueDate"]');
                if (dueDateInput) {
                    const span = clonedDoc.createElement('span');
                    span.textContent = this.invoice.dueDate || '';
                    span.style.fontSize = '14px';
                    span.style.fontWeight = '500';
                    span.style.color = '#1e293b';
                    span.style.textAlign = 'right';
                    dueDateInput.parentNode.replaceChild(span, dueDateInput);
                }
                const paymentTermsInput = sheet.querySelector('input[x-model="invoice.paymentTerms"]');
                if (paymentTermsInput) {
                    const val = (this.invoice.paymentTerms || '').trim();
                    const row = paymentTermsInput.closest('.flex');
                    if (!val && row) {
                        row.remove();
                    } else if (row) {
                        const span = clonedDoc.createElement('span');
                        span.textContent = val;
                        span.style.fontSize = '14px';
                        span.style.color = '#1e293b';
                        span.style.textAlign = 'right';
                        paymentTermsInput.parentNode.replaceChild(span, paymentTermsInput);
                    }
                }
                const poNumberInput = sheet.querySelector('input[x-model="invoice.poNumber"]');
                if (poNumberInput) {
                    const val = (this.invoice.poNumber || '').trim();
                    const row = poNumberInput.closest('.flex');
                    if (!val && row) {
                        row.remove();
                    } else if (row) {
                        const span = clonedDoc.createElement('span');
                        span.textContent = val;
                        span.style.fontSize = '14px';
                        span.style.color = '#1e293b';
                        span.style.textAlign = 'right';
                        poNumberInput.parentNode.replaceChild(span, poNumberInput);
                    }
                }
                const theadLastTh = sheet.querySelector('thead tr th.no-print, thead tr th:last-child');
                if (theadLastTh && theadLastTh.textContent.trim() === '') {
                    theadLastTh.remove();
                }

                const tableRows = sheet.querySelectorAll('tbody tr');
                tableRows.forEach((tr, index) => {
                    const itemData = this.invoice.items[index] || {};
                    const descInput = tr.querySelector('input[x-model="item.description"]');
                    if (descInput) {
                        const div = clonedDoc.createElement('div');
                        div.textContent = itemData.description || descInput.value || '';
                        div.style.fontSize = '14px';
                        div.style.color = '#1e293b';
                        div.style.lineHeight = '1.4';
                        div.style.padding = '4px 2px';
                        descInput.parentNode.replaceChild(div, descInput);
                    }
                    const qtyInput = tr.querySelector('input[x-model\\.number="item.quantity"], input[x-model="item.quantity"]');
                    if (qtyInput) {
                        const div = clonedDoc.createElement('div');
                        div.textContent = String(itemData.quantity ?? qtyInput.value ?? '1');
                        div.style.fontSize = '14px';
                        div.style.color = '#1e293b';
                        div.style.textAlign = 'right';
                        div.style.padding = '4px 2px';
                        qtyInput.parentNode.replaceChild(div, qtyInput);
                    }
                    const rateInput = tr.querySelector('input[x-model\\.number="item.rate"], input[x-model="item.rate"]');
                    if (rateInput) {
                        const wrapper = rateInput.closest('.relative') || rateInput.parentNode;
                        const rateVal = Number(itemData.rate ?? rateInput.value ?? 0);
                        const div = clonedDoc.createElement('div');
                        div.textContent = (this.invoice.currency || '$') + this.formatNumber(rateVal);
                        div.style.fontSize = '14px';
                        div.style.color = '#1e293b';
                        div.style.textAlign = 'right';
                        div.style.padding = '4px 2px';
                        wrapper.parentNode.replaceChild(div, wrapper);
                    }
                    const lastTd = tr.querySelector('td.no-print, td:last-child');
                    if (lastTd && lastTd.querySelector('button, svg')) {
                        lastTd.remove();
                    }
                    tr.querySelectorAll('[x-show]').forEach(el => el.remove());
                });
                const notesTextarea = sheet.querySelector('textarea[x-model="invoice.notes"]');
                if (notesTextarea) {
                    const val = (this.invoice.notes || '').trim();
                    const notesBox = notesTextarea.closest('div');
                    if (!val && notesBox) {
                        notesBox.remove();
                    } else if (notesBox) {
                        const div = clonedDoc.createElement('div');
                        div.textContent = val;
                        div.style.whiteSpace = 'pre-wrap';
                        div.style.fontSize = '13px';
                        div.style.color = '#334155';
                        div.style.lineHeight = '1.5';
                        notesTextarea.parentNode.replaceChild(div, notesTextarea);
                    }
                }
                const termsTextarea = sheet.querySelector('textarea[x-model="invoice.terms"]');
                if (termsTextarea) {
                    const val = (this.invoice.terms || '').trim();
                    const termsBox = termsTextarea.closest('div');
                    if (!val && termsBox) {
                        termsBox.remove();
                    } else if (termsBox) {
                        const div = clonedDoc.createElement('div');
                        div.textContent = val;
                        div.style.whiteSpace = 'pre-wrap';
                        div.style.fontSize = '13px';
                        div.style.color = '#334155';
                        div.style.lineHeight = '1.5';
                        termsTextarea.parentNode.replaceChild(div, termsTextarea);
                    }
                }
                const taxInput = sheet.querySelector('input[x-model\\.number="invoice.taxRate"]');
                if (taxInput) {
                    const taxRate = this.invoice.taxRate || 0;
                    const taxBox = taxInput.closest('.tax-box-border') || taxInput.parentNode;
                    const span = clonedDoc.createElement('span');
                    span.textContent = taxRate + '%';
                    span.style.fontSize = '14px';
                    span.style.fontWeight = '500';
                    span.style.color = '#1e293b';
                    taxBox.parentNode.replaceChild(span, taxBox);
                }
                const discRow = sheet.querySelector('div[x-show="showDiscount"]');
                if (discRow) {
                    if (!this.showDiscount || Number(this.invoice.discount) <= 0) {
                        discRow.remove();
                    } else {
                        const val = this.formatNumber(this.invoice.discount);
                        const span = clonedDoc.createElement('span');
                        span.textContent = (this.invoice.currency || '$') + val;
                        span.style.fontSize = '14px';
                        span.style.color = '#1e293b';
                        const inputWrap = discRow.querySelector('.flex.items-center.gap-1') || discRow.querySelector('input');
                        if (inputWrap) inputWrap.parentNode.replaceChild(span, inputWrap);
                    }
                }
                const shipRow = sheet.querySelector('div[x-show="showShipping"]');
                if (shipRow) {
                    if (!this.showShipping || Number(this.invoice.shipping) <= 0) {
                        shipRow.remove();
                    } else {
                        const val = this.formatNumber(this.invoice.shipping);
                        const span = clonedDoc.createElement('span');
                        span.textContent = (this.invoice.currency || '$') + val;
                        span.style.fontSize = '14px';
                        span.style.color = '#1e293b';
                        const inputWrap = shipRow.querySelector('.flex.items-center.gap-1') || shipRow.querySelector('input');
                        if (inputWrap) inputWrap.parentNode.replaceChild(span, inputWrap);
                    }
                }

                const paidInput = sheet.querySelector('input[x-model\\.number="invoice.amountPaid"]');
                if (paidInput) {
                    const paidVal = Number(this.invoice.amountPaid || 0);
                    const paidRow = paidInput.closest('.flex.items-center.justify-between');
                    if (paidVal <= 0 && paidRow) {
                        paidRow.remove();
                    } else if (paidRow) {
                        const span = clonedDoc.createElement('span');
                        span.textContent = (this.invoice.currency || '$') + this.formatNumber(paidVal);
                        span.style.fontSize = '14px';
                        span.style.color = '#1e293b';
                        const wrap = paidInput.closest('.relative') || paidInput.parentNode;
                        wrap.parentNode.replaceChild(span, wrap);
                    }
                }
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