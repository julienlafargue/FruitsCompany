/* ==========================================================================
   translations.js — TOUTES LES CHAÎNES DE TEXTE (EN / FR)
   --------------------------------------------------------------------------
   ⭐ Modifie ici tous les textes "d'interface" (menus, titres, boutons...).
   Les produits et producteurs, eux, se modifient dans content.js.

   Fonctionnement : chaque clé (ex. "nav.about") correspond à un élément du
   HTML portant l'attribut  data-i18n="nav.about".  Au clic sur le toggle
   EN/FR, main.js remplace le texte automatiquement.

   Pour traduire un attribut (ex. placeholder d'un input), utilise dans le
   HTML :  data-i18n-attr="placeholder:contact.form.namePlaceholder"
   ========================================================================== */

const TRANSLATIONS = {

  /* ===================== ANGLAIS (langue par défaut) ===================== */
  en: {
    // Navigation
    "nav.about":     "About",
    "nav.producers": "Producers",
    "nav.products":  "Products",
    "nav.why":       "Why Mauritius",
    "nav.contact":   "Contact",
    "nav.cta":       "Contact us",

    // Hero
    "hero.badge":    "🇲🇺 Mauritius → 🇫🇷 France",
    "hero.title":    "Fresh <span class=\"grad\">fruits &amp; vegetables</span> from the heart of the Indian Ocean",
    "hero.subtitle": "We export the finest fresh produce of Mauritius directly to France — picked at ripeness, shipped with care, delivered with full traceability.",
    "hero.ctaPrimary":   "Discover our products",
    "hero.ctaSecondary": "Contact us",
    "hero.motto":    "★ Star & Key of the Indian Ocean",

    // Statistiques
    "stats.producers":     "Partner producers",
    "stats.freshness":     "Harvest to dispatch",
    "stats.varieties":     "Fruit & veg varieties",
    "stats.traceability":  "Traceable, field to France",

    // À propos
    "about.kicker": "About us",
    "about.title":  "A direct bridge between Mauritian growers and French tables",
    "about.p1":     "We are an export company dedicated to bringing the freshness and flavour of Mauritius to the French market. We work hand in hand with local growers to select, pack and ship fruits and vegetables at their absolute best.",
    "about.p2":     "Our promise is simple: quality you can trust, freshness you can taste, and a supply chain you can follow from field to destination.",
    "about.point1": "Rigorous quality selection",
    "about.point2": "Full traceability, field to France",
    "about.point3": "Reliable, temperature-controlled logistics",

    // Producteurs
    "producers.kicker": "Our producers",
    "producers.title":  "Partner growers you can trust",
    "producers.intro":  "Behind every crate is a Mauritian grower. We build long-term, direct relationships with family farms across the island — for consistent quality, fair sourcing and produce you can trace with confidence.",
    "producers.regionLabel": "Region",
    "producers.feature1.title": "Know-how",
    "producers.feature1.desc":  "Generations of growing expertise adapted to each fruit and vegetable.",
    "producers.feature2.title": "Rich soils",
    "producers.feature2.desc":  "Volcanic, mineral-rich earth and a tropical climate that concentrate flavour.",
    "producers.feature3.title": "Traceability",
    "producers.feature3.desc":  "Every batch is identified and followed from the plot to delivery.",
    "producers.learnMore":      "View producer",
    "producers.modal.founded":     "Established",
    "producers.modal.area":        "Cultivated area",
    "producers.modal.specialties": "Specialities",
    "producers.modal.close":       "Close",

    // Produits
    "products.kicker": "Our products",
    "products.title":  "Emblematic produce of Mauritius",
    "products.intro":  "A selection of the island's most sought-after fruits and vegetables. The full range adapts to the season and to your needs.",
    "products.season": "Season",

    // Pourquoi Maurice → France
    "why.kicker": "Why Mauritius → France",
    "why.title":  "The right origin, the right partner",
    "why.card1.title": "Exceptional quality",
    "why.card1.desc":  "Tropical sun, volcanic soils and careful growing give produce a flavour and quality that stand out.",
    "why.card2.title": "Unmatched freshness",
    "why.card2.desc":  "Harvested at ripeness and dispatched fast, our produce reaches France with its freshness intact.",
    "why.card3.title": "Reliable logistics",
    "why.card3.desc":  "Optimised air and sea routes with a controlled cold chain from Mauritius to France.",
    "why.card4.title": "A historic link",
    "why.card4.desc":  "A shared language and deep Mauritius–France ties make for a natural, trusted trade relationship.",

    // Contact
    "contact.kicker": "Contact",
    "contact.title":  "Let's talk about your needs",
    "contact.intro":  "Importer, wholesaler, distributor or retailer? Tell us what you're looking for and we'll get back to you quickly.",
    "contact.form.name":          "Your name",
    "contact.form.namePlaceholder":    "Full name",
    "contact.form.email":         "Your email",
    "contact.form.emailPlaceholder":   "you@company.com",
    "contact.form.company":       "Company",
    "contact.form.companyPlaceholder": "Company name",
    "contact.form.message":       "Message",
    "contact.form.messagePlaceholder": "Tell us about your needs...",
    "contact.form.submit":        "Send message",
    "contact.info.title":     "Contact details",
    "contact.info.emailLabel":   "Email",
    "contact.info.phoneLabel":   "Phone (Mauritius)",
    "contact.info.phoneFrLabel": "Phone (France)",
    "contact.info.addressLabel": "Addresses",

    // Footer
    "footer.tagline": "Fresh fruits & vegetables exported from Mauritius to France.",
    "footer.nav":     "Navigation",
    "footer.contact": "Contact",
    "footer.follow":  "Follow us",
    "footer.rights":  "All rights reserved.",
    "footer.madeWith":"Exported with care from Mauritius 🇲🇺 to France 🇫🇷",

    // Divers (libellé du bouton = langue vers laquelle on bascule)
    "lang.toggle": "🇫🇷 FR",
  },

  /* ========================= FRANÇAIS ==================================== */
  fr: {
    // Navigation
    "nav.about":     "À propos",
    "nav.producers": "Producteurs",
    "nav.products":  "Produits",
    "nav.why":       "Pourquoi Maurice",
    "nav.contact":   "Contact",
    "nav.cta":       "Nous contacter",

    // Hero
    "hero.badge":    "🇲🇺 Maurice → 🇫🇷 France",
    "hero.title":    "Fruits &amp; <span class=\"grad\">légumes frais</span> venus du cœur de l'océan Indien",
    "hero.subtitle": "Nous exportons les meilleurs produits frais de Maurice directement vers la France — cueillis à maturité, expédiés avec soin, livrés en toute traçabilité.",
    "hero.ctaPrimary":   "Découvrir nos produits",
    "hero.ctaSecondary": "Nous contacter",
    "hero.motto":    "★ Étoile et Clé de l'océan Indien",

    // Statistiques
    "stats.producers":     "Producteurs partenaires",
    "stats.freshness":     "De la récolte à l'expédition",
    "stats.varieties":     "Variétés de fruits & légumes",
    "stats.traceability":  "Traçable, du champ à la France",

    // À propos
    "about.kicker": "À propos",
    "about.title":  "Un pont direct entre les producteurs mauriciens et les tables françaises",
    "about.p1":     "Nous sommes une entreprise d'export dédiée à faire voyager la fraîcheur et les saveurs de Maurice jusqu'au marché français. Nous travaillons main dans la main avec les producteurs locaux pour sélectionner, conditionner et expédier les fruits et légumes au meilleur de leur forme.",
    "about.p2":     "Notre promesse est simple : une qualité de confiance, une fraîcheur qui se goûte, et une chaîne d'approvisionnement que vous pouvez suivre du champ à la destination.",
    "about.point1": "Sélection qualité rigoureuse",
    "about.point2": "Traçabilité totale, du champ à la France",
    "about.point3": "Logistique fiable et sous température dirigée",

    // Producteurs
    "producers.kicker": "Nos producteurs",
    "producers.title":  "Des producteurs partenaires de confiance",
    "producers.intro":  "Derrière chaque cagette, il y a un producteur mauricien. Nous construisons des relations directes et durables avec les exploitations familiales de l'île — pour une qualité constante, un sourcing équitable et des produits traçables en toute confiance.",
    "producers.regionLabel": "Région",
    "producers.feature1.title": "Savoir-faire",
    "producers.feature1.desc":  "Des générations d'expertise agricole adaptées à chaque fruit et légume.",
    "producers.feature2.title": "Terres riches",
    "producers.feature2.desc":  "Une terre volcanique riche en minéraux et un climat tropical qui concentrent les saveurs.",
    "producers.feature3.title": "Traçabilité",
    "producers.feature3.desc":  "Chaque lot est identifié et suivi de la parcelle jusqu'à la livraison.",
    "producers.learnMore":      "Voir le producteur",
    "producers.modal.founded":     "Depuis",
    "producers.modal.area":        "Surface cultivée",
    "producers.modal.specialties": "Spécialités",
    "producers.modal.close":       "Fermer",

    // Produits
    "products.kicker": "Nos produits",
    "products.title":  "Les produits emblématiques de Maurice",
    "products.intro":  "Une sélection des fruits et légumes les plus recherchés de l'île. La gamme complète s'adapte à la saison et à vos besoins.",
    "products.season": "Saison",

    // Pourquoi Maurice → France
    "why.kicker": "Pourquoi Maurice → France",
    "why.title":  "La bonne origine, le bon partenaire",
    "why.card1.title": "Une qualité d'exception",
    "why.card1.desc":  "Le soleil tropical, les sols volcaniques et une culture soignée donnent aux produits une saveur et une qualité remarquables.",
    "why.card2.title": "Une fraîcheur inégalée",
    "why.card2.desc":  "Récoltés à maturité et expédiés rapidement, nos produits arrivent en France avec toute leur fraîcheur.",
    "why.card3.title": "Une logistique fiable",
    "why.card3.desc":  "Des liaisons aériennes et maritimes optimisées, avec une chaîne du froid maîtrisée de Maurice à la France.",
    "why.card4.title": "Un lien historique",
    "why.card4.desc":  "Une langue commune et des liens profonds entre Maurice et la France pour une relation commerciale naturelle et de confiance.",

    // Contact
    "contact.kicker": "Contact",
    "contact.title":  "Parlons de vos besoins",
    "contact.intro":  "Importateur, grossiste, distributeur ou détaillant ? Dites-nous ce que vous recherchez et nous vous répondrons rapidement.",
    "contact.form.name":          "Votre nom",
    "contact.form.namePlaceholder":    "Nom complet",
    "contact.form.email":         "Votre email",
    "contact.form.emailPlaceholder":   "vous@entreprise.com",
    "contact.form.company":       "Société",
    "contact.form.companyPlaceholder": "Nom de la société",
    "contact.form.message":       "Message",
    "contact.form.messagePlaceholder": "Parlez-nous de vos besoins...",
    "contact.form.submit":        "Envoyer le message",
    "contact.info.title":     "Coordonnées",
    "contact.info.emailLabel":   "Email",
    "contact.info.phoneLabel":   "Téléphone (Maurice)",
    "contact.info.phoneFrLabel": "Téléphone (France)",
    "contact.info.addressLabel": "Adresses",

    // Footer
    "footer.tagline": "Fruits & légumes frais exportés de Maurice vers la France.",
    "footer.nav":     "Navigation",
    "footer.contact": "Contact",
    "footer.follow":  "Suivez-nous",
    "footer.rights":  "Tous droits réservés.",
    "footer.madeWith":"Exporté avec soin de Maurice 🇲🇺 vers la France 🇫🇷",

    // Divers (libellé du bouton = langue vers laquelle on bascule)
    "lang.toggle": "🇬🇧 EN",
  },
};
