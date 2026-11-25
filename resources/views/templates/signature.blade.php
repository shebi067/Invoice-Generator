<div class="border-2 border-[#134E4A] p-6 sm:p-10 space-y-6 text-slate-900 font-sans bg-white relative overflow-hidden">

    <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full border-[18px] border-teal-50 pointer-events-none"></div>
    <div class="absolute top-1/4 -left-16 w-48 h-48 rounded-full border-[14px] border-slate-50 pointer-events-none"></div>

    <div class="text-center space-y-3 relative z-10">
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
                   class="text-4xl sm:text-5xl font-black uppercase tracking-wider text-[#134E4A] text-center w-full border-none focus:outline-hidden bg-transparent"
                   placeholder="INVOICE">
        </div>
        <div class="w-32 mx-auto border-b-2 border-slate-700"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs pt-4 relative z-10">
        
        <div class="border-l-2 border-[#134E4A] pl-3 space-y-1">
            <span class="font-bold text-slate-900 block text-xs">Your Information</span>
            <textarea x-model="invoice.sender"
                      rows="3"
                      placeholder="John Smith&#10;123 Main Street, Anytown, USA&#10;johnsmith@example.com"
                      class="w-full text-slate-600 border border-transparent hover:border-slate-300 focus:border-[#134E4A] bg-transparent resize-none p-0 leading-relaxed text-xs"></textarea>
        </div>

        <div class="border-l-2 border-[#134E4A] pl-3 space-y-1">
            <span class="font-bold text-slate-900 block text-xs">Client Information</span>
            <textarea x-model="invoice.billTo"
                      rows="3"
                      placeholder="Jane Doe&#10;456 Elm Street, Anycity, USA&#10;janedoe@example.com"
                      class="w-full text-slate-600 border border-transparent hover:border-slate-300 focus:border-[#134E4A] bg-transparent resize-none p-0 leading-relaxed text-xs"
                      :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
        </div>

        <div class="border-l-2 border-[#134E4A] pl-3 space-y-2 text-slate-700">
            <div>
                <span class="font-bold text-slate-900 block">Issued on</span>
                <input type="text" x-model="invoice.date" class="border-b border-transparent hover:border-slate-300 focus:border-[#134E4A] bg-transparent font-medium">
            </div>
            <div>
                <span class="font-bold text-slate-900 block">Due date</span>
                <input type="text" x-model="invoice.dueDate" class="border-b border-transparent hover:border-slate-300 focus:border-[#134E4A] bg-transparent font-medium">
            </div>
        </div>

    </div>

    <div class="pt-2 relative z-10 overflow-x-auto">
        <table class="w-full text-left text-xs min-w-[500px] border border-slate-200">
            <thead>
                <tr style="background-color: #4A7A82;" class="text-white font-bold text-xs">
                    <th class="py-2.5 px-4">Item Description</th>
                    <th class="py-2.5 px-4 text-center w-20">Quantity</th>
                    <th class="py-2.5 px-4 text-right w-28">Unit Price</th>
                    <th class="py-2.5 px-4 text-right w-28">Total Price</th>
                    <th class="py-2.5 px-2 text-center w-8 no-print"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-2.5 px-4">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Web Design / SEO Optimization"
                                   class="w-full text-slate-800 border-none bg-transparent focus:outline-hidden text-xs font-semibold"
                                   :class="activeError === ('item_desc_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-2.5 px-4 text-center">
                            <input type="number"
                                   x-model.number="item.quantity"
                                   min="1"
                                   class="w-full text-center text-slate-800 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_qty_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-2.5 px-4 text-right">
                            <input type="number"
                                   x-model.number="item.rate"
                                   step="0.01"
                                   min="0"
                                   class="w-full text-right text-slate-800 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_rate_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-2.5 px-4 text-right font-medium text-slate-900">
                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                        </td>
                        <td class="p-2.5 px-2 text-center no-print">
                            <button type="button" @click="removeItem(index)" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="no-print">
        <button type="button" @click="addItem()" style="color: #134E4A;" class="hover:underline font-bold text-xs inline-flex items-center gap-1 cursor-pointer">
            <span>+ Add Line Item</span>
        </button>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-end gap-6 pt-4 relative z-10">
        <div></div>
        <div class="text-right space-y-4">
            <div class="text-sm sm:text-base font-bold text-slate-900">
                <span>Total Amount Due: </span>
                <span class="font-black text-lg text-[#134E4A]"><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
            </div>
            <div class="inline-block text-center pt-2">
                <div class="font-serif italic text-2xl text-slate-700 leading-none select-none tracking-wide" style="font-family: 'Brush Script MT', 'Dancing Script', cursive;">
                    John Smith
                </div>
                <div class="border-t border-slate-700 pt-0.5 text-xs text-slate-800 font-bold mt-1">
                    John Smith
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-slate-200 pt-6 text-center text-xs text-slate-500 italic leading-relaxed relative z-10">
        Thank you for choosing our services! We appreciate the opportunity to work with you. Please make the payment within 30 days of receiving this invoice. If you have any questions or concerns regarding the invoice, feel free to contact us at the provided email address. We look forward to serving you again in the future.
    </div>

</div>

