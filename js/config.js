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
    // Logo : "image" (ton fichier, ci-dessous) | "svg" (dessin de secours) | "text"
    // ⭐ Dépose ton vrai logo (PNG/SVG à fond TRANSPARENT) sous ce chemin :
    logoMode: "image",
    logoImage: "assets/logo2.png",
    // Logo vectoriel Chi-Agri : le texte suit la couleur (currentColor), le
    // globe garde ses couleurs. Remplaçable par ton vrai fichier (voir README).
    logoSvg: `<svg class="logo-svg" viewBox="0 0 372 88" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Chi-Agri">
      <text x="0" y="66" fill="currentColor" font-family="'Oswald', 'Arial Narrow', sans-serif" font-weight="300" font-size="70" letter-spacing="3">CHI</text>
      <g transform="translate(160,42)">
        <circle r="34" fill="#3AA451"/>
        <path d="M0,-34 A34,34 0 0,0 0,34 A17,17 0 0,0 0,0 A17,17 0 0,1 0,-34 Z" fill="#1B3FC4"/>
        <circle cx="0" cy="-17" r="5.5" fill="#F2A81E"/>
        <circle cx="0" cy="17" r="5.5" fill="#E5484D"/>
      </g>
      <text x="212" y="66" fill="currentColor" font-family="'Oswald', 'Arial Narrow', sans-serif" font-weight="300" font-size="70" letter-spacing="3">AGRI</text>
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
    // Carrousel « À propos » : ananas Victoria + fruit de la passion appétissant
    aboutSlides: [
      "photo-1694592014176-0ef0c28274f2", // ananas Victoria doré (petit, mûr)
      "photo-1589990423411-5b2cebc1ab3f", // ananas Victoria sur pied
      "photo-1502009285422-74e42ac2fd68", // fruit de la passion (pulpe juteuse)
      "photo-1616077498072-ccba9b178fa5", // fruit de la passion coupé
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
