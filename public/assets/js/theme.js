(function ($) {
  "use strict";

  // =============================================
  // AOS Init
  // =============================================
  // AOS disabled — content shows immediately without scroll delay
  // Remove all data-aos attributes so elements are visible by default
  document.querySelectorAll("[data-aos]").forEach(function(el) {
    el.removeAttribute("data-aos");
    el.removeAttribute("data-aos-delay");
    el.removeAttribute("data-aos-duration");
  });

  // =============================================
  // Preloader
  // =============================================
  $(window).on("load", function () {
    $(".preloader").addClass("hidden");
    setTimeout(function () { $(".preloader").remove(); }, 600);
  });

  // =============================================
  // Sticky Navbar on Scroll
  // =============================================
  var $nav = $("#mainNav");
  function handleNavScroll() {
    if ($(window).scrollTop() > 80) {
      $nav.addClass("scrolled");
    } else {
      $nav.removeClass("scrolled");
    }
  }
  $(window).on("scroll", handleNavScroll);
  handleNavScroll();

  // =============================================
  // Scroll to Top
  // =============================================
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 300) {
      $(".scroll-to-top").fadeIn(400);
    } else {
      $(".scroll-to-top").fadeOut(400);
    }
  });
  $(".scroll-to-top").on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, 800);
  });

  // =============================================
  // Side Menu Toggle (Mobile)
  // =============================================
  $(".side-menu__toggler").on("click", function (e) {
    e.preventDefault();
    $(".side-menu__block").addClass("active");
  });
  $(".side-menu__block-overlay").on("click", function (e) {
    e.preventDefault();
    $(".side-menu__block").removeClass("active");
  });

  // =============================================
  // Search Popup
  // =============================================
  $(".search-popup__toggler").on("click", function (e) {
    e.preventDefault();
    $(".search-popup").addClass("active");
    $(".search-popup input").focus();
  });
  $(".search-popup__overlay").on("click", function () {
    $(".search-popup").removeClass("active");
  });
  $(document).on("keydown", function (e) {
    if (e.key === "Escape") $(".search-popup").removeClass("active");
  });

  // =============================================
  // Typed.js
  // =============================================
  if ($(".typed-effect").length && typeof Typed !== "undefined") {
    $(".typed-effect").each(function () {
      var typedStrings = $(this).data("strings");
      var typedTag = $(this).attr("id");
      new Typed("#" + typedTag, {
        typeSpeed: 80,
        backSpeed: 50,
        backDelay: 2000,
        fadeOut: true,
        loop: true,
        strings: typedStrings.split(",")
      });
    });
  }

  // =============================================
  // Counter Animation (CountUp.js + IntersectionObserver)
  // =============================================
  if ($(".counter").length && typeof countUp !== "undefined") {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var endVal = parseInt($(el).data("count") || $(el).text(), 10);
          var cu = new countUp.CountUp(el, endVal, {
            duration: 2.5,
            separator: ",",
            enableScrollSpy: false
          });
          if (!cu.error) cu.start();
          counterObserver.unobserve(el);
        }
      });
    }, { threshold: 0.3 });
    $(".counter").each(function () {
      counterObserver.observe(this);
    });
  }

  // =============================================
  // GLightbox (image + video popups)
  // =============================================
  if (typeof GLightbox !== "undefined") {
    if ($(".video-popup").length) {
      GLightbox({ selector: ".video-popup", type: "video" });
    }
    if ($(".img-popup").length) {
      // Collect all img-popup hrefs for thumbnail nav
      var galleryItems = [];
      $(".img-popup").each(function () {
        galleryItems.push($(this).attr("href"));
      });

      var imgLightbox = GLightbox({
        selector: ".img-popup",
        type: "image",
        afterSlideChange: function (prev, current) {
          // Highlight active thumb
          $(".glightbox-thumb-nav a").removeClass("active");
          $(".glightbox-thumb-nav a").eq(current.index).addClass("active");
        },
        onOpen: function () {
          // Inject thumbnail nav strip if not exists
          if ($(".glightbox-thumb-nav").length) return;
          var $container = $(".gcontainer");
          if (!$container.length) return;

          var thumbHtml = '<div class="glightbox-thumb-nav" style="position:fixed;bottom:16px;left:50%;transform:translateX(-50%);z-index:2147483647;display:flex;gap:8px;padding:8px;background:rgba(0,0,0,0.6);border-radius:12px;backdrop-filter:blur(8px);max-width:90vw;overflow-x:auto;">';
          galleryItems.forEach(function (src, i) {
            var thumbSrc = src.replace(/w=\d+/, "w=80").replace(/h=\d+/, "h=60");
            thumbHtml += '<a href="#" data-index="' + i + '" class="glightbox-thumb-item' + (i === 0 ? ' active' : '') + '" style="flex-shrink:0;width:64px;height:48px;border-radius:8px;overflow:hidden;border:2px solid transparent;opacity:0.6;transition:all 0.2s;">';
            thumbHtml += '<img src="' + thumbSrc + '" style="width:100%;height:100%;object-fit:cover;" alt="thumb">';
            thumbHtml += '</a>';
          });
          thumbHtml += '</div>';

          // Append inside GLightbox overlay so it fades together with the lightbox
          var $glightbox = $(".glightbox-container");
          if ($glightbox.length) {
            $glightbox.append(thumbHtml);
          } else {
            $("body").append(thumbHtml);
          }

          // Prevent clicks on thumb nav from closing lightbox
          $(".glightbox-thumb-nav").on("click", function (e) {
            e.stopPropagation();
          });

          // Click thumb to navigate
          $(".glightbox-thumb-nav").on("click", "a", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var idx = parseInt($(this).data("index"));
            imgLightbox.goToSlide(idx);
            $(".glightbox-thumb-nav a").removeClass("active");
            $(this).addClass("active");
          });

          // Style active thumb
          var style = document.createElement("style");
          style.textContent = ".glightbox-thumb-nav a.active{border-color:#fc3c3c!important;opacity:1!important;} .glightbox-thumb-nav a:hover{opacity:0.9!important;}";
          document.head.appendChild(style);

          // Watch GLightbox close button click to hide thumb nav instantly
          $(document).on("click.thumbclose", ".gclose, .goverlay", function () {
            $(".glightbox-thumb-nav").hide();
          });
          $(document).on("keydown.thumbclose", function (e) {
            if (e.key === "Escape") $(".glightbox-thumb-nav").hide();
          });
        },
        onClose: function () {
          $(".glightbox-thumb-nav").remove();
          $(document).off(".thumbclose");
        }
      });
    }
  }

  // =============================================
  // Swipers
  // =============================================
  $(window).on("load", function () {

    // Popular Places
    if ($(".popular-places-swiper").length) {
      new Swiper(".popular-places-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 600,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: ".popular-places-swiper .swiper-pagination", clickable: true },
        breakpoints: {
          640: { slidesPerView: 2, spaceBetween: 20 },
          1024: { slidesPerView: 3, spaceBetween: 24 },
          1280: { slidesPerView: 4, spaceBetween: 24 }
        }
      });
    }

    // Latest Listings
    if ($(".listings-swiper").length) {
      new Swiper(".listings-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 600,
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: ".listings-swiper .swiper-pagination", clickable: true },
        breakpoints: {
          640: { slidesPerView: 2, spaceBetween: 20 },
          1024: { slidesPerView: 3, spaceBetween: 24 }
        }
      });
    }

    // Testimonials
    if ($(".testimonials-swiper").length) {
      new Swiper(".testimonials-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 600,
        autoplay: { delay: 7000, disableOnInteraction: false },
        pagination: { el: ".testimonials-swiper .swiper-pagination", clickable: true },
        breakpoints: {
          768: { slidesPerView: 2, spaceBetween: 24 }
        }
      });
    }

    // Brand Partners — continuous marquee
    if ($(".brand-swiper").length) {
      new Swiper(".brand-swiper", {
        slidesPerView: 2,
        spaceBetween: 40,
        loop: true,
        speed: 5000,
        freeMode: true,
        autoplay: { delay: 0, disableOnInteraction: false },
        breakpoints: {
          480: { slidesPerView: 3 },
          768: { slidesPerView: 4 },
          1024: { slidesPerView: 5 }
        }
      });
    }

    // Weekly/Categories/Generic carousels
    if ($(".categories-swiper").length) {
      new Swiper(".categories-swiper", {
        slidesPerView: 2,
        spaceBetween: 16,
        loop: true,
        speed: 500,
        autoplay: { delay: 4000, disableOnInteraction: false },
        navigation: { nextEl: ".cat-swiper-next", prevEl: ".cat-swiper-prev" },
        breakpoints: {
          640: { slidesPerView: 3 },
          1024: { slidesPerView: 5 },
          1280: { slidesPerView: 6 }
        }
      });
    }

    // Weekly carousel
    if ($(".weekly-swiper").length) {
      new Swiper(".weekly-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        speed: 600,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: ".weekly-swiper .swiper-pagination", clickable: true },
        breakpoints: {
          640: { slidesPerView: 2, spaceBetween: 20 },
          1024: { slidesPerView: 3, spaceBetween: 24 },
          1400: { slidesPerView: 4, spaceBetween: 24 }
        }
      });
    }

    // Gallery thumbs + main
    if ($(".gallery-thumb-swiper").length) {
      var thumbSwiper = new Swiper(".gallery-thumb-swiper", {
        slidesPerView: 5,
        spaceBetween: 10,
        loop: true,
        speed: 600,
        watchSlidesProgress: true
      });
      if ($(".gallery-main-swiper").length) {
        new Swiper(".gallery-main-swiper", {
          loop: true,
          speed: 600,
          autoplay: { delay: 5000 },
          thumbs: { swiper: thumbSwiper }
        });
      }
    }
  });

  // =============================================
  // Vegas.js Background
  // =============================================
  $(window).on("load", function () {
    if ($("#heroSection").length && typeof $.fn.vegas !== "undefined") {
      var $hero = $("#heroSection");
      var vegasOptions = $hero.data("vegas");
      if (vegasOptions) {
        $hero.vegas(vegasOptions);
      } else {
        // Default slides
        $hero.vegas({
          delay: 6000,
          timer: false,
          transition: "fade",
          transitionDuration: 2000,
          slides: [
            { src: "https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=1920&h=1080&fit=crop&q=80" },
            { src: "https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=1920&h=1080&fit=crop&q=80" },
            { src: "https://images.unsplash.com/photo-1514565131-fce0801e5785?w=1920&h=1080&fit=crop&q=80" }
          ]
        });
      }
    }
  });

  // =============================================
  // Accordion
  // =============================================
  $(document).on("click", ".accrodion-title, [data-accordion-trigger]", function () {
    var $item = $(this).closest(".accrodion, [data-accordion-item]");
    var $group = $item.parent();
    $group.find(".accrodion, [data-accordion-item]").not($item).removeClass("active").find(".accrodion-content, [data-accordion-content]").slideUp(300);
    $item.toggleClass("active");
    $item.find(".accrodion-content, [data-accordion-content]").slideToggle(300);
  });

  // =============================================
  // Contact Form Validation
  // =============================================
  if ($(".contact-form-validated").length && typeof $.fn.validate !== "undefined") {
    $(".contact-form-validated").validate({
      rules: {
        name: { required: true },
        email: { required: true, email: true },
        message: { required: true },
        subject: { required: true }
      },
      submitHandler: function (form) {
        $.post($(form).attr("action"), $(form).serialize(), function (response) {
          $(form).parent().find(".result").append(response);
          form.reset();
        });
        return false;
      }
    });
  }

  // =============================================
  // Newsletter form
  // =============================================
  $(".mc-form").on("submit", function (e) {
    e.preventDefault();
    var $form = $(this);
    var $resp = $form.parent().find(".mc-form__response");
    $resp.html('<p class="text-sm text-green-400 mt-2">Thank you for subscribing!</p>');
    $form.find("input").val("");
    setTimeout(function () { $resp.find("p").fadeOut(3000); }, 5000);
  });
