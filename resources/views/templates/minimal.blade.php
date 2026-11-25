<div class="space-y-6 text-slate-900 font-serif bg-white overflow-hidden rounded-xl">

    <div style="background-color: #CAD2C5;" class="w-full py-8 px-6 text-center rounded-t-lg -mx-0">
        <template x-if="invoice.logo">
            <div class="relative group inline-block max-w-xs mb-2">
                <img :src="invoice.logo" alt="Logo" class="max-h-16 w-auto object-contain mx-auto">
                <div class="no-print absolute -top-2 -right-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button type="button" @click="removeLogo()" class="bg-rose-500 text-white rounded-full p-1 shadow-xs" title="Remove Logo">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </template>
        <div>
            <input type="text"
                   x-model="invoice.title"
                   class="font-serif tracking-[0.25em] text-4xl sm:text-5xl uppercase font-normal text-slate-900 text-center w-full border-none focus:outline-hidden bg-transparent"
                   :class="activeError === 'title' ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"
                   placeholder="INVOICE">
        </div>
        <div class="no-print mt-2" x-show="!invoice.logo">
            <label class="cursor-pointer inline-flex items-center gap-1.5 text-xs text-slate-700 hover:text-black border border-dashed border-slate-600 rounded px-2.5 py-1 transition-colors">
                <span>+ Add Logo</span>
                <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
            </label>
        </div>
    </div>

    <div class="px-2 sm:px-6 space-y-6">
        
        <div class="flex flex-col sm:flex-row justify-between items-start gap-6 pt-2">
            
            <div class="space-y-1 max-w-sm">
                <span class="font-bold text-slate-900 block text-xs sm:text-sm">Issued to</span>
                <textarea x-model="invoice.billTo"
                          rows="3"
                          placeholder="Paul Limpet&#10;(509) 555-0125&#10;www.example.site.com"
                          class="w-full font-serif text-xs sm:text-sm text-slate-700 border border-transparent hover:border-slate-300 focus:border-black bg-transparent resize-none p-0 leading-relaxed"
                          :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
            </div>

            <div class="text-left sm:text-right space-y-1.5 text-xs sm:text-sm min-w-[200px]">
                <div class="flex items-center justify-start sm:justify-end gap-1.5 font-bold">
                    <span>Invoice No.</span>
                    <input type="text"
                           x-model="invoice.number"
                           placeholder="12224"
                           class="w-24 text-left sm:text-right font-bold border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent"
                           :class="activeError === 'number' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                </div>
                <div class="flex items-center justify-start sm:justify-end gap-1.5 text-slate-800">
                    <span class="font-medium">Date:</span>
                    <input type="text"
                           x-model="invoice.date"
                           placeholder="01/02/2025"
                           class="w-28 text-left sm:text-right border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent"
                           :class="activeError === 'date' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                </div>
                <div class="flex items-center justify-start sm:justify-end gap-1.5 text-slate-800">
                    <span class="font-medium">Due:</span>
                    <input type="text"
                           x-model="invoice.dueDate"
                           placeholder="02/02/2025"
                           class="w-28 text-left sm:text-right border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
                </div>
            </div>

        </div>

        <div class="pt-4 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-300 text-xs sm:text-sm font-bold text-slate-900">
                        <th class="py-3 px-2 w-6/12">Description</th>
                        <th class="py-3 px-2 text-right w-2/12">Unit Cost</th>
                        <th class="py-3 px-2 text-center w-2/12">Qty</th>
                        <th class="py-3 px-2 text-right w-2/12">Amount</th>
                        <th class="no-print py-3 px-1 w-8 text-center"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm">
                    <template x-for="(item, index) in invoice.items" :key="index">
                        <tr class="group hover:bg-slate-50/50">
                            <td class="py-3 px-2 align-top">
                                <input type="text"
                                       x-model="item.description"
                                       placeholder="Freight Charges..."
                                       class="w-full font-serif text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                       :class="activeError === ('item_desc_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                            </td>
                            <td class="py-3 px-2 text-right align-top">
                                <div class="inline-flex items-center justify-end gap-1">
                                    <span class="text-slate-500" x-text="invoice.currency"></span>
                                    <input type="number"
                                           x-model.number="item.rate"
                                           min="0"
                                           step="0.01"
                                           class="w-20 text-right font-serif text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                           :class="activeError === ('item_rate_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                                </div>
                            </td>
                            <td class="py-3 px-2 text-center align-top">
                                <input type="number"
                                       x-model.number="item.quantity"
                                       min="1"
                                       step="1"
                                       class="w-16 text-center font-serif text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                       :class="activeError === ('item_qty_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                            </td>
                            <td class="py-3 px-2 text-right font-serif font-medium text-slate-900 align-top">
                                <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                            </td>
                            <td class="no-print py-3 px-1 text-center align-top">
                                <button type="button"
                                        @click="removeItem(index)"
                                        class="text-slate-400 hover:text-rose-600 transition-colors p-1"
                                        title="Delete row">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="no-print">
            <button type="button"
                    @click="addItem()"
                    class="px-4 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold transition-all inline-flex items-center gap-1.5">
                <span>+</span>
                <span>Add Item</span>
            </button>
        </div>

        <div class="pt-4 flex justify-end">
            <div class="w-full sm:w-64 space-y-2 text-xs sm:text-sm">
                <div class="flex justify-between items-center text-slate-700">
                    <span>Sub total</span>
                    <span><span x-text="invoice.currency"></span><span x-text="formatNumber(subtotal)"></span></span>
                </div>
                <div class="flex justify-between items-center text-slate-700" x-show="showDiscount || invoice.discount > 0">
                    <span>Less Deposit</span>
                    <div class="flex items-center gap-1">
                        <span>-</span>
                        <span x-text="invoice.currency"></span>
                        <input type="number" x-model.number="invoice.discount" class="w-16 text-right border-b border-slate-300 font-serif bg-transparent">
                    </div>
                </div>
                <div class="pt-2 border-t border-slate-300 flex justify-between items-center font-bold text-sm sm:text-base text-slate-900">
                    <span>Balance due</span>
                    <span><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
                </div>
            </div>
        </div>

        <div class="pt-6 pb-4 text-xs italic text-slate-600">
            <textarea x-model="invoice.notes"
                      rows="2"
                      placeholder="All remaining amounts are due on the first of the following month, pending previous payment arrangements."
                      class="w-full border border-transparent hover:border-slate-300 focus:border-black bg-transparent resize-none p-0 leading-relaxed italic"></textarea>
        </div>

    </div>

    <div style="background-color: #CAD2C5;" class="w-full py-6 px-6 rounded-b-lg flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-900">
        <div class="space-y-1 text-center sm:text-left">
            <input type="text" x-model="invoice.companyName" placeholder="SHIP CARGO WORLDWIDE" class="font-black text-sm uppercase tracking-wider border-b border-transparent hover:border-slate-400 bg-transparent block w-full">
            <input type="text" x-model="invoice.sender" placeholder="(208) 555-0155 | www.example.site.com" class="text-xs text-slate-800 border-b border-transparent hover:border-slate-400 bg-transparent block w-full">
        </div>
        <div class="text-center sm:text-right">
            <textarea x-model="invoice.shipTo" rows="2" placeholder="100 Fifth Avenue, New York&#10;York, NY 10011" class="text-xs text-slate-800 text-center sm:text-right border border-transparent hover:border-slate-400 bg-transparent resize-none p-0 leading-relaxed"></textarea>
        </div>
    </div>

</div>

