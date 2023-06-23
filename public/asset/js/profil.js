var swiper = new Swiper(".mySwiper", {

    slidePerView: 3,
    spaceBetween: 30,
    grabCursor: true,
    autoplay: {
    delay: 100000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true
    },
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
    el: ".swiper-pagination",
    clickable: true
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
    }
    
    
})