<div class="border-4 border-slate-900 p-6 sm:p-10 space-y-6 text-slate-900 bg-white">

    <div class="text-center space-y-3">
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
                   class="text-4xl sm:text-6xl font-black uppercase tracking-[0.2em] text-slate-900 text-center w-full border-none focus:outline-hidden bg-transparent"
                   :class="activeError === 'title' ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"
                   placeholder="INVOICE">
        </div>
        <div class="border-b-2 border-slate-900 w-full"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-xs sm:text-sm pt-2">
        
        <div class="space-y-4">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-900 whitespace-nowrap">Date:</span>
                <input type="text"
                       x-model="invoice.date"
                       placeholder="01/02/2025"
                       class="flex-1 border-b border-dotted border-slate-400 focus:border-black bg-transparent text-slate-800"
                       :class="activeError === 'date' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
            </div>
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-900 whitespace-nowrap">No. Invoice :</span>
                <input type="text"
                       x-model="invoice.number"
                       placeholder="12224"
                       class="flex-1 border-b border-dotted border-slate-400 focus:border-black bg-transparent text-slate-800 font-bold"
                       :class="activeError === 'number' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
            </div>
            <div class="no-print" x-show="!invoice.logo">
                <label class="cursor-pointer inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-900 border border-dashed border-slate-300 rounded px-2.5 py-1 transition-colors">
                    <span>+ Add Logo</span>
                    <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                </label>
            </div>
        </div>

        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-900 whitespace-nowrap">Bill to:</span>
                <input type="text"
                       x-model="invoice.billToName"
                       placeholder="Client Name / Business"
                       class="flex-1 border-b border-dotted border-slate-400 focus:border-black bg-transparent text-slate-800 font-semibold">
            </div>
            <textarea x-model="invoice.billTo"
                      rows="2"
                      placeholder="123 Anywhere St., Any City, ST 12345"
                      class="w-full text-xs sm:text-sm text-slate-700 bg-transparent border-none focus:outline-hidden resize-none p-0 leading-relaxed"
                      :class="activeError === 'billTo' ? 'border border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
        </div>

    </div>

    <div class="pt-4 overflow-x-auto">
        <table class="w-full text-left border-collapse border border-slate-800">
            <thead>
                <tr class="bg-slate-200 text-slate-900 text-xs sm:text-sm font-bold">
                    <th class="py-2.5 px-3 border border-slate-800 w-2/12">Date</th>
                    <th class="py-2.5 px-3 border border-slate-800 w-5/12">Item Description</th>
                    <th class="py-2.5 px-3 border border-slate-800 text-right w-2/12">Price</th>
                    <th class="py-2.5 px-3 border border-slate-800 text-center w-1/12">Qty</th>
                    <th class="py-2.5 px-3 border border-slate-800 text-right w-2/12">Total</th>
                    <th class="no-print py-2 px-1 border border-slate-800 w-8 text-center bg-white"></th>
                </tr>
            </thead>
            <tbody class="text-xs sm:text-sm divide-y divide-slate-800">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr>
                        <td class="py-2.5 px-2 border border-slate-800 align-top">
                            <input type="text"
                                   x-model="invoice.date"
                                   placeholder="01/02"
                                   class="w-full text-slate-700 border-none bg-transparent p-0 text-xs">
                        </td>
                        <td class="py-2.5 px-2 border border-slate-800 align-top">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Item Description..."
                                   class="w-full font-medium text-slate-900 border-none bg-transparent p-0"
                                   :class="activeError === ('item_desc_' + index) ? 'border-b border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-2.5 px-2 border border-slate-800 text-right align-top">
                            <div class="inline-flex items-center justify-end gap-1">
                                <span class="text-slate-500 text-xs" x-text="invoice.currency"></span>
                                <input type="number"
                                       x-model.number="item.rate"
                                       min="0"
                                       step="0.01"
                                       class="w-16 text-right text-slate-900 border-none bg-transparent p-0"
                                       :class="activeError === ('item_rate_' + index) ? 'border-b border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                            </div>
                        </td>
                        <td class="py-2.5 px-2 border border-slate-800 text-center align-top">
                            <input type="number"
                                   x-model.number="item.quantity"
                                   min="1"
                                   step="1"
                                   class="w-10 text-center text-slate-900 border-none bg-transparent p-0"
                                   :class="activeError === ('item_qty_' + index) ? 'border-b border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-2.5 px-3 border border-slate-800 text-right font-bold text-slate-900 align-top">
                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                        </td>
                        <td class="no-print py-2 px-1 border border-slate-800 text-center align-top">
                            <button type="button"
                                    @click="removeItem(index)"
                                    class="text-slate-400 hover:text-rose-600 transition-colors p-0.5"
                                    title="Delete line">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
            <tfoot>
                <tr class="bg-slate-200 text-slate-900 font-bold">
                    <td colspan="4" class="py-2.5 px-4 border border-slate-800 text-right text-xs sm:text-sm">
                        Total:
                    </td>
                    <td class="py-2.5 px-3 border border-slate-800 text-right text-sm sm:text-base font-black">
                        <span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span>
                    </td>
                    <td class="no-print border border-slate-800 bg-white"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="no-print">
        <button type="button"
                @click="addItem()"
                class="px-4 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition-all inline-flex items-center gap-1.5 border border-slate-300">
            <span>+</span>
            <span>Add Row</span>
        </button>
    </div>

    <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 gap-8 text-xs sm:text-sm items-end">
        
        <div class="space-y-4">
            <div class="font-serif italic font-bold text-3xl sm:text-4xl text-slate-900">
                Thank you!
            </div>
            <div class="space-y-2 text-slate-700 text-xs">
                <div class="flex items-center gap-2.5">
                    <div class="w-5 h-5 rounded-full bg-black text-white flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" x-model="invoice.sender" placeholder="123 Anywhere St., Any City, ST 12345" class="w-full border-b border-transparent hover:border-slate-300 bg-transparent">
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="w-5 h-5 rounded-full bg-black text-white flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                    </div>
                    <input type="text" x-model="invoice.phone" placeholder="+123-456-7890" class="w-full border-b border-transparent hover:border-slate-300 bg-transparent">
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="w-5 h-5 rounded-full bg-black text-white flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    </div>
                    <input type="text" x-model="invoice.email" placeholder="hello@reallygreatsite.com" class="w-full border-b border-transparent hover:border-slate-300 bg-transparent">
                </div>
            </div>
        </div>

        <div class="space-y-2 sm:text-right">
            <span class="font-bold text-slate-900 block text-xs sm:text-sm">Payment Method:</span>
            <div class="space-y-1 text-slate-800 text-xs">
                <div>
                    Bank Name: <input type="text" x-model="invoice.bankName" placeholder="Borcelle Bank" class="font-semibold text-right border-b border-transparent hover:border-slate-300 bg-transparent w-40">
                </div>
                <div>
                    Account Number: <input type="text" x-model="invoice.accountNumber" placeholder="0123 4567 89" class="font-semibold text-right border-b border-transparent hover:border-slate-300 bg-transparent w-40">
                </div>
            </div>
        </div>

    </div>

</div>

