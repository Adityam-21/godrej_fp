<div class="manualsGrid">
    @if ($product->manuals && count($product->manuals))
        @foreach ($product->manuals as $manual)
            <div class="manualCard">
                <div class="cardImage">
                    <picture>
                        <source srcset="{{ asset('assets/images/usermanual-desktop.jpg') }}" media="(min-width: 768px)">
                        <source srcset="{{ asset('assets/images/usermanual-mobile.jpg') }}" media="(max-width: 767px)">
                        <img src="{{ asset('assets/images/usermanual-desktop.jpg') }}" alt="{{ $manual->title }}">
                    </picture>
                    <div class="cardOverlay">
                        <h3>{{ $product->subcategory }}</h3>
                        <a href="{{ asset('storage/manuals/' . $manual->file_path) }}" class="commonBtn" target="_blank"
                            download>
                            <span class="btn">Download PDF</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No manuals available.</p>
    @endif

    @if ($product->videos && count($product->videos))
        <div class="videoSection" style="margin-top: 40px;">
            <h3>Product Videos</h3>
            <ul>
                @foreach ($product->videos as $video)
                    <li><a href="{{ $video->video_url }}" target="_blank">{{ $video->title }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
