"use strict";(self.webpackChunkatierant_website=self.webpackChunkatierant_website||[]).push([[824],{9208:(e,t,i)=>{i(8436),i(9693),i(228),i(7522),i(4253),i(9749),i(6544),i(4254),i(752),i(1694),i(6265),i(7049),i(9730),i(24),i(2826),i(4284),i(4043);var n=i(2711),o=i.n(n),r=i(7727),a=i.n(r),l=i(9228),s=i(3274),c=i.n(s),d=i(9911);function f(e){return function(e){if(Array.isArray(e))return u(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return u(e,t);var i=Object.prototype.toString.call(e).slice(8,-1);"Object"===i&&e.constructor&&(i=e.constructor.name);if("Map"===i||"Set"===i)return Array.from(e);if("Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i))return u(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function u(e,t){(null==t||t>e.length)&&(t=e.length);for(var i=0,n=new Array(t);i<t;i++)n[i]=e[i];return n}o().init(),i(6682);var p=i(3391);!function(){var e,t,i=function(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];return e=e.trim(),t?f(document.querySelectorAll(e)):document.querySelector(e)},n=function(e,t,n){var o=arguments.length>3&&void 0!==arguments[3]&&arguments[3],r=i(t,o);r&&(o?r.forEach((function(t){return t.addEventListener(e,n)})):r.addEventListener(e,n))},r=function(e){var t=i(e).offsetTop;window.scrollTo({top:t,behavior:"smooth"})},s=i(".back-to-top");if(s){var u=function(){window.scrollY>100?s.classList.add("active"):s.classList.remove("active")};window.addEventListener("load",u),e=document,t=u,e.addEventListener("scroll",t)}n("click",".mobile-nav-toggle",(function(){i("body").classList.toggle("mobile-nav-active"),this.classList.toggle("bi-list"),this.classList.toggle("bi-x")})),n("click",".scrollto",(function(e){if(i(this.hash)){e.preventDefault();var t=i("body");if(t.classList.contains("mobile-nav-active")){t.classList.remove("mobile-nav-active");var n=i(".mobile-nav-toggle");n.classList.toggle("bi-list"),n.classList.toggle("bi-x")}r(this.hash)}}),!0),window.addEventListener("load",(function(){window.location.hash&&i(window.location.hash)&&r(window.location.hash)}));var v=i(".typed");if(v){var b=v.getAttribute("data-typed-items");b=b.split(","),new d.Z(".typed",{strings:b,loop:!0,typeSpeed:100,backSpeed:50,backDelay:2e3})}var w=i(".skills-content");w&&new Waypoint({element:w,offset:"80%",handler:function(){i(".progress .progress-bar",!0).forEach((function(e){e.style.width=e.getAttribute("aria-valuenow")+"%"}))}}),window.addEventListener("load",(function(){var e=i(".portfolio-container");if(e){var t=new p(e,{itemSelector:".portfolio-item"}),r=i("#portfolio-flters li",!0);n("click","#portfolio-flters li",(function(e){e.preventDefault(),r.forEach((function(e){e.classList.remove("filter-active")})),this.classList.add("filter-active"),t.arrange({filter:this.getAttribute("data-filter")}),t.on("arrangeComplete",(function(){o().refresh()}))}),!0)}})),a()({selector:".portfolio-lightbox"}),new l.Z(".portfolio-details-slider",{speed:400,loop:!0,autoplay:{delay:5e3,disableOnInteraction:!1},pagination:{el:".swiper-pagination",type:"bullets",clickable:!0}}),new l.Z(".testimonials-slider",{speed:600,loop:!0,autoplay:{delay:5e3,disableOnInteraction:!1},slidesPerView:"auto",pagination:{el:".swiper-pagination",type:"bullets",clickable:!0},breakpoints:{320:{slidesPerView:1,spaceBetween:20},1200:{slidesPerView:3,spaceBetween:20}}}),window.addEventListener("load",(function(){o().init({duration:1e3,easing:"ease-in-out",once:!0,mirror:!1})})),new(c())}()}},e=>{e.O(0,[639,966,704],(()=>{return t=9208,e(e.s=t);var t}));e.O()}]);