// =============================================================================
// SWIPER SLIDER JS START
// =============================================================================
var swiper = new Swiper('.swiper-container.simpleSlider', {
    cssMode: true,
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    mousewheel: true,
    keyboard: true,
});


var swiper = new Swiper('.swiper-container.coverflowEffect', {
    effect: 'coverflow',
    loop: true,
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 1,
    breakpoints: {
        769: {
            slidesPerView: 3,
        },
        577: {
            slidesPerView: 2,
        }
    },
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
// =============================================================================
// SWIPER SLIDER JS END
// =============================================================================