<?php if(!isset($content_width)) $content_width = 640;
define('CPOTHEME_ID', 'illustrious');
define('CPOTHEME_NAME', 'Illustrious');
define('CPOTHEME_VERSION', '2.2.6');
//Other constants
define('CPOTHEME_LOGO_WIDTH', '195');
define('CPOTHEME_USE_SLIDES', true);
define('CPOTHEME_USE_FEATURES', true);
define('CPOTHEME_USE_PORTFOLIO', true);
define('CPOTHEME_THUMBNAIL_WIDTH', '600');
define('CPOTHEME_THUMBNAIL_HEIGHT', '400');
define('CPOTHEME_PREMIUM_NAME', 'Illustrious Pro');
define('CPOTHEME_PREMIUM_URL', 'http://www.cpothemes.com/theme/illustrious');


//Load Core; check existing core or load development core
$core_path = get_template_directory().'/core/';
if(defined('CPOTHEME_CORELITE')) $core_path = CPOTHEME_CORELITE;
require_once $core_path.'init.php';

$include_path = get_template_directory().'/includes/';

//Main components
require_once($include_path.'setup.php');