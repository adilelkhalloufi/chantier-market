# BTP360 WordPress Theme (ACF + Seeder)

This theme converts your static BTP pages into WordPress templates using ACF fields and seeded data.

## Included

- Custom post type: `listing`
- Custom taxonomy: `listing_category`
- Page templates:
  - `front-page.php` (home)
  - `page-bulldozer.php`
  - `page-login-register.php`
  - `page-dashboard-client.php`
  - `page-depose-annonce.php`
- Single template:
  - `single-listing.php`
- Archive template:
  - `archive-listing.php`
- Local ACF registration in PHP (`inc/acf-fields.php`)
- Admin seeder screen in Tools > BTP360 Seeder

## Install

1. Copy the folder `btp360-acf` to `wp-content/themes/`.
2. Install and activate plugin **Advanced Custom Fields**.
3. Activate theme **BTP360 ACF Theme** from Appearance > Themes.
4. Go to Tools > BTP360 Seeder.
5. Click **Run Seeder Now**.

## What the Seeder Creates

- Main listing categories and subcategories from the static website.
- Listings (DAF XF460 + bulldozer list + homepage cards).
- News posts from the static actualites section.
- Pages:
  - Accueil
  - Login/Register
  - Dashboard Client
  - Deposer une annonce
  - Bulldozer
- Front page setting and primary menu entries.

## Notes

- Image fields are URL-based for fast import from static paths.
- If you want WordPress Media Library attachments instead of URL strings, I can add a media import pass.
- The login/register and dashboard interactions are UI demo behavior, same spirit as your static prototype.