// =============================================
// noUiSlider (listings pages)
// =============================================

if (
    typeof noUiSlider !== "undefined" &&
    document.getElementById("range-slider-price")
) {

    var priceRange = document.getElementById("range-slider-price");

    var minPriceInput = document.getElementById("min-price-input");
    var maxPriceInput = document.getElementById("max-price-input");

    var minPrice = minPriceInput
        ? Number(minPriceInput.value)
        : 0;

    var maxPrice = maxPriceInput
        ? Number(maxPriceInput.value)
        : 1000;

    noUiSlider.create(priceRange, {

        start: [
            minPrice,
            maxPrice
        ],

        connect: true,

        range: {
            min: 0,
            max: maxPrice
        },

        step: 10

    });

    priceRange.noUiSlider.on("update", function (values, handle) {

        var value = Math.round(values[handle]);

        if (handle === 0) {

            var el = document.getElementById(
                "min-value-rangeslider"
            );

            if (el) {
                el.textContent = value;
            }

            if (minPriceInput) {
                minPriceInput.value = value;
            }

        } else {

            var el = document.getElementById(
                "max-value-rangeslider"
            );

            if (el) {
                el.textContent = value;
            }

            if (maxPriceInput) {
                maxPriceInput.value = value;
            }

        }

    });

}
  // =============================================
  // Isotope (listing filter/masonry)
  // =============================================
  $(window).on("load", function () {
    if (typeof $.fn.isotope !== "undefined" || typeof Isotope !== "undefined") {
      if ($(".masonary-layout").length) {
        $(".masonary-layout").isotope({ layoutMode: "masonry", itemSelector: ".masonary-item" });
      }
      if ($(".post-filter").length) {
        var $filterList = $(".post-filter li");
        $(".filter-layout").isotope({ filter: ".filter-item" });
        $filterList.on("click", function () {
          $filterList.removeClass("active");
          $(this).addClass("active");
          $(".filter-layout").isotope({ filter: $(this).attr("data-filter") });
          return false;
        });
      }
    }
  });

  // =============================================
  // Tom Select (enhanced dropdowns)
  // =============================================
  $(window).on("load", function () {
    if (typeof TomSelect !== "undefined" && $(".selectpicker").length) {
      $(".selectpicker").each(function () {
        new TomSelect(this, { create: false, allowEmptyOption: true });
      });
    }
  });

  // =============================================
  // Flatpickr
  // =============================================
  $(window).on("load", function () {
    if (typeof flatpickr !== "undefined" && $("[data-datepicker]").length) {
      $("[data-datepicker]").each(function () {
        flatpickr(this, { dateFormat: "m/d/Y", allowInput: true });
      });
    }
  });

  // =============================================
  // Tabs
  // =============================================
  $(document).on("click", "[data-tab-trigger]", function (e) {
    e.preventDefault();
    var target = $(this).data("tab-trigger");
    var $group = $(this).closest("[data-tab-group]");
    $group.find("[data-tab-trigger]").removeClass("active");
    $(this).addClass("active");
    $group.find("[data-tab-panel]").hide();
    $group.find('[data-tab-panel="' + target + '"]').fadeIn(300);
  });

})(jQuery);
