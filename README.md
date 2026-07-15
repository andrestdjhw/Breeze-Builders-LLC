# Breeze Builders — WordPress Theme (scaffold v0.1)

Custom theme for **Breeze Builders LLC** (Remodeling · HVAC · Electrical · General Contracting — Las Vegas / Henderson / North Las Vegas).
Copy and structure derived from the 828 strategic brief. **English-primary**, Home + core pages.

## Stack
Plain PHP templates + CSS design tokens (no build step — runs directly in Local by Flywheel).
Asset versioning via `filemtime()` (828 convention). Vanilla JS only (mobile nav, before/after slider, footer year).
> To port to the 828 pattern (Tailwind v4 + wp-scripts + React islands), the component parts map 1:1 to React components — say the word.

## Install
1. Copy the `breeze-builders/` folder into `wp-content/themes/`.
2. **Appearance → Themes → Activate** "Breeze Builders".
3. Create these Pages and assign templates (Page → Attributes → Template):
   | Page | Slug | Template |
   |---|---|---|
   | Home | (set as front page) | *default* → uses `front-page.php` |
   | About | `about` | About / Why Breeze |
   | Remodeling | `remodeling` | Service — Remodeling |
   | HVAC | `hvac` | Service — HVAC |
   | Electrical | `electrical` | Service — Electrical |
   | General Contractor | `general-contractor` | Service — General Contractor |
   | Contact | `contact` | Contact / Get Estimate |
4. **Settings → Reading →** set Home to a static page.
5. **Appearance → Menus →** create a "Primary Menu", add the pages, assign to *Primary* location. (A fallback menu renders until then.)

## File map
- `functions.php` — setup, enqueues, `breeze_config()` (NAP/brand — single source of truth), `breeze_part()` helper, and `breeze_schema()` (LocalBusiness JSON-LD for local SEO).
- `assets/css/tokens.css` — palette (828 approved: midnight `#14213D` / deep `#0A3D62`, steel `#6C7A89`, amber `#C8863C`) + type scale.
- `assets/css/main.css` — all component styles.
- `template-parts/` — hero, trust-strip, services-grid, fear-answer (8-fear signature device), proof, financing, service-area, cta-band, service-page (reusable service layout).
- `template-*.php` — the 4 service pages (thin; content lives in the template, layout in `service-page` part).

## Populated from the 828 Client Profile
NAP is now live in `breeze_config()`: phone **(702) 491-4767**, HQ **871 Coronado Center Drive, Suite 200, Henderson, NV 89052**, domain **breezebuildersgc.com**, extended coverage **CA · AZ (by project)**. LocalBusiness schema anchors NV only.

## Before launch — open items (confirm with client)
Grep the theme for `TODO`. Still pending confirmation:
- **#1** exact brand HEX (values in place, approved-branding) + logo → `tokens.css`, `.brand__mark` in `header.php`
- **#2** confirm (702) 491-4767 as primary NAP line
- **#3** real photos (before/after, team, fleet) → `assets/img/`
- **#4** live Google reviews embed + count → `trust-strip.php`, `proof.php`
- **#5** confirm price ranges → `template-remodeling.php`
- **#6** financing partner + terms → `financing.php`
- **#6b** final brand lockup: "Breeze Builders" vs "Breeze Builders GC" → `breeze_config('brand')`
- **#8** exact license numbers (B + C-2) → `breeze_config()`
- **#9** owner name + business email; wire the contact form (Gravity/HubSpot) → `page-contact.php`
- **#10** CA (CSLB) + AZ (ROC) license status + cities served → gates CA/AZ service pages

## Phase 2 — full architecture (per Client Profile §6)
- **Service-by-city pages** (local SEO): one page per trade × core city — e.g. "HVAC in Henderson", "Remodeling in Las Vegas".
- **Commercial** (selective): tenant improvements, commercial HVAC/electrical, property maintenance — secondary to residential.
- **Projects / Gallery** with trade filters + before/after; **Reviews** page; **Financing** page; **Service Areas** (NV anchored, CA/AZ extended).
- **FAQ**; **Spanish** option (Polylang) for the ~18% Hispanic market.
- GBP connection + embedded map + live reviews widget; SSL; performance pass.
