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
    "nav.home":      "Home",
    "nav.about":     "About",
    "nav.producers": "Producers",
    "nav.products":  "Products",
    "nav.why":       "Why Mauritius",
    "nav.contact":   "Contact",
    "nav.cta":       "Contact us",

    // Hero
    "hero.title":    "Fresh <span class=\"grad\">Fruits</span> from the heart of the Indian Ocean",
    "hero.tagline":  "Exporter of fresh exotic fruits",
    "hero.ctaPrimary":   "Discover our products",
    "hero.ctaSecondary": "Contact us",
    "hero.cardCaption":  "🌱 Our pineapple farm",

    // Statistiques
    "stats.varieties":     "Exotic fruits",
    "stats.freshness":     "Harvest to dispatch",
    "stats.ownfarms":      "Grown in Mauritius",
    "stats.traceability":  "Traceable to the plot",

    // À propos
    "about.kicker": "About us",
    "about.title":  "Grown and exported with care",
    "about.p1":     "At Chi-Agri, we specialise in exporting premium exotic fruits from Mauritius. From the field to the crate, we manage every step of the process to ensure our fruit arrives fresh and of the highest quality.",
    "about.p2":     "We focus exclusively on Victoria pineapples and Passion fruit, sourced directly from Mauritius and delivered to Rungis Market in France.",

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
    "products.title":  "Our fruit",
    "products.intro":  "Two exotic fruits, grown in Mauritius and available year-round.",
    "products.season": "Season",
    "products.weight": "Weight",

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

    // Contact (home = coordonnées) + Inquiry (page dédiée)
    "contact.kicker": "Contact",
    "contact.title":  "Get in touch",
    "contact.intro":  "Importer, wholesaler or distributor? Send us an inquiry.",
    "contact.sendInquiry": "Send an inquiry",
    "contact.info.title":     "Our contact details",
    "contact.info.personLabel":  "Contact",
    "contact.info.emailLabel":   "Email",
    "contact.info.phoneLabel":   "Phone",
    "contact.info.addressLabel": "Address",

    "inquiry.kicker": "Inquiry",
    "inquiry.title":  "Send us an inquiry",
    "inquiry.intro":  "Tell us which fruit and quantity you're interested in.",
    "inquiry.back":   "← Back to home",
    "contact.form.name":          "Your name",
    "contact.form.namePlaceholder":    "Full name",
    "contact.form.email":         "Your email",
    "contact.form.emailPlaceholder":   "you@company.com",
    "contact.form.company":       "Company",
    "contact.form.companyPlaceholder": "Company name",
    "contact.form.product":       "Product of interest",
    "contact.form.quantity":      "Quantity",
    "contact.form.quantityPlaceholder": "e.g. pallets / tonnes",
    "contact.form.message":       "Message",
    "contact.form.messagePlaceholder": "Your message",
    "contact.form.submit":        "Send inquiry",

    // Footer
    "footer.tagline": "Exporter of fresh exotic fruits",
    "footer.nav":     "Navigation",
    "footer.contact": "Contact",
    "footer.rights":  "All rights reserved.",
    "footer.madeWith":"Grown and exported with care from Mauritius",

    // Divers (libellé du bouton = langue vers laquelle on bascule)
    "lang.toggle": "🇫🇷 FR",
  },

  /* ========================= FRANÇAIS ==================================== */
  fr: {
    // Navigation
    "nav.home":      "Accueil",
    "nav.about":     "À propos",
    "nav.producers": "Producteurs",
    "nav.products":  "Produits",
    "nav.why":       "Pourquoi Maurice",
    "nav.contact":   "Contact",
    "nav.cta":       "Nous contacter",

    // Hero
    "hero.title":    "<span class=\"grad\">Fruits</span> frais venu du cœur de l'océan Indien",
    "hero.tagline":  "Exportateur de fruits exotiques frais",
    "hero.ctaPrimary":   "Découvrir nos produits",
    "hero.ctaSecondary": "Nous contacter",
    "hero.cardCaption":  "🌱 Notre ferme d'ananas",

    // Statistiques
    "stats.varieties":     "Fruits exotiques",
    "stats.freshness":     "De la récolte à l'expédition",
    "stats.ownfarms":      "Cultivé à l'île Maurice",
    "stats.traceability":  "Traçable jusqu'à la parcelle",

    // À propos
    "about.kicker": "À propos",
    "about.title":  "Cultivé et exporté avec soin",
    "about.p1":     "Chez Chi-Agri, nous sommes spécialisés dans l'export de fruits exotiques premium de l'île Maurice. Du champ à la caisse, nous gérons chaque étape pour garantir un fruit frais et de la plus haute qualité.",
    "about.p2":     "Nous nous concentrons exclusivement sur l'ananas Victoria et le fruit de la passion, sourcés directement à Maurice et livrés au marché de Rungis en France.",

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
    "products.title":  "Nos fruits",
    "products.intro":  "Deux fruits exotiques, cultivés à l'île Maurice et disponibles toute l'année.",
    "products.season": "Saison",
    "products.weight": "Poids",

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

    // Contact (home = coordonnées) + Inquiry (page dédiée)
    "contact.kicker": "Contact",
    "contact.title":  "Contactez-nous",
    "contact.intro":  "Importateur, grossiste ou distributeur ? Envoyez-nous une demande.",
    "contact.sendInquiry": "Envoyer une demande",
    "contact.info.title":     "Nos coordonnées",
    "contact.info.personLabel":  "Contact",
    "contact.info.emailLabel":   "Email",
    "contact.info.phoneLabel":   "Téléphone",
    "contact.info.addressLabel": "Adresse",

    "inquiry.kicker": "Demande",
    "inquiry.title":  "Envoyez-nous une demande",
    "inquiry.intro":  "Indiquez-nous le fruit et la quantité qui vous intéressent.",
    "inquiry.back":   "← Retour à l'accueil",
    "contact.form.name":          "Votre nom",
    "contact.form.namePlaceholder":    "Nom complet",
    "contact.form.email":         "Votre email",
    "contact.form.emailPlaceholder":   "vous@entreprise.com",
    "contact.form.company":       "Société",
    "contact.form.companyPlaceholder": "Nom de la société",
    "contact.form.product":       "Produit concerné",
    "contact.form.quantity":      "Quantité",
    "contact.form.quantityPlaceholder": "ex. palettes / tonnes",
    "contact.form.message":       "Message",
    "contact.form.messagePlaceholder": "Votre message",
    "contact.form.submit":        "Envoyer la demande",

    // Footer
    "footer.tagline": "Exportateur de fruits exotiques frais",
    "footer.nav":     "Navigation",
    "footer.contact": "Contact",
    "footer.rights":  "Tous droits réservés.",
    "footer.madeWith":"Cultivé et exporté avec soin depuis l'île Maurice",

    // Divers (libellé du bouton = langue vers laquelle on bascule)
    "lang.toggle": "🇬🇧 EN",
  },
};
