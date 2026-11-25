<div class="space-y-6 text-slate-900 font-sans bg-white p-2">

    <div class="flex flex-col sm:flex-row justify-between items-start gap-6">
        
        <div class="space-y-1 text-xs text-slate-700 max-w-sm">
            <template x-if="invoice.logo">
                <div class="relative group inline-block max-w-xs mb-2">
                    <img :src="invoice.logo" alt="Logo" class="max-h-16 w-auto object-contain">
                    <div class="no-print absolute -top-2 -right-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button type="button" @click="removeLogo()" class="bg-rose-500 text-white rounded-full p-1 shadow-xs" title="Remove Logo">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </template>
            <div>
                <input type="text"
                       x-model="invoice.companyName"
                       placeholder="[Company Name]"
                       class="text-xl font-bold text-slate-800 border-b border-transparent hover:border-slate-300 focus:border-slate-800 focus:outline-hidden bg-transparent w-full">
            </div>
            <textarea x-model="invoice.sender"
                      rows="3"
                      placeholder="[Street Address]&#10;[City, ST ZIP]&#10;Phone: (000) 000-0000"
                      class="w-full text-xs text-slate-700 border border-transparent hover:border-slate-300 focus:border-slate-800 focus:outline-hidden bg-transparent resize-none p-0 leading-relaxed"></textarea>
            <div class="no-print pt-1" x-show="!invoice.logo">
                <label class="cursor-pointer inline-flex items-center gap-1.5 text-[11px] text-slate-600 hover:text-black">
                    <span>+ Add Logo</span>
                    <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                </label>
            </div>
        </div>

        <div class="text-left sm:text-right space-y-2 w-full sm:w-auto">
            <div>
                <input type="text"
                       x-model="invoice.title"
                       class="text-3xl sm:text-4xl font-extrabold uppercase tracking-wide text-slate-400 text-left sm:text-right w-full sm:w-60 border-b border-transparent hover:border-slate-300 focus:border-slate-600 focus:outline-hidden bg-transparent"
                       placeholder="INVOICE">
            </div>
            <div class="border border-slate-400 text-xs w-full sm:w-64 ml-auto text-left overflow-hidden">
                <div class="grid grid-cols-2 bg-slate-200 border-b border-slate-400 text-center font-bold text-slate-700 text-[10px] uppercase tracking-wider">
                    <div class="py-1.5 px-2 border-r border-slate-400 flex items-center justify-center">INVOICE #</div>
                    <div class="py-1.5 px-2 flex items-center justify-center">DATE</div>
                </div>
                <div class="grid grid-cols-2 text-center text-slate-800 bg-white">
                    <div class="border-r border-slate-400 flex items-center justify-center p-0 h-8">
                        <input type="text"
                               x-model="invoice.number"
                               placeholder="1024"
                               class="w-full h-full text-center bg-transparent font-medium text-xs text-slate-800 border-none outline-none focus:outline-none focus:ring-0 p-0 m-0 leading-none">
                    </div>
                    <div class="flex items-center justify-center p-0 h-8">
                        <input type="text"
                               x-model="invoice.date"
                               placeholder="2026-10-21"
                               class="w-full h-full text-center bg-transparent font-medium text-xs text-slate-800 border-none outline-none focus:outline-none focus:ring-0 p-0 m-0 leading-none">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="max-w-md space-y-1 text-xs pt-1">
        <div class="bg-slate-200 border border-slate-300 font-bold px-3 py-1 text-slate-800 uppercase text-[11px]">
            BILL TO
        </div>
        <textarea x-model="invoice.billTo"
                  rows="4"
                  placeholder="[Name]&#10;[Company Name]&#10;[Street Address]&#10;[City, ST ZIP]&#10;[Phone]&#10;[Email Address]"
                  class="w-full text-xs text-slate-800 border border-transparent hover:border-slate-300 focus:border-slate-600 focus:outline-hidden bg-transparent resize-none p-1 leading-relaxed"
                  :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
    </div>

    <div class="border border-slate-400">
        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="bg-slate-200 text-slate-800 font-bold uppercase text-[11px] border-b border-slate-400">
                    <th class="py-1.5 px-3 border-r border-slate-400">DESCRIPTION</th>
                    <th class="py-1.5 px-3 text-right w-40">AMOUNT</th>
                    <th class="py-1.5 px-2 text-center w-8 no-print"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 min-h-[160px]">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-2 border-r border-slate-400">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Service Fee / Consultation / Labor"
                                   class="w-full text-slate-800 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_desc_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-2 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <span x-text="invoice.currency"></span>
                                <input type="number"
                                       x-model.number="item.rate"
                                       step="0.01"
                                       min="0"
                                       class="w-24 text-right text-slate-800 border-none bg-transparent focus:outline-hidden text-xs font-medium"
                                       :class="activeError === ('item_rate_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                            </div>
                        </td>
                        <td class="p-2 text-center no-print">
                            <button type="button" @click="removeItem(index)" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
                        </td>
                    </tr>
                </template>
            </tbody>
            <tfoot>
                <tr class="border-t-2 border-slate-400">
                    <td class="p-3 border-r border-slate-400 italic text-slate-700 text-xs">
                        Thank you for your business!
                    </td>
                    <td class="p-3 text-right bg-slate-50">
                        <div class="flex items-center justify-between text-xs sm:text-sm font-bold text-slate-900">
                            <span class="uppercase">TOTAL</span>
                            <span><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
                        </div>
                    </td>
                    <td class="no-print"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="no-print">
        <button type="button" @click="addItem()" class="text-slate-700 hover:text-black font-bold text-xs inline-flex items-center gap-1 cursor-pointer">
            <span>+ Add Line</span>
        </button>
    </div>

    <div class="text-center text-xs text-slate-500 pt-6 space-y-1">
        <div>If you have any questions about this invoice, please contact</div>
        <div class="font-medium text-slate-700" x-text="invoice.senderEmail ? (invoice.senderPhone + ', ' + invoice.senderEmail) : '[Name, Phone, email@address.com]'"></div>
    </div>

</div>

