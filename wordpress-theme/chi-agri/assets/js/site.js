/* ==========================================================================
   site.js — Interactions du thème Chi-Agri (version allégée).
   Le contenu est rendu par PHP ; ce script ne gère que :
     • le carrousel « À propos »
     • le menu mobile
     • l'apparition au scroll (reveal / stagger)
     • les compteurs animés des chiffres clés
     • l'ombre du header au défilement
   ========================================================================== */
(function () {
  "use strict";

  /* --- Carrousel « À propos » ------------------------------------------- */
  function initCarousel() {
    var carousel = document.getElementById("aboutCarousel");
    if (!carousel) return;
    var slides = [].slice.call(carousel.querySelectorAll(".carousel-slide"));
    var dots = [].slice.call(document.querySelectorAll("#aboutDots button"));
    if (slides.length < 2) return;
    var i = 0;

    function show(n) {
      slides.forEach(function (s, k) { s.classList.toggle("active", k === n); });
      dots.forEach(function (d, k) { d.classList.toggle("active", k === n); });
      i = n;
    }
    dots.forEach(function (d, k) {
      d.addEventListener("click", function () { show(k); });
    });
    setInterval(function () { show((i + 1) % slides.length); }, 4500);
  }

  /* --- Menu mobile ------------------------------------------------------- */
  function initMobileMenu() {
    var toggle = document.getElementById("navToggle");
    var nav = document.getElementById("mainNav");
    if (!toggle || !nav) return;
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", String(open));
    });
    nav.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("click", function () {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      });
    });
  }

  /* --- Apparition au scroll --------------------------------------------- */
  function initReveal() {
    var targets = document.querySelectorAll(".reveal, .stagger");
    if (!("IntersectionObserver" in window) || !targets.length) {
      targets.forEach(function (el) { el.classList.add("in-view"); });
      return;
    }
    var io = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add("in-view"); obs.unobserve(entry.target); }
      });
    }, { threshold: 0.15 });
    targets.forEach(function (el) { io.observe(el); });
  }

  /* --- Compteurs animés -------------------------------------------------- */
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute("data-target") || "0");
    var suffix = el.getAttribute("data-suffix") || "";
    var duration = 1400;
    var start = performance.now();
    function step(now) {
      var p = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased) + suffix;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = target + suffix;
    }
    requestAnimationFrame(step);
  }

  function initCounters() {
    var values = document.querySelectorAll(".stat-value");
    if (!("IntersectionObserver" in window) || !values.length) {
      values.forEach(function (el) {
        el.textContent = (el.getAttribute("data-target") || "") + (el.getAttribute("data-suffix") || "");
      });
      return;
    }
    var io = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { animateCounter(entry.target); obs.unobserve(entry.target); }
      });
    }, { threshold: 0.5 });
    values.forEach(function (el) { io.observe(el); });
  }

  /* --- Ombre du header au défilement ------------------------------------ */
  function initHeaderScroll() {
    var header = document.querySelector(".site-header");
    if (!header) return;
    if (!document.getElementById("hero")) { header.classList.add("scrolled"); return; }
    var onScroll = function () { header.classList.toggle("scrolled", window.scrollY > 12); };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  document.addEventListener("DOMContentLoaded", function () {
    initCarousel();
    initMobileMenu();
    initReveal();
    initCounters();
    initHeaderScroll();
  });
})();
