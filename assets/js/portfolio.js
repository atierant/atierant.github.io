import 'scssRootDir/portfolio.scss';

// AOS - Animate on scroll library - https://www.npmjs.com/package/aos
import AOS from 'aos';
// Javascript lightbox - https://www.npmjs.com/package/glightbox
import GLightbox from 'glightbox';

// mobile touch slider  - https://www.npmjs.com/package/swiper
// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/css';
import PureCounter from '@srexi/purecounterjs';
// typed.js - A JavaScript Typing Animation Library
// Can also be included with a regular script tag
import Typed from 'typed.js';

AOS.init();

// TODO Décommenter si besoin
// const swiper = new Swiper('.swiper');
// const pure = new PureCounter();

// let options = {
//   strings: ['<i>First</i> sentence.', '&amp; a second sentence.'],
//   typeSpeed: 40
// };
// let typed = new Typed('.element', options);

require('waypoints/lib/noframework.waypoints');

// main.js
let Isotope = require('isotope-layout');
// let iso = new Isotope( '.grid', {
//   // options...
// });

/**
 * Template Name: iPortfolio - v3.10.0
 * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
(function () {
    'use strict';

    /**
   * Easy selector helper function
   */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
   * Easy event listener function
   */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    };

    /**
   * Easy on scroll event listener
   */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener);
    };

    // /**
    //  * Navbar links active state on scroll
    //  */
    // let navbarlinks = select('#navbar .scrollto', true)
    // const navbarlinksActive = () => {
    //   let position = window.scrollY + 200
    //   navbarlinks.forEach(navbarlink => {
    //     if (!navbarlink.hash) return
    //     let section = select(navbarlink.hash)
    //     if (!section) return
    //     if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
    //       navbarlink.classList.add('active')
    //     } else {
    //       navbarlink.classList.remove('active')
    //     }
    //   })
    // }
    // window.addEventListener('load', navbarlinksActive)
    // onscroll(document, navbarlinksActive)

    /**
   * Scrolls to an element with header offset
   */
    const scrollto = (el) => {
        let elementPos = select(el).offsetTop;
        window.scrollTo({
            top: elementPos,
            behavior: 'smooth'
        });
    };

    /**
   * Back to top button
   */
    let backtotop = select('.back-to-top');
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active');
            } else {
                backtotop.classList.remove('active');
            }
        };
        window.addEventListener('load', toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    // function isInViewport(element) {
    //   const rect = element.getBoundingClientRect();
    //   return (
    //     rect.top >= 0 &&
    //     rect.left >= 0 &&
    //     rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    //     rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    //   );
    // }

    // /**
    //  * Previous button
    //  */
    // let previous = select('a.previous')
    // if (previous) {
    //   const togglePrevious = () => {
    //     let lastSection = document.querySelector('main section:last-child');
    //
    //     console.log({'lastSection' : lastSection.id})
    //     if (!isInViewport(lastSection)) {
    //       previous.classList.add('active')
    //     } else {
    //       previous.classList.remove('active')
    //     }
    //   }
    //   window.addEventListener('load', togglePrevious)
    //   onscroll(document, togglePrevious)
    // }


    // $('#arrows a.previous').click(function() {
    //   $.scrollTo($(this).closest('section').prev(),800);
    // });
    //
    // $('#arrows a.next').click(function() {
    //   $.scrollTo($(this).closest('section').next(),800);
    // });


    // /**
    //  * Scrool with ofset on links with a class name .scrollto
    //  */
    // on('click', 'a.previous', function (e) {
    //   let previousSection = $(this).closest('section').prev();
    //   console.log(previousSection)
    //   $.scrollTo(previousSection, 800);
    // }, true)

    // /**
    //  * next button
    //  */
    // let next = select('a.next')
    // if (next) {
    //   const toggleNext = () => {
    //     let firstSection = $(this).closest('section').first();
    //     if (window.scrollY > firstSection.scrollTop) {
    //       next.classList.add('active')
    //     } else {
    //       next.classList.remove('active')
    //     }
    //   }
    //   window.addEventListener('load', toggleNext)
    //   onscroll(document, toggleNext)
    // }
    //
    //
    // /**
    //  * Scrool with ofset on links with a class name .scrollto
    //  */
    // on('click', 'a.next', function (e) {
    //   let nextSection = $(this).closest('section').next();
    //   $.scrollTo(nextSection, 800);
    // }, true)

    /**
   * Mobile nav toggle
   */
    on('click', '.mobile-nav-toggle', function () {
        select('body').classList.toggle('mobile-nav-active');
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
    });

    /**
   * Scrool with ofset on links with a class name .scrollto
   */
    on('click', '.scrollto', function (e) {
        if (select(this.hash)) {
            e.preventDefault();

            let body = select('body');
            if (body.classList.contains('mobile-nav-active')) {
                body.classList.remove('mobile-nav-active');
                let navbarToggle = select('.mobile-nav-toggle');
                navbarToggle.classList.toggle('bi-list');
                navbarToggle.classList.toggle('bi-x');
            }
            scrollto(this.hash);
        }
    }, true);

    /**
   * Scroll with ofset on page load with hash links in the url
   */
    window.addEventListener('load', () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash);
            }
        }
    });

    /**
   * Hero type effect
   */
    const typed = select('.typed');
    if (typed) {
        let typed_strings = typed.getAttribute('data-typed-items');
        typed_strings = typed_strings.split(',');
        new Typed('.typed', {
            strings: typed_strings,
            loop: true,
            typeSpeed: 100,
            backSpeed: 50,
            backDelay: 2000
        });
    }

    /**
   * Skills animation
   */
    let skilsContent = select('.skills-content');
    if (skilsContent) {
        new Waypoint({
            element: skilsContent,
            offset: '80%',
            handler: function () {
                let progress = select('.progress .progress-bar', true);
                progress.forEach((el) => {
                    el.style.width = el.getAttribute('aria-valuenow') + '%';
                });
            }
        });
    }

    /**
   * Porfolio isotope and filter
   */
    window.addEventListener('load', () => {
        let portfolioContainer = select('.portfolio-container');
        if (portfolioContainer) {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: '.portfolio-item'
            });

            let portfolioFilters = select('#portfolio-flters li', true);

            on('click', '#portfolio-flters li', function (e) {
                e.preventDefault();
                portfolioFilters.forEach(function (el) {
                    el.classList.remove('filter-active');
                });
                this.classList.add('filter-active');

                portfolioIsotope.arrange({
                    filter: this.getAttribute('data-filter')
                });
                portfolioIsotope.on('arrangeComplete', function () {
                    AOS.refresh();
                });
            }, true);
        }

    });

    /**
   * Initiate portfolio lightbox
   */
    GLightbox({
    // const portfolioLightbox = GLightbox({
        selector: '.portfolio-lightbox'
    });

    /**
   * Portfolio details slider
   */
    new Swiper('.portfolio-details-slider', {
        speed: 400,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        }
    });

    /**
   * Testimonials slider
   */
    new Swiper('.testimonials-slider', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },

            1200: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });

    /**
   * Animation on scroll
   */
    window.addEventListener('load', () => {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    });

    /**
   * Initiate Pure Counter
   */
    new PureCounter();

})();
