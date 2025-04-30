@php
    use Illuminate\Support\Str;

    function extractYoutubeId($url)
    {
        if (Str::contains($url, 'youtu.be/')) {
            return Str::after($url, 'youtu.be/');
        } elseif (Str::contains($url, 'watch?v=')) {
            return Str::after($url, 'v=');
        } elseif (Str::contains($url, 'embed/')) {
            return Str::after($url, 'embed/');
        }
        return '';
    }
@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/godrejLogo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- Add Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>Godrej</title>
</head>

<body>
    <!-- Header section -->
    <header>
        <div class="godrejContainer">
            <div class="mainInner">
                <div class="logo">
                    <a href="https://www.godrejenterprises.com/">
                        <img src="{{ asset('assets/images/godrejLogo.svg') }}" alt="Godrej" width="94"
                            height="55">
                    </a>
                </div>
                <div class="commonBtn">
                    <a href="https://www.godrejenterprises.com/support/" target="_blank" class="btn">service support
                        <svg width="12" height="14" viewBox="0 0 13 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.07129 1L11.7281 6.65685L6.07129 12.3137" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- Header section end -->

    <section class="applianceInfo">
        <div class="godrejContainer">
            <div class="mainInner">
                <div class="commonHeading">
                    <h1>Know more about your Godrej appliance!</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Styled Import Excel Form -->
    <div class="card shadow-sm mb-4" style="max-width: 600px; margin: auto;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Import Product Data</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Select Excel File</label>
                    <input type="file" name="file" id="file" class="form-control" required
                        accept=".xls,.xlsx,.csv">
                </div>
                <button type="submit" class="btn btn-success w-100">Upload & Import</button>
            </form>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>


    <!-- Hero section -->
    <section class="heroSection">
        <div class="godrejContainer">
            <div class="mainInner">
                <div class="commonHeading">
                    <h2>Contact us for customer support</h2>
                </div>
                <div class="serviceContactCards">
                    <!-- Swiper -->
                    <div class="swiper serviceContactSwiper">
                        <div class="swiper-wrapper">
                            <!-- Card 1 -->
                            <div class="swiper-slide">
                                <div class="contactCard">
                                    <div class="cardNumber">{1}</div>
                                    <div class="cardIcon">
                                        <img src="{{ asset('assets/images/headphone.svg') }}" alt="Whatsapp">
                                    </div>
                                    <div class="cardContent">
                                        <h3>Whatsapp Number</h3>
                                        <a href="https://wa.me/912368890">+91 12 3678 8990</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 2 -->
                            <div class="swiper-slide">
                                <div class="contactCard">
                                    <div class="cardNumber">{2}</div>
                                    <div class="cardIcon">
                                        <img src="{{ asset('assets/images/calling.svg') }}" alt="Call">
                                    </div>
                                    <div class="cardContent">
                                        <h3>Call Number</h3>
                                        <a href="tel:+912368890">+91 12 3678 8990</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="swiper-slide">
                                <div class="contactCard">
                                    <div class="cardNumber">{3}</div>
                                    <div class="cardIcon">
                                        <img src="{{ asset('assets/images/message.svg') }}" alt="SMS">
                                    </div>
                                    <div class="cardContent">
                                        <h3>SMS Number</h3>
                                        <a href="sms:+912368890">+91 12 3678 8990</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 4 -->
                            <div class="swiper-slide">
                                <div class="contactCard">
                                    <div class="cardNumber">{4}</div>
                                    <div class="cardIcon">
                                        <img src="{{ asset('assets/images/email.svg') }}" alt="Email">
                                    </div>
                                    <div class="cardContent">
                                        <h3>Email</h3>
                                        <a
                                            href="mailto:client.services@godrejinds.com">client.services@godrejinds.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- swiper end -->
                </div>
            </div>
        </div>
    </section>
</body>

</html>


