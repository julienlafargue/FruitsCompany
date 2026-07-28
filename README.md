# Chi-Agri — site vitrine (fruits exotiques frais de l'île Maurice 🇲🇺)

Site vitrine **statique** (HTML / CSS / JavaScript pur, sans framework ni étape de build)
pour **Chi-Agri**, exportateur de fruits exotiques frais de l'île Maurice
(ananas Victoria & fruit de la passion, cultivés sur ses propres fermes).

- ✅ Fonctionne en ouvrant `index.html` (ou via GitHub Pages)
- ✅ **2 pages** : `index.html` (one-page) + `inquiry.html` (formulaire de demande)
- ✅ Bilingue **EN / FR** avec bouton de bascule (persistance `localStorage`)
- ✅ Charte aux **couleurs du drapeau mauricien** 🇲🇺
- ✅ Hero immersif (lagon de Maurice + carte « ferme d'ananas »), titre au dégradé
  « drapeau qui flotte », carrousel « À propos », navigation latérale, animations
- ✅ **SEO** (meta, Open Graph, Twitter, JSON-LD, bilingue)
- ✅ Contenu 100 % centralisé : tout se modifie sans toucher au HTML

> ℹ️ À finaliser (fournis par le client) : logo, adresse exacte à Port Louis,
> chiffres des stats « À propos », email/téléphone. La section « Nos producteurs »
> a été retirée pour l'instant (données conservées dans `content.js` pour un retour futur).

---

## 🗂️ Structure du projet

```
.
├── index.html            # Page principale (one-page, aucun texte en dur)
├── inquiry.html          # 2e page : formulaire de demande
├── css/
│   └── style.css         # Styles + variables de thème (couleurs en haut)
├── js/
│   ├── config.js         # ⭐ Nom, logo, coordonnées, images, SEO
│   ├── content.js        # ⭐ Produits (+ producteurs, en réserve)
│   ├── translations.js   # ⭐ Tous les textes EN / FR
│   └── main.js           # Logique (i18n, menu, carrousel, formulaire)
├── assets/
│   ├── logo.svg          # Logo placeholder (si logoMode = "image")
│   ├── favicon.svg       # Favicon placeholder
│   └── img/              # Photos placeholder des producteurs
├── .nojekyll             # Désactive Jekyll sur GitHub Pages
└── README.md
```

> 💡 Les 3 fichiers marqués ⭐ sont **les seuls** à modifier dans 99 % des cas.

---

## ✏️ Comment tout personnaliser

### 1. Changer le nom de l'entreprise et le logo
Fichier : **`js/config.js`** → objet `company`

```js
company: {
  name: "Mauri<b>lis</b>",     // nom AFFICHÉ (nom factice) — le <b> = 2e couleur du logo
  nameText: "Maurilis",        // nom BRUT (sans HTML) : SEO, email, titre d'onglet
  tagline: "Primeurs de l'île Maurice",
  logoMode: "text",            // "text" = nom + icône | "image" = fichier
  logoImage: "assets/logo.svg" // utilisé seulement si logoMode = "image"
}
```

- Le nom actuel (**Maurilis**) est un **placeholder** : remplace `name` et
  `nameText` par ton vrai nom. Le texte entre `<b></b>` est coloré (logo 2 tons).
- **Logo texte** (par défaut) : change juste `name`. L'icône est un emoji `🍃`
  défini dans `js/main.js` (fonction `buildLogo`) — remplace-le si besoin.
- **Logo image** : mets `logoMode: "image"`, dépose ton fichier dans `assets/`
  et indique son chemin dans `logoImage`.

### 2. Changer les coordonnées (email, téléphone, adresses, réseaux)
Fichier : **`js/config.js`** → objets `contact` et `social`.
L'email du `contact` est aussi celui qui reçoit les messages du formulaire.
Laisse un champ à `""` pour le masquer automatiquement (ex. téléphone France, réseaux sociaux).

### 🖼️ Changer les images (photos)
Les photos du site (hero, à propos, fonds de sections) sont centralisées dans
**`js/config.js`** → objet `images`. Les photos des produits et des producteurs
sont dans **`js/content.js`** (champ `img`).

Deux façons de renseigner une image, partout :
- **un identifiant Unsplash** `"photo-xxxxxxxx"` → chargé depuis le web et
  redimensionné automatiquement (pratique pour démarrer, aucune image à fournir) ;
- **un chemin local** `"assets/img/ma-photo.jpg"` → utilise **ton propre fichier**.

👉 Pour passer en **100 % local / hors-ligne** : dépose tes photos dans
`assets/img/` et remplace les valeurs `"photo-..."` par leur chemin. Aucune autre
modification nécessaire.

**Carrousel « À propos »** : les photos qui défilent sont la liste
`images.aboutSlides` dans `js/config.js`. Ajoute / retire / réordonne librement.

### 🔎 SEO (référencement)
Les textes SEO sont centralisés dans **`js/config.js`** → objet `seo`
(`title`, `description`, `keywords` en EN/FR) et optimisés pour
« import/export fruits & légumes, île Maurice, France ». `js/main.js` met à jour
automatiquement le `<title>`, la meta description et les balises Open Graph /
Twitter selon la langue choisie.

À faire avant la mise en ligne : remplace `seo.url` (et les `href` des balises
`canonical` / `hreflang` / `og:url` dans `index.html`) par ton vrai domaine, et
adapte le bloc de **données structurées** (`application/ld+json`) dans `index.html`
(nom, adresses).

### 3. Changer la palette de couleurs
La charte reprend les **couleurs officielles du drapeau mauricien** 🇲🇺.
Fichier : **`css/style.css`** → bloc `:root` tout en haut.

```css
:root {
  --flag-red:    #EA2839;
  --flag-blue:   #1A206D;
  --flag-yellow: #FFD500;
  --flag-green:  #00A551;
  /* ...les couleurs de marque, fonds, textes et dégradés en découlent... */
}
```

Change une valeur = tout le site se met à jour (titres, boutons, dégradé du
titre, ruban, barres des chiffres…). **Aucune autre modification nécessaire.**
Le dégradé « drapeau » du mot surligné dans le titre est la variable
`--gradient-flag`.

### 4. Modifier les textes (EN / FR)
Fichier : **`js/translations.js`**. Chaque clé existe en `en` et en `fr`.
Pour changer un texte, édite la valeur ; pour en ajouter un, crée la clé dans
les **deux** langues puis ajoute `data-i18n="ta.cle"` sur l'élément HTML voulu.

### 5. Ajouter / modifier des produits
Fichier : **`js/content.js`** → tableau `PRODUCTS`. Copie un bloc :

```js
{
  img:    "photo-1589820296156-2454bb8a6ad1",   // photo Unsplash OU "assets/img/xxx.jpg"
  emoji:  "🍍",                                  // petite pastille sur la photo
  name:   { en: "Victoria Pineapple", fr: "Ananas Victoria" },
  season: { en: "Year-round",         fr: "Toute l'année" },
  desc:   { en: "…", fr: "…" },
  tag:    { en: "Signature", fr: "Emblématique" }, // badge optionnel ("" = aucun)
}
```

Les chiffres du bandeau (producteurs, 48h, variétés…) se modifient dans le
tableau **`STATS`** du même fichier (`value` + `suffix`).

### 6. Modifier les producteurs (+ fenêtre détaillée)
Fichier : **`js/content.js`** → tableau `PRODUCERS`. Chaque carte est **cliquable**
et ouvre une fenêtre (modal) avec les infos détaillées. Un bloc contient :

```js
{
  img:    "photo-1654526645468-9ae1cde48fe2",   // photo (Unsplash ou locale)
  name:   "[PRODUCTEUR_1]",                       // nom (placeholder)
  region: { en: "North — …", fr: "Nord — …" },
  short:  { en: "…", fr: "…" },                   // phrase sur la carte
  founded: "1998",                                // affiché dans la fenêtre
  hectares: "18 ha",                              // affiché dans la fenêtre
  specialties: { en: ["Pineapple", …], fr: ["Ananas", …] }, // badges
  bio:    { en: "…", fr: "…" },                   // texte long de la fenêtre
}
```

Ajoute autant de producteurs que voulu : les cartes et les fenêtres sont
générées automatiquement.

---

## 🚀 Déploiement sur GitHub Pages

Le site est 100 % statique : aucune configuration serveur.

### Option recommandée — branche `main`, dossier racine
1. Pousse le code sur GitHub (branche `main`).
2. Repo → **Settings** → **Pages**.
3. **Build and deployment** → *Source* : **Deploy from a branch**.
4. *Branch* : **`main`** — *Folder* : **`/ (root)`** → **Save**.
5. Le site est publié sous quelques minutes sur
   `https://<utilisateur>.github.io/<nom-du-repo>/`.

> Le fichier **`.nojekyll`** (déjà présent) évite que GitHub applique Jekyll.

### Variante — dossier `/docs`
Si tu préfères garder le code source ailleurs : place le site dans un dossier
`docs/`, puis en étape 4 choisis *Folder* : **`/docs`**.

### Test en local
Double-clique sur `index.html`, **ou** lance un petit serveur :
```bash
python3 -m http.server 8000
# puis ouvre http://localhost:8000
```

> **Connexion Internet** : par défaut, les photos (Unsplash) et les polices
> Google Fonts sont chargées depuis le web. Sans connexion, le site reste
> fonctionnel (les polices basculent sur celles du système). Pour un site
> totalement autonome, remplace les identifiants `"photo-..."` par des fichiers
> locaux dans `assets/img/` (voir « Changer les images » ci-dessus).

---

## 🧩 Notes techniques

- **Aucune dépendance externe** ni étape de build.
- i18n maison : `data-i18n="cle"` (texte) et `data-i18n-attr="placeholder:cle"` (attribut).
- Contenu injecté au chargement par `js/main.js` ; l'ordre des `<script>` compte
  (`config` → `content` → `translations` → `main`).
- Chaque section fait **au moins la hauteur d'un écran** (`min-height: 100vh` sur
  desktop ; hauteur libre sur mobile). Les chiffres clés sont intégrés dans la
  section « À propos ».
- Responsive mobile / tablette / desktop, menu hamburger, `prefers-reduced-motion` respecté.
- Animations en JS vanilla : `IntersectionObserver` (apparitions au scroll +
  compteurs), fruits flottants et ruban défilant générés au chargement.
- Fiches producteurs : fenêtre (modal) accessible (clavier + touche Échap).
- **Header immersif** : transparent au-dessus du hero, il devient une barre pleine
  et ombrée au défilement (classe `.scrolled` gérée par `js/main.js`), avec un
  fin liseré aux couleurs du drapeau.
- **Texture d'ambiance** : `assets/pattern-leaves.svg` en filigrane des sections
  claires (règle `.mesh::after`). Ajuste `stroke-opacity` dans le SVG pour
  l'intensité, ou `background-size` dans le CSS pour l'espacement.
- Formulaire de contact **sans backend** : il ouvre le client mail de l'utilisateur
  (`mailto:`). Pour de vrais envois côté serveur, branche un service type
  Formspree / Getform sur le `<form>` dans `js/main.js` (fonction `buildMailto`).
