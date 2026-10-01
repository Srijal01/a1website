@extends('layouts.app')

@section('meta_title', 'About Us - ' . ($settings['company_name'] ?? config('app.name')))
@section('meta_description', 'Learn about our team, mission, and values.')
@section('body_class', 'service-details-page')

@section('content')
<div class="page-title">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>About Us</h1>
                    <p class="mb-0">We excel in providing cutting-edge, technology-powered solutions that help businesses succeed in a dynamic digital world.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">About</li>
            </ol>
        </div>
    </nav>
</div>

<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-6 ps-lg-5" data-aos="fade-up" data-aos-delay="200" style="margin-top: auto; margin-bottom: auto;">
                <img src="https://aonetech.com.np/assets/img/about-us.jpg" alt="" class="img-fluid services-img">
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <p>Established in the year 2024, we're a technologically advanced IT outsourcing company that boasts an impressive array of software development services on offer. We create forward-thinking products whose primary purpose lies in the improvement of organizational communication and engagement of the information. We create very sophisticated IT applications at the local and district levels, more aligned to the 'Digital Nepal' initiative by the government.</p>
                <p>Our services extend to website and mobile application engineering, solution developing ERP, CRM applications, electronic commerce systems, B2B and B2C solution and even managed cloud hosting.</p>
                <p>Our company has been geared towards comprehensive client service and high product quality. It cannot overstate about customer appreciation and meeting of the set deadlines. More so, the company is committed to ensuring that product and cost are optimized as much as possible. Last but not the least, there is nothing more motivating is working with results-oriented individuals who genuinely want to make a difference.</p>
            </div>
        </div>
    </div>
</section>

<section id="values" class="values section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Values</h2>
        <p>What we value most<br></p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <img src="https://aonetech.com.np/assets/img/innovation.png" class="img-fluid" alt="">
                    <h3>Innovation & Excellence</h3>
                    <p>We embrace cutting-edge technology and deliver high-quality solutions that drive digital transformation.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card">
                    <img src="https://aonetech.com.np/assets/img/security.png" class="img-fluid" alt="">
                    <h3>Security & Reliability</h3>
                    <p>We ensure robust security, data protection, and compliance to safeguard businesses and users.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card">
                    <img src="https://aonetech.com.np/assets/img/transparency.png" class="img-fluid" alt="">
                    <h3>Transparency & Integrity</h3>
                    <p>We believe in honest communication, ethical development, and building long-term trust with clients.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="clients" class="clients section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Technologies we work with</h2>
        <p>We work with different latest technologies<br></p>
    </div>
    <div class="tech-marquee" data-aos="fade-up" data-aos-delay="100">
        <div class="tech-marquee-track">
            @foreach ($technologies as $tech)
                <div class="tech-marquee-item">
                    @if ($tech->logo)
                        <img src="{{ asset($tech->logo) }}" alt="{{ $tech->name }}" title="{{ $tech->name }}" loading="lazy">
                    @else
                        <span class="tech-name" title="{{ $tech->name }}">{{ $tech->name }}</span>
                    @endif
                </div>
            @endforeach
            @foreach ($technologies as $tech)
                <div class="tech-marquee-item">
                    @if ($tech->logo)
                        <img src="{{ asset($tech->logo) }}" alt="{{ $tech->name }}" title="{{ $tech->name }}" loading="lazy">
                    @else
                        <span class="tech-name" title="{{ $tech->name }}">{{ $tech->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
