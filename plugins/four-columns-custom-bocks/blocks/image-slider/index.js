/* === Custom Block Scripts === */
jQuery(document).ready(function () {
  let swiperIndex = 0;
  jQuery(".imageSliderSwiper").each(function (index, element) {
    IS__swiperHandler(element);
  });
});

function IS__swiperHandler(element) {
  const imageSliderParams = {
    // Optional parameters
    direction: "vertical",
    loop: false,
    // If we need pagination
    pagination: {
      el: ".imageSliderPagination",
      clickable: true,
    },
    allowTouchMove: true,
    autoplay: {
      duration: 3000,
    },
    breakpoints: {
      0: {
        direction: "horizontal",
      },
      768: {
        direction: "vertical",
      },
    },
  };
  let imageSlider = new Swiper(element, imageSliderParams);
}
