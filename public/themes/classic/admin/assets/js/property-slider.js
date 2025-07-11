$(document).ready(function(){
    console.log('Initializing property slider');
    $('.property-slider').each(function(){
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: $(this).find('.prev-arrow'),
            nextArrow: $(this).find('.next-arrow'),
            dots: false,
            autoplay: false,
            infinite: true
        });
    });
});
