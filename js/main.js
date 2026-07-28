/* ==========================================================================
   main.js — LOGIQUE DU SITE
   --------------------------------------------------------------------------
   • Injecte config (nom, logo, coordonnées, images)
   • Génère produits, producteurs, marquee, stats depuis content.js
   • i18n EN/FR (data-i18n / data-i18n-html / data-i18n-attr) + localStorage
   • Fenêtre détaillée producteur (modal)
   • Animations : fruits flottants, apparition au scroll, compteurs
   • Sélecteur de palettes + menu mobile

   Dépend de (chargés AVANT dans index.html) :
     config.js (SITE_CONFIG, resolveImage) · content.js (STATS, PRODUCTS,
     PRODUCERS) · translations.js (TRANSLATIONS)
   ========================================================================== */

(function () {
  "use strict";

  const LS_LANG = "mru_site_lang";
  let currentLang = SITE_CONFIG.defaultLang || "en";
  let openProducerIndex = null; // producteur affiché dans la modal (ou null)


  /* ======================================================================
     1. INTERNATIONALISATION
     ====================================================================== */
  function t(key) {
    const dict = TRANSLATIONS[currentLang] || TRANSLATIONS.en;
    return dict[key] !== undefined ? dict[key] : (TRANSLATIONS.en[key] || key);
  }

  function applyTranslations() {
    // Texte simple
    document.querySelectorAll("[data-i18n]").forEach((el) => {
      el.textContent = t(el.getAttribute("data-i18n"));
    });
    // Texte contenant du HTML de confiance (ex. mot surligné du hero)
    document.querySelectorAll("[data-i18n-html]").forEach((el) => {
      el.innerHTML = t(el.getAttribute("data-i18n-html"));
    });
    // Attributs (placeholder, etc.)
    document.querySelectorAll("[data-i18n-attr]").forEach((el) => {
      el.getAttribute("data-i18n-attr").split(";").forEach((pair) => {
        const [attr, key] = pair.split(":").map((s) => s.trim());
        if (attr && key) el.setAttribute(attr, t(key));
      });
    });
    document.documentElement.lang = currentLang;
    const toggle = document.getElementById("langToggle");
    if (toggle) toggle.textContent = t("lang.toggle");
  }

  function setLang(lang) {
    currentLang = TRANSLATIONS[lang] ? lang : "en";
    localStorage.setItem(LS_LANG, currentLang);
    applyTranslations();
    fillSEO();
    renderProducts();
    renderProducers();
    buildMailto();
    updateSectionNavLabels();
    if (openProducerIndex !== null) fillModal(openProducerIndex); // met à jour la modal ouverte
  }


  /* ======================================================================
     2. IMAGES DU SITE (hero, à propos, fonds de sections)
     ====================================================================== */
  function applyImages() {
    const im = SITE_CONFIG.images;
    const heroBg = document.getElementById("heroBg");
    if (heroBg) heroBg.style.backgroundImage = "url('" + resolveImage(im.hero, 1920) + "')";

    // On expose aussi l'image hero en variable CSS (utilisée par .hero-bg)
    document.documentElement.style.setProperty("--hero-img", "url('" + resolveImage(im.hero, 1920) + "')");

    // Carte "plantation" flottante par-dessus le fond Maurice
    const heroCard = document.getElementById("heroCardImg");
    if (heroCard && im.heroCard) heroCard.style.backgroundImage = "url('" + resolveImage(im.heroCard, 600, 420) + "')";

    const producersBg = document.getElementById("producersBg");
    if (producersBg) producersBg.style.backgroundImage = "url('" + resolveImage(im.producersBg, 1600) + "')";

    const whyBg = document.getElementById("whyBg");
    if (whyBg && im.whyBg) whyBg.style.backgroundImage = "url('" + resolveImage(im.whyBg, 1600) + "')";
  }

  /* Carrousel de la section « À propos » : photos qui défilent en fondu. */
  function buildAboutCarousel() {
    const wrap = document.getElementById("aboutCarousel");
    const dots = document.getElementById("aboutDots");
    const slides = (SITE_CONFIG.images.aboutSlides || []).filter(Boolean);
    if (!wrap || !slides.length) return;

    wrap.innerHTML = slides.map((src, i) =>
      `<div class="carousel-slide${i === 0 ? " active" : ""}" style="background-image:url('${resolveImage(src, 900, 620)}')"></div>`
    ).join("");

    if (dots) {
      dots.innerHTML = slides.map((_, i) =>
        `<button class="${i === 0 ? "active" : ""}" data-i="${i}" aria-label="Photo ${i + 1}"></button>`
      ).join("");
    }

    const slideEls = wrap.querySelectorAll(".carousel-slide");
    const dotEls = dots ? dots.querySelectorAll("button") : [];
    let current = 0;
    let timer = null;

    function show(i) {
      current = (i + slideEls.length) % slideEls.length;
      slideEls.forEach((el, k) => el.classList.toggle("active", k === current));
      dotEls.forEach((el, k) => el.classList.toggle("active", k === current));
    }
    function next() { show(current + 1); }
    function start() { stop(); if (slideEls.length > 1) timer = setInterval(next, 4500); }
    function stop() { if (timer) clearInterval(timer); }

    dotEls.forEach((dot) => dot.addEventListener("click", () => { show(parseInt(dot.dataset.i, 10)); start(); }));
    // Pause au survol
    wrap.addEventListener("mouseenter", stop);
    wrap.addEventListener("mouseleave", start);
    start();
  }



  /* ======================================================================
     4. INJECTION CONFIG (logo, coordonnées)
     ====================================================================== */
  function buildLogo(container) {
    if (!container) return;
    container.innerHTML = "";
    if (SITE_CONFIG.company.logoMode === "image") {
      const img = document.createElement("img");
      img.src = SITE_CONFIG.company.logoImage;
      img.alt = SITE_CONFIG.company.name;
      img.className = "logo-img";
      container.appendChild(img);
    } else {
      const mark = document.createElement("span");
      mark.className = "logo-mark";
      mark.textContent = "🍃";
      const name = document.createElement("span");
      name.className = "logo-name";
      name.innerHTML = SITE_CONFIG.company.name;
      container.appendChild(mark);
      container.appendChild(name);
    }
  }

  function fillContactInfo() {
    const c = SITE_CONFIG.contact;
    const setText = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
    const setHref = (id, v) => { const el = document.getElementById(id); if (el) el.setAttribute("href", v); };

    setText("infoEmail", c.email); setHref("infoEmail", "mailto:" + c.email);
    setText("infoPhone", c.phone); setHref("infoPhone", "tel:" + c.phone.replace(/\s+/g, ""));

    const phoneFrItem = document.getElementById("infoPhoneFrItem");
    if (c.phoneFrance) {
      setText("infoPhoneFr", c.phoneFrance);
      setHref("infoPhoneFr", "tel:" + c.phoneFrance.replace(/\s+/g, ""));
    } else if (phoneFrItem) { phoneFrItem.style.display = "none"; }

    setText("infoAddress", c.addressMauritius + " · " + c.addressFrance);
    setText("footerEmail", c.email); setHref("footerEmail", "mailto:" + c.email);
    setText("footerPhone", c.phone); setHref("footerPhone", "tel:" + c.phone.replace(/\s+/g, ""));

    const s = SITE_CONFIG.social;
    [["footerLinkedin", s.linkedin], ["footerInstagram", s.instagram], ["footerFacebook", s.facebook]]
      .forEach(([id, url]) => {
        const el = document.getElementById(id);
        if (!el) return;
        if (url) el.setAttribute("href", url);
        else el.parentElement.style.display = "none";
      });
  }

  /* Met à jour titre + balises SEO selon la langue (depuis SITE_CONFIG.seo). */
  function fillSEO() {
    const seo = SITE_CONFIG.seo || {};
    const lang = currentLang;
    const title = (seo.title && seo.title[lang]) || document.title;
    const desc = (seo.description && seo.description[lang]) || "";

    document.title = title;

    const setMeta = (sel, val) => { const el = document.querySelector(sel); if (el && val) el.setAttribute("content", val); };
    setMeta('meta[name="description"]', desc);
    setMeta('meta[property="og:title"]', title);
    setMeta('meta[property="og:description"]', desc);
    setMeta('meta[name="twitter:title"]', title);
    setMeta('meta[name="twitter:description"]', desc);
    setMeta('meta[property="og:locale"]', lang === "fr" ? "fr_FR" : "en_US");
    setMeta('meta[property="og:locale:alternate"]', lang === "fr" ? "en_US" : "fr_FR");
  }


  /* ======================================================================
     5. RENDU : STATS, PRODUITS, PRODUCTEURS
     ====================================================================== */
  function renderStats() {
    const grid = document.getElementById("statsGrid");
    if (!grid) return;
    grid.innerHTML = STATS.map((s) => `
      <div class="about-stat">
        <div class="stat-icon">${s.icon || ""}</div>
        <div class="stat-value" data-target="${s.value}" data-suffix="${s.suffix || ""}">0${s.suffix || ""}</div>
        <div class="stat-label" data-i18n="${s.labelKey}">${t(s.labelKey)}</div>
      </div>`).join("");
  }

  function renderProducts() {
    const grid = document.getElementById("productsGrid");
    if (!grid) return;
    grid.innerHTML = PRODUCTS.map((p) => {
      const tag = p.tag && p.tag[currentLang] ? `<span class="product-tag">${p.tag[currentLang]}</span>` : "";
      const img = resolveImage(p.img, 500, 360);
      return `
        <article class="product-card">
          <div class="product-media">
            <div class="pm-img" style="background-image:url('${img}')"></div>
            ${tag}
            <span class="pm-emoji">${p.emoji}</span>
          </div>
          <div class="product-body">
            <h3>${p.name[currentLang]}</h3>
            <p class="product-season">${t("products.season")} : <b>${p.season[currentLang]}</b></p>
            <p class="product-desc">${p.desc[currentLang]}</p>
          </div>
        </article>`;
    }).join("");
  }

  function renderProducers() {
    const grid = document.getElementById("producersGrid");
    if (!grid) return;
    grid.innerHTML = PRODUCERS.map((p, i) => {
      const img = resolveImage(p.img, 600, 760);
      return `
        <article class="producer-card" data-index="${i}" tabindex="0" role="button"
                 aria-label="${p.name} — ${t("producers.learnMore")}">
          <div class="pc-img" style="background-image:url('${img}')"></div>
          <div class="pc-body">
            <span class="pc-region">${p.region[currentLang]}</span>
            <h3>${p.name}</h3>
            <p class="pc-short">${p.short[currentLang]}</p>
            <span class="pc-more">${t("producers.learnMore")}</span>
          </div>
        </article>`;
    }).join("");

    // Ouverture de la fenêtre au clic / clavier
    grid.querySelectorAll(".producer-card").forEach((card) => {
      const i = parseInt(card.dataset.index, 10);
      card.addEventListener("click", () => openModal(i));
      card.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") { e.preventDefault(); openModal(i); }
      });
    });
  }


  /* ======================================================================
     6. FENÊTRE PRODUCTEUR (modal)
     ====================================================================== */
  function fillModal(i) {
    const p = PRODUCERS[i];
    if (!p) return;
    const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
    document.getElementById("modalImg").style.backgroundImage = "url('" + resolveImage(p.img, 700, 800) + "')";
    set("modalRegion", p.region[currentLang]);
    set("modalName", p.name);
    set("modalBio", p.bio[currentLang]);
    set("modalFounded", p.founded);
    set("modalArea", p.hectares);
    document.getElementById("modalTags").innerHTML =
      p.specialties[currentLang].map((s) => `<span>${s}</span>`).join("");
  }

  function openModal(i) {
    openProducerIndex = i;
    fillModal(i);
    const overlay = document.getElementById("producerModal");
    overlay.classList.add("is-open");
    document.body.classList.add("no-scroll");
    document.getElementById("modalClose").focus();
  }

  function closeModal() {
    openProducerIndex = null;
    document.getElementById("producerModal").classList.remove("is-open");
    document.body.classList.remove("no-scroll");
  }

  function initModal() {
    const overlay = document.getElementById("producerModal");
    if (!overlay) return;
    document.getElementById("modalClose").addEventListener("click", closeModal);
    overlay.addEventListener("click", (e) => { if (e.target === overlay) closeModal(); });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && overlay.classList.contains("is-open")) closeModal();
    });
  }


  /* ======================================================================
     7. FORMULAIRE DE CONTACT (mailto)
     ====================================================================== */
  function buildMailto() {
    const form = document.getElementById("contactForm");
    if (!form) return;
    form.onsubmit = function (e) {
      e.preventDefault();
      const name = (form.name.value || "").trim();
      const email = (form.email.value || "").trim();
      const company = (form.company.value || "").trim();
      const message = (form.message.value || "").trim();
      const brand = SITE_CONFIG.company.nameText || SITE_CONFIG.company.name;
      const subject = `[${brand}] Contact — ${name || email}`;
      const body = `${message}\n\n— — —\nName: ${name}\nEmail: ${email}\nCompany: ${company}`;
      window.location.href =
        `mailto:${SITE_CONFIG.contact.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    };
  }


  /* ======================================================================
     8. ANIMATIONS : apparition au scroll + compteurs
     ====================================================================== */
  function initReveal() {
    const targets = document.querySelectorAll(".reveal, .stagger");
    if (!("IntersectionObserver" in window) || !targets.length) {
      targets.forEach((el) => el.classList.add("in-view"));
      return;
    }
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) { entry.target.classList.add("in-view"); obs.unobserve(entry.target); }
      });
    }, { threshold: 0.15 });
    targets.forEach((el) => io.observe(el));
  }

  function animateCounter(el) {
    const target = parseFloat(el.dataset.target || "0");
    const suffix = el.dataset.suffix || "";
    const duration = 1400;
    const start = performance.now();
    function step(now) {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
      el.textContent = Math.round(target * eased) + suffix;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = target + suffix;
    }
    requestAnimationFrame(step);
  }

  function initCounters() {
    const values = document.querySelectorAll(".stat-value");
    if (!("IntersectionObserver" in window) || !values.length) {
      values.forEach((el) => { el.textContent = (el.dataset.target || "") + (el.dataset.suffix || ""); });
      return;
    }
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) { animateCounter(entry.target); obs.unobserve(entry.target); }
      });
    }, { threshold: 0.5 });
    values.forEach((el) => io.observe(el));
  }


  /* ======================================================================
     9. MENU MOBILE
     ====================================================================== */
  function initMobileMenu() {
    const toggle = document.getElementById("navToggle");
    const nav = document.getElementById("mainNav");
    if (!toggle || !nav) return;
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", String(open));
    });
    nav.querySelectorAll("a").forEach((a) =>
      a.addEventListener("click", () => {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      })
    );
  }


  /* Ombre / opacité du header au défilement (plus intégré). */
  function initHeaderScroll() {
    const header = document.querySelector(".site-header");
    if (!header) return;
    const onScroll = () => header.classList.toggle("scrolled", window.scrollY > 12);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  /* Navigation latérale par points : aide à circuler entre les sections. */
  const SECTION_NAV = [
    ["hero", "nav.home"], ["about", "nav.about"], ["producers", "nav.producers"],
    ["products", "nav.products"], ["why", "nav.why"], ["contact", "nav.contact"],
  ];

  function initSectionNav() {
    const nav = document.createElement("nav");
    nav.className = "section-nav";
    nav.setAttribute("aria-label", "Sections");
    nav.innerHTML = SECTION_NAV.map(([id, key]) =>
      `<a href="#${id}" class="sn-dot" data-id="${id}" aria-label="${t(key)}">
         <span class="sn-label">${t(key)}</span>
       </a>`
    ).join("");
    document.body.appendChild(nav);

    const dots = [...nav.querySelectorAll(".sn-dot")];
    if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) dots.forEach((d) => d.classList.toggle("active", d.dataset.id === e.target.id));
        });
      }, { threshold: 0.5, rootMargin: "-20% 0px -20% 0px" });
      SECTION_NAV.forEach(([id]) => { const s = document.getElementById(id); if (s) io.observe(s); });
    }
  }

  /* Met à jour les libellés (tooltips) des points au changement de langue. */
  function updateSectionNavLabels() {
    document.querySelectorAll(".section-nav .sn-dot").forEach((dot) => {
      const key = SECTION_NAV.find(([id]) => id === dot.dataset.id);
      if (!key) return;
      dot.setAttribute("aria-label", t(key[1]));
      const label = dot.querySelector(".sn-label");
      if (label) label.textContent = t(key[1]);
    });
  }


  /* ======================================================================
     10. INITIALISATION
     ====================================================================== */
  function init() {
    currentLang = localStorage.getItem(LS_LANG) || SITE_CONFIG.defaultLang || "en";

    buildLogo(document.getElementById("headerLogo"));
    buildLogo(document.getElementById("footerLogo"));

    applyImages();
    buildAboutCarousel();
    fillContactInfo();
    renderStats();
    renderProducts();
    renderProducers();
    buildMailto();
    initModal();
    initSectionNav();

    applyTranslations();
    fillSEO();

    const langToggle = document.getElementById("langToggle");
    if (langToggle) langToggle.addEventListener("click", () => setLang(currentLang === "en" ? "fr" : "en"));

    initMobileMenu();
    initHeaderScroll();
    initReveal();
    initCounters();

    const year = document.getElementById("footerYear");
    if (year) year.textContent = new Date().getFullYear();
  }

  document.addEventListener("DOMContentLoaded", init);
})();
