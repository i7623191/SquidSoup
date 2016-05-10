== Think Up Themes ==

- By Think Up Themes, http://www.thinkupthemes.com/

Requires at least:	4.0.0
Tested up to:		4.5.0

Grow is the free version of the multi-purpose professional theme (Grow Pro) ideal for a business or blog website. The theme has a responsive layout, HD retina ready and comes with a powerful theme options panel with can be used to make awesome changes without touching any code. The theme also comes with a full width easy to use slider. Easily add a logo to your site and create a beautiful homepage using the built-in homepage layout.

-----------------------------------------------------------------------------
	Support
-----------------------------------------------------------------------------

- For support for Grow (free) please post a support ticket over at the https://wordpress.org/support/theme/grow.

-----------------------------------------------------------------------------
	Frequently Asked Questions
-----------------------------------------------------------------------------

- None Yet


-----------------------------------------------------------------------------
	Limitations
-----------------------------------------------------------------------------

- RTL support is yet to be added. This is planned for inclusion in v1.1.0


-----------------------------------------------------------------------------
	Copyright, Sources, Credits & Licenses
-----------------------------------------------------------------------------

Grow WordPress Theme, Copyright 2015 Think Up Themes Ltd
Grow is distributed under the terms of the GNU GPL

The following opensource projects, graphics, fonts, API's or other files as listed have been used in developing this theme. Thanks to the author for the creative work they made. All creative works are licensed as being GPL or GPL compatible.

    [1.01] Item:        Underscores (_s) starter theme - Copyright: Automattic, automattic.com
           Item URL:    http://underscores.me/
           Licence:     Licensed under GPLv2 or later
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.02] Item:        Redux Framework
           Item URL:    https://github.com/ReduxFramework/ReduxFramework
           Licence:     GPLv3
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.03] Item:        html5shiv (jQuery file)
           Item URL:    http://code.google.com/p/html5shiv/
           Licence:     MIT
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.04] Item:        PrettyPhoto
           Item URL:    http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
           Licence:     GPLv2
           Licence URL: http://www.gnu.org/licenses/gpl-2.0.html

    [1.05] Item:        ImagesLoaded
           Item URL:    https://github.com/desandro/imagesloaded
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.06] Item:        Waypoints
           Item URL:    https://github.com/imakewebthings/jquery-waypoints
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.07] Item:        ResponsiveSlides
           Item URL:    https://github.com/viljamis/ResponsiveSlides.js
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.08] Item:        ScrollUp
           Item URL:    https://github.com/markgoodyear/scrollup
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.09] Item:        Font Awesome
           Item URL:    http://fortawesome.github.io/Font-Awesome/#license
           Licence:     SIL Open Font &  MIT
           Licence OFL: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.10] Item:        Twitter Bootstrap
           Item URL:    https://github.com/twitter/bootstrap/wiki/License
           Licence:     Apache 2.0
           Licence URL: http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------
	Changelog
-----------------------------------------------------------------------------

Version 1.0.6
- Fixed:   Correct textdaomin added to pagination function.
- Fixed:   get_option method removed to retrieve variable vlaues due to PHP errors. Now got using global variables set in 00.variables.php. Reverted back to pre v1.0.4.
- Updated: Link to gmpg.org in header.php now compatible with https sites.
- Removed: wp_reset_query() removed from template-sitemap.php.

Version 1.0.5
- Updated: esc_html() removed from line 361 in 02.homepage.php to prevent error on sites using PHP earlier than v5.5

Version 1.0.4
- New:     Title tag support added using native WordPress wp_title() feature.
- Updated: 404 error code now translatable within 404.php file.
- Updated: Various functions which are not currently being used have been removed.
- Updated: All references to meta variables removed as these are not currently being used.
- Updated: All variables where the value is not know with certainly now escaped on output.
- Updated: All translatable strings which are output in html attributes escaped using esc_attr__().
- Updated: Links to widgets page changed from /wp-admin/widgets.php to esc_url( admin_url( 'widgets.php' ) ).
- Updated: Theme options values no longer user global variables. Values pulled using get_option() within the function itself.
- Removed: Twitter meta removed from header.php.
- Removed: wp_reset_query() removed from archive.php, page.php and single.php.
- Removed: 00.variables.php no longer required as variables values are pulled usin get_option() within function.

Version 1.0.3
- Fixed:   Duplicate comma removed from line 1496 in options.php. Site now loads correctly.
- Fixed:   Check on whether site title and description removed. Now site title and description both output if user chooses to option in Site Identity.

Version 1.0.2
- New:     Support added for WP v4.5 custom logo options.
- Updated: Logo image width set to "auto".
- Updated: Theme admin scripts only load on customizer page.
- Updated: Upgrade button moved to active theme section of customizer.
- Updated: Logo options removed from theme options section of customizer.
- Updated: HTML will be stripped from description inputs to if added inline.
- Updated: Pagination functionaity uses WP core function - the_posts_pagination().
- Updated: Various text strings in functions.php and 02.homepage.php internationalized.
- Updated: Page name on archive pages output using WP core function - the_archive_title().
- Updated: Translation .pot file updated to take account of recent updates in core theme files.
- Updated: Demo content only displays to users with atleast "edit_theme_options" rights. The user must actively switch on the sections (slider, featured content).
- Updated: Description inputs in "Homepage (Featured)" changed from textarea to text fields to ensure it's clear that the input is intended only for minimal content.
- Removed: Retina.js removed as it's no longer given custom_logo support.
- Removed: Custom pagination function removed - thinkup_input_pagination().

Version 1.0.1
- New:     ThinkUpSlider replaced with 3 slide page slider.
- Fixed:   PHP notices fixed for comments form - changes made comments.php file.
- Fixed:   PHP notices fixed upgrade section in theme options - changes made field_thinkup_upgrade.php file.
- Fixed:   Custom titles now display correctly on mobile layouts. Issue previously caused titles to be squashed on smaller screens.
- Fixed:   Customizer theme options sections now fully scroll to the bottom. Previously sections with vertical scroll cut-off when using Firefox browser.
- Updated: Margin added to alignleft and alignright classes.
- Updated: Site preview does not move when customizer expands for theme options section.
- Updated: Setting 'use_cdn' set to false in options.php to prevent loading of external resources.
- Updated: Setting 'save_defaults' set to false to ensure no theme settings are saved on activation.
- Updated: Homepage (Content) section renamed to Homepage (Featured) to make it clear that the section is intended for minimal content.
- Updated: Upgrade information moved to theme options section to prevent confusion with 3rd party code which may also be using the customizer.
- Removed: Favicon option removed from theme options.
- Removed: Social sharing removed from blog section of theme options.

Version 1.0.0
- Initial release.