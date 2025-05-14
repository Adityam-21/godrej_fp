@if($videos->filter(fn($video) => !empty($video->video_url))->isNotEmpty())
    <!-- Product Videos Section -->
    <section class="productVideos">
        <div class="godrejContainer">
            <div class="mainInner">
                <div class="commonHeading">
                    <h2>Watch our Videos</h2>
                    {{ $videoSectionDescription ?? 'Watch product videos to learn more about installation, usage tips, and maintenance guidelines. Explore step-by-step tutorials to get the best out of your product.' }}
                </div>

                <!-- Mobile View: Show Only First Video -->
                <div class="mobileSingleCard d-md-none">
                    @if (!empty($videos[0]->video_url))
                        <div class="videoCard"
                            data-video-src="https://www.youtube.com/watch?v={{ $videos[0]->video_url }}"
                            data-video-type="youtube">
                            <div class="cardImage">
                                <iframe width="100%" height="315"
                                    src="https://www.youtube.com/embed/{{ $videos[0]->video_url }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </div>
                            <div class="cardContent">
                                <h3>{{ $videos[0]->video_title }}</h3>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Desktop Swiper Video Grid -->
                <div class="swiper videoSwiper d-none d-md-block">
                    <div class="swiper-wrapper">
                        @foreach ($videos as $video)
                            @if (!empty($video->video_url))
                                <div class="swiper-slide">
                                    <div class="videoCard"
                                        data-video-src="https://www.youtube.com/watch?v={{ $video->video_url }}"
                                        data-video-type="youtube">
                                        <div class="cardImage">
                                            <iframe width="100%" height="200"
                                                src="https://www.youtube.com/embed/{{ $video->video_url }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                            </iframe>
                                        </div>
                                        <div class="cardContent">
                                            <h3>{{ $video->video_title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <!-- Video Modal -->
        <div class="videoModal">
            <div class="modalContent">
                <button class="closeModal">&times;</button>
                <div class="videoContainer">
                    <div id="videoPlayer"></div>
                </div>
            </div>
        </div>
    </section>
@endif
