var
    //selector vars
    main_window = $(window),
    root = $('html, body'),
    bdyOnePage = $('body.landing-page-demo '),
    pageHeader = $('#page-header'),
    navMain = $('nav.menu-navbar'),
    navMenuwrapper = $('.navbar-menu-wrapper'),
    hasSubMenu = $(".has-sub-menu"),
    onePage_menuLink = $('.landing-page-demo .menu-navbar .menu-link'),

    // Measurements vars
    navMainHeight = navMain.innerHeight(),

    //class Names Strings vars

    inputHasText = "has-text",

    // condetionals vars
    counterShowsUp = false;

$(function ($) {
    "use strict";

    /*  START #page-header js rules */

    // Start open/close navbar search box
    $(".header-search-box form").on("click", function (e) {
        e.stopPropagation()
    });

    $('.header-search-btn').on("click", function () {
        $(".header-search-box").addClass('show');

        setTimeout(function () {
            $(".search-input").focus()
        }, 1000);
    });

    $('.header-search-box .close-search , .header-search-box').on("click", function () {
        $(".header-search-box").removeClass('show');
    });
    // End open/close navbar search box


    /* Start bootstrap Scrollspy Options  */
    //on one page demos only
    //   if (navMain) {
    //       $(bdyOnePage).scrollspy({
    //           target: navMain,
    //           offset: navMainHeight + 1
    //       });
    //   }


    if ($(this).scrollTop() > 50) {
        if (!$(pageHeader).hasClass("is-sticky")) {
            pageHeader.addClass("is-sticky");
        }
    }

    main_window.on("scroll", function () {
        if ($(this).scrollTop() > 50) {
            if (!$(pageHeader).hasClass("is-sticky")) {
                pageHeader.addClass("is-sticky");
            }
        } else {
            if ($(pageHeader).hasClass("is-sticky")) {
                pageHeader.removeClass("is-sticky");
            }
        }
    });

    // show/hide navbar links menu
    $(".menu-toggler").on("click", function () {
        pageHeader.find(".show:not(.bar-bottom .links) ").removeClass("show");
        pageHeader.find(".bar-bottom .links").toggleClass("show");
        $('.menu-toggler').toggleClass('close-menu')
    });

    // show/hide navbar info menu
    $(".info-toggler, .close-icon").on("click", function () {
        pageHeader.find(".show:not(.bar-top .info-panel)").removeClass("show");
        pageHeader.find(".bar-top .info-panel").toggleClass("show");
        if ($('.menu-toggler').hasClass('close-menu')) {
            $('.menu-toggler').removeClass('close-menu')
        }

    });



    $(".list-js").on("click", function (e) {
        e.stopPropagation()
    });

    // close the currnt opend menu when click on its wrapper
    $(".menu-wrapper").on("click", function () {
        $(this).removeClass("show");
        if ($('.menu-toggler').hasClass('close-menu')) {
            $('.menu-toggler').removeClass('close-menu')
        }
    });

    //showing navbar sub-menus on mobile
    hasSubMenu.on("click", function (e) {
        if (!(main_window.innerWidth() > 991)) {
            $(this).children('.sub-menu').slideToggle();
        }
    });
    $(document).ready(function () {
        $(function () {

            var swiper = new Swiper(".slider-main .swiper-container", {
                slidesPerView: 1,
                effect: 'fade',

                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '">' + '<svg class="fp-arc-loader" width="16" height="16" viewBox="0 0 16 16">' +
                            '<circle class="path" cx="8" cy="8" r="5.5" fill="none" transform="rotate(-90 8 8)" stroke="#FFF"' +
                            'stroke-opacity="1" stroke-width="1.5px"></circle>' +
                            '<circle cx="8" cy="8" r="3" fill="#FFF"></circle>' +
                            '</svg></span>';
                    },

                },
                loop: true,


                speed: 3000
            });
            $(document).ready(function () {
                $('.count').each(function () {
                    var $this = $(this),
                        countTo = $this.attr('data-count'),
                        appendChar = $this.text().charAt(0) === '+' ? '+' : $this.text().charAt($this.text().length - 1) === '%' ? '%' : '';

                    $({ countNum: $this.text().replace(/[^0-9]/g, '') }).animate({
                        countNum: countTo
                    },
                        {
                            duration: 4000,
                            easing: 'swing',
                            step: function () {
                                $this.text(appendChar + Math.floor(this.countNum));
                            },
                            complete: function () {
                                $this.text(appendChar + this.countNum);
                            }
                        });
                });
            });
            var swiper = new Swiper('.testmonials-area .swiper-container', {
                loop: true,
                slidesPerView: 2,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 50,
                    },
                },
            });
          
            // var ctxx = document.getElementById("columnchart").getContext("2d");
            // var myBar = new Chart(ctxx).Bar(chartData, {
            //     showTooltips: false,
            //     onAnimationComplete: function () {

            //         var ctx = this.chart.ctx;
            //         ctx.font = this.scale.font;
            //         ctx.fillStyle = this.scale.textColor
            //         ctx.textAlign = "center";
            //         ctx.textBaseline = "bottom";

            //         this.datasets.forEach(function (dataset) {
            //             dataset.bars.forEach(function (bar) {
            //                 ctx.fillText(bar.value, bar.x, bar.y - 5);
            //             });
            //         })
            //     }
            // });
            let profile = document.querySelector('.profile');
            let menu = document.querySelector('.menu');

            profile.onclick = function () {
                menu.classList.toggle('active');
            }
        },)
    })
});