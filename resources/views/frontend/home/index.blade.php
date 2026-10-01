@extends('layouts.app')

@section('meta_title', ($settings['company_name'] ?? config('app.name')) . ' - Technology Solutions')
@section('meta_description', 'We offer top-notch IT solutions, software development, web development, and mobile app development services.')
@section('body_class', 'index-page')

@section('content')
{{-- Hero Section --}}
<section id="hero" class="hero section">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">We offer top-notch IT solutions.</h1>
                <p data-aos="fade-up" data-aos-delay="100">We excel in providing cutting-edge, technology-powered solutions that help businesses succeed in a dynamic digital world.</p>
                <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('about') }}" class="btn-get-started">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="https://aonetech.com.np/assets/img/banner-img.jpg" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>
</section>

{{-- About Section --}}
<section id="about" class="about section">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0">
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h3>Who We Are</h3>
                    <h2>"Driving digital transformation with cutting-edge software solutions."</h2>
                    <p><b>{{ $settings['company_name'] ?? 'A one national technology' }}</b> which was founded in 2024, is a vibrant software development firm dedicated to providing intelligent, scalable, and effective digital solutions. We use cutting-edge technology to assist companies in increasing productivity, streamlining processes, and achieving digital excellence.</p>
                    <p>Our team of skilled developers, designers, and strategists works closely with clients to understand their unique challenges and deliver tailor-made solutions that drive real business outcomes. From startups to established enterprises, we partner with organizations across diverse industries to bring their digital vision to life.</p>
                    <p>We take pride in our agile development methodology, ensuring rapid delivery without compromising on quality. Every project we undertake is backed by rigorous testing, continuous iteration, and a deep commitment to user-centric design principles that make technology work for people.</p>
                    <div class="text-center text-lg-start">
                        <a href="{{ route('about') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Read More</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                <img src="https://aonetech.com.np/assets/img/about-us.jpg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

{{-- Services Section --}}
<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Featured Services</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
            @foreach ($services as $service)
                <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ 200 + ($loop->index * 100) }}">
                    <div class="service-item">
                        <div class="img">
                                <img src="{{ asset($service->featured_image) }}" class="img-fluid" alt="">
                        </div>
                        <div class="details position-relative">
                            <div class="icon">
                                <i class="bi {{ $loop->iteration == 1 ? 'bi-activity' : ($loop->iteration == 2 ? 'bi-broadcast' : 'bi-easel') }}"></i>
                            </div>
                            <a href="{{ route('services.show', $service->slug) }}" class="stretched-link">
                                <h3>{{ $service->title }}</h3>
                            </a>
                            <p>{{ $service->short_description }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" class="read-more stretched-link" style="line-height: 36px;">
                                <span>Read More</span> <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Values Section --}}
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

{{-- Technologies Section --}}
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

{{-- Portfolio Section --}}
@if ($portfolios->count() > 0)
<section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Our Featured Projects</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            @foreach ($portfolios as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-item">
                        <div class="img">
                            <img src="{{ $item->featured_image ?: 'https://aonetech.com.np/assets/img/services-1.jpg' }}" alt="{{ $item->title }}">
                        </div>
                        <div class="info">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->short_description }}</p>
                            @if ($item->technologies_used)
                                <div>
                                    @foreach ((array) $item->technologies_used as $tech)
                                        <span class="tech-badge">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('portfolio') }}" class="btn-view-all">View All Projects <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>
@endif

{{-- Testimonials Section --}}
@if ($testimonials->count() > 0)
<section id="testimonials" class="testimonials section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>What Our Clients Say</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            @foreach ($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-item">
                        <div class="stars">
                            @for ($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                        <p>"{{ $testimonial->message }}"</p>
                        <div class="profile">
                            <div class="avatar">
                                {{ substr($testimonial->client_name, 0, 1) }}
                            </div>
                            <div>
                                <h4>{{ $testimonial->client_name }}</h4>
                                <span>{{ $testimonial->client_position ? $testimonial->client_position . ($testimonial->company_name ? ', ' . $testimonial->company_name : '') : $testimonial->company_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Blog Section --}}
@if ($posts->count() > 0)
<section id="blog" class="blog section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Blog</h2>
        <p>Latest Articles</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="meta">
                            @if ($post->published_at)
                                <span><i class="bi bi-calendar3"></i> {{ $post->published_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                        <div class="content">
                            <h3>{{ $post->title }}</h3>
                            @if ($post->excerpt)
                                <p>{{ $post->excerpt }}</p>
                            @endif
                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('blog') }}" class="btn-view-all">View All Posts <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>
@endif

{{-- Contact Section --}}
<section id="contact" class="contact section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="row gy-4">
                    <div class="col-md-6 text-center">
                        <div class="info-item" data-aos="fade" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>{{ $settings['address'] ?? 'Kupondole, Lalitpur' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="info-item" data-aos="fade" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>{{ $settings['phone'] ?? '+977 9851240569' }}</p>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="info-item" data-aos="fade" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>{{ $settings['email'] ?? 'info@aonetech.com.np' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form method="POST" action="{{ route('contact.store') }}" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required>{{ old('message') }}</textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
