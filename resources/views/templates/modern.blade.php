<div class="space-y-6 text-slate-900 font-sans">
    
    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
        <div class="space-y-2">
            <template x-if="invoice.logo">
                <div class="relative group inline-block max-w-xs mb-2">
                    <img :src="invoice.logo" alt="Logo" class="max-h-20 w-auto object-contain">
                    <div class="no-print absolute -top-2 -right-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <label class="cursor-pointer bg-[#2A373D] text-white rounded-full p-1 shadow-xs" title="Change Logo">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                        </label>
                        <button type="button" @click="removeLogo()" class="bg-rose-500 text-white rounded-full p-1 shadow-xs" title="Remove Logo">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </template>
            <div class="relative">
                <input type="text"
                       x-model="invoice.title"
                       class="text-4xl sm:text-5xl font-black uppercase tracking-tight text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent transition-all w-full sm:w-auto"
                       :class="activeError === 'title' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"
                       placeholder="INVOICE">
                <div x-show="activeError === 'title'" x-cloak class="no-print text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                    <span>(Please fill this section)</span>
                </div>
            </div>
            <div class="no-print" x-show="!invoice.logo">
                <label class="cursor-pointer inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-900 border border-dashed border-slate-300 rounded px-2.5 py-1 transition-colors">
                    <span>+ Add Company Logo</span>
                    <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                </label>
            </div>
        </div>

        <div class="text-left sm:text-right space-y-1 sm:min-w-[220px]">
            <input type="text"
                   x-model="invoice.companyName"
                   placeholder="CAVEIN"
                   class="font-black text-base sm:text-lg uppercase tracking-wider text-left sm:text-right border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full">
            <div>
                <input type="text"
                       x-model="invoice.date"
                       placeholder="15 March 2025"
                       class="text-xs sm:text-sm text-slate-700 text-left sm:text-right border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full"
                       :class="activeError === 'date' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
            </div>
            <div class="flex items-center justify-start sm:justify-end gap-1.5 font-bold text-xs sm:text-sm uppercase tracking-wide">
                <span>INVOICE NO.</span>
                <input type="text"
                       x-model="invoice.number"
                       placeholder="15325"
                       class="w-24 text-left sm:text-right font-bold border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                       :class="activeError === 'number' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
            </div>
        </div>
    </div>

    <div class="border-b-2 border-slate-900"></div>

    <div class="space-y-1 max-w-md">
        <span class="block text-xs font-black uppercase tracking-wider text-slate-900">BILLED TO:</span>
        <input type="text"
               x-model="invoice.billToName"
               placeholder="Honey Ruby"
               class="font-bold text-sm text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full">
        <textarea x-model="invoice.billTo"
                  rows="2"
                  placeholder="123 Anywhere St., Any City&#10;+123 456 7890"
                  class="text-xs sm:text-sm text-slate-700 border border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full resize-none p-0 leading-relaxed"
                  :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
    </div>

    <div class="border-b border-slate-900"></div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-y-2 border-slate-900 text-xs sm:text-sm font-black uppercase tracking-wider text-slate-900">
                    <th class="py-3 px-2 w-6/12">DESCRIPTION</th>
                    <th class="py-3 px-2 text-right w-2/12">PRICE</th>
                    <th class="py-3 px-2 text-center w-2/12">QTY</th>
                    <th class="py-3 px-2 text-right w-2/12">TOTAL</th>
                    <th class="no-print py-3 px-1 w-8 text-center"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs sm:text-sm">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr class="group hover:bg-slate-50/50">
                        <td class="py-3 px-2 align-top">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Description..."
                                   class="w-full font-medium text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                   :class="activeError === ('item_desc_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-3 px-2 text-right align-top">
                            <div class="inline-flex items-center justify-end gap-1">
                                <span class="text-slate-500" x-text="invoice.currency"></span>
                                <input type="number"
                                       x-model.number="item.rate"
                                       min="0"
                                       step="0.01"
                                       class="w-20 text-right font-medium text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                       :class="activeError === ('item_rate_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                            </div>
                        </td>
                        <td class="py-3 px-2 text-center align-top">
                            <input type="number"
                                   x-model.number="item.quantity"
                                   min="1"
                                   step="1"
                                   class="w-16 text-center font-medium text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                   :class="activeError === ('item_qty_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-3 px-2 text-right font-bold text-slate-900 align-top">
                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                        </td>
                        <td class="no-print py-3 px-1 text-center align-top">
                            <button type="button"
                                    @click="removeItem(index)"
                                    class="text-slate-400 hover:text-rose-600 transition-colors p-1"
                                    title="Delete line">
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
                class="px-4 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition-all inline-flex items-center gap-1.5">
            <span>+</span>
            <span>Line Item</span>
        </button>
    </div>

    <div class="border-b border-slate-900"></div>

    <div class="flex justify-end">
        <div class="w-full sm:w-64 space-y-2 text-xs sm:text-sm">
            <div class="flex justify-between items-center text-slate-900 font-bold">
                <span>Subtotal</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(subtotal)"></span></span>
            </div>
            <div class="flex justify-between items-center text-slate-900 font-bold" x-show="showDiscount || invoice.discount > 0">
                <span>Discount</span>
                <div class="flex items-center gap-1">
                    <span>-</span>
                    <span x-text="invoice.currency"></span>
                    <input type="number" x-model.number="invoice.discount" class="w-16 text-right border-b border-slate-300 font-medium bg-transparent">
                </div>
            </div>
            <div class="flex justify-between items-center text-slate-900 font-bold">
                <span class="cursor-pointer" @click="toggleTaxMode()">Tax (<span x-text="invoice.taxRate"></span>%)</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(taxAmount)"></span></span>
            </div>
            <div class="border-t border-slate-900 pt-2 flex justify-between items-center text-sm sm:text-base font-black text-slate-900">
                <span>Total</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
            </div>
        </div>
    </div>

    <div class="border-t-2 border-slate-900 pt-6 pb-2 border-b border-slate-900 grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs text-slate-900">
        <div class="space-y-1.5">
            <span class="font-black uppercase tracking-wider block">PAYMENT INFORMATION :</span>
            <input type="text" x-model="invoice.accountName" placeholder="Studio Miracle" class="font-bold text-xs text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full block">
            <div class="flex items-center gap-2 text-slate-700">
                <span class="w-20 font-medium">Bank</span>
                <span>:</span>
                <input type="text" x-model="invoice.bankName" placeholder="Pinky Bank" class="font-medium text-xs border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent flex-1">
            </div>
            <div class="flex items-center gap-2 text-slate-700">
                <span class="w-20 font-medium">Account No.</span>
                <span>:</span>
                <input type="text" x-model="invoice.accountNumber" placeholder="0123 4567 8901" class="font-medium text-xs border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent flex-1">
            </div>
        </div>

        <div class="sm:text-right space-y-1">
            <input type="text" x-model="invoice.companyName" placeholder="SUDIUM LOVRA" class="font-black uppercase tracking-wider text-xs sm:text-sm text-left sm:text-right border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full block">
            <textarea x-model="invoice.sender" rows="3" placeholder="123 Anywhere St., Any City&#10;+123 456 7890&#10;www.reallygreatsite.com" class="text-xs text-slate-600 text-left sm:text-right border border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent w-full resize-none p-0 leading-relaxed"></textarea>
        </div>
    </div>

</div>

