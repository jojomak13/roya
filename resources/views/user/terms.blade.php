@extends('layouts.user.master')

@section('title', __('user.title.terms'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li>@lang('user.title.terms')</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<main class="single-blog-page">
    <div class="container">
        <div class="header">
            <h1>@lang('user.title.terms')</h1>
        </div>

        <div class="card" style="direction:ltr">
            <div class="card-body article">
                <h2 class="text-primary">Ro'ya store Privacy Policy</h2>
                <p>This Privacy Policy describes how your personal information is collected, used, and shared when you visit or make a purchase from www.royabookstore.com (the “Site”).</p>
                <p>When you visit the Site, we automatically collect certain information about your device, including information about your web browser, IP address, time zone, and some of the cookies that are installed on your device. Additionally, as you browse the Site, we collect information about the individual web pages or products that you view, what websites or search terms referred you to the Site, and information about how you interact with the Site. We refer to this automatically-collected information as “Device Information.”</p>
                <p>We collect Device Information using the following technologies:</p>
                <ul>
                    <li>“Cookies” are data files that are placed on your device or computer and often include an anonymous unique identifier. For more information about cookies, and how to disable cookies, visit <a href="http://www.allaboutcookies.org">allaboutcookies</a>.</li>
                    <li>“Log files” track actions occurring on the Site, and collect data including your IP address, browser type, Internet service provider, referring/exit pages, and date/time stamps.</li>
                    <li>“Web beacons,” “tags,” and “pixels” are electronic files used to record information about how you browse the Site.</li>
                </ul>
                <p>Additionally when you make a purchase or attempt to make a purchase through the Site, we collect certain information from you, including your name, billing address, shipping address, payment information (including credit card numbers email address, and phone number.  We refer to this information as “Order Information.”</p>
                <p>When we talk about “Personal Information” in this Privacy Policy, we are talking both about Device Information and Order Information.</p>
                <h2 class="text-primary">How do we use your personal information?</h2>
                <p>We use the Order Information that we collect generally to fulfill any orders placed through the Site (including processing your payment information, arranging for shipping, and providing you with invoices and/or order confirmations).  Additionally, we use this Order Information to:
                    Communicate with you;
                    Screen our orders for potential risk or fraud; and
                    When in line with the preferences you have shared with us, provide you with information or advertising relating to our products or services.
                    We use the Device Information that we collect to help us screen for potential risk and fraud (in particular, your IP address), and more generally to improve and optimize our Site (for example, by generating analytics about how our customers browse and interact with the Site, and to assess the success of our marketing and advertising campaigns).
                </p>
                <p>We share your Personal Information with third parties to help us use your Personal Information, as described above.  For example, we use Shopify to power our online store. 
                    Finally, we may also share your Personal Information to comply with applicable laws and regulations, to respond to a subpoena, search warrant or other lawful request for information we receive, or to otherwise protect our rights.</p>
                <h2 class="text-primary">Behavioural Advertising</h2>
                <p>As described above, we use your Personal Information to provide you with targeted advertisements or marketing communications we believe may be of interest to you.  For more information about how targeted advertising works, you can visit the <a href="http://www.networkadvertising.org/understanding-online-advertising/how-does-it-work">Network Advertising Initiative’s</a> (“NAI”) educational page.</p>
                <h2 class="text-primary">Do not track</h2>
                <p>Please note that we do not alter our Site’s data collection and use practices when we see a Do Not Track signal from your browser.</p>
                <h2 class="text-primary">Your Rights</h2>
                <p>If you are a European resident, you have the right to access personal information we hold about you and to ask that your personal information be corrected, updated, or deleted. If you would like to exercise this right, please contact us through the contact information below.</p>
                <p>Additionally, if you are a European resident we note that we are processing your information in order to fulfill contracts we might have with you (for example if you make an order through the Site), or otherwise to pursue our legitimate business interests listed above.  Additionally, please note that your information will be transferred outside of Europe, including to Canada and the United States.</p>
                <h2 class="text-primary">Data Retention</h2>
                <p>When you place an order through the Site, we will maintain your Order Information for our records unless and until you ask us to delete this information.</p>
                <h2 class="text-primary">Minors</h2>
                <p>he Site is not intended for individuals under the age of 12 years old.</p>
                <h2 class="text-primary">Changes</h2>
                <p>We may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal or regulatory reasons.</p>
                <h2 class="text-primary">Contact Us</h2>
                <p>For more information about our privacy practices, if you have questions, or if you would like to make a complaint, please contact us by e-mail at <a href="mailto:royabookstore@gmail.com">royabookstore@gmail.com</a> or by mail using the details provided below:</p>
                <p>Store 24,Center of Region 9 , 10th of Ramdan City , SHR, 44637, Egypt</p>
            </div>
        </div>
    </div>
</main>
@endsection