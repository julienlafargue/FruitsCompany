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
    // Nom AFFICHÉ (le logo). Astuce : le texte entre <b></b> est coloré (2 tons).
    name: "Chi-<b>Agri</b>",
    // Nom "brut" (sans HTML) — utilisé pour le SEO, l'email, le titre d'onglet.
    nameText: "Chi-Agri",
    tagline: "Exporter of fresh exotic fruits",
    logoMode: "text",                  // "text" (nom + icône) ou "image"
    logoImage: "assets/logo.svg",      // utilisé seulement si logoMode = "image"
  },

  /* --- Coordonnées de contact -------------------------------------------- */
  contact: {
    email: "contact@example.com",      // ← à remplacer
    phone: "+230 5 000 0000",          // Maurice (à remplacer)
    phoneFrance: "",                   // (laisse "" pour masquer)
    addressMauritius: "Port Louis, Mauritius", // ← adresse exacte à venir
    addressFrance: "",                 // (laisse "" pour masquer)
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
      en: "Chi-Agri — Exporter of fresh exotic fruits from Mauritius",
      fr: "Chi-Agri — Exportateur de fruits exotiques frais de l'île Maurice",
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
