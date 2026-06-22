=== CPS | Age Verification ===
Contributors: CherryPickStudios, Surbma
Donate link: https://surbma.com/donate/
Tags: age verify, age verification, adult, confirmation, restrict
Requires at least: 5.2
Tested up to: 7.0
Stable tag: 8.2.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An easy to use age verification plugin for any membership or 18+ adult sites or any sites, that requires confirmation from a visitor.

== Description ==

>NEW WooCommerce Settings Arrived for Premium version!

This plugin is showing a Popup for visitors to verify their ages on your page. YES button will close the Popup and visitors can continue reading your content. NO button will redirect visitors to another URL, set by you to inform them about your policy.

The CPS | Age Verification plugin can be used on 18+ adult sites, restricted content websites or any websites, where a visitor confirmation about age, knowledge, warning is necessary to continue reading the website. Even can be used for online marketing tricks.

This plugin can be an alternative for other Cookie Notice plugins to inform users that your site uses cookies and to comply with the EU cookie law regulations.

### Cache Proof Technology

The CPS | Age Verification plugin is compatible with all kind of cache systems. It even works with all managed WordPress hostings' server side cache solutions.

**IMPORTANT:** the popup is intentionally obtrusive and can not be closed, except clicking on the yes or no buttons. In the Premium version, you can enable the close function, but it is not recommended.

### Free version features

- Popup Positions
- Customizations
- Developer Friendly
- WPML & Polylang Compatible

### Additional features in the Premium version

- Header Image Field / Logo
- Set Background Image
- Popup Styles
- Popup Themes
- Button Styles
- Dark mode
- Other Customizations
- Membership Mode
- Close Popup
- Popup Delay
- Cookie Control
- WooCommerce Settings

### Features in details

#### Popup Positions
You can set where to show the popup, for example: only on frontpage, only on category pages, only on special pages or posts, even for Custom Post Types and more...

#### Customizations
Every text is customizable, even the button's texts! You can also set the design of the buttons and you have the option to make the first or the second button to be the confirmation button.

#### Developer Friendly
If you enable debug mode, popup will show always, on every refresh, so you can test how it works.

#### WPML & Polylang Compatible
If you have a multilingual website, you can set the texts for each language with WPML String Translation add-on.

#### Header Image Field / Logo
You can upload an image or logo, that will display above the title. It can be an icon also. Make your popup to fit your website and brand.

#### Set Background Image
Custom background image for the popup. It will cover the entire screen with your beautiful background. One of the best design feature to wow your visitors.

#### Popup Styles
There are popup styles to choose the look and feel of the popup: Default, Almost Flat and Gradient. Fit the style to your website easily.

#### Popup Themes
There are popup themes to choose the design, you like. The Full Page Themes are hiding the entire content behind the popup. There are a lot of design settings to make the popup fit your website design. Dark mode is also available.

#### Button Styles
Choose from one of the pre-defined button styles to fit your message and design. You can set custom style for your "yes" and for your "no" button individually.

#### Dark mode
Welcome to the dark side! If you prefer dark design, this feature is for you. Choose this option also, when you have a dark background image.

#### Membership Mode
You can disable popup for logged in users, so your members will not see any popups at all. You can always show the popup to all visitors, who are not logged in, even if they clicked on the Yes button. There is a "One button mode" also, that will hide the second button, so you can show only one option to your visitors. This option is best paired with the "always show to all visitors, who are not logged in" option, so you can keep your content safe.

#### Close Popup
Yes, I know, the point of an age verification popup is, that it can not be closed without the consent. But some of you missed this feature, so it is built in. Don't use, if you don't need it!

#### Popup Delay
Set your preferred time to delay the popup after the page is loaded. Maybe you want your visitors to have a few seconds to see the webpage and only then ask them to consent your conditions.

#### Cookie Control
Set cookie expiration for visitors, so the popup won't show again in X days, you set.

#### WooCommerce Settings
Set the popup to show it on WooCommerce pages: Shop, Cart, Checkout, Account pages, single Products or Product category and tag archive pages.

