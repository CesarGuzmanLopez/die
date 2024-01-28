class OWSlider {
  flickity;

  constructor() {
    this.start();
  }

  start = (
    elements = document.querySelectorAll(
      ".gallery-format, .product-entry-slider"
    )
  ) => {
    this.flickity = [];

    elements?.forEach((element) => {
      const flickity = new Flickity(element, {
        autoPlay: element.classList.contains("woo-entry-image") ? false : 6000,
        rightToLeft: document.body.classList.contains("rtl") ? true : false,
        imagesLoaded: true,
        // contain: true,
        pageDots: false,
        on: {
          ready: () => {
            element.style.opacity = 1;
            element.style.visibility = "visible";
            element.style.height = "auto";
          },
        },
      });

      this.flickity.push(flickity);
    });
  };
}

("use script");
window.ctemawp = window.ctemawp || {};
window.ctemawp.theme = window.ctemawp.theme || {};
ctemawp.owSlider = new OWSlider();
ctemawp.theme.owSlider = ctemawp.owSlider;
