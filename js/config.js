/* ==========================================================================
   config.js — CONFIGURATION CENTRALE DU SITE
   --------------------------------------------------------------------------
   ⭐ C'est LE fichier à modifier en premier.
   Tout ce qui identifie l'entreprise (nom, logo, coordonnées, images de fond)
   est ici. Aucun de ces éléments n'est écrit "en dur" dans le HTML.
   ========================================================================== */

const SITE_CONFIG = {

  /* --- Identité de l'entreprise ------------------------------------------ */
  company: {
    name: "Chi-Agri",
    nameText: "Chi-Agri",
    tagline: "Exporter of fresh exotic fruits",
    // Logo : "svg" (dessin ci-dessous, s'adapte au fond) | "image" (fichier) | "text"
    logoMode: "svg",
    logoImage: "assets/logo.svg",      // utilisé seulement si logoMode = "image"
    // Logo vectoriel Chi-Agri : le texte suit la couleur (currentColor), le
    // globe garde ses couleurs. Remplaçable par ton vrai fichier (voir README).
    logoSvg: `<svg class="logo-svg" viewBox="0 0 360 84" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Chi-Agri">
      <text x="0" y="64" fill="currentColor" font-family="'Bebas Neue', Impact, sans-serif" font-size="72" letter-spacing="4">CHI</text>
      <g transform="translate(158,40)">
        <circle r="33" fill="#3AA451"/>
        <path d="M0,-33 A33,33 0 0,0 0,33 A16.5,16.5 0 0,0 0,0 A16.5,16.5 0 0,1 0,-33 Z" fill="#1B3FC4"/>
        <circle cx="0" cy="-16.5" r="5.5" fill="#F2A81E"/>
        <circle cx="0" cy="16.5" r="5.5" fill="#E5484D"/>
      </g>
      <text x="204" y="64" fill="currentColor" font-family="'Bebas Neue', Impact, sans-serif" font-size="72" letter-spacing="4">AGRI</text>
    </svg>`,
  },

  /* --- Coordonnées de contact -------------------------------------------- */
  contact: {
    person: "Jaysen Chinapyel",
    role:   "Director",
    email: "chiagri_Mauritius@gmail.com",
    phone: "+230 57803810",
    phoneFrance: "",
    addressMauritius: "Sanashee Towers, Reserve Street, Port Louis, Mauritius",
    addressFrance: "",
  },

  /* --- Images du site ----------------------------------------------------
     💡 Deux façons de renseigner une image :
        1) Un identifiant Unsplash "photo-xxxxxxxx" → chargé depuis le web,
           redimensionné automatiquement (pratique pour démarrer).
        2) Un chemin local, ex. "assets/img/hero.jpg" → utilise TON fichier.
     Pour passer en 100 % local : dépose tes photos dans assets/img/ et
     remplace simplement les valeurs ci-dessous par leur chemin.            */
  images: {
    hero:        "photo-1513415277900-a62401e19be4", // lagon de Maurice (Le Morne)
    heroCard:    "photo-1649960861739-113b8588eaf8", // carte flottante : ferme d'ananas
    // Carrousel « À propos » : uniquement ananas / fruit de la passion + fermes
    aboutSlides: [
      "photo-1546546683-7fe6f2a456d3",    // champ d'ananas
      "photo-1604360829141-704ec65eda94", // régime d'ananas sur pied
      "photo-1628341423248-4b8c5c51a3cd", // fleur / vigne de passiflore
      "photo-1502009285422-74e42ac2fd68", // fruit de la passion coupé
    ],
  },

  /* --- Langue ------------------------------------------------------------ */
  defaultLang: "en",            // "en" ou "fr"

  /* --- SEO (référencement) ----------------------------------------------
     ⭐ Textes optimisés pour import/export de fruits & légumes, Maurice, France.
     Remplace `url` par ton vrai domaine une fois le site en ligne.          */
  seo: {
    url: "https://exemple-chi-agri.com/",              // ← ton domaine
    ogImage: "photo-1649960861739-113b8588eaf8",       // image de partage (ferme d'ananas)
    title: {
      en: "Chi-Agri | Exporter of fresh exotic fruits from Mauritius",
      fr: "Chi-Agri | Exportateur de fruits exotiques frais de l'île Maurice",
    },
    description: {
      en: "Chi-Agri is a Mauritian exporter of fresh exotic fruits: Victoria pineapple and passion fruit, grown on our own farms in Mauritius. Based in Port Louis.",
      fr: "Chi-Agri, exportateur mauricien de fruits exotiques frais : ananas Victoria et fruit de la passion, cultivés dans nos fermes à l'île Maurice. Basé à Port Louis.",
    },
    keywords: "Chi-Agri, exotic fruit export Mauritius, Victoria pineapple, passion fruit, pineapple farm Mauritius, Mauritius fruit exporter, Port Louis, fresh exotic fruits, ananas Victoria, fruit de la passion, exportateur fruits Maurice",
  },

  /* NB : la charte graphique est celle du drapeau mauricien 🇲🇺.
     Les couleurs se modifient dans css/style.css → bloc :root (tout en haut). */
};

/* --------------------------------------------------------------------------
   Helper interne : transforme une valeur d'image en URL utilisable.
   - "photo-xxxx"       → URL Unsplash redimensionnée
   - "assets/..." / URL → renvoyée telle quelle
   (utilisé par main.js — pas besoin d'y toucher)
   -------------------------------------------------------------------------- */
function resolveImage(src, w, h) {
  if (!src) return "";
  if (src.indexOf("photo-") === 0) {
    const size = "auto=format&fit=crop&q=75&w=" + (w || 1200) + (h ? "&h=" + h : "");
    return "https://images.unsplash.com/" + src + "?" + size;
  }
  return src; // chemin local ou URL complète
}
