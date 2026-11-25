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
                       class="text-xl font-bold text-[#1D3557] border-b border-transparent hover:border-slate-300 focus:border-[#1D3557] focus:outline-hidden bg-transparent w-full">
            </div>
            <textarea x-model="invoice.sender"
                      rows="4"
                      placeholder="[Street Address]&#10;[City, ST ZIP]&#10;Phone: [000-000-0000]&#10;Website: company.com"
                      class="w-full text-xs text-slate-700 border border-transparent hover:border-slate-300 focus:border-[#1D3557] focus:outline-hidden bg-transparent resize-none p-0 leading-relaxed"></textarea>
            <div class="no-print pt-1" x-show="!invoice.logo">
                <label class="cursor-pointer inline-flex items-center gap-1.5 text-[11px] text-[#1D3557] hover:underline">
                    <span>+ Add Company Logo</span>
                    <input type="file" accept="image/*" @change="handleLogoUpload($event)" class="hidden">
                </label>
            </div>
        </div>

        <div class="text-left sm:text-right space-y-2 w-full sm:w-auto">
            <div>
                <input type="text"
                       x-model="invoice.title"
                       class="text-3xl sm:text-4xl font-extrabold uppercase tracking-wide text-[#4A90E2] text-left sm:text-right w-full sm:w-60 border-b border-transparent hover:border-slate-300 focus:border-[#4A90E2] focus:outline-hidden bg-transparent"
                       placeholder="INVOICE">
            </div>
            <div class="border border-slate-400 text-xs w-full sm:w-64 ml-auto text-left">
                <div class="grid grid-cols-2 border-b border-slate-300">
                    <span class="bg-slate-100 px-2 py-1 font-bold text-slate-700 uppercase text-[10px]">DATE</span>
                    <input type="text" x-model="invoice.date" class="px-2 py-1 text-slate-800 border-l border-slate-300 bg-transparent text-right font-medium">
                </div>
                <div class="grid grid-cols-2 border-b border-slate-300">
                    <span class="bg-slate-100 px-2 py-1 font-bold text-slate-700 uppercase text-[10px]">INVOICE #</span>
                    <input type="text" x-model="invoice.number" class="px-2 py-1 text-slate-800 border-l border-slate-300 bg-transparent text-right font-bold">
                </div>
                <div class="grid grid-cols-2">
                    <span class="bg-slate-100 px-2 py-1 font-bold text-slate-700 uppercase text-[10px]">CUSTOMER ID</span>
                    <input type="text" x-model="invoice.poNumber" placeholder="[123]" class="px-2 py-1 text-slate-800 border-l border-slate-300 bg-transparent text-right">
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs pt-2">
        <div class="space-y-1">
            <div style="background-color: #2B4C7E;" class="text-white font-bold px-3 py-1 uppercase tracking-wider text-[11px]">
                BILL TO:
            </div>
            <textarea x-model="invoice.billTo"
                      rows="4"
                      placeholder="[Name]&#10;[Company Name]&#10;[Street Address]&#10;[City, ST ZIP]&#10;Phone: [000-000-0000]"
                      class="w-full text-xs text-slate-800 border border-slate-200 rounded p-2 focus:border-[#2B4C7E] focus:outline-hidden bg-transparent leading-relaxed"
                      :class="activeError === 'billTo' ? 'border-rose-500 ring-2 ring-rose-200 error-highlight' : ''"></textarea>
        </div>

        <div class="space-y-1">
            <div style="background-color: #2B4C7E;" class="text-white font-bold px-3 py-1 uppercase tracking-wider text-[11px]">
                SHIP TO:
            </div>
            <textarea x-model="invoice.shipTo"
                      rows="4"
                      placeholder="[Name]&#10;[Company Name]&#10;[Street Address]&#10;[City, ST ZIP]&#10;Phone: [000-000-0000]"
                      class="w-full text-xs text-slate-800 border border-slate-200 rounded p-2 focus:border-[#2B4C7E] focus:outline-hidden bg-transparent leading-relaxed"></textarea>
        </div>
    </div>

    <div class="border border-slate-300 text-[11px] overflow-x-auto">
        <div style="background-color: #2B4C7E;" class="grid grid-cols-6 text-white font-bold text-center py-1 text-[10px] uppercase tracking-wider min-w-[500px]">
            <div>SALESPERSON</div>
            <div>P.O. #</div>
            <div>SHIP DATE</div>
            <div>SHIP VIA</div>
            <div>F.O.B.</div>
            <div>TERMS</div>
        </div>
        <div class="grid grid-cols-6 text-center py-1 text-slate-800 divide-x divide-slate-300 min-w-[500px]">
            <input type="text" placeholder="Sales Team" class="text-center px-1 bg-transparent border-none focus:outline-hidden">
            <input type="text" x-model="invoice.poNumber" placeholder="PO-998" class="text-center px-1 bg-transparent border-none focus:outline-hidden">
            <input type="text" placeholder="Pending" class="text-center px-1 bg-transparent border-none focus:outline-hidden">
            <input type="text" placeholder="Ground" class="text-center px-1 bg-transparent border-none focus:outline-hidden">
            <input type="text" placeholder="Origin" class="text-center px-1 bg-transparent border-none focus:outline-hidden">
            <input type="text" x-model="invoice.paymentTerms" placeholder="Net 30" class="text-center px-1 bg-transparent border-none focus:outline-hidden">
        </div>
    </div>

    <div class="border border-slate-300 overflow-x-auto">
        <table class="w-full text-left text-xs min-w-[550px] border-collapse">
            <thead>
                <tr style="background-color: #2B4C7E;" class="text-white text-[11px] font-bold uppercase tracking-wider divide-x divide-slate-400">
                    <th class="py-1.5 px-3 w-24">ITEM #</th>
                    <th class="py-1.5 px-3">DESCRIPTION</th>
                    <th class="py-1.5 px-3 text-center w-20">QTY</th>
                    <th class="py-1.5 px-3 text-right w-28">UNIT PRICE</th>
                    <th class="py-1.5 px-3 text-right w-28">TOTAL</th>
                    <th class="py-1.5 px-2 text-center w-8 no-print"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <template x-for="(item, index) in invoice.items" :key="index">
                    <tr class="divide-x divide-slate-200 hover:bg-slate-50/50">
                        <td class="p-1.5">
                            <input type="text" placeholder="[101]" class="w-full text-slate-600 border-none bg-transparent focus:outline-hidden text-center text-xs">
                        </td>
                        <td class="p-1.5">
                            <input type="text"
                                   x-model="item.description"
                                   placeholder="Product XYZ"
                                   class="w-full text-slate-900 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_desc_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-1.5">
                            <input type="number"
                                   x-model.number="item.quantity"
                                   min="1"
                                   class="w-full text-center text-slate-900 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_qty_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-1.5 text-right">
                            <input type="number"
                                   x-model.number="item.rate"
                                   step="0.01"
                                   min="0"
                                   class="w-full text-right text-slate-900 border-none bg-transparent focus:outline-hidden text-xs"
                                   :class="activeError === ('item_rate_' + index) ? 'border-b-2 border-rose-500 ring-2 ring-rose-200 error-highlight' : ''">
                        </td>
                        <td class="p-1.5 text-right font-medium text-slate-900">
                            <span x-text="invoice.currency"></span><span x-text="formatNumber(item.quantity * item.rate)"></span>
                        </td>
                        <td class="p-1.5 text-center no-print">
                            <button type="button" @click="removeItem(index)" class="text-rose-500 hover:text-rose-700 text-sm font-bold">&times;</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="no-print">
        <button type="button"
                @click="addItem()"
                style="color: #2B4C7E;"
                class="hover:underline text-xs font-bold inline-flex items-center gap-1 cursor-pointer">
            <span>+ Add Row Item</span>
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 pt-2">
        
        <div class="sm:col-span-7 space-y-3">
            <div class="border border-slate-300">
                <div class="bg-slate-200 px-3 py-1 font-bold text-slate-800 text-[11px] uppercase border-b border-slate-300">
                    Other Comments or Special Instructions
                </div>
                <div class="p-3">
                    <textarea x-model="invoice.notes"
                              rows="3"
                              placeholder="1. Total payment due in 30 days.&#10;2. Please include invoice number on your check."
                              class="w-full text-xs text-slate-700 border-none bg-transparent focus:outline-hidden resize-none leading-relaxed"></textarea>
                </div>
            </div>
            <div class="text-xs text-slate-700 space-y-1">
                <div class="font-bold">Make all checks payable to <span x-text="invoice.companyName || '[Your Company Name]'"></span></div>
                <div class="italic text-[#2B4C7E] font-serif font-bold text-sm pt-1">Thank You For Your Business!</div>
            </div>
        </div>

        <div class="sm:col-span-5 border border-slate-300 text-xs divide-y divide-slate-200 ml-auto w-full sm:max-w-xs">
            <div class="flex justify-between px-3 py-1 text-slate-700">
                <span class="font-bold uppercase text-[10px]">SUBTOTAL</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(subtotal)"></span></span>
            </div>
            <div class="flex justify-between items-center px-3 py-1 text-slate-700">
                <span class="font-bold uppercase text-[10px] cursor-pointer" @click="toggleTaxMode()">TAX RATE (%)</span>
                <input type="number" x-model.number="invoice.taxRate" class="w-16 text-right font-medium bg-transparent border-b border-slate-300">
            </div>
            <div class="flex justify-between px-3 py-1 text-slate-700">
                <span class="font-bold uppercase text-[10px]">TAX</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(taxAmount)"></span></span>
            </div>
            <div class="flex justify-between items-center px-3 py-1 text-slate-700" x-show="showShipping || invoice.shipping > 0">
                <span class="font-bold uppercase text-[10px]">S &amp; H</span>
                <input type="number" x-model.number="invoice.shipping" class="w-16 text-right font-medium bg-transparent border-b border-slate-300">
            </div>
            <div class="flex justify-between items-center px-3 py-1.5 font-black text-sm text-white" style="background-color: #2B4C7E;">
                <span class="uppercase">TOTAL</span>
                <span><span x-text="invoice.currency"></span><span x-text="formatNumber(totalAmount)"></span></span>
            </div>
        </div>

    </div>

</div>

