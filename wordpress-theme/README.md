# Chi-Agri — Thème WordPress

Thème sur-mesure reprenant **à l'identique** le design du site statique Chi-Agri,
avec un **contenu entièrement éditable** depuis l'admin WordPress et un support
**bilingue EN/FR** (Polylang).

## Ce qui est éditable (sans toucher au code)

| Zone | Où l'éditer dans l'admin |
|---|---|
| Logo header | Apparence → Personnaliser → Identité du site (logo) |
| Logo footer (texte blanc) | fourni dans le thème (`assets/img/logo-footer.png`) |
| Coordonnées (contact, email, tél, adresse) | Menu **Chi-Agri** → onglet « Général » |
| Image du hero + carrousel « À propos » | Menu **Chi-Agri** → onglet « Images » |
| Chiffres clés (2+, 48h, 100%…) | Menu **Chi-Agri** → onglet « Chiffres clés » |
| Produits (nom, photo, saison, poids, description) | Menu **Produits** (chaque produit = 1 fiche) |
| **Tous les textes** (titres, paragraphes, boutons, formulaire) en **EN et FR** | Menu **Chi-Agri** → onglet « Textes » |
| Formulaire de demande | fonctionne d'origine (envoi email `wp_mail`) |

> ⚙️ Le menu **« Chi-Agri »** ouvre directement la fiche « Réglages du site ».
> **ACF gratuit suffit** — le thème n'utilise aucune fonctionnalité ACF PRO
> (pas de page d'options, ni de répéteur, ni de galerie).

> Le thème affiche le **contenu actuel par défaut** même sans rien configurer :
> chaque champ retombe sur la valeur du site statique.

## Bilingue EN/FR (autonome, sans Polylang)

Le thème gère lui-même les deux langues :
- chaque texte a un champ **EN** et un champ **FR** dans **Chi-Agri → Textes** ;
- le bouton **🇫🇷 FR / 🇬🇧 EN** du header bascule la langue (via `?lang=fr`/`?lang=en`,
  mémorisé par cookie) ;
- la **langue par défaut** se règle dans **Chi-Agri → Général**.

Les produits ont aussi des champs **Nom / Saison / Description** en EN et FR.

## Plugins requis / recommandés (gratuits)

- **Advanced Custom Fields** (version **gratuite**, par WP Engine) — *requis* pour
  éditer le contenu. Sans lui, le site s'affiche avec les valeurs par défaut mais
  rien n'est modifiable dans l'admin. ⚠️ Ne PAS confondre avec l'add-on
  « ACF: CommonMark » (inutile ici).
- (optionnel) **Yoast SEO** ou **Rank Math** — balises SEO

> Polylang n'est **plus nécessaire** : le bilingue est intégré au thème.

## Tester en local

WordPress exige **PHP + MySQL** (GitHub Pages ne suffit pas). Deux options :

### Option A — `@wordpress/env` (Docker + Node)

Depuis `wordpress-theme/` :

```bash
npx @wordpress/env start
```

Ouvre http://localhost:8888 (admin : http://localhost:8888/wp-admin, `admin` / `password`).
Le thème, ACF et Polylang sont installés automatiquement ; un script de dev
(`mu-plugins/chi-seed.php`) crée la page **Inquiry** et 2 produits de démo.
Active le thème **Chi-Agri** dans Apparence → Thèmes.

Pour arrêter :

```bash
npx @wordpress/env stop
```

### Option B — Local (Local by Flywheel), sans terminal

1. Crée un site WordPress dans **Local**.
2. Copie le dossier `chi-agri/` dans `wp-content/themes/`.
3. Active le thème, installe ACF + Polylang. La page « Inquiry » est créée
   automatiquement à l'activation du thème.

## Mise en ligne

Choisir un hébergeur WordPress (OVH, Hostinger, o2switch, Kinsta, WP Engine…),
y installer WordPress, téléverser le dossier `chi-agri/` dans
`wp-content/themes/`, activer le thème et les plugins, puis recréer le contenu
(ou l'importer). Ne pas déployer `mu-plugins/chi-seed.php` (outil de dev).

## Structure

```
chi-agri/
  style.css              en-tête de thème
  functions.php          assets, supports, menus, chaînes Polylang
  front-page.php         accueil (hero + about + produits + contact)
  page-inquiry.php       page « Demande » (formulaire réel)
  index.php              repli générique
  header.php / footer.php
  template-parts/        hero, about, products, contact
  inc/                   helpers, CPT produits, champs ACF, form
  assets/                css (repris à l'identique), js allégé, images
```
