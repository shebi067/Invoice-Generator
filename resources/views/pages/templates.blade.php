@extends('layouts.app')

@section('title', 'Free Invoice Templates | Customizable & Ready-to-Use - InvoiceMaker')
@section('meta_description', 'Browse free, customizable invoice templates. Pick a professional design, edit online in seconds, and download your instant PDF invoice!')
@section('canonical', route('templates'))

@section('content')
<div class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-6 pb-16 sm:pt-10 sm:pb-24 overflow-hidden">

        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                Free Invoice Templates
            </h1>
            <p class="mt-2 text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl mx-auto">
                Choose the best invoice template that matches your business style. Every template is 100% customizable, free to use, and ready to export as clean PDF or PNG.
            </p>
        </div>

        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
            <svg class="relative block w-full h-10 sm:h-14 md:h-20 text-slate-50" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,45 C320,115 520,10 880,75 C1120,115 1320,50 1440,40 L1440,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
        @foreach($templates as $tpl)
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden flex flex-col group hover:shadow-xl hover:border-slate-400/80 transition-all duration-300">
                
                <a href="{{ route('templates.customize', $tpl['id']) }}" class="p-6 bg-slate-50/90 border-b border-slate-100 flex items-center justify-center relative overflow-hidden cursor-pointer block select-none group-hover:bg-slate-100/70 transition-colors">
                    <div class="w-full max-w-sm bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden transform group-hover:scale-[1.02] transition-transform">

                        @if($tpl['id'] === 'modern')
                            <div class="p-4 space-y-2.5 font-sans text-[11px] text-slate-900 bg-white">
                                <div class="flex justify-between items-start border-b border-slate-900 pb-2">
                                    <div>
                                        <div class="font-black text-base uppercase tracking-tight">INVOICE</div>
                                        <div class="text-[9px] text-slate-500"># 1024 &bull; 01/02/2025</div>
                                    </div>
                                    <div class="text-right text-[9px] text-slate-600 leading-tight">
                                        <div class="font-bold text-slate-900 uppercase">CAVEIN ARCHITECTS</div>
                                        <div>123 Design Blvd, Studio 4A</div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-[9px] font-bold uppercase tracking-wider text-slate-400">BILLED TO:</div>
                                    <div class="text-[10px] text-slate-800">Modern Living Co. &bull; 908 Broadway Ave</div>
                                </div>
                                <div class="border-t border-b border-slate-900 py-1 space-y-1 text-[10px]">
                                    <div class="flex justify-between font-bold text-[9px] text-slate-400 uppercase">
                                        <span>Description</span>
                                        <span>Total</span>
                                    </div>
                                    <div class="flex justify-between text-slate-800">
                                        <span>Architectural Concept Design</span>
                                        <span class="font-semibold">$2,400.00</span>
                                    </div>
                                    <div class="flex justify-between text-slate-800">
                                        <span>3D CAD Modeling & Renderings</span>
                                        <span class="font-semibold">$1,600.00</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] pt-1">
                                    <div class="text-[8px] text-slate-500 leading-tight">
                                        <span class="font-bold uppercase text-slate-700">Payment:</span> Pinky Bank #0123-4567
                                    </div>
                                    <div class="text-right font-black text-xs text-slate-900">
                                        Total: $4,400.00
                                    </div>
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'freelancer')
                            <div class="p-4 space-y-2.5 font-sans text-[11px] text-slate-900 bg-white">
                                <div class="flex justify-between items-start">
                                    <div class="text-[9px] space-y-0.5">
                                        <div class="font-bold uppercase tracking-wider text-slate-900">BILLED TO:</div>
                                        <div class="text-slate-600">Really Great Company</div>
                                        <div class="font-bold uppercase tracking-wider text-slate-900 pt-1">PAY TO:</div>
                                        <div class="text-slate-600">Avery Davis &bull; Freelance</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-sans tracking-[0.25em] text-sm uppercase font-light text-slate-900">I N V O I C E</div>
                                        <div class="text-[9px] text-slate-500"># 1024 &bull; 14 Days Term</div>
                                    </div>
                                </div>
                                <div class="bg-slate-50 rounded p-1.5 text-[8px] text-slate-600 space-y-0.5 border border-slate-100">
                                    <div><span class="font-semibold text-slate-800">Bank:</span> Really Great Bank</div>
                                    <div><span class="font-semibold text-slate-800">Account:</span> Avery Davis (123-456-7890)</div>
                                </div>
                                <div class="border-t border-b border-slate-200 py-1 space-y-1 text-[10px]">
                                    <div class="flex justify-between text-[9px] font-bold text-slate-400">
                                        <span>Description</span>
                                        <span>Rate &bull; Hrs</span>
                                        <span>Amount</span>
                                    </div>
                                    <div class="flex justify-between text-slate-800">
                                        <span>Brand Identity Design</span>
                                        <span class="text-slate-500">$85 &times; 20</span>
                                        <span class="font-semibold">$1,700.00</span>
                                    </div>
                                    <div class="flex justify-between text-slate-800">
                                        <span>Responsive UI/UX System</span>
                                        <span class="text-slate-500">$95 &times; 15</span>
                                        <span class="font-semibold">$1,425.00</span>
                                    </div>
                                </div>
                                <div class="flex justify-end pt-1">
                                    <div class="text-right font-black text-xs text-slate-900">
                                        Total: $3,125.00
                                    </div>
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'classic')
                            <div class="p-3 bg-white">
                                <div class="border-2 border-slate-900 p-2.5 space-y-2 text-[10px] text-slate-900">
                                    <div class="text-center border-b border-slate-900 pb-1">
                                        <div class="font-black text-sm uppercase tracking-[0.18em]">INVOICE</div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-[8px]">
                                        <div><span class="font-bold">Date:</span> <span class="border-b border-dotted border-slate-400">01/02/2025</span></div>
                                        <div class="text-right"><span class="font-bold">No. Invoice:</span> <span class="border-b border-dotted border-slate-400"># 1024</span></div>
                                    </div>
                                    <div class="text-[8px] bg-slate-50 p-1 rounded border border-slate-200">
                                        <span class="font-bold">Bill to:</span> Alexander Pierce &bull; Springfield, OR
                                    </div>
                                    <div class="border border-slate-800 text-[9px]">
                                        <div class="bg-slate-200 font-bold px-1.5 py-0.5 flex justify-between border-b border-slate-800 text-[8px]">
                                            <span>Item Description</span>
                                            <span>Total</span>
                                        </div>
                                        <div class="px-1.5 py-0.5 flex justify-between border-b border-slate-200">
                                            <span>Corporate Advisory Services</span>
                                            <span class="font-semibold">$1,850.00</span>
                                        </div>
                                        <div class="px-1.5 py-0.5 flex justify-between">
                                            <span>Financial Statement Audit</span>
                                            <span class="font-semibold">$950.00</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center pt-0.5 text-[9px]">
                                        <span class="font-serif italic font-bold text-slate-700">Thank you!</span>
                                        <span class="font-black text-xs">Total: $2,800.00</span>
                                    </div>
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'minimal')
                            <div class="space-y-2 text-[10px] text-slate-900 bg-white font-serif">
                                <div style="background-color: #CAD2C5;" class="py-2.5 px-3 text-center">
                                    <div class="font-serif tracking-[0.2em] text-xs uppercase font-bold text-slate-900">
                                        INVOICE
                                    </div>
                                    <div class="text-[8px] text-slate-700">Invoice No. 12224 &bull; Date: 01/02/2025</div>
                                </div>
                                <div class="px-3 space-y-1.5">
                                    <div class="text-[9px] text-slate-700">
                                        <span class="font-bold text-slate-900 block text-[8px] uppercase">Issued to</span>
                                        Paul Limpet &bull; (509) 555-0125 &bull; Logistics
                                    </div>
                                    <div class="border-t border-b border-slate-300 py-1 space-y-1 text-[9px]">
                                        <div class="flex justify-between font-bold text-[8px] text-slate-500 uppercase">
                                            <span>Description</span>
                                            <span>Amount</span>
                                        </div>
                                        <div class="flex justify-between text-slate-800">
                                            <span>Ocean Freight Cargo (40ft Container)</span>
                                            <span class="font-semibold">$2,500.00</span>
                                        </div>
                                        <div class="flex justify-between text-slate-800">
                                            <span>Customs Clearance & Documentation</span>
                                            <span class="font-semibold">$350.00</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-end pt-0.5">
                                        <span class="font-bold text-xs text-slate-900">Balance Due: $2,850.00</span>
                                    </div>
                                </div>
                                <div style="background-color: #CAD2C5;" class="py-1 px-3 text-center text-[8px] text-slate-800 font-sans">
                                    Ship Cargo Worldwide &bull; Fast, Reliable Logistics
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'corporate')
                            <div class="p-3 space-y-1.5 font-sans text-[10px] text-slate-900 bg-white">
                                <div class="flex justify-between items-start">
                                    <div class="text-[9px] leading-tight">
                                        <div class="font-bold text-[#1D3557] text-[11px]">[Company Name]</div>
                                        <div class="text-slate-500">100 Business Parkway</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-extrabold text-sm text-[#4A90E2] tracking-wide">INVOICE</div>
                                        <div class="border border-slate-300 text-[8px] mt-0.5">
                                            <div class="bg-slate-100 font-bold px-1 py-0.5 border-b border-slate-300 flex justify-between">
                                                <span>DATE</span>
                                                <span>5/1/2014</span>
                                            </div>
                                            <div class="px-1 py-0.5 flex justify-between">
                                                <span class="font-bold text-slate-600">INVOICE #</span>
                                                <span class="font-semibold text-slate-800">123456</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-[8px] pt-1">
                                    <div>
                                        <div style="background-color: #2B4C7E;" class="text-white font-bold px-1.5 py-0.5 text-[8px]">BILL TO:</div>
                                        <div class="border border-slate-200 p-1 text-slate-600 leading-tight">Name &bull; Company &bull; Address</div>
                                    </div>
                                    <div>
                                        <div style="background-color: #2B4C7E;" class="text-white font-bold px-1.5 py-0.5 text-[8px]">SHIP TO:</div>
                                        <div class="border border-slate-200 p-1 text-slate-600 leading-tight">Name &bull; Company &bull; Address</div>
                                    </div>
                                </div>
                                <div style="background-color: #2B4C7E;" class="text-white font-bold text-[7px] py-0.5 px-1 flex justify-between uppercase">
                                    <span>SALESPERSON</span>
                                    <span>P.O. #</span>
                                    <span>TERMS</span>
                                </div>
                                <div class="border border-slate-300 text-[8px]">
                                    <div style="background-color: #2B4C7E;" class="text-white font-bold px-1 py-0.5 flex justify-between text-[8px]">
                                        <span>DESCRIPTION</span>
                                        <span>TOTAL</span>
                                    </div>
                                    <div class="px-1 py-0.5 flex justify-between border-b border-slate-200">
                                        <span>Product XYZ &times; 15</span>
                                        <span class="font-semibold">$2,250.00</span>
                                    </div>
                                    <div class="px-1 py-0.5 flex justify-between">
                                        <span>Product ABC &times; 1</span>
                                        <span class="font-semibold">$75.00</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[9px] pt-0.5">
                                    <span class="italic text-[#2B4C7E] font-serif text-[8px]">Thank You For Your Business!</span>
                                    <span class="bg-[#2B4C7E] text-white px-2 py-0.5 font-black text-[10px] rounded">TOTAL: $2,484.84</span>
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'wave')
                            <div class="p-3 space-y-2 font-sans text-[10px] text-slate-900 bg-white relative overflow-hidden pb-8">
                                <div class="flex justify-between items-start">
                                    <div class="text-[9px] font-bold text-slate-400">YOUR LOGO</div>
                                    <div class="text-[8px] font-bold text-slate-600">NO. 000001</div>
                                </div>
                                <div>
                                    <div class="font-black text-lg tracking-tight uppercase">INVOICE</div>
                                    <div class="text-[8px] text-slate-500">Date: 02 June, 2030</div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-[8px] text-slate-600">
                                    <div><span class="font-bold text-slate-900 block">Billed to:</span>Studio Shodwe &bull; 123 Main St</div>
                                    <div><span class="font-bold text-slate-900 block">From:</span>Olivia Wilson &bull; 123 Main St</div>
                                </div>
                                <div class="bg-slate-100 rounded p-1 text-[8px]">
                                    <div class="font-bold text-slate-700 flex justify-between border-b border-slate-200 pb-0.5">
                                        <span>Item Description</span>
                                        <span>Amount</span>
                                    </div>
                                    <div class="flex justify-between py-0.5 text-slate-800">
                                        <span>Brand Logo Design</span>
                                        <span class="font-semibold">$500.00</span>
                                    </div>
                                    <div class="flex justify-between py-0.5 text-slate-800">
                                        <span>Banner (2&times;6m) &bull; Poster (1&times;2m)</span>
                                        <span class="font-semibold">$255.00</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[9px] pt-0.5">
                                    <span class="text-[8px] text-slate-500 font-medium">Payment: Cash</span>
                                    <span class="font-black text-[11px] text-slate-900">Total: $755.00</span>
                                </div>
                                <div class="absolute -bottom-1 -left-1 -right-1 pointer-events-none h-6">
                                    <svg viewBox="0 0 500 120" preserveAspectRatio="none" class="w-full h-full block">
                                        <path d="M0,70 C150,110 320,30 500,80 L500,120 L0,120 Z" fill="#D1D5DB" opacity="0.6"></path>
                                        <path d="M0,90 C180,60 300,110 500,60 L500,120 L0,120 Z" fill="#2A373D"></path>
                                    </svg>
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'simple')
                            <div class="p-3 space-y-1.5 font-sans text-[10px] text-slate-900 bg-white">
                                <div class="flex justify-between items-start">
                                    <div class="text-[9px] leading-tight">
                                        <div class="font-bold text-slate-800 text-[11px]">[Company Name]</div>
                                        <div class="text-slate-500">Street Address &bull; (000) 000-0000</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-sm text-slate-400 uppercase">INVOICE</div>
                                        <div class="border border-slate-400 text-[8px] mt-0.5">
                                            <div class="bg-slate-200 font-bold px-1 py-0.5 border-b border-slate-400 flex justify-between">
                                                <span>INVOICE #</span>
                                                <span>DATE</span>
                                            </div>
                                            <div class="px-1 py-0.5 flex justify-between text-slate-700">
                                                <span>123456</span>
                                                <span>5/1/2014</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="bg-slate-200 border border-slate-300 font-bold px-1.5 py-0.5 text-slate-800 text-[8px] uppercase">BILL TO</div>
                                    <div class="border border-slate-200 p-1 text-[8px] text-slate-600">Robert Davis &bull; Davis Consulting Group</div>
                                </div>
                                <div class="border border-slate-400 text-[8px]">
                                    <div class="bg-slate-200 font-bold px-1.5 py-0.5 flex justify-between border-b border-slate-400">
                                        <span>DESCRIPTION</span>
                                        <span>AMOUNT</span>
                                    </div>
                                    <div class="px-1.5 py-0.5 flex justify-between border-b border-slate-200 text-slate-700">
                                        <span>Consultation Service Fee</span>
                                        <span>$200.00</span>
                                    </div>
                                    <div class="px-1.5 py-0.5 flex justify-between text-slate-700">
                                        <span>Labor: 5 hours @ $75/hr</span>
                                        <span>$375.00</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[9px] pt-0.5 border-t border-slate-300">
                                    <span class="italic text-slate-500 text-[8px]">Thank you for your business!</span>
                                    <span class="font-bold text-[10px] text-slate-900">TOTAL: $551.56</span>
                                </div>
                            </div>

                        @elseif($tpl['id'] === 'signature')
                            <div class="p-2.5 space-y-1.5 font-sans text-[10px] text-slate-900 bg-white border border-[#134E4A] relative overflow-hidden">
                                <div class="absolute -top-8 -right-8 w-24 h-24 rounded-full border-4 border-teal-50 pointer-events-none"></div>
                                <div class="text-center">
                                    <div class="font-black text-sm uppercase tracking-wider text-[#134E4A]">INVOICE</div>
                                    <div class="w-16 mx-auto border-b border-slate-700 mt-0.5"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-1.5 text-[8px] pt-1">
                                    <div class="border-l border-[#134E4A] pl-1 text-slate-600 leading-tight">
                                        <span class="font-bold text-slate-800 block text-[7px]">Your Info</span>
                                        John Smith
                                    </div>
                                    <div class="border-l border-[#134E4A] pl-1 text-slate-600 leading-tight">
                                        <span class="font-bold text-slate-800 block text-[7px]">Client Info</span>
                                        Jane Doe
                                    </div>
                                    <div class="border-l border-[#134E4A] pl-1 text-slate-600 leading-tight">
                                        <span class="font-bold text-slate-800 block text-[7px]">Issued / Due</span>
                                        12/10 &bull; 12/11
                                    </div>
                                </div>
                                <div class="border border-slate-200 text-[8px]">
                                    <div style="background-color: #4A7A82;" class="text-white font-bold px-1.5 py-0.5 flex justify-between">
                                        <span>Item Description</span>
                                        <span>Total</span>
                                    </div>
                                    <div class="px-1.5 py-0.5 flex justify-between border-b border-slate-100 text-slate-700">
                                        <span>Web Platform Design</span>
                                        <span class="font-semibold">$800.00</span>
                                    </div>
                                    <div class="px-1.5 py-0.5 flex justify-between text-slate-700">
                                        <span>SEO &amp; Content Strategy</span>
                                        <span class="font-semibold">$500.00</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[8px] pt-0.5">
                                    <span class="italic text-[7px] text-slate-400">Thank you for choosing us!</span>
                                    <div class="text-right">
                                        <div class="font-bold text-[9px] text-[#134E4A]">Total: $2,100.00</div>
                                        <div class="font-serif italic text-[8px] text-slate-600" style="font-family: cursive;">John Smith</div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </a>

                <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h2 class="text-xl font-bold text-slate-900 group-hover:text-slate-800 transition-colors">
                        {{ $tpl['name'] }}
                    </h2>
                    <a href="{{ route('templates.customize', $tpl['id']) }}" 
                       style="background-color: #2A373D;"
                       class="w-full sm:w-auto hover:brightness-110 active:scale-[0.99] text-white py-2.5 px-6 rounded-full font-bold text-sm flex items-center justify-center gap-2 shadow-sm transition-all cursor-pointer whitespace-nowrap">
                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Customize</span>
                    </a>
                </div>

            </div>
        @endforeach
    </div>

    <div class="mt-20 text-center max-w-2xl mx-auto space-y-4">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Customize your Own Invoice
        </h2>
        <p class="text-base text-slate-600 leading-relaxed">
            Want to build an invoice with your own logo, currency, tax rates, and line items? Start creating now for free.
        </p>
        <div class="pt-2">
            <a href="{{ route('invoice.builder') }}" 
               style="background-color: #2A373D;"
               class="hover:brightness-110 active:scale-[0.98] text-white px-8 py-3.5 rounded-full font-bold text-sm sm:text-base inline-flex items-center gap-2 shadow-sm transition-all">
                <span>Customize Your Invoice Now</span>
                <span class="text-lg leading-none">&rarr;</span>
            </a>
        </div>
    </div>

    </div>
</div>
@endsection
