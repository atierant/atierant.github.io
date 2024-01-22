// Arnaud Tiérant 2019

import {polyfillCountryFlagEmojis} from 'country-flag-emoji-polyfill';

const main = {
    scrollBoxCheck: false,

    init: function () {
        polyfillCountryFlagEmojis();
        // // Réduction de la navbar au scroll
        // $(window).scroll(function () {
        //   // Shorten the navbar after scrolling a little bit down
        //   const $navbar = $('.navbar');
        //   if ($navbar.offset().top > 50) {
        //     $navbar.addClass('top-nav-short');
        //   } else {
        //     $navbar.removeClass('top-nav-short');
        //   }
        //
        //   // Check if the scrollbox should be made visible
        //   if (main.scrollBoxCheck) {
        //     if ($(window).scrollTop() > main.scrollBoxCheck) {
        //       setTimeout(function () {
        //         $('#scroll-box').fadeIn(500);
        //       }, 500);
        //       main.scrollBoxCheck = false;
        //       $('body').addClass('scroll-box-on');
        //     }
        //   }
        // });
        //
        // // On mobile, hide the avatar when expanding the navbar menu
        // const $mainNavbar = $('#main-navbar');
        // $mainNavbar.on('show.bs.collapse', function () {
        //   $('.navbar').addClass('top-nav-expanded');
        // });
        // $mainNavbar.on('hidden.bs.collapse', function () {
        //   $('.navbar').removeClass('top-nav-expanded');
        // });
        //
        // // On mobile, when clicking on a multi-level navbar menu, show the child links
        // $mainNavbar.on('click', '.navlinks-parent', function (e) {
        //   const target = e.target;
        //   $.each($('.navlinks-parent'), function (key, value) {
        //     if (value == target) {
        //       $(value).parent().toggleClass('show-children');
        //     } else {
        //       $(value).parent().removeClass('show-children');
        //     }
        //   });
        // });
        //
        // // Ensure nested navbar menus are not longer than the menu header
        // const menus = $('.navlinks-container');
        // if (menus.length > 0) {
        //   const navbar = $('#main-navbar ul');
        //   const fakeMenuHtml = '<li class=\'fake-menu\' style=\'display:none;\'><a></a></li>';
        //   navbar.append(fakeMenuHtml);
        //   const fakeMenu = $('.fake-menu');
        //
        //   $.each(menus, function (i) {
        //     const parent = $(menus[i]).find('.navlinks-parent');
        //     const children = $(menus[i]).find('.navlinks-children a');
        //     let words = [];
        //     $.each(children, function (idx, el) {
        //       words = words.concat($(el).text().trim().split(/\s+/));
        //     });
        //     let maxwidth = 0;
        //     $.each(words, function (id, word) {
        //       fakeMenu.html('<a>' + word + '</a>');
        //       const width = fakeMenu.width();
        //       if (width > maxwidth) {
        //         maxwidth = width;
        //       }
        //     });
        //     $(menus[i]).css('min-width', maxwidth + 'px');
        //   });
        //
        //   fakeMenu.remove();
        // }

        // set up Google Analytics event tracking
        if (typeof ga === 'function') {
            $('a[data-ga-event]').click(function () {
                ga('send', 'event', $(this).data('ga-category'), $(this).data('ga-action'), $(this).data('ga-label'));
            });
        }
    },

    // get the GET parameters in the URL
    getQueryParams: function () {
        const qs = document.location.search.replace(/\?/g, '&').split('+').join(' ');

        const params = {};
        let tokens;
        const re = /[?&]?([^=]+)=([^&]*)/g;

        while ((tokens = re.exec(qs))) {
            params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
        }

        return params;
    }
};

document.addEventListener('DOMContentLoaded', main.init);

(function () {
    /**
   * Animation on scroll
   */
    window.addEventListener('load', () => {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
})();
