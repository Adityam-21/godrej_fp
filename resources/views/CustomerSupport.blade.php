<!-- Hero section -->
<section class="heroSection">
    <div class="godrejContainer">
        <div class="mainInner">
            <div class="commonHeading">
                <h1>Contact us for customer support</h1>
            </div>
            <div class="serviceContactCards">
                <!-- Swiper -->
                <div class="swiper serviceContactSwiper">
                    <div class="swiper-wrapper">
                        @forelse ($contacts as $index => $contact)
                            <div class="swiper-slide">
                                <div class="contactCard">
                                    <div class="cardNumber">{{ $index + 1 }}</div>
                                    <div class="cardIcon">
                                        <img src="{{ asset($contact->icon) }}" alt="{{ $contact->title ?? 'Contact' }}">
                                    </div>
                                    <div class="cardContent">
                                        <h3>{{ $contact->title ?? 'No Title' }}</h3>
                                        @php
                                            $safeLink = Str::startsWith($contact->link, [
                                                'mailto:',
                                                'tel:',
                                                'sms:',
                                                'https://wa.me',
                                            ])
                                                ? $contact->link
                                                : '#';
                                        @endphp
                                        <a href="{{ $safeLink }}">{{ $contact->text ?? 'No Info Available' }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="contactCard">
                                    <div class="cardNumber">1</div>
                                    <div class="cardIcon">
                                        <img src="{{ asset('assets/images/headphone.svg') }}" alt="No contacts">
                                    </div>
                                    <div class="cardContent">
                                        <h3>No contact info</h3>
                                        <span>No contact info available.</span>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