### Developer informations

#### Do you want to contribute to the plugin development?

You can find the plugin source code on GitHub:

- [https://github.com/cherrypickstudios/surbma-yes-no-popup](https://github.com/cherrypickstudios/surbma-yes-no-popup)

#### More projects on GitHub:

- [https://github.com/CherryPickStudios](https://github.com/CherryPickStudios)

You are welcome to contribute to our free softwares.

#### Want to know more about us?

Check our website: [Cherry Pick Studios](https://www.cherrypickstudios.com/)

== Installation ==

### Automatic installation

1. Search for the plugin *CPS | Age Verification* under "Plugins -> Add New" menu item.
2. Click on the "Install Now" button in the plugin's box.
3. After installation, click on the "Activate" button in the same box to activate *CPS | Age Verification* plugin.
4. Under the plugin's settings menu, set up the popup.
5. That's all. :)

### Manual installation on WordPress admin

1. Download the plugin from here: [CPS | Age Verification](https://downloads.wordpress.org/plugin/surbma-yes-no-popup.zip)
2. Upload the `surbma-yes-no-popup.zip` file on the "Plugins -> Add New" page by clicking on the "Upload Plugin" button.
3. Activate the *CPS | Age Verification* plugin after the upload.
4. Under the plugin's settings menu, set up the popup.
5. That's all. :)

### Manual installation via FTP

1. Download the plugin from here: [CPS | Age Verification](https://downloads.wordpress.org/plugin/surbma-yes-no-popup.zip)
2. Uncompress the zip file on your local computer.
3. Upload the `surbma-yes-no-popup` folder into your `/wp-content/plugins/` folder.
4. Activate the *CPS | Age Verification* plugin on the "Plugins" page.
4. Under the plugin's settings menu, set up the popup.
6. That's all. :)

== Frequently Asked Questions ==

= What is this plugin good for? =

This plugin shows a simple popup with two options: Yes or No. One option is set a cookie, so popup will disappear for the visitor and the other option is redirecting the visitor to another url set by you. This solution is very good for +18 adult sites or any other website, that require any confirmation. This plugin can be used by online marketers also.

= What does Surbma mean? =

It is the reverse version of my last name. ;)

== Changelog ==

= 8.2.0 =

Release date: 2026-06-22

FIXED

- Fixed broken `allowed_tags()` call on the settings page that could cause a fatal error when viewing allowed HTML tags help text.
- Fixed missing `popupshowposts` field sanitization when saving settings.
- Removed duplicate `popupshowpages` sanitization line in the settings validator.

OTHER

- Standardized direct-access guards (`defined( 'ABSPATH' ) || exit`) across all plugin PHP files.
- Added proper output escaping across popup markup, admin screens, and CPS SDK templates (`esc_html`, `esc_attr`, `esc_url`, `esc_js`, `wp_kses_post`).
- Replaced `stripslashes()` with `wp_unslash()` before escaping stored option values.
- Popup title, text, and button labels are now escaped on output; popup text uses `wp_kses_post()`.
- Enqueued popup CSS filename is now sanitized with `sanitize_file_name()`.
- Settings page `$_GET['settings-updated']` check and premium/free field output hardened.
- CPS plugins page remote JSON output is escaped; invalid API responses are handled safely.
- Admin sidebar and welcome notice URLs and HTML output sanitized.
- Code formatting aligned with WordPress and project PHP style rules.

PREMIUM

- Freemius SDK updated to latest version.
- Freemius bootstrap uses the premium plugin directory constant.
- Text domain loading path aligned with WordPress best practices.

= 8.1.1 =

Release date: 2026-06-22

FIXED

- Fixed visitor confirmation cookie not being saved, which caused the age verification popup to appear on every page load.
- Fixed popup button click handlers not firing when another plugin on the same page also used generic `button1` / `button2` element IDs.
- Fixed the popup markup being scheduled more than once per page when multiple visibility rules matched at the same time.

OTHER

- Popup action buttons now use unique IDs (`surbma-ynp-button1`, `surbma-ynp-button2`) and bind events within the popup modal container.
- Popup output is now rendered only once per page load.

= 8.1.0 =

Release date: 2026-05-19

FIXED

- Fixed `_load_textdomain_just_in_time` PHP notice on WordPress 6.7+ (translations are now loaded on `init`, not before).
- Fixed admin settings menu missing and “Sorry, you are not allowed to access this page” when opening the settings screen directly.
- Fixed PHP warnings on the settings page when no options have been saved yet (fresh install).
- Fixed incorrect use of `esc_attr__()` and `esc_attr_e()` on dynamic option values in the popup output and settings fields (now uses `esc_attr()`, `esc_url()`, and integer casting where appropriate).

OTHER

- Restored `load_plugin_textdomain()` on the `init` hook (replacing the 8.0.1 removal that did not resolve the notice).
- Deferred translatable settings option labels to `admin_init` so they no longer run at plugin load time.
- Tested with WordPress 7.0 version.

PREMIUM

- Freemius SDK updated to latest version.

= 8.0.1 =

Release date: 2026-05-11

OTHER

- Removed the `load_plugin_textdomain()` call.
- Tested with WordPress 7.0 version.

PREMIUM

- Freemius SDK updated to latest version.
- Minimum PHP requirement updated to 7.4 version.

= 8.0 =

Release date: 2023-07-11

NEW

- Popup can now set to show on specified post tags archive pages and on posts, that have the specified tags.

OTHER

- Code optimizations.
- WooCommerce settings are preserved, even if Premium license is not valid.

PREMIUM

- NEW - Show popup on all product pages.
- NEW - Show popup on specified product category pages and single product pages, that have the specified categories.
- NEW - Show popup on specified product tag pages and single product pages, that have the specified tags.

= 7.8 =

Release date: 2023-07-05

PREMIUM

- Freemius SDK updated to latest version.

= 7.7 =

Release date: 2023-04-08

PREMIUM

- Freemius SDK updated to 2.5.6 version.

= 7.6 =

Release date: 2023-03-25

OTHER

- Tested with WordPress 6.2 version.

PREMIUM

- Freemius SDK updated to 2.5.5 version.

= 7.5 =

Release date: 2022-09-15

OTHER

- Premium version fee updated to current price in admin notification.
- Tested with WordPress 6.1 version.

= 7.4 =

Release date: 2022-03-03

OTHER

- Tested with WordPress 5.9 version.

PREMIUM

- Freemius SDK updated to 2.4.3 version.

= 7.3 =

Release date: 2021-03-13

FIXES

- Fixes some PHP warnings.
- Popup display conditions are refactored.
- Fixed checking, when visitor is on the redirected page.

OTHER

- Tested with WordPress 5.7 version.
- Changed minimum PHP requirement.

PREMIUM

- Freemius SDK updated to 2.4.2 version.

= 7.2 =

Release date: 2020-10-11

OTHER

- Tested with WordPress 5.5 version.
- PREMIUM - Freemius SDK updated to 2.4.0.1 version.

= 7.1 =

Release date: 2020-04-25

OTHER

- CPS SDK updated to 6.0 version.

= 7.0 =

Release date: 2020-04-24

NEW

- PREMIUM - New settings for WooCommerce pages: Shop, Cart, Checkout, Account and Product archives.

FIXES

- Minor CSS fix for popup.

OTHER

- CPS SDK updated to 5.10 version.
- Modifications in description.

= 6.2 =

Release date: 2020-04-21

OTHER

- Let Freemius show coupon field.

= 6.1 =

Release date: 2019-08-23

Minor, but important changes under the hood. Sorry, no new features now. It is safe to update the plugin.

OTHER

- Added missing descriptions.
- Tested with WordPress 5.3 version.
- Updated to use a new way to deploy it to wp.org repo.
- PREMIUM - Freemius SDK updated to 2.3.2 version.

= 5.2 =

Release date: 2019-08-23

It is a minor release with a new CPS SDK under the hood. It is safe to update the plugin on a production website.

OTHER

- CPS SDK updated to 5.3 version.

= 5.1 =

Release date: 2019-08-21

This is a maintenance release with some small fixes. It is safe to update the plugin on a production website.

FIXES

- Force remove any margin or padding above the popup's header and footer elements.
- Popup background CSS fix, if no background image is set.
- Minor text modifications and typo fixes.

= 5.0 =

Release date: 2019-07-24

The Age Verification Premium is here! There are a lot of new and fantastic features to manage and design your Age Verification popup. Please consider to buy the Premium version not only for the new features, but for supporting our work.

IMPORTANT! A lot of new codes are added and modified. The logic of the design is changed under the hood. There are options also, that were moved to Premium only features. These options can not be changed in the free version, but you can keep your current options without losing it.

NEW

- New premium options added to the admin.
- PREMIUM - Add Image to the header.
- PREMIUM - Add background image to the popup.
- PREMIUM - A lot of cool design features added, like Dark mode, Vertical centering, Large modifier, etc.
- PREMIUM - You can enable closing the popup with a button, ESC or clicking on the background.
- PREMIUM - Give delay to the popup.

ENHANCEMENTS

- Code optimization from the ground up.
- A lot of security hardening for input elements.
- Validation enhancements.
- Added new field for WPML translation.

OTHER

- Changes in the description.
- Settings page sidebar changes.
- Welcome notice added.

= 4.0 =

Release date: 2019-07-18

Welcome in the CPS world! Plugin is rebranded for Cherry Pick Studios brand. This release added a new popup image option to show an image or logo on the popup. There is also a new option to choose the style of the popup window and buttons. The CPS SDK is added to the plugin.

NEW

- New plugin name and brand.
- Image field for the popup.
- Three new style: default, almost flat, gradient.

ENHACEMENTS

- UIkit framework added to the plugin.
- UIkit is updated to 2.27.5 version.
- Javascript functions got unique names to avoid conflicts.
- The admin function has been switched to CPS SDK.
- CSS and JS files are moved to assets folder.
- UIkit framework moved to vendors folder.
- Admin menu moved under the CPS Plugins main menu.

OTHER

- Tested with WordPress 5.2 version.
- Added minimum PHP version requirement.

= 3.0 =

- NEW - Dynamic post type selection. Automatically shows all available public post types to choose. IMPORTANT! You have to set these options again after the upgrade!
- Tested with WordPress 5.0 version.

= 2.2 =

- NEW - Simple versioning.
- NEW - Plugin name change: Surbma | Age Verification Yes/No Popup

= 2.1.0 =

- Added WPML compability, so now options can be translated with WPML's String Translation.

= 2.0.1 =

- Admin UI code enhancements.

= 2.0.0 =

- NEW admin UI.
- Added Donation link.
- Tested with WordPress 4.9 version.

= 1.6.0 =

- Membership mode! New options for membership sites.
- Added "Always show Popup for NOT logged in users" option.
- Added "One button mode (Show only Popup Button 1)" option.
- Added "Except on this page" option to "EVERYWHERE" option, to let you choose one page, where the popup will not show up. Good for registration or login pages.

= 1.5.0 =

- Improved cookie read method to make it compatible with server side caching.
- Added Debug mode option to settings page.
- Added Hide Popup for logged in users option to settings page.
- Tested with WordPress 4.8 version.

= 1.4.0 =

- Added new condition: post category.

= 1.3.1 =

- Minor CSS fix for buttons with long text.

= 1.3.0 =

- NEW Feature: Themes. There are 3 new themes added now and more are coming. Check out the two new full page themes to hide everything behind the popup!

= 1.2.1 =

- Admin styles are loading from local file, instead of external CDN. This is a strict plugin development rule.

= 1.2.0 =

- First version to prepare for the official WordPress repo.
- Added option to conditionally show popup.
- Added option to set cookie expiration.
- Added debug mode, so popup will show always.

= 1.1.0 =

- A lot of changes to make it work actually.
- Added settings page.
- Every text can be modified.

= 1.0.0 =

- Initial commit.
