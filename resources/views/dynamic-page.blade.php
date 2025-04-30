@section('content')
    <div class="container">


        <h2>{{ $product->subcategory }}</h2>
        <p>{{ $product->description ?? 'No description available.' }}</p>


        @if ($product->videos && count($product->videos))
            <h3>Videos</h3>
            <ul>
                @foreach ($product->videos as $video)
                    <li>
                        <strong>{{ $video->video_title }}</strong><br>
                        <a href="{{ $video->video_link }}" target="_blank">{{ $video->video_link }}</a>
                    </li>
                @endforeach
            </ul>
        @endif


        @if ($product->manuals && count($product->manuals))
            <section class="downloadManuals">
                <div class="godrejContainer">
                    <div class="mainInner">
                        <div class="commonHeading">
                            <h2>Download User Manual</h2>
                        </div>
                        <div class="manualsGrid">
                            @foreach ($product->manuals as $manual)
                                <div class="manualCard">
                                    <div class="cardImage">
                                        <picture>
                                            <source srcset="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                                media="(min-width: 768px)">
                                            <source srcset="{{ asset('assets/images/usermanual-mobile.jpg') }}"
                                                media="(max-width: 767px)">
                                            <img src="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                                alt="{{ $manual->pdf_title }}">
                                        </picture>
                                        <div class="cardOverlay">
                                            <h3>{{ $product->subcategory }}</h3>
                                            <a href="{{ asset('storage/manuals/' . $manual->pdf_file) }}" class="commonBtn"
                                                target="_blank" download>
                                                <span class="btn">Download PDF
                                                    <svg width="12" height="14" viewBox="0 0 13 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.07129 1L11.7281 6.65685L6.07129 12.3137" stroke="white"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection
