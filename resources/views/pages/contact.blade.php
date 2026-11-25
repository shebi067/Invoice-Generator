@extends('layouts.app')

@section('title', 'Contact Us | Get Support & Share Feedback - InvoiceMaker')
@section('meta_description', 'Need help or have feedback? Contact the InvoiceMaker support team for quick assistance with our free online invoice generator.')

@section('content')
<div class="w-full selection:bg-slate-800 selection:text-white">

    <div class="relative bg-[#2A373D] text-white pt-10 pb-28 sm:pt-16 sm:pb-36 overflow-hidden">

        <div class="absolute inset-0 bg-radial from-white/5 to-transparent pointer-events-none opacity-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="sr-only">Contact Information</span>

            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight text-white">
                Contact Us
            </h1>
        </div>

        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none z-10">
            <svg class="relative block w-full h-10 sm:h-14 md:h-20 text-white" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,45 C320,115 520,10 880,75 C1120,115 1320,50 1440,40 L1440,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>


    <div class="bg-white text-slate-700 py-12 lg:py-20">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 text-center sm:text-left">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Send Us a Message
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Fill out the form below and our team will get back to you as soon as possible.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <div class="font-bold">Message Sent</div>
                        <div class="mt-0.5 text-emerald-800">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                    <div class="font-bold mb-1">Please fix the following errors:</div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Your Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="e.g. John Doe"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white focus:bg-white focus:border-[#2A373D] focus:ring-2 focus:ring-slate-200 focus:outline-hidden text-sm transition-all">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="john@example.com"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white focus:bg-white focus:border-[#2A373D] focus:ring-2 focus:ring-slate-200 focus:outline-hidden text-sm transition-all">
                    </div>
                </div>

                <div>
                    <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subject *</label>
                    <input type="text" 
                           id="subject" 
                           name="subject" 
                           value="{{ old('subject') }}" 
                           required 
                           placeholder="What would you like to discuss?"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white focus:bg-white focus:border-[#2A373D] focus:ring-2 focus:ring-slate-200 focus:outline-hidden text-sm transition-all">
                </div>

                <div>
                    <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Message *</label>
                    <textarea id="message" 
                              name="message" 
                              rows="6" 
                              required 
                              placeholder="Write your message here..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white focus:bg-white focus:border-[#2A373D] focus:ring-2 focus:ring-slate-200 focus:outline-hidden text-sm transition-all leading-relaxed">{{ old('message') }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            style="background-color: #2A373D;"
                            class="hover:brightness-110 active:scale-[0.99] text-white w-full sm:w-auto px-8 py-3.5 rounded-full font-bold text-sm inline-flex items-center justify-center gap-2 shadow-sm transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <span>Send Message</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
