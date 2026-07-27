/* ==========================================================================
   content.js — CONTENU STRUCTURÉ (chiffres, produits, producteurs)
   --------------------------------------------------------------------------
   ⭐ Ajoute / modifie / supprime du contenu ICI. Le HTML est généré
   automatiquement : pas de code dupliqué. Chaque entrée est bilingue (en/fr).

   Rappel images : une valeur "photo-xxxx" = image Unsplash (auto-redimensionnée) ;
   un chemin "assets/img/xxx.jpg" = ton propre fichier local.
   ========================================================================== */

/* --- Chiffres clés (bandeau animé qui compte à l'arrivée à l'écran) -------
   value  : le nombre à atteindre
   suffix : "+", "%", "h"... ajouté après le nombre ("" si aucun)
   labelKey : clé de traduction (voir translations.js)                       */
const STATS = [
  { value: 25,  suffix: "+", icon: "🤝", labelKey: "stats.producers" },
  { value: 48,  suffix: "h", icon: "⏱️", labelKey: "stats.freshness" },
  { value: 15,  suffix: "+", icon: "🧺", labelKey: "stats.varieties" },
  { value: 100, suffix: "%", icon: "🛡️", labelKey: "stats.traceability" },
];

/* --- Produits emblématiques ----------------------------------------------
   img    : vraie photo (Unsplash "photo-..." ou "assets/img/...")
   name / season / desc : bilingue (en / fr)
   tag    : petit badge optionnel ("" pour aucun)                            */
const PRODUCTS = [
  {
    img: "photo-1589820296156-2454bb8a6ad1",
    emoji: "🍍",
    name:   { en: "Victoria Pineapple", fr: "Ananas Victoria" },
    season: { en: "Year-round",         fr: "Toute l'année" },
    desc: {
      en: "Small, intensely sweet and fragrant — the signature pineapple of Mauritius.",
      fr: "Petit, intensément sucré et parfumé — l'ananas emblématique de Maurice.",
    },
    tag: { en: "Signature", fr: "Emblématique" },
  },
  {
    img: "photo-1616077498072-ccba9b178fa5",
    emoji: "🍈",
    name:   { en: "Passion Fruit", fr: "Fruit de la Passion" },
    season: { en: "Year-round",    fr: "Toute l'année" },
    desc: {
      en: "Tangy, intensely aromatic and packed with pulp — prized by chefs and juice makers alike.",
      fr: "Acidulé, intensément parfumé et gorgé de pulpe — prisé des chefs comme des jus artisanaux.",
    },
    tag: { en: "Premium", fr: "Premium" },
  },
];

/* --- Producteurs partenaires ---------------------------------------------
   Cliquables : au clic, une fenêtre affiche les infos détaillées.
   img        : portrait / photo (Unsplash "photo-..." ou "assets/img/...")
   name       : nom de l'exploitation / du producteur (placeholder)
   region     : région de Maurice (en / fr)
   short      : phrase d'accroche affichée sur la carte (en / fr)
   founded / hectares : petits chiffres affichés dans la fenêtre
   specialties: liste de badges (en / fr)
   bio        : texte long affiché dans la fenêtre (en / fr)                 */
const PRODUCERS = [
  {
    img: "photo-1654526645468-9ae1cde48fe2",
    name: "[PRODUCTEUR_1]",
    region: { en: "North — Pamplemousses", fr: "Nord — Pamplemousses" },
    short: {
      en: "Family orchards specialising in pineapple and mango.",
      fr: "Vergers familiaux spécialisés en ananas et mangue.",
    },
    founded: "1998",
    hectares: "18 ha",
    specialties: {
      en: ["Pineapple", "Mango", "Passion fruit"],
      fr: ["Ananas", "Mangue", "Fruit de la passion"],
    },
    bio: {
      en: "On the fertile northern plains of Pamplemousses, this family orchard has grown tropical fruit for three generations. Trees are tended by hand and fruit is picked only at full ripeness, then cooled within hours of harvest. Every crate is labelled and traceable back to its plot.",
      fr: "Sur les plaines fertiles du nord, à Pamplemousses, ce verger familial cultive des fruits tropicaux depuis trois générations. Les arbres sont soignés à la main et les fruits cueillis à pleine maturité, puis refroidis quelques heures seulement après la récolte. Chaque cagette est étiquetée et traçable jusqu'à sa parcelle.",
    },
  },
  {
    img: "photo-1666452165223-a369d541ff0a",
    name: "[PRODUCTEUR_2]",
    region: { en: "East — Flacq", fr: "Est — Flacq" },
    short: {
      en: "Sustainable smallholdings ripening lychees in the humid east.",
      fr: "Petites exploitations durables où mûrissent les letchis dans l'est humide.",
    },
    founded: "2005",
    hectares: "9 ha",
    specialties: {
      en: ["Lychee", "Banana", "Chilli"],
      fr: ["Letchi", "Banane", "Piment"],
    },
    bio: {
      en: "In the humid east around Flacq, these smallholders practise low-input, sustainable farming. Their lychees, prized for their floral sweetness, are hand-harvested during the short December season and shipped within days to reach France at their peak.",
      fr: "Dans l'est humide, autour de Flacq, ces petits exploitants pratiquent une agriculture durable à faibles intrants. Leurs letchis, prisés pour leur douceur florale, sont récoltés à la main pendant la courte saison de décembre et expédiés en quelques jours pour arriver en France à leur apogée.",
    },
  },
  {
    img: "photo-1615909495126-3554c248bf33",
    name: "[PRODUCTEUR_3]",
    region: { en: "Centre — Curepipe highlands", fr: "Centre — Hauts de Curepipe" },
    short: {
      en: "Cool-climate growers of crisp vegetables and herbs.",
      fr: "Producteurs d'altitude de légumes croquants et d'herbes.",
    },
    founded: "2011",
    hectares: "12 ha",
    specialties: {
      en: ["Vegetables", "Herbs", "Heart of palm"],
      fr: ["Légumes", "Herbes", "Cœur de palmier"],
    },
    bio: {
      en: "On the cool central highlands near Curepipe, mild temperatures and mineral-rich volcanic soils produce exceptionally crisp vegetables and aromatic herbs. Careful crop rotation keeps the land healthy and the harvest consistent all year round.",
      fr: "Sur les hauts plateaux frais du centre, près de Curepipe, des températures douces et des sols volcaniques riches en minéraux donnent des légumes exceptionnellement croquants et des herbes aromatiques. Une rotation soignée des cultures maintient la terre en bonne santé et une récolte constante toute l'année.",
    },
  },
];
