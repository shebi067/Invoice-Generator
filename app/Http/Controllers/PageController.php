<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home(Request $request)
    {
        return view('home');
    }


    public function templates()
    {
        $templates = [
            [
                'id' => 'modern',
                'name' => 'Everyday',
                'color' => '#111827',
            ],
            [
                'id' => 'freelancer',
                'name' => 'Studio',
                'color' => '#2A373D',
            ],
            [
                'id' => 'classic',
                'name' => 'Standard',
                'color' => '#1e293b',
            ],
            [
                'id' => 'minimal',
                'name' => 'Mint',
                'color' => '#849B89',
            ],
            [
                'id' => 'corporate',
                'name' => 'Blue Line',
                'color' => '#2B4C7E',
            ],
            [
                'id' => 'wave',
                'name' => 'Flow',
                'color' => '#1F2937',
            ],
            [
                'id' => 'simple',
                'name' => 'Silver',
                'color' => '#64748B',
            ],
            [
                'id' => 'signature',
                'name' => 'Aqua',
                'color' => '#134E4A',
            ],
        ];

        return view('pages.templates', compact('templates'));
    }


    public function customizeTemplate(string $template)
    {
        $validTemplates = ['modern', 'freelancer', 'classic', 'minimal', 'corporate', 'wave', 'simple', 'signature'];
        if (!in_array($template, $validTemplates)) {
            $template = 'modern';
        }

        $templateNames = [
            'modern' => 'Everyday',
            'freelancer' => 'Studio',
            'classic' => 'Standard',
            'minimal' => 'Mint',
            'corporate' => 'Blue Line',
            'wave' => 'Flow',
            'simple' => 'Silver',
            'signature' => 'Aqua',
        ];

        $templateName = $templateNames[$template] ?? 'Everyday';

        return view('pages.customize', compact('template', 'templateName'));
    }

    public function builder()
    {
        return view('pages.builder');
    }


    public function howItWorks()
    {
        return view('pages.how-it-works');
    }


    public function about()
    {
        return view('pages.about');
    }


    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        return redirect()->route('contact')->with('success', 'Thank you! Your message has been sent successfully. We will get back to you shortly.');
    }


    public function privacy()
    {
        return view('pages.privacy');
    }


    public function faqs()
    {
        return view('pages.faqs');
    }


    public function blog()
    {
        return view('pages.blog');
    }


    public function blogPost()
    {
        return view('pages.blog-detail');
    }


    public function blogWhatIsAnInvoice()
    {
        return view('pages.blog-what-is-an-invoice');
    }


    public function blogInvoiceVsReceipt()
    {
        return view('pages.blog-invoice-vs-receipt');
    }
}
