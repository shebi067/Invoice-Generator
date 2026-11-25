<?php

namespace Tests\Feature;

use Tests\TestCase;

class InvoicePagesTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('Invoice');
        $response->assertSee('From');
        $response->assertSee('Bill To');
        $response->assertSee('Download Invoice');
        $response->assertSee('Print Invoice');
        $response->assertSee('Clear Invoice');
        $response->assertSee('Customize Your Invoice');
        $response->assertSee('invoicemaker');
        $response->assertSee('images/logo.png');
    }

    public function test_homepage_includes_vite_assets_for_live_reload(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $content = $response->getContent();
        $this->assertTrue(str_contains($content, '5173') || str_contains($content, '/build/') || str_contains($content, '@vite'));
    }

    public function test_templates_page_loads_successfully(): void
    {
        $response = $this->get('/templates');
        $response->assertOk();
        $response->assertSee('Everyday');
        $response->assertSee('Standard');
        $response->assertSee('Studio');
        $response->assertSee('Mint');
        $response->assertSee('Customize');
    }

    public function test_template_customizers_load_successfully(): void
    {
        foreach (['modern', 'freelancer', 'classic', 'minimal', 'corporate', 'wave', 'simple', 'signature'] as $tpl) {
            $response = $this->get('/templates/' . $tpl);
            $response->assertOk();
            $response->assertSee('Customize');
            $response->assertSee('Download Invoice');
            $response->assertSee('Print Invoice');
        }
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/about');
        $response->assertOk();
        $response->assertSee('About Our Mission');
    }

    public function test_how_it_works_page_loads_successfully(): void
    {
        $response = $this->get('/how-it-works');
        $response->assertOk();
        $response->assertSee('How It Works');
        $response->assertSee('Choose How You Want to Start');
        $response->assertSee('Use the default invoice editor');
        $response->assertSee('how_it_works_editor.png');
        $response->assertSee('how_it_works_templates.png');
        $response->assertSee('how_it_works_builder.png');
        $response->assertSee('Frequently Asked Questions');
        $response->assertSee('#2A373D');
    }

    public function test_contact_page_loads_and_form_submits(): void
    {
        $response = $this->get('/contact');
        $response->assertOk();
        $response->assertSee('Contact Information');

        $postResponse = $this->post('/contact', [
            'name' => 'Ahmed Khan',
            'email' => 'ahmed@example.com',
            'subject' => 'Template Suggestion',
            'message' => 'Please add an Urdu or multi-language invoice template.'
        ]);

        $postResponse->assertRedirect('/contact');
        $postResponse->assertSessionHas('success');
    }

    public function test_privacy_policy_page_loads_successfully(): void
    {
        $response = $this->get('/privacy-policy');
        $response->assertOk();
        $response->assertSee('Privacy & Policy');
        $response->assertSee('Zero Data Storage');
    }

    public function test_homepage_has_sequential_validation_elements(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('(Please fill this section)');
        $response->assertDontSee('Jab tak ye required fields fill nahi hongi');
    }

    public function test_homepage_has_format_selector_and_clean_export(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('Format');
        $response->assertSee('PDF');
        $response->assertSee('PNG');
        $response->assertSee('html2canvas');
        $response->assertSee('downloadInvoice');
        $response->assertSee('prepareInvoiceClone');
    }

    public function test_homepage_has_clean_print_pipeline(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('Print Invoice');
        $response->assertSee('printInvoice()');
        $response->assertSee('invoice-print-frame');
        $response->assertSee('isPrinting');
    }

    public function test_homepage_has_faq_section(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('FAQ');
        $response->assertSee('Get quick answers to your questions.');
        $response->assertSee('How does InvoiceMaker work and is it free?');
        $response->assertSee('Read all FAQ');
        $response->assertSee('Contact Us');
    }

    public function test_builder_page_loads_successfully(): void
    {
        $response = $this->get('/builder');
        $response->assertOk();
        $response->assertSee('Customize Your Own Invoice');
        $response->assertSee('Add Boxes');
        $response->assertSee('Manage Box Locations');
    }

    public function test_faqs_page_loads_successfully(): void
    {
        $response = $this->get('/faqs');
        $response->assertOk();
        $response->assertSee('Frequently Asked Questions');
        $response->assertSee('Is Invoice Maker completely free?');
        $response->assertSee('Do I need to create an account?');
        $response->assertSee('help@invoicemaker.tech');
    }

    public function test_blog_page_loads_successfully(): void
    {
        $response = $this->get('/blog');
        $response->assertOk();
        $response->assertSee('Blog');
        $response->assertSee('How to Create an Invoice Online for Free');
        $response->assertSee('blog_1_cover.png');
        $homeResponse = $this->get('/');
        $homeResponse->assertOk();
        $homeResponse->assertSee('Blog');
    }

    public function test_first_blog_post_loads_successfully(): void
    {
        $response = $this->get('/blog/how-to-create-an-invoice-online-for-free');
        $response->assertOk();
        $response->assertSee('How to Create an Invoice Online for Free');
        $response->assertSee('blog_1_cover.png');
        $response->assertSee('blog_1_image_2.png');
        $response->assertSee('blog_1_image_3.png');
        $response->assertSee('blog_1_image_4.png');
        $response->assertSee('Choose How You Want to Start');
        $response->assertSee('Check and Download Your Invoice');
    }

    public function test_second_blog_post_loads_successfully(): void
    {
        $response = $this->get('/blog/what-is-an-invoice');
        $response->assertOk();
        $response->assertSee('What Is an Invoice? A Simple Guide for Beginners');
        $response->assertSee('blog_2_cover.png');
        $response->assertSee('blog_2_image_2.png');
        $response->assertSee('blog_2_image_3.png');
        $response->assertSee('What Should You Include?');
        $response->assertSee('Invoice, Receipt, and Quote: What Is the Difference?');
        $response->assertSee('business.gov.au');
    }

    public function test_third_blog_post_loads_successfully(): void
    {
        $response = $this->get('/blog/invoice-vs-receipt');
        $response->assertOk();
        $response->assertSee('Invoice vs Receipt: Key Differences Explained');
        $response->assertSee('blog_3_cover.png');
        $response->assertSee('Key Differences at a Glance');
        $response->assertSee('When to Send an Invoice vs a Receipt');
        $response->assertSee('What Is a Receipt?');
    }

    public function test_blogs_redirects_to_blog(): void
    {
        $response = $this->get('/blogs');
        $response->assertRedirect('/blog');
    }

    public function test_technical_seo_metadata_and_structured_data(): void
    {
        // Homepage SEO: Canonical & WebApplication Schema
        $homeResponse = $this->get('/');
        $homeResponse->assertOk();
        $homeResponse->assertSee('rel="canonical"', false);
        $homeResponse->assertSee('property="og:title"', false);
        $homeResponse->assertSee('name="twitter:card"', false);
        $homeResponse->assertSee('"@type": "WebApplication"', false);
        $homeResponse->assertSee('"@type": "Organization"', false);
        $homeResponse->assertSee('"@type": "WebSite"', false);

        // How It Works SEO: FAQPage Schema
        $howResponse = $this->get('/how-it-works');
        $howResponse->assertOk();
        $howResponse->assertSee('"@type": "FAQPage"', false);
        $howResponse->assertSee('Is InvoiceMaker.tech free?', false);

        // Blog Post SEO: BlogPosting Article Schema & Article OG Type
        $blogResponse = $this->get('/blog/what-is-an-invoice');
        $blogResponse->assertOk();
        $blogResponse->assertSee('"@type": "BlogPosting"', false);
        $blogResponse->assertSee('content="article"', false);
    }

    public function test_custom_404_page_renders_cleanly(): void
    {
        $response = $this->get('/this-page-does-not-exist-at-all-404');
        $response->assertNotFound();
        $response->assertSee('Page Not Found');
        $response->assertSee('404');
        $response->assertSee('Visit Homepage');
    }
}
