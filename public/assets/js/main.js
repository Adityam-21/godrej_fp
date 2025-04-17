// Initialize Swipers
function initSwipers() {
    // Service Contact Swiper
    if (window.innerWidth < 1200) {
        const serviceSwiper = new Swiper('.serviceContactSwiper', {
            slidesPerView: 1.3,
            spaceBetween: 20,
            centeredSlides: false,
            initialSlide: 0,
            breakpoints: {
                480: {
                    slidesPerView: 1.3,
                    spaceBetween: 20,
                    centeredSlides: false
                },
                768: {
                    slidesPerView: 2.3,
                    spaceBetween: 24,
                    centeredSlides: false
                },
                991: {
                    slidesPerView: 3.3,
                    spaceBetween: 24,
                    centeredSlides: false
                }
            }
        });
    }

    // Video Swiper
    const videoSwiper = new Swiper('.videoSwiper', {
        slidesPerView: 2.2,
        spaceBetween: 10,
        centeredSlides: false,
        initialSlide: 0,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        // pagination: {
        //     el: '.swiper-pagination',
        //     type: 'progressbar',
        // },
        breakpoints: {
            480: {
                slidesPerView: 1.5,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 2.5,
                spaceBetween: 24,
            },
            991: {
                slidesPerView: 2.2,
                spaceBetween: 24,
            },
            1200: {
                slidesPerView: 2.7,
                spaceBetween: 24,
            }
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initSwipers);

// Reinitialize on window resize
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        initSwipers();
    }, 250);
});

// YouTube API Integration
let tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let player;
let currentVideoId = '';

function onYouTubeIframeAPIReady() {
    // Player will be initialized when a video is clicked
    console.log('YouTube API Ready');
}

// Video Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.querySelector('.videoModal');
    const closeModalBtn = document.querySelector('.closeModal');
    const videoCards = document.querySelectorAll('.videoCard');
    const videoPlayer = document.querySelector('#videoPlayer');

    // Close modal when clicking the close button
    closeModalBtn?.addEventListener('click', function() {
        closeVideoModal();
    });

    // Close modal when clicking outside the content
    videoModal?.addEventListener('click', function(e) {
        if (e.target === videoModal) {
            closeVideoModal();
        }
    });

    // Handle video card clicks
    videoCards.forEach(card => {
        card.addEventListener('click', function() {
            const videoSrc = this.dataset.videoSrc;
            const videoType = this.dataset.videoType;
            openVideoModal(videoSrc, videoType);
        });
    });
});

function openVideoModal(videoSrc, videoType) {
    const videoModal = document.querySelector('.videoModal');
    const videoPlayer = document.querySelector('#videoPlayer');
    if (!videoModal || !videoPlayer) return;

    videoModal.classList.add('active');
    document.body.style.overflow = 'hidden';

    if (videoType === 'youtube') {
        // Extract video ID from YouTube URL
        const videoId = videoSrc.split('v=')[1];
        if (!videoId) return;

        // Create YouTube iframe
        videoPlayer.innerHTML = `
            <iframe width="100%" height="600"
                src="https://www.youtube.com/embed/${videoId}?autoplay=1"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        `;
    } else if (videoType === 'local') {
        // Create video element for local video
        videoPlayer.innerHTML = `
            <video width="100%" height="auto" controls autoplay>
                <source src="${videoSrc}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        `;
    }
}

function closeVideoModal() {
    const videoModal = document.querySelector('.videoModal');
    const videoPlayer = document.querySelector('#videoPlayer');
    if (!videoModal || !videoPlayer) return;

    videoModal.classList.remove('active');
    document.body.style.overflow = '';
    videoPlayer.innerHTML = ''; // Clear the video player
}

// Footer Accordion for Mobile
function initFooterAccordion() {
    const footerCols = document.querySelectorAll('.footerCol');
    const mediaQuery = window.matchMedia('(max-width: 767px)');

    function handleAccordionClick(e) {
        if (!mediaQuery.matches) return;
        
        const currentCol = e.currentTarget;
        const isActive = currentCol.classList.contains('active');
        
        // Close all accordions
        footerCols.forEach(col => {
            col.classList.remove('active');
            const ul = col.querySelector('ul');
            ul.style.display = 'none';
        });

        // Open clicked accordion if it wasn't active
        if (!isActive) {
            currentCol.classList.add('active');
            const ul = currentCol.querySelector('ul');
            ul.style.display = 'block';
        }
    }

    footerCols.forEach(col => {
        col.addEventListener('click', handleAccordionClick);
    });

    // Initial state for mobile
    function handleMobileState(e) {
        if (e.matches) {
            footerCols.forEach(col => {
                const ul = col.querySelector('ul');
                ul.style.display = 'none';
            });
        } else {
            footerCols.forEach(col => {
                const ul = col.querySelector('ul');
                ul.style.display = 'block';
            });
        }
    }

    mediaQuery.addListener(handleMobileState);
    handleMobileState(mediaQuery);
}

// Initialize footer accordion
document.addEventListener('DOMContentLoaded', initFooterAccordion);
document.querySelector('.scrollTopBtn').onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};