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
    // Nom AFFICHÉ (le logo). Nom factice le temps d'avoir le vrai.
    // Astuce : le texte entre <b></b> est coloré (2 tons dans le logo).
    name: "Mauri<b>lis</b>",
    // Nom "brut" (sans HTML) — utilisé pour le SEO, l'email, le titre d'onglet.
    nameText: "Maurilis",
    tagline: "Primeurs de l'île Maurice",
    logoMode: "text",                  // "text" (nom + icône) ou "image"
    logoImage: "assets/logo.svg",      // utilisé seulement si logoMode = "image"
  },

  /* --- Coordonnées de contact -------------------------------------------- */
  contact: {
    email: "contact@example.com",
    phone: "+230 5 000 0000",          // Maurice
    phoneFrance: "+33 6 00 00 00 00",  // France (laisse "" pour masquer)
    addressMauritius: "Port-Louis, Île Maurice",
    addressFrance: "Rungis, France",
  },

  /* --- Réseaux sociaux (laisse "" pour masquer un lien) ------------------- */
  social: {
    linkedin: "",
    instagram: "",
    facebook: "",
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
    heroCard:    "photo-1707282399877-8d57c412c5c4", // carte "plantation" flottante (papayers)
    // Carrousel défilant de la section « À propos » (ajoute/retire des photos librement)
    aboutSlides: [
      "photo-1768734836361-68606214611c", // ananas au marché
      "photo-1545830790-68595959c491",    // producteur souriant
      "photo-1659822887922-c1386185cc6b", // panier de légumes frais
      "photo-1592864554447-5e40d96e2b21", // mains tenant la récolte
    ],
    producersBg: "photo-1765055237527-f92fdd1a2c68", // plantation vue du ciel
    whyBg:       "photo-1509440159596-0249088772ff", // caisses de produits frais
  },

  /* --- Langue ------------------------------------------------------------ */
  defaultLang: "en",            // "en" ou "fr"

  /* --- SEO (référencement) ----------------------------------------------
     ⭐ Textes optimisés pour import/export de fruits & légumes, Maurice, France.
     Remplace `url` par ton vrai domaine une fois le site en ligne.          */
  seo: {
    url: "https://exemple-maurilis.com/",              // ← ton domaine
    ogImage: "photo-1513415277900-a62401e19be4",       // image de partage (réseaux sociaux)
    title: {
      en: "Maurilis — Fresh fruit & vegetable export from Mauritius to France",
      fr: "Maurilis — Export de fruits & légumes frais de l'île Maurice vers la France",
    },
    description: {
      en: "Maurilis exports fresh Mauritian fruits and vegetables to France: Victoria pineapple, lychees, mangoes, chillies. Direct sourcing from partner growers, full traceability, controlled cold chain. B2B import/export specialist.",
      fr: "Maurilis exporte les fruits et légumes frais de l'île Maurice vers la France : ananas Victoria, letchis, mangues, piments. Sourcing direct chez les producteurs, traçabilité totale, chaîne du froid maîtrisée. Spécialiste import/export B2B.",
    },
    keywords: "export fruits légumes Maurice France, import export île Maurice, fruits tropicaux Maurice, ananas Victoria, letchis Maurice, mangues Maurice, piments Maurice, grossiste fruits exotiques, importateur fruits et légumes France, fruits et légumes frais Maurice, primeurs Maurice, Mauritius fruit export, tropical fruit importer France",
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
