<!-- Download Product Manuals Section -->
<section class="downloadManuals">
    <div class="godrejContainer">
        <div class="mainInner">
            <div class="commonHeading">
                <h2>Download User Manuals</h2>
            </div>

            <!-- Product Manuals Grid -->
            <div class="manualsGrid">
                @forelse($manuals as $manual)
                    <!-- Manual Card -->
                    <div class="manualCard">
                        <div class="cardImage">
                            <picture>
                                {{-- Optional: use dynamic images from DB if available --}}
                                {{-- <source srcset="{{ asset('storage/' . $manual->image_desktop) }}" media="(min-width: 768px)"> --}}
                                <source srcset="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                    media="(min-width: 768px)">
                                {{-- <source srcset="{{ asset('storage/' . $manual->image_mobile) }}" media="(max-width: 767px)"> --}}
                                <source srcset="{{ asset('assets/images/usermanual-mobile.jpg') }}"
                                    media="(max-width: 767px)">
                                <img src="{{ asset('assets/images/usermanual-desktop.jpg') }}"
                                    alt="{{ $manual->title }}">
                            </picture>

                            <div class="cardOverlay">
                                <h3>{{ $manual->pdf_title }}</h3>

                                {{-- <a href="{{ asset('/assets/manuals' . $manual->pdf_file) }}" target="_blank" --}}
                                    <a href="{{ asset($manual->file_path) }}" target="_blank"

                                    class="commonBtn">
                                    <span class="btn">Download PDF
                                        <svg width="12" height="14" viewBox="0 0 13 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.07129 1L11.7281 6.65685L6.07129 12.3137" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>

                                <!-- Share Button -->
                                <button class="shareBtn" onclick="toggleShareMenu({{ $manual->id }})">

                                    <!-- Share Menu -->
                                    <div class="shareMenu" id="share-menu-{{ $manual->id }}">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(asset('storage/' . $manual->pdf_file)) }}"
                                            target="_blank">Facebook</a>
                                        <a href="https://wa.me/?text={{ urlencode(asset('storage/' . $manual->pdf_file)) }}"
                                            target="_blank">WhatsApp</a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(asset('storage/' . $manual->pdf_file)) }}"
                                            target="_blank">Twitter</a>
                                        <a
                                            href="mailto:client.services@godrejinds.com?subject={{ rawurlencode('User Manual') }}&body={{ rawurlencode("Hi,\n\nPlease find the user manual here:\n" . asset('storage/' . $manual->pdf_file)) }}">
                                            Mail
                                        </a>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center; padding: 40px 0;">No user manuals available at the moment.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Share Menu Toggle Script -->
<script>
    function toggleShareMenu(id) {
        document.querySelectorAll('.shareMenu').forEach(menu => menu.style.display = 'none');
        const current = document.getElementById('share-menu-' + id);
        if (current) current.style.display = current.style.display === 'block' ? 'none' : 'block';
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.cardOverlay')) {
            document.querySelectorAll('.shareMenu').forEach(menu => menu.style.display = 'none');
        }
    });
</script>
