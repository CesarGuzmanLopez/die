import InfiniteScroll from "infinite-scroll";
import ResponsiveAutoHeight from "responsive-auto-height";

class OWInfiniteScroll {
  #elements = {
    infiniteScrollNav: document.querySelector(".infinite-scroll-nav"),
  };
  #infiniteScroll;

  constructor() {
    if (
      !!this.#elements.infiniteScrollNav &&
      !!this.#elements.infiniteScrollNav.querySelector(".older-posts a")
    ) {
      this.#setElements();
      this.#start();
      this.#setupEventListeners();
    }
  }

  #setElements = () => {
    this.#elements = {
      ...this.#elements,
      infiniteScrollWrapper: document.querySelector(".infinite-scroll-wrap"),
    };
  };

  #start = () => {
    this.#infiniteScroll = new InfiniteScroll(
      this.#elements.infiniteScrollWrapper,
      {
        path: ".older-posts a",
        append: ".item-entry",
        status: ".scroller-status",
        hideNav: ".infinite-scroll-nav",
        history: false,
        prefill: true,
        scrollThreshold: 500,
      }
    );
  };

  #setupEventListeners = () => {
    this.#infiniteScroll.on("load", function (body, path, response) {
      const items = body.querySelectorAll(".item-entry");

      imagesLoaded(items, () => {
        // Blog masonry isotope
        if (this.element.classList.contains("blog-masonry-grid")) {
          ctemawp?.blogMasonry?.isotop.appended(items);

          // Fix Gallery posts
          if (!!this.element.querySelector(".gallery-format")) {
            setTimeout(() => {
              ctemawp?.blogMasonry?.isotop.layout();
            }, 600 + 1);
          }
        }

        // Gallery posts slider
        if (!document.body.classList.contains("no-carousel")) {
          ctemawp?.owSlider?.start(
            this.element.querySelectorAll(
              ".gallery-format, .product-entry-slider"
            )
          );
        }

        if (!document.body.classList.contains("no-lightbox")) {
          ctemawp?.owLightbox?.initSingleImageLightbox();
          ctemawp?.owLightbox?.initGalleryLightbox();
        }

        // Force the images to be parsed to fix Safari issue
        items.forEach((item) => {
          item.querySelectorAll("img")?.forEach((img) => {
            img.outerHTML = img.outerHTML;
          });
        });
      });
    });

    this.#infiniteScroll.on("append", function (body, path, items, response) {
      imagesLoaded(items, () => {
        // Equal height elements
        if (!document.body.classList.contains("no-matchheight")) {
          let entryItemsSelectors = Array.from(items).map((item) => {
            if ( item.id ) {
              return `#${item.id} .blog-entry-inner`;
            } else {
              return;
            }
          });

          entryItemsSelectors = entryItemsSelectors.filter(function( element ) {
            return element !== undefined;
         });

          if ( entryItemsSelectors.length > 0 ) {
            new ResponsiveAutoHeight(entryItemsSelectors.join(","));
          }
        }
      });
      jQuery(document).trigger('maybe-init-oec-wishlist');
    });
  };
}

("use script");
window.ctemawp = window.ctemawp || {};
document.addEventListener("DOMContentLoaded", () => {
  ctemawp.owInfiniteScroll = new OWInfiniteScroll();
});
