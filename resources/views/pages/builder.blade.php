@extends('layouts.app')

@section('title', 'Blank Canvas Invoice Builder | Design Custom Invoices Online')
@section('meta_description', 'Design custom invoices from scratch with our Blank Canvas Builder. Add boxes, pick brand colors, and export high-res PDFs for free!')
@section('canonical', route('invoice.builder'))

@section('content')
<div x-data="invoiceBuilderApp()" x-init="initBuilder()" class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-6 pb-16 sm:pt-8 sm:pb-20">
        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                        Customize Your Own Invoice
                    </h1>
                </div>

                <div class="flex items-center flex-wrap gap-2.5">
                    <div class="relative"
                         x-data="{ openCurrency: false }"
                         @click.outside="openCurrency = false"
                         @keydown.escape.window="openCurrency = false">

                        <button type="button"
                                @click="openCurrency = !openCurrency"
                                :class="openCurrency ? 'border-white bg-white text-slate-900 shadow-md ring-2 ring-white/20' : 'border-white/25 bg-white/10 hover:bg-white/20 text-white'"
                                class="border rounded-full px-3.5 py-1.5 flex items-center gap-2 text-xs font-semibold backdrop-blur-md transition-all cursor-pointer select-none">
                            <span class="opacity-75">Currency:</span>
                            <span class="font-bold" x-text="currencyLabel"></span>
                            <svg class="w-3.5 h-3.5 opacity-70 transition-transform duration-200"
                                 :class="openCurrency ? 'rotate-180' : 'rotate-0'"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>






                        <div x-show="openCurrency"
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute left-0 mt-2 z-50 w-52 max-h-72 overflow-y-auto bg-white border border-slate-200/90 rounded-2xl shadow-[0_16px_36px_rgba(42,55,61,0.2)] p-1.5 space-y-0.5 text-slate-800">
                            <template x-for="curr in currencies" :key="curr.symbol">
                                <button type="button"
                                        @click="currency = curr.symbol; openCurrency = false"
                                        :class="currency === curr.symbol
                                            ? 'bg-[#2A373D] text-white font-bold shadow-xs'
                                            : 'text-slate-700 hover:bg-slate-100/90 hover:text-slate-900 font-medium'"
                                        class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs transition-all text-left cursor-pointer">
                                    <span x-text="curr.label"></span>
                                    <svg x-show="currency === curr.symbol"
                                         class="w-3.5 h-3.5 text-white shrink-0"
                                         fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </div>




                    <div class="bg-white/10 border border-white/25 rounded-full p-0.5 flex items-center backdrop-blur-md shadow-xs">
                        <button type="button"
                                @click="downloadFormat = 'pdf'"
                                :class="downloadFormat === 'pdf' ? 'bg-white text-slate-900 shadow-xs font-bold' : 'text-white/80 hover:text-white font-semibold'"
                                class="py-1 px-3 rounded-full text-xs transition-all cursor-pointer">
                            PDF
                        </button>
                        <button type="button"
                                @click="downloadFormat = 'png'"
                                :class="downloadFormat === 'png' ? 'bg-white text-slate-900 shadow-xs font-bold' : 'text-white/80 hover:text-white font-semibold'"
                                class="py-1 px-3 rounded-full text-xs transition-all cursor-pointer">
                            PNG
                        </button>
                    </div>
                    <button type="button"
                            @click="printInvoice()"
                            :disabled="isPrinting || isGenerating"
                            class="bg-white/10 hover:bg-white/20 border border-white/25 text-white px-4 py-1.5 rounded-full text-xs font-bold flex items-center gap-1.5 transition-all cursor-pointer disabled:opacity-60">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V3h12v6M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v7H6z"/></svg>
                        <span x-text="isPrinting ? 'Preparing Print...' : 'Print Invoice'">Print Invoice</span>
                    </button>
                    <button type="button"
                            @click="downloadInvoice()"
                            :disabled="isGenerating || isPrinting"
                            class="bg-white hover:bg-slate-100 active:scale-[0.98] text-[#2A373D] px-5 py-1.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 shadow-sm transition-all disabled:opacity-60 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span x-text="isGenerating ? 'Exporting...' : 'Download'">Download</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
            <svg class="relative block w-full h-8 sm:h-12 text-slate-50" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,45 C320,115 520,10 880,75 C1120,115 1320,50 1440,40 L1440,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-slate-50">

        <div class="ib-layout">
            <aside class="ib-sidebar no-print">
                <section class="ib-panel">
                    <button class="ib-add" @click="paletteOpen = !paletteOpen" :aria-expanded="paletteOpen">＋ Add Boxes <span x-text="paletteOpen ? '−' : '⌄'"></span></button>
                    <div x-show="paletteOpen" x-cloak class="ib-palette">
                        <template x-for="item in availableBoxTypes" :key="item.type">
                            <button draggable="true" @dragstart="paletteDrag($event, item.type)" @click="addBlock(item.type)"><span x-text="item.label"></span><span>＋</span></button>
                        </template>
                    </div>
                </section>
                <section class="ib-panel">
                    <div class="ib-panel-title"><strong>Manage Box Locations</strong><span x-text="blocks.length + ' boxes'"></span></div>
                    <p x-show="!blocks.length" class="ib-hint">No boxes added yet. Click Add Boxes or drag a box onto your invoice.</p>
                    <div class="ib-layers">
                        <template x-for="(block, index) in blocks" :key="block.id">
                            <div class="ib-layer" :class="selectedId === block.id && 'active'">
                                <button class="ib-layer-name" @click="selectedId = block.id"><span class="ib-dot" :style="{background: block.color}"></span><span x-text="getBlockLabel(block.type)"></span></button>
                                <button @click="moveLayer(index, -1)" :disabled="index === 0" title="Send backward">↓</button>
                                <button @click="moveLayer(index, 1)" :disabled="index === blocks.length - 1" title="Bring forward">↑</button>
                                <button @click="removeBlock(block.id)" title="Delete box" class="ib-delete">×</button>
                            </div>
                        </template>
                    </div>
                    <div class="ib-panel-footer"><span>Drag the handle to move</span><button @click="clearAll()" class="ib-delete">Clear all</button></div>
                </section>
                <template x-if="selected">
                    <section class="ib-panel ib-properties">
                        <div class="ib-panel-title"><strong>Customize Box</strong><span x-text="getBlockLabel(selected.type)"></span></div>
                        <label x-show="selected.type !== 'logo'">Font<select x-model="selected.font"><option>Instrument Sans</option><option>Plus Jakarta Sans</option><option>Arial</option><option>Georgia</option><option>Times New Roman</option><option>Courier New</option></select></label>
                        <div class="ib-grid" x-show="selected.type !== 'logo'"><label>Font size<input type="number" min="8" max="96" x-model.number="selected.size" @change="selected.size = clamp(selected.size, 8, 96)"></label><label>Text color<input type="color" x-model="selected.color"></label></div>
                        <div class="ib-format" x-show="selected.type !== 'logo'"><button @click="selected.bold = !selected.bold" :aria-pressed="selected.bold" :class="selected.bold && 'active'"><b>B</b></button><button @click="selected.italic = !selected.italic" :aria-pressed="selected.italic" :class="selected.italic && 'active'"><i>I</i></button><select aria-label="Text alignment" x-model="selected.align"><option value="left">Left</option><option value="center">Center</option><option value="right">Right</option></select></div>
                        <div class="ib-grid"><label>X<input type="number" min="0" :max="900-selected.w" x-model.number="selected.x" @change="constrain(selected)"></label><label>Y<input type="number" min="0" :max="1273-selected.h" x-model.number="selected.y" @change="constrain(selected)"></label><label>Width<input type="number" :min="minWidth(selected)" max="900" x-model.number="selected.w" @change="constrain(selected)"></label><label>Height<input type="number" :min="selected.type === 'logo' &amp;&amp; selected.aspectRatio ? 0.01 : 36" step="any" max="1273" x-model.number="selected.h" @change="constrain(selected, 'height')"></label></div>
                        <div class="ib-grid" x-show="selected.type !== 'logo'"><div class="ib-background-control"><label class="ib-background-toggle"><input type="checkbox" x-model="selected.backgroundEnabled"> Background fill</label><label x-show="selected.backgroundEnabled">Fill color<input type="color" x-model="selected.background"></label><span x-show="!selected.backgroundEnabled" class="ib-hint">Transparent</span></div><label>Border color<input type="color" x-model="selected.borderColor"></label><label>Border / line<input type="number" min="0" max="12" x-model.number="selected.border" @change="selected.border = clamp(selected.border, 0, 12)"></label><label>Currency<select x-model="currency"><template x-for="option in currencies" :key="option.label"><option :value="option.symbol" x-text="option.label"></option></template></select></label></div>
                        <template x-if="selected.type === 'qr'"><div><label>QR text or URL<textarea x-model="selected.content" maxlength="1500"></textarea></label><button class="ib-secondary" @click="makeQr(selected)">Generate QR Code</button></div></template>
                        <template x-if="selected.type === 'date'"><div class="ib-properties">
                            <label>Date<input type="date" x-model="selected.content"></label>
                            <label>Date label<input type="text" x-model="selected.label"></label>
                            <label>Date format<select x-model="selected.dateFormat"><option>DD/MM/YYYY</option><option>MM/DD/YYYY</option><option>YYYY-MM-DD</option><option>DD-MM-YYYY</option><option>D MMM YYYY</option><option>MMMM D, YYYY</option></select></label>
                        </div></template>
                        <template x-if="['field','label'].includes(selected.type)"><div class="ib-properties">
                            <label>Field text<input type="text" x-model="selected.content"></label>
                            <div class="ib-grid">
                                <label>Line length (px)<input type="number" min="1" max="900" x-model.number="selected.lineWidth" @change="selected.lineWidth = clamp(selected.lineWidth,1,900)"></label>
                                <label>Line thickness<input type="number" min="0" max="12" x-model.number="selected.lineThickness" @change="selected.lineThickness = clamp(selected.lineThickness,0,12)"></label>
                                <label>Line color<input type="color" x-model="selected.lineColor"></label>
                                <label>Line style<select x-model="selected.lineStyle"><option value="solid">Solid</option><option value="dashed">Dashed</option><option value="dotted">Dotted</option><option value="double">Double</option><option value="none">None</option></select></label>
                            </div>
                            <template x-if="selected.type === 'label'"><div class="ib-grid">
                                <label>Label<input type="text" x-model="selected.label"></label>
                                <label>Separator<input type="text" x-model="selected.delimiter" maxlength="10"></label>
                                <label>Label width (px)<input type="number" min="0" max="500" x-model.number="selected.labelWidth" @change="selected.labelWidth = clamp(selected.labelWidth,0,500)"></label>
                                <label>Spacing (px)<input type="number" min="0" max="100" x-model.number="selected.fieldGap" @change="selected.fieldGap = clamp(selected.fieldGap,0,100)"></label>
                            </div></template>
                        </div></template>
                        <template x-if="selected.type === 'table'"><div class="ib-properties">
                            <div class="ib-grid"><label>Header color<input type="color" x-model="selected.headerBackground"></label><label>Header text color<input type="color" x-model="selected.headerColor"></label></div>
                            <div class="ib-grid"><label>Item heading<input x-model="selected.columns.item"></label><label>Quantity heading<input x-model="selected.columns.quantity"></label><label>Rate heading<input x-model="selected.columns.rate"></label><label>Amount heading<input x-model="selected.columns.amount"></label></div>
                        </div></template>
                        <template x-if="selected.type === 'logo'">
                            <div class="ib-image-controls">
                                <label class="ib-secondary"><span x-text="selected.src ? 'Change Logo' : 'Upload Logo'"></span><input type="file" accept="image/png,image/jpeg,image/webp" @change="uploadLogo($event, selected)" hidden></label>
                                <button x-show="selected.src" class="ib-delete" @click="selected.src = ''">Remove Logo</button>
                            </div>
                        </template>
                        <template x-if="selected.type === 'summary'">
                            <div class="ib-checkout-options">
                                <strong>Checkout rows</strong>
                                <p class="ib-hint">Choose the rows to include and edit their names. Removed charges do not affect the total.</p>
                                <template x-for="row in summaryRows" :key="row.key">
                                    <div class="ib-row-option">
                                        <label class="ib-row-toggle"><input type="checkbox" x-model="selected.visible[row.key]" :aria-label="'Include ' + row.label"><span x-text="row.label"></span></label>
                                        <input x-show="selected.visible[row.key]" type="text" x-model="selected.labels[row.key]" :aria-label="row.label + ' label'">
                                    </div>
                                </template>
                            </div>
                        </template>
                        <button class="ib-secondary" @click="duplicateBlock(selected)">Duplicate Box</button>
                        <p class="ib-hint">Use the move handle or X / Y fields to position this box.</p>
                    </section>
                </template>
                <p x-show="error" x-text="error" role="alert" class="ib-error"></p>
            </aside>
            <div class="ib-canvas-scroll">
                <div id="invoice-sheet" class="ib-sheet invoice-printable-card" x-ref="sheet" @dragover.prevent @drop.prevent="dropBox($event)" @click.self="selectedId = null">
                    <template x-for="block in blocks" :key="block.id">
                        <div class="ib-block" :class="{'ib-selected': selectedId === block.id}" :style="blockStyle(block)" @pointerdown="selectedId = block.id">
                            <button class="ib-handle no-print" aria-label="Move box" @pointerdown.prevent.stop="startGesture($event, block, false)" @keydown.arrow-left.prevent="nudge(block, -1, 0)" @keydown.arrow-right.prevent="nudge(block, 1, 0)" @keydown.arrow-up.prevent="nudge(block, 0, -1)" @keydown.arrow-down.prevent="nudge(block, 0, 1)">⠿ <span x-text="getBlockLabel(block.type)"></span></button>
                            <div class="ib-content" :style="{border: block.type === 'separator' ? 'none' : block.border + 'px solid ' + block.borderColor}">
                                <template x-if="block.type === 'logo'"><div class="ib-logo" :class="{'ib-logo-empty': !block.src}">
                                    <template x-if="block.src"><img :src="block.src" alt="Company logo" draggable="false" tabindex="0" @click="selectedId = block.id" @keydown.enter="selectedId = block.id"></template>
                                    <template x-if="!block.src"><label class="ib-logo-upload">+ Upload Logo<input type="file" accept="image/png,image/jpeg,image/webp" @change="uploadLogo($event, block)" hidden></label></template>
                                </div></template>
                                <template x-if="['company','title','number','heading','text','empty'].includes(block.type)"><textarea :aria-label="getBlockLabel(block.type)" x-model="block.content" :placeholder="block.type === 'empty' ? '' : getBlockLabel(block.type)"></textarea></template>
                                <template x-if="block.type === 'date'"><div class="ib-date-field"><input aria-label="Date label" x-model="block.label" :style="{width: Math.max(1, block.label.length) + 'ch'}"><span>:</span><span x-text="formattedDate(block)"></span></div></template>
                                <template x-if="block.type === 'field'"><div class="ib-single-field"><div class="ib-field-line" :style="fieldLineStyle(block)"><input aria-label="Field text" x-model="block.content"></div></div></template>
                                <template x-if="block.type === 'label'"><div class="ib-label-field" :style="{gap: block.fieldGap + 'px'}"><input class="ib-field-label" aria-label="Field label" x-model="block.label" :style="{width: block.labelWidth + 'px'}"><input class="ib-field-separator" aria-label="Field separator" x-model="block.delimiter" :style="{width: Math.max(1, block.delimiter.length) + 'ch'}"><div class="ib-field-line" :style="fieldLineStyle(block)"><input aria-label="Field value" x-model="block.content"></div></div></template>
                                <template x-if="['notes','terms','address'].includes(block.type)"><div class="ib-text-group"><input aria-label="Section heading" x-model="block.label"><textarea :aria-label="block.label" x-model="block.content" :placeholder="block.placeholder"></textarea></div></template>
                                <template x-if="block.type === 'separator'"><div class="ib-line" :style="{borderTop: Math.max(1, block.border) * (block.bold ? 2 : 1) + 'px solid ' + block.color}"></div></template>
                                <template x-if="block.type === 'qr'"><div class="ib-qr"><img x-show="block.src" :src="block.src || null" alt="Custom QR code"><span x-show="!block.src">Enter QR text in Customize Box</span></div></template>
                                <template x-if="block.type === 'table'"><div>
                                    <table class="ib-table"><thead :style="{background: block.headerBackground, color: block.headerColor}"><tr><th><input aria-label="Item heading" x-model="block.columns.item"></th><th><input aria-label="Quantity heading" x-model="block.columns.quantity"></th><th><input aria-label="Rate heading" x-model="block.columns.rate"></th><th><input aria-label="Amount heading" x-model="block.columns.amount"></th><th class="no-print"></th></tr></thead><tbody><template x-for="(item, i) in block.items" :key="item.id"><tr><td><input aria-label="Item" x-model="item.description" placeholder="Description of item/service..."></td><td><input aria-label="Quantity" type="number" min="0" step="any" x-model.number="item.qty" @change="item.qty = positive(item.qty)"></td><td><div class="ib-money-input"><span x-text="currency"></span><input aria-label="Rate" type="number" min="0" step="any" x-model.number="item.rate" @change="item.rate = positive(item.rate)"></div></td><td x-text="money(positive(item.qty) * positive(item.rate))"></td><td class="no-print"><button aria-label="Remove line item" @click="block.items.splice(i, 1)">×</button></td></tr></template></tbody></table>
                                    <button class="ib-secondary no-print" @click="addItem(block)">+ Line Item</button>
                                </div></template>
                                <template x-if="block.type === 'summary'"><div class="ib-summary">
                                    <div x-show="block.visible.subtotal"><span x-text="block.labels.subtotal"></span><span x-text="money(subtotal)"></span></div>
                                    <div x-show="block.visible.tax"><label><span x-text="block.labels.tax"></span> <input aria-label="Tax percent" type="number" min="0" step="any" x-model.number="block.tax"></label><span x-text="money(subtotal * positive(block.tax) / 100)"></span></div>
                                    <div x-show="block.visible.discount"><label x-text="block.labels.discount"></label><div class="ib-money-input"><span x-text="currency"></span><input aria-label="Discount" type="number" min="0" step="any" x-model.number="block.discount"></div></div>
                                    <div x-show="block.visible.shipping"><label x-text="block.labels.shipping"></label><div class="ib-money-input"><span x-text="currency"></span><input aria-label="Shipping" type="number" min="0" step="any" x-model.number="block.shipping"></div></div>
                                    <div x-show="block.visible.total" class="ib-total"><span x-text="block.labels.total"></span><span x-text="money(total(block))"></span></div>
                                    <div x-show="block.visible.paid"><label x-text="block.labels.paid"></label><div class="ib-money-input"><span x-text="currency"></span><input aria-label="Amount Paid" type="number" min="0" step="any" x-model.number="block.paid"></div></div>
                                    <div x-show="block.visible.balance" class="ib-total"><span x-text="block.labels.balance"></span><span x-text="money(balance(block))"></span></div>
                                </div></template>
                            </div>
                            <button class="ib-resize no-print" aria-label="Resize box" @pointerdown.prevent.stop="startGesture($event, block, true)">◢</button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.ib-layout{display:flex;align-items:flex-start;gap:32px}.ib-sidebar{width:320px;flex-shrink:0;display:grid;gap:16px}.ib-panel{background:transparent;border:0;border-radius:0;padding:16px 0}.ib-add{display:flex;justify-content:space-between;width:100%;background:#101729;color:white;border-radius:12px;padding:13px 16px;font-weight:700;font-size:14px}.ib-palette{padding-top:12px;display:grid;grid-template-columns:1fr 1fr;gap:4px}.ib-palette button{display:flex;justify-content:space-between;text-align:left;padding:9px 7px;font-size:12px;border-radius:6px}.ib-palette button:hover,.ib-format .active{background:#f1f5f9;color:#0f172a}.ib-panel-title{display:flex;justify-content:space-between;gap:8px;font-size:11px;padding-bottom:12px;border-bottom:1px solid #edf1f6;color:#475569}.ib-panel-title strong{text-transform:uppercase}.ib-panel-title span,.ib-hint{color:#8090a7}.ib-hint{font-size:12px;line-height:1.7;margin-top:12px}.ib-layers{max-height:300px;overflow:auto}.ib-layer{display:flex;gap:8px;align-items:center;border:1px solid #e0e7f0;border-radius:10px;padding:10px;margin-top:10px;font-size:12px;background:#f8fafc}.ib-layer.active{border-color:#2A373D}.ib-layer-name{display:flex;align-items:center;gap:8px;flex:1;text-align:left}.ib-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0}.ib-delete{color:#e64764}.ib-panel-footer{display:flex;justify-content:space-between;font-size:11px;border-top:1px solid #edf1f6;padding-top:10px;margin-top:12px;color:#8090a7}.ib-properties{display:grid;gap:12px}.ib-properties label{display:grid;gap:5px;font-size:11px;color:#64748b}.ib-properties input,.ib-properties select,.ib-properties textarea{min-width:0;width:100%;border:1px solid #dce4ef;border-radius:6px;padding:6px;color:#172033;background:white;font-size:12px}.ib-properties input[type=color]{height:32px;padding:3px}.ib-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}.ib-format{display:flex;gap:8px}.ib-format button{width:38px;border:1px solid #dce4ef;border-radius:6px}.ib-secondary{font-size:12px;padding:8px 12px;border:1px solid #cbd5e1;border-radius:5px;background:#f1f5f9;margin-top:8px;color:#15253c}.ib-canvas-scroll{flex:1;min-width:0;overflow:auto;padding:1px 2px 16px}.ib-sheet{position:relative;width:900px;height:1273px;background:#fff;border:1px solid #dce4ef;border-radius:16px;box-shadow:0 2px 4px #15253c20;overflow:hidden}.ib-block{position:absolute;box-sizing:border-box}.ib-block.ib-selected{outline:1px solid #2A373D;outline-offset:1px}.ib-content{height:100%;width:100%;overflow:auto;box-sizing:border-box}.ib-content input,.ib-content textarea{font:inherit;color:inherit;text-align:inherit;background:transparent;outline:none;min-width:0;max-width:100%;border-radius:0}.ib-content textarea{display:block;width:100%;height:100%;resize:none;padding:5px;line-height:1.5}.ib-content input:focus,.ib-content textarea:focus{background:#f1f5f955}.ib-handle{position:absolute;top:0;left:0;transform:translateY(-100%);height:23px;background:#132036;color:#fff;border-radius:4px 4px 0 0;white-space:nowrap;padding:2px 8px;font:11px 'Instrument Sans',sans-serif;cursor:move;touch-action:none;z-index:3;display:none}.ib-block:hover .ib-handle,.ib-selected .ib-handle,.ib-block:focus-within .ib-handle{display:block}.ib-block[style*="top: 0px"] .ib-handle{transform:none}.ib-resize{position:absolute;right:0;bottom:0;color:#2A373D;cursor:nwse-resize;touch-action:none;display:none;line-height:16px;background:white}.ib-selected .ib-resize{display:block}.ib-logo,.ib-qr{display:flex;align-items:center;justify-content:center;height:100%;font-size:12px;color:#64748b;text-align:center}.ib-logo{cursor:default}.ib-logo-empty{border:1px dashed #cbd5e1;border-radius:8px}.ib-logo-upload{display:flex;align-items:center;justify-content:center;width:100%;height:100%;cursor:pointer}.ib-logo img{cursor:pointer;width:100%;height:100%;display:block}.ib-logo img,.ib-qr img{max-width:100%;max-height:100%;object-fit:contain}.ib-label-field{display:flex;gap:8px;align-items:center;height:100%;padding:5px}.ib-label-field input{width:35%}.ib-label-field .ib-underline{flex:1;border-bottom:1px solid currentColor}.ib-text-group{display:flex;flex-direction:column;height:100%;padding:5px;gap:6px}.ib-text-group>input{width:100%;font-weight:700}.ib-text-group textarea{flex:1;min-height:0;padding:0}.ib-line{position:absolute;top:50%;width:100%}.ib-table{width:100%;table-layout:fixed;border-collapse:collapse}.ib-table th{background:transparent;color:inherit;text-align:left;padding:10px 8px;font-weight:700}.ib-table th:first-child{width:51%}.ib-table th:last-child{width:24px}.ib-table td{padding:8px;border-bottom:1px solid #edf1f6}.ib-table input{width:100%}.ib-table td:nth-child(4){text-align:right;font-variant-numeric:tabular-nums}.ib-summary{padding:8px}.ib-summary>div{display:flex;justify-content:space-between;align-items:center;gap:12px;padding:6px 0}.ib-summary input{width:75px;text-align:right;border-bottom:1px solid #dce4ef}.ib-total{border-top:1px solid #cbd5e1;font-weight:700}.ib-error{color:#b42338;font-size:12px}button{cursor:pointer}button:disabled{opacity:.3}.is-exporting .ib-sheet{border:none;border-radius:0;box-shadow:none}.is-exporting .ib-block{outline:none}.is-exporting .ib-sheet .no-print{display:none!important}.is-exporting .ib-content{overflow:hidden}.is-exporting .ib-logo{border:none}.is-exporting .ib-content input,.is-exporting .ib-content textarea{background:transparent!important}.is-exporting .ib-content textarea::placeholder,.is-exporting .ib-content input::placeholder{color:transparent}
@media(max-width:1023px){.ib-layout{flex-direction:column}.ib-sidebar{width:100%}.ib-canvas-scroll{width:100%}.ib-palette{grid-template-columns:repeat(3,1fr)}}
.ib-image-controls{display:flex;align-items:center;gap:16px;font-size:12px}.ib-image-controls .ib-secondary{cursor:pointer}.ib-properties input[hidden]{display:none}.ib-checkout-options{display:grid;gap:10px;font-size:12px}.ib-checkout-options .ib-hint{margin:0}.ib-row-option{display:grid;gap:6px}.ib-properties .ib-row-toggle{display:flex;align-items:center;gap:8px;font-size:12px}.ib-properties .ib-row-toggle input{width:15px;height:15px;accent-color:#2A373D}.ib-row-option>input{margin-left:23px;width:calc(100% - 23px)}
.ib-background-control{display:grid;gap:5px}.ib-properties .ib-background-toggle{display:flex;align-items:center;gap:6px}.ib-properties .ib-background-toggle input{width:14px;height:14px;accent-color:#2A373D}.ib-background-control .ib-hint{margin:0}
.ib-date-field{display:flex;align-items:baseline;gap:8px;padding:5px;white-space:nowrap}.ib-date-field input{flex-shrink:0}.ib-single-field{padding:5px;display:flex;align-items:baseline}.ib-label-field{align-items:baseline;height:auto;max-width:100%}.ib-label-field .ib-field-label,.ib-label-field .ib-field-separator{flex-shrink:0}.ib-field-line{flex:0 1 auto;min-width:0;max-width:100%;align-self:baseline}.ib-content .ib-field-line input{display:block;width:100%;height:auto;padding:0 0 1px;line-height:1.2;border:0;margin:0}.ib-content .ib-field-label,.ib-content .ib-field-separator{padding:0;line-height:1.2;border:0}.ib-money-input{display:flex;align-items:baseline;justify-content:flex-end;gap:3px;min-width:0;white-space:nowrap}.ib-money-input>span{flex-shrink:0}.ib-money-input input{min-width:0}.ib-table .ib-money-input input{flex:1;width:0}.ib-summary .ib-money-input{max-width:55%}.ib-table th input{font-weight:inherit}.ib-table td:nth-child(4){overflow-wrap:anywhere}
.ib-print-button{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:1px solid #cbd5e1;border-radius:999px;padding:8px 16px;background:white;color:#172033;font-size:12px;font-weight:700}.ib-print-button:hover{background:#f1f5f9}.ib-print-button:disabled{cursor:wait;opacity:.6}
</style>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script src="{{ asset('js/invoice-builder.js') }}"></script>
@endpush
