const BannerSlide = {
    swiperOption: (setting) => {
        let option = {};
        if (setting.animation.length) {
            option.effect = setting.animation;
        }
        if (setting.arrow === 'accept') {
            option.navigation = {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            };
        }
        if (setting.autoplay === 'accept') {
            option.autoplay = {
                delay: 2000,
                disableOnInteraction: false,
            };
        }
        if (setting.navigate === 'dots') {
            option.pagination = {
                el: '.swiper-pagination',
            };
        }
        return option;
    },

    swiper: function() {
        const container = document.querySelector(".panel-slide .swiper-container");
        if (container) {
            let setting = JSON.parse($('.panel-slide').attr('data-setting') || '{}');
            let option = BannerSlide.swiperOption(setting);
            new Swiper(container, option);
        }
    },

    swiperCategory: function() {
        return new Swiper(".panel-category .swiper-container", {
            loop: false,
            pagination: {
                el: '.swiper-pagination',
            },
            spaceBetween: 20,
            slidesPerView: 3,
            breakpoints: {
                415: { slidesPerView: 3 },
                500: { slidesPerView: 3 },
                768: { slidesPerView: 6 },
                1280: { slidesPerView: 10 }
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    },

    swiperProduct: function() {
        $('.products-swiper').each(function() {
            var $swiperEl = $(this);
            var rows = $swiperEl.data('row') || 1;
    
            new Swiper(this, {
                slidesPerView: 2,
                grid: {
                    rows: rows,
                    fill: 'row'
                },
                spaceBetween: 16,
                navigation: {
                    nextEl: '.swiper-button-next-custom',
                    prevEl: '.swiper-button-prev-custom',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 3,
                        grid: {
                            rows: rows,
                            fill: 'row'
                        }
                    },
                    768: {
                        slidesPerView: 4,
                        grid: {
                            rows: rows,
                            fill: 'row'
                        }
                    },
                    992: {
                        slidesPerView: 5,
                        grid: {
                            rows: rows,
                            fill: 'row'
                        }
                    },
                    1200: {
                        slidesPerView: 6,
                        grid: {
                            rows: rows,
                            fill: 'row'
                        }
                    }
                }
            });
        });
    },

    swiperProductDetails: function () {
        var thumbSwiper = new Swiper(".thumbSwiperProductDetails", {
            direction: "vertical",
            spaceBetween: 10,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                320: {
                    direction: "horizontal",
                    slidesPerView: 3
                },
                768: {
                    direction: "vertical",
                    slidesPerView: 3
                }
            }
        });
    
        var mainSwiper = new Swiper(".mainSwiperProductDetails", {
            spaceBetween: 10,
            zoom: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            thumbs: {
                swiper: thumbSwiper,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    },

    swiperProductModal: function() {
        const thumbsSwiper = new Swiper('.productThumbsSwiper', {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
    
        const productSwiper = new Swiper('.productImagesSwiper', {
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            thumbs: {
                swiper: thumbsSwiper
            }
        });
    },

    swiperBestSeller: function() {
        return new Swiper(".panel-bestseller .swiper-container", {
            loop: false,
            pagination: {
                el: '.swiper-pagination',
            },
            spaceBetween: 20,
            slidesPerView: 2,
            breakpoints: {
                415: { slidesPerView: 1 },
                500: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    },

    wow: function() {
        return new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true,
            live: true,
            callback: function(box) {},
            scrollContainer: null,
            resetAnimation: true,
        }).init();
    },

    _token: $('meta[name="csrf-token"]').attr('content')
};

const SwiperInitializer = {
    initialize: function() {
        BannerSlide.wow();
        BannerSlide.swiperCategory();
        BannerSlide.swiperBestSeller();
        BannerSlide.swiperProduct();
        BannerSlide.swiper();
        BannerSlide.swiperProductModal();
        BannerSlide.swiperProductDetails();
    }
};

const FormatUtils = {
    addCommas: function(nStr) {
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str = '';
        for (let i = nStr.length; i > 0; i -= 3) {
            let a = ((i - 3) < 0) ? 0 : (i - 3);
            str = nStr.slice(a, i) + '.' + str;
        }
        str = str.slice(0, str.length - 1);
        return str;
    }
};

$(document).ready(function() {
    SwiperInitializer.initialize();
});