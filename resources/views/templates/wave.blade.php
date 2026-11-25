<div class="wave-template-container w-full space-y-6 text-slate-900 font-sans bg-white relative overflow-hidden rounded-2xl p-4 sm:p-6 pb-28" style="position: relative !important; width: 100% !important;">

    <div class="flex justify-between items-start">
        <div>
            <template x-if="invoice.logo">
                <div class="relative group inline-block max-w-xs">
                    <img :src="invoice.logo" alt="Logo" class="max-h-16 w-auto object-contain">
                    <div class="no-print absolute -top-2 -right-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button type="button" @click="removeLogo()" class="bg-rose-500 text-white rounded-full p-1 shadow-xs" title="Remove Logo">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </template>
            <div class="no-print" x-show="!invoice.logo">
                <label class="cursor-pointer border border-dashed border-slate-300 rounded px-3 py-2 text-xs font-semibold text-slate-500 hover:text-black flex items-center gap-1.5 transition-colors">
                    <span>+ YOUR LOGO</span>
                    <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                </label>
            </div>
        </div>
        <div class="text-right text-xs text-slate-700 font-medium">
            <span>NO.</span>
            <input type="text" x-model="invoice.number" placeholder="000001" class="w-24 text-right font-bold border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
        </div>
    </div>

    <div>
        <input type="text"
               x-model="invoice.title"
               class="text-4xl sm:text-6xl font-black uppercase tracking-tight text-slate-900 border-none focus:outline-hidden bg-transparent w-full"
               placeholder="INVOICE">
    </div>

    <div class="text-xs text-slate-800 font-medium flex items-center gap-1.5">
        <span class="font-bold">Date:</span>
        <input type="text" x-model="invoice.date" placeholder="02 June, 2030" class="border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-xs pt-1">
        <div class="space-y-1">
            <span class="font-bold text-slate-900 block text-sm">Billed to:</span>
            <textarea x-model="invoice.billTo"
                      rows="3"
                      placeholder="Studio Shodwe&#10;123 Anywhere St., Any City&#10;hello@reallygreatsite.com"
                      class="w-full text-slate-600 border border-transparent hover:border-slate-300 focus:border-black bg-transparent resize-none p-0 leading-relaxed text-xs"
                      :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
        </div>

        <div class="space-y-1">
            <span class="font-bold text-slate-900 block text-sm">From:</span>
            <textarea x-model="invoice.sender"
                      rows="3"
                      placeholder="Olivia Wilson&#10;123 Anywhere St., Any City&#10;hello@reallygreatsite.com"
                      class="w-full text-slate-600 border border-transparent hover:border-slate-300 focus:border-black bg-transparent resize-none p-0 leading-relaxed text-xs"></textarea>
        </div>
    </div>

    <div class="pt-2">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="bg-slate-100/90 text-slate-700 font-semibold rounded-md">
                    <th class="py-2.5 px-3 rounded-l-md">Item</th>
                    <th class="py-2.5 px-3 text-center w-24">Quantity</th>
                    <th class="py-2.5 px-3 text-right w-28">Price</th>
                    <th class="py-2.5 px-3 text-right w-28 rounded-r-md">Amount</th>
                    <th class="py-2.5 px-2 text-center w-8 no-print"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr class="hover:bg-slate-50/50">
                        <td class="py-2 px-3">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Logo / Banner / Design"
                                   class="w-full text-slate-800 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_desc_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-2 px-3 text-center">
                            <input type="number"
                                   x-model.number="item.quantity"
                                   min="1"
                                   class="w-full text-center text-slate-800 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_qty_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-2 px-3 text-right">
                            <input type="number"
                                   x-model.number="item.rate"
                                   step="0.01"
                                   min="0"
                                   class="w-full text-right text-slate-800 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_rate_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="py-2 px-3 text-right font-medium text-slate-900">
                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                        </td>
                        <td class="py-2 px-2 text-center no-print">
                            <button type="button" @click="removeItem(index)" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="no-print">
        <button type="button" @click="addItem()" class="text-slate-800 hover:text-black font-bold text-xs inline-flex items-center gap-1 cursor-pointer">
            <span>+ Add Item</span>
        </button>
    </div>

    <div class="border-t border-b border-slate-200 py-3 flex justify-between items-center text-sm sm:text-base font-black text-slate-900">
        <span>Total</span>
        <span><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
    </div>

    <div class="space-y-1.5 text-xs text-slate-700 pt-1">
        <div class="flex items-center gap-2">
            <span class="font-bold text-slate-900">Payment method:</span>
            <input type="text" x-model="invoice.paymentMethod" placeholder="Cash / Bank Transfer" class="border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent flex-1 text-slate-800">
        </div>
        <div class="flex items-center gap-2">
            <span class="font-bold text-slate-900">Note:</span>
            <input type="text" x-model="invoice.notes" placeholder="Thank you for choosing us!" class="border-b border-transparent hover:border-slate-300 focus:border-black bg-transparent flex-1 text-slate-800">
        </div>
    </div>

    <div class="flow-wave-decor absolute bottom-0 left-0 right-0 w-full pointer-events-none overflow-hidden h-24" style="position: absolute !important; width: 100% !important; min-width: 100% !important; left: 0 !important; right: 0 !important; bottom: 0 !important;">
        <svg viewBox="0 0 500 120" preserveAspectRatio="none" class="w-full h-full block" style="width: 100% !important; min-width: 100% !important; height: 100% !important; display: block !important;">
            <path d="M0,70 C150,110 320,30 500,80 L500,120 L0,120 Z" fill="#D1D5DB" opacity="0.6"></path>
            <path d="M0,90 C180,60 300,110 500,60 L500,120 L0,120 Z" fill="#2A373D"></path>
        </svg>
    </div>

</div>