<!-- Download Product Manuals Section -->
<section class="downloadManuals">
    <div class="godrejContainer">
        <div class="mainInner">
            <div class="commonHeading">
                <h2>Download User Manual</h2>
            </div>

            <!-- ✅ Dynamic AJAX Section -->
            <div id="dynamicSection" style="margin-top: 30px;">
                <div class="manualsGrid">
                    @if ($selectedProduct)
                        {{-- Dynamic Product Manuals --}}
                        @foreach ($selectedProduct->manuals as $manual)
                            <div class="manualCard">
                                <div class="cardImage">
                                    <picture>
                                        <source srcset="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ asset('assets/images/usermanual-mobile.jpg') }}"
                                            media="(max-width: 767px)">
                                        <img src="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                            alt="{{ $manual->title }}">
                                    </picture>
                                    <div class="cardOverlay">
                                        <h3>{{ $selectedProduct->subcategory }}</h3>
                                        <a href="{{ asset('storage/manuals/' . $manual->file_path) }}"
                                            class="commonBtn" target="_blank" download>
                                            <span class="btn">Download PDF</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Fallback Static Manual --}}
                        <div class="manualCard">
                            <div class="cardImage">
                                <picture>
                                    <source srcset="assets/images/usermanual-desktop.jpg" media="(min-width: 768px)">
                                    <source srcset="assets/images/usermanual-mobile.jpg" media="(max-width: 767px)">
                                    <img src="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                        alt="Home Locks & Security">
                                </picture>
                                <div class="cardOverlay">
                                    <h3>Air Conditioner</h3>
                                    <a href="{{ asset('assets/manuals/godrej_ac_dummy_manual.pdf') }}"
                                        class="commonBtn" target="_blank" download>
                                        <span class="btn">Download PDF
                                            <svg width="12" height="14" viewBox="0 0 13 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.07129 1L11.7281 6.65685L6.07129 12.3137" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>

                                    <!-- Share Section -->
                                    <div style="position: relative;">
                                        <div id="shareContainer"
                                            style="position: absolute; bottom: 20px; right: 20px; z-index: 999;">
                                            <button id="shareBtn"
                                                style="width: 50px; height: 50px; border-radius: 50%; background: white; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.2); cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                                <svg width="30" height="30" viewBox="0 0 51 51"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="25.9365" cy="25.0508" r="25" fill="white" />
                                                    <path
                                                        d="M31.7695 21.2274C33.3343 21.2274 34.6028 19.9514 34.6028 18.3774..."
                                                        stroke="#333333" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            <div id="shareMenu"
                                                style="display: none; position: absolute; bottom: 60px; right: 0; background: white; border: 1px solid #ccc; padding: 10px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                                <a href="#" class="share-link" data-platform="whatsapp"
                                                    style="...">Share on WhatsApp</a>
                                                <a href="#" class="share-link" data-platform="facebook"
                                                    style="...">Share on Facebook</a>
                                                <a href="#" class="share-link" data-platform="linkedin"
                                                    style="...">Share on LinkedIn</a>
                                                <a href="#" class="share-link" data-platform="twitter"
                                                    style="...">Share on Twitter</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Share JS -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const shareBtn = document.getElementById('shareBtn');
                                            const shareMenu = document.getElementById('shareMenu');
                                            const links = document.querySelectorAll('.share-link');

                                            shareBtn.addEventListener('click', (e) => {
                                                e.stopPropagation();
                                                shareMenu.style.display = shareMenu.style.display === 'block' ? 'none' : 'block';
                                            });

                                            links.forEach(link => {
                                                link.addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    const platform = this.getAttribute('data-platform');
                                                    const url = encodeURIComponent(window.location.href);
                                                    const text = encodeURIComponent("Check this out!");
                                                    let shareUrl = "";

                                                    switch (platform) {
                                                        case "whatsapp":
                                                            shareUrl = `https://wa.me/?text=${text}%20${url}`;
                                                            break;
                                                        case "facebook":
                                                            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                                                            break;
                                                        case "linkedin":
                                                            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                                                            break;
                                                        case "twitter":
                                                            shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${text}`;
                                                            break;
                                                    }

                                                    window.open(shareUrl, '_blank');
                                                    shareMenu.style.display = 'none';
                                                });
                                            });

                                            document.addEventListener('click', (e) => {
                                                if (!document.getElementById('shareContainer').contains(e.target)) {
                                                    shareMenu.style.display = 'none';
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Product Videos Section -->
<section class="productVideos">
    <div class="godrejContainer">
        <div class="mainInner">
            <div class="commonHeading">
                <h2>Watch our Videos</h2>
                <p>Watch product videos to learn more about installation, usage tips, and maintenance guidelines.
                    Explore step-by-step tutorials to get the best out of your product.</p>
            </div>

            @if ($selectedProduct && count($selectedProduct->videos))
                <!-- Main Single Video -->
                <div class="mobileSingleCard">
                    <div class="videoCard">
                        <div class="cardImage">
                            @if ($selectedProduct && count($selectedProduct->videos))
                                @foreach ($selectedProduct->videos as $video)
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/{{ extractYoutubeId($video->video_link) }}"
                                        title="{{ $video->title }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @endforeach
                            @endif
                        </div>
                        <div class="cardContent">
                            <h3>{{ $selectedProduct->videos[0]->title }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Swiper Video List -->
                <div class="swiper videoSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($selectedProduct->videos as $video)
                            <div class="swiper-slide">
                                <div class="videoCard">
                                    <div class="cardImage">
                                        @if ($selectedProduct && count($selectedProduct->videos))
                                            @foreach ($selectedProduct->videos as $video)
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/{{ extractYoutubeId($video->video_link) }}"
                                                    title="{{ $video->title }}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="cardContent">
                                        <h3>{{ $video->title }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <!-- Fallback Static Video -->
                <div class="mobileSingleCard">
                    <div class="videoCard">
                        <div class="cardImage">
                            @if ($selectedProduct && count($selectedProduct->videos))
                                @foreach ($selectedProduct->videos as $video)
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/{{ extractYoutubeId($video->video_link) }}"
                                        title="{{ $video->title }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @endforeach
                            @endif
                        </div>
                        <div class="cardContent">
                            <h3>Step-by-Step Installation Guide for product</h3>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>


<!-- Footer Section -->
<footer class="footer">
    <div class="footerUpperSection">
        <div class="godrejContainer">
            <div class="footerUpperSectionInner">
                <div class="logo">
                    <a href="https://www.godrejenterprises.com/">
                        <img src="{{ asset('images/godrejLogo-white.svg') }}" alt="Godrej" width="94"
                            height="24">
                    </a>

                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="https://www.godrejenterprises.com/">Home</a></li>
                        <li><svg width="9" height="12" viewBox="0 0 13 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.07129 1L11.7281 6.65685L6.07129 12.3137" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg></li>
                        <li><a href="#" class="active">Home Appliances</a></li>
                    </ol>
                </nav>
                <button class="scrollTopBtn">
                    &#8593;
                </button>
            </div>
        </div>
    </div>
    <div class="godrejContainer">
        <div class="footerInner">
            <div class="footerCol">
                <h4>For Consumer</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/home-appliances">Home Appliances</a></li>
                    <li><a href="https://www.godrejenterprises.com/furniture">Furniture & Fittings</a></li>
                    <li><a href="https://www.godrejenterprises.com/locks-and-security">Locks & Security</a></li>

                </ul>
            </div>
            <div class="footerCol">
                <h4>For Business</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/aerospace">Aerospace</a></li>
                    <li><a href="https://www.godrejenterprises.com/commercial-appliances">Commercial Appliances</a>
                    </li>
                    <li><a href="https://www.godrejenterprises.com/advanced-engineering">Advanced Engineering</a>
                    </li>
                    <li><a href="https://www.godrejenterprises.com/intralogistics">Intralogistics</a></li>
                    <li><a href="https://www.godrejenterprises.com/real-estate">Real Estate</a></li>
                    <li><a href="https://www.godrejenterprises.com/security">Security</a></li>
                    <li><a href="https://www.godrejenterprises.com/furniture-and-fittings">Furniture & Fittings</a>
                    </li>

                </ul>
            </div>
            <div class="footerCol">
                <h4>Good & Green</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/about-us/good-and-green">Our Goals</a></li>
                    <li><a href="https://static.godrejenterprises.com/CS_Rpolicy4_P20022531_9a0c553524.pdf">CSR
                            Policy</a></li>
                    <li><a
                            href="https://www.godrejenterprises.com/about-us/good-and-green/corporate-social-responsibility#leadership">CSR
                            Committee</a></li>
                    <li><a
                            href="https://www.godrejenterprises.com/about-us/good-and-green/corporate-social-responsibility#csr-initiative">CSR
                            Action Plan</a></li>
                    <li><a href="https://static.godrejenterprises.com/sustainability_full_report_6211d33fdd.pdf">Sustainability
                            Report</a></li>
                </ul>

                <div class="footerCol InerCol">
                    <h4>Careers</h4>
                    <ul>
                        <li><a href="https://www.godrejenterprises.com/about-us/careers">Life at Godrej
                                Enterprises</a></li>
                        <li><a href="https://www.godrejenterprises.com/about-us/careers/openings">Explore
                                Openings</a></li>

                    </ul>
                </div>
            </div>
            <div class="footerCol mobile-show">
                <h4>Careers</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/about-us/careers">Life at Godrej Enterprises</a>
                    </li>
                    <li><a href="https://www.godrejenterprises.com/about-us/careers/openings">Explore Openings</a>
                    </li>

                </ul>
            </div>
            <div class="footerCol">
                <h4>About</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/about-us">About us</a></li>
                    <li><a href="https://www.godrejenterprises.com/about-us/our-milestones">Our Milestones</a></li>
                    <li><a href="https://www.godrejenterprises.com/about-us/awards-and-recognition">Awards &
                            Recognition</a></li>
                    <li><a href="https://www.godrejenterprises.com/about-us/our-foundations">Our Foundation</a>
                    </li>
                    <li><a href="https://www.godrejenterprises.com/about-us/our-directors">Our Directors</a></li>
                    <li><a href="https://www.godrejenterprises.com/about-us/policies-and-reports/corporate-policies">Corporate
                            Policies</a></li>
                    <li><a href="https://www.godrejenterprises.com/legal/statutory-reports">Statutory Report</a>
                    </li>
                    <li><a href="https://archives.godrejenterprises.com/GodrejArchives/">Godrej Archives</a></li>
                    <li><a href="https://designlab.godrejenterprises.com/">Godrej Design Lab</a></li>
                    <li><a href="https://designlab.godrejenterprises.com/cc/">Conscious Collective</a></li>
                </ul>
            </div>
            <div class="footerCol">
                <h4>Newsroom</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/newsroom/news">News</a></li>
                    <li><a href="https://www.godrejenterprises.com/newsroom/press-releases">Press Releases</a></li>
                    <li><a href="https://www.godrejenterprises.com/newsroom/blog">Blog</a></li>
                    <li><a href="https://www.godrejenterprises.com/newsroom/media-assets">Media Assets</a></li>
                </ul>
            </div>
            <div class="footerCol">
                <h4>Contact</h4>
                <ul>
                    <li><a href="https://www.godrejenterprises.com/contact-us">Contact us</a></li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#corporate-office">Corporate
                            Office</a></li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#sales-inquiries">Sales Inquiries</a>
                    </li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#customer-care">Customer Care</a></li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#media-contact">Media Contact</a></li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#dealers-suppliers">Dealers &
                            Suppliers</a></li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#registered-offices">Registered
                            Offices</a></li>
                    <li><a href="https://www.godrejenterprises.com/contact-us#branch-addresses">Branch Address</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="footerBottom">
        <div class="godrejContainer">
            <div class="footerBottomInner">
                <div class="copyrightText">
                    Copyright © 2025 Godrej Enterprises. All right reserved
                </div>
                <div class="footerLinks">
                    <a href="https://www.godrejenterprises.com/legal">Legal</a>
                    <a href="https://www.godrejenterprises.com/legal/disclaimer">Disclaimer</a>
                    <a href="https://www.godrejenterprises.com/legal/privacy-policy">Privacy Policy</a>
                    <a href="https://www.godrejenterprises.com/legal/terms-and-conditions">Terms & Conditions</a>
                </div>
                <div class="socialLinks">
                    <a href="https://www.youtube.com/@godrej-enterprises" aria-label="YouTube">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21.543 6.498C22 8.28 22 12 22 12C22 12 22 15.72 21.543 17.502C21.289 18.487 20.546 19.262 19.605 19.524C17.896 20 12 20 12 20C12 20 6.107 20 4.395 19.524C3.45 19.258 2.708 18.484 2.457 17.502C2 15.72 2 12 2 12C2 12 2 8.28 2.457 6.498C2.711 5.513 3.454 4.738 4.395 4.476C6.107 4 12 4 12 4C12 4 17.896 4 19.605 4.476C20.55 4.742 21.292 5.516 21.543 6.498ZM10 15.5L16 12L10 8.5V15.5Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/GodrejEnterprises" aria-label="Facebook">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M22 12C22 6.48 17.52 2 12 2C6.48 2 2 6.48 2 12C2 16.84 5.44 20.87 10 21.8V15H8V12H10V9.5C10 7.57 11.57 6 13.5 6H16V9H14C13.45 9 13 9.45 13 10V12H16V15H13V21.95C18.05 21.45 22 17.19 22 12Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/godrej/" aria-label="LinkedIn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19 3C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19ZM18.5 18.5V13.2C18.5 12.3354 18.1565 11.5062 17.5452 10.8948C16.9338 10.2835 16.1046 9.94 15.24 9.94C14.39 9.94 13.4 10.46 12.92 11.24V10.13H10.13V18.5H12.92V13.57C12.92 12.8 13.54 12.17 14.31 12.17C14.6813 12.17 15.0374 12.3175 15.2999 12.5801C15.5625 12.8426 15.71 13.1987 15.71 13.57V18.5H18.5ZM6.88 8.56C7.32556 8.56 7.75288 8.383 8.06794 8.06794C8.383 7.75288 8.56 7.32556 8.56 6.88C8.56 5.95 7.81 5.19 6.88 5.19C6.43178 5.19 6.00193 5.36805 5.68499 5.68499C5.36805 6.00193 5.19 6.43178 5.19 6.88C5.19 7.81 5.95 8.56 6.88 8.56ZM8.27 18.5V10.13H5.5V18.5H8.27Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="https://x.com/GodrejEntGroup" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" height="1.35em" aria-hidden="true"
                            focusable="false" class="icon icon-twitter" viewBox="0 0 512 512">
                            <path
                                d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/godrejenterprisesgroup" aria-label="Instagram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M12 2C14.717 2 15.056 2.01 16.122 2.06C17.187 2.11 17.912 2.277 18.55 2.525C19.21 2.779 19.766 3.123 20.322 3.678C20.8305 4.1779 21.224 4.78259 21.475 5.45C21.722 6.087 21.89 6.813 21.94 7.878C21.987 8.944 22 9.283 22 12C22 14.717 21.99 15.056 21.94 16.122C21.89 17.187 21.722 17.912 21.475 18.55C21.2247 19.2178 20.8311 19.8226 20.322 20.322C19.822 20.8303 19.2173 21.2238 18.55 21.475C17.913 21.722 17.187 21.89 16.122 21.94C15.056 21.987 14.717 22 12 22C9.283 22 8.944 21.99 7.878 21.94C6.813 21.89 6.088 21.722 5.45 21.475C4.78233 21.2245 4.17753 20.8309 3.678 20.322C3.16941 19.8222 2.77593 19.2175 2.525 18.55C2.277 17.913 2.11 17.187 2.06 16.122C2.013 15.056 2 14.717 2 12C2 9.283 2.01 8.944 2.06 7.878C2.11 6.812 2.277 6.088 2.525 5.45C2.77524 4.78218 3.1688 4.17732 3.678 3.678C4.17767 3.16923 4.78243 2.77573 5.45 2.525C6.088 2.277 6.812 2.11 7.878 2.06C8.944 2.013 9.283 2 12 2ZM12 7C10.6739 7 9.40215 7.52678 8.46447 8.46447C7.52678 9.40215 7 10.6739 7 12C7 13.3261 7.52678 14.5979 8.46447 15.5355C9.40215 16.4732 10.6739 17 12 17C13.3261 17 14.5979 16.4732 15.5355 15.5355C16.4732 14.5979 17 13.3261 17 12C17 10.6739 16.4732 9.40215 15.5355 8.46447C14.5979 7.52678 13.3261 7 12 7ZM18.5 6.75C18.5 6.41848 18.3683 6.10054 18.1339 5.86612C17.8995 5.6317 17.5815 5.5 17.25 5.5C16.9185 5.5 16.6005 5.6317 16.3661 5.86612C16.1317 6.10054 16 6.41848 16 6.75C16 7.08152 16.1317 7.39946 16.3661 7.63388C16.6005 7.8683 16.9185 8 17.25 8C17.5815 8 17.8995 7.8683 18.1339 7.63388C18.3683 7.39946 18.5 7.08152 18.5 6.75ZM12 9C12.7956 9 13.5587 9.31607 14.1213 9.87868C14.6839 10.4413 15 11.2044 15 12C15 12.7956 14.6839 13.5587 14.1213 14.1213C13.5587 14.6839 12.7956 15 12 15C11.2044 15 10.4413 14.6839 9.87868 14.1213C9.31607 13.5587 9 12.7956 9 12C9 11.2044 9.31607 10.4413 9.87868 9.87868C10.4413 9.31607 11.2044 9 12 9Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Add Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loadManuals').on('click', function() {
        let slug = $('#slugInput').val().trim();
        if (!slug) {
            alert('Please enter a product slug.');
            return;
        }

        $.ajax({
            url: '/section/' + slug,
            method: 'GET',
            success: function(response) {
                $('#dynamicSection').html(response);
            },
            error: function() {
                alert('Product not found or something went wrong.');
            }
        });
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#productSearch').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('search.products') }}",
            type: "GET",
            data: {
                query: query
            },
            success: function(response) {

                $('#productDetails').html(response);
            }
        });
    });
</script>


</body>

</html>
