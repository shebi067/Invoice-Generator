<div class="space-y-6 text-slate-900 font-sans">

    <div class="flex flex-col-reverse sm:flex-row justify-between items-start gap-6">
        
        <div class="space-y-4 max-w-md text-xs sm:text-sm">
            
            <div class="space-y-1">
                <span class="font-bold uppercase tracking-wider text-slate-900 block text-xs">BILLED TO:</span>
                <textarea x-model="invoice.billTo"
                          rows="2"
                          placeholder="Really Great Company&#10;123 Client St."
                          class="w-full text-slate-700 font-serif border border-transparent hover:border-slate-300 focus:border-slate-800 bg-transparent resize-none p-0 leading-relaxed"
                          :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
            </div>

            <div class="space-y-1">
                <span class="font-bold uppercase tracking-wider text-slate-900 block text-xs">PAY TO:</span>
                <textarea x-model="invoice.sender"
                          rows="3"
                          placeholder="Avery Davis&#10;123 Anywhere St., Any City&#10;123-456-7890"
                          class="w-full text-slate-700 font-serif border border-transparent hover:border-slate-300 focus:border-slate-800 bg-transparent resize-none p-0 leading-relaxed"
                          :class="activeError === 'sender' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
            </div>

            <div class="pt-2 space-y-1 text-slate-800 font-serif text-xs">
                <div class="grid grid-cols-12 gap-2">
                    <span class="col-span-4 text-slate-500">Bank</span>
                    <input type="text" x-model="invoice.bankName" placeholder="Really Great Bank" class="col-span-8 border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
                </div>
                <div class="grid grid-cols-12 gap-2">
                    <span class="col-span-4 text-slate-500">Account Name</span>
                    <input type="text" x-model="invoice.accountName" placeholder="John Smith" class="col-span-8 border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
                </div>
                <div class="grid grid-cols-12 gap-2">
                    <span class="col-span-4 text-slate-500">BSB</span>
                    <input type="text" x-model="invoice.bsb" placeholder="000-000" class="col-span-8 border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
                </div>
                <div class="grid grid-cols-12 gap-2">
                    <span class="col-span-4 text-slate-500">Account Number</span>
                    <input type="text" x-model="invoice.accountNumber" placeholder="0000 0000" class="col-span-8 border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
                </div>
            </div>

        </div>

        <div class="text-left sm:text-right space-y-2">
            <template x-if="invoice.logo">
                <div class="relative group inline-block max-w-xs mb-2">
                    <img :src="invoice.logo" alt="Logo" class="max-h-16 w-auto object-contain ml-auto">
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
                       class="text-3xl sm:text-5xl font-light uppercase tracking-[0.25em] text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent text-left sm:text-right w-full sm:w-auto"
                       :class="activeError === 'title' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"
                       placeholder="INVOICE">
            </div>
            <div class="flex items-center justify-start sm:justify-end gap-1 text-sm font-medium text-slate-600">
                <span>#</span>
                <input type="text"
                       x-model="invoice.number"
                       placeholder="1024"
                       class="w-20 text-left sm:text-right border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent"
                       :class="activeError === 'number' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
            </div>
            <div class="no-print" x-show="!invoice.logo">
                <label class="cursor-pointer inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-slate-900 border border-dashed border-slate-300 rounded px-2.5 py-1 transition-colors">
                    <span>+ Add Logo</span>
                    <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                </label>
            </div>
        </div>

    </div>

    <div class="pt-4 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-y-2 border-slate-900 text-xs font-bold uppercase tracking-wider text-slate-900">
                    <th class="py-3 px-2 w-6/12">DESCRIPTION</th>
                    <th class="py-3 px-2 text-right w-2/12">RATE</th>
                    <th class="py-3 px-2 text-center w-2/12">HOURS</th>
                    <th class="py-3 px-2 text-right w-2/12">AMOUNT</th>
                    <th class="no-print py-3 px-1 w-8 text-center"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-300 text-xs sm:text-sm font-serif">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr class="group hover:bg-slate-50/50">
                        <td class="py-3.5 px-2 align-top">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Content Plan..."
                                   class="w-full font-serif text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                   :class="activeError === ('item_desc_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-3.5 px-2 text-right align-top">
                            <div class="inline-flex items-center justify-end gap-0.5">
                                <span class="text-slate-500" x-text="invoice.currency"></span>
                                <input type="number"
                                       x-model.number="item.rate"
                                       min="0"
                                       step="0.01"
                                       class="w-16 text-right font-serif text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                       :class="activeError === ('item_rate_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                                <span class="text-slate-400 text-xs">/hr</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-2 text-center align-top">
                            <input type="number"
                                   x-model.number="item.quantity"
                                   min="1"
                                   step="1"
                                   class="w-14 text-center font-serif text-slate-900 border-b border-transparent hover:border-slate-300 focus:border-black focus:outline-hidden bg-transparent"
                                   :class="activeError === ('item_qty_' + index) ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-3.5 px-2 text-right font-serif text-slate-900 align-top">
                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                        </td>
                        <td class="no-print py-3.5 px-1 text-center align-top">
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
                class="px-4 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold transition-all inline-flex items-center gap-1.5">
            <span>+</span>
            <span>Add Row</span>
        </button>
    </div>

    <div class="pt-4 flex justify-end">
        <div class="w-full sm:w-64 space-y-2 text-xs sm:text-sm font-serif">
            <div class="flex justify-between items-center text-slate-800">
                <span>Sub-Total</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(subtotal)"></span></span>
            </div>
            <div class="flex justify-between items-center text-slate-800">
                <span>Package Discount</span>
                <div class="flex items-center gap-1">
                    <span>-</span>
                    <span x-text="invoice.currency"></span>
                    <input type="number" x-model.number="invoice.discount" placeholder="0" class="w-16 text-right border-b border-slate-300 font-serif bg-transparent">
                </div>
            </div>
            <div class="border-y-2 border-slate-900 py-2.5 flex justify-between items-center text-sm sm:text-base font-bold text-slate-900 uppercase">
                <span>TOTAL</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
            </div>
        </div>
    </div>

    <div class="pt-10 space-y-4 text-xs font-serif text-slate-600">
        <textarea x-model="invoice.notes"
                  rows="2"
                  placeholder="Payment is required within 14 business days of invoice date. Please send remittance to hello@reallygreatsite.com."
                  class="w-full border border-transparent hover:border-slate-300 focus:border-black bg-transparent resize-none p-0 leading-relaxed"></textarea>
        <div>
            <input type="text"
                   x-model="invoice.terms"
                   placeholder="Thank you for your business."
                   class="w-full font-serif text-slate-800 border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
        </div>
    </div>

</div>

