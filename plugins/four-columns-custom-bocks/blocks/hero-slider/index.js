/* === Hero Slider Scripts === */
jQuery(document).ready(function() {
    jQuery('.heroSlider').each(function () {
        HS__sliderHandler(jQuery(this));
    });
    
});

function HS__sliderHandler(wrapper) {
    let id = wrapper.attr('id');
    var heroSlider = new Swiper('#' + id + ' .heroSliderSwiper', {
        // Optional parameters
        direction: 'vertical',
        loop: false,
        // If we need pagination
        pagination: {
            el: '#' + id + ' .heroSliderPagination',
            clickable: true,
        },
        allowTouchMove: false,
        on:{
            afterInit: function(){
                jQuery('#' + id + ' .heroSliderSwiper').addClass('init');
            }
        }
    });
}