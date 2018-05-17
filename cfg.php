<?php

require_once __DIR__ . '/vendor/autoload.php';

/* ******* END INI SETTINGS ******* */
$dbconfig = PHPArcade\Core::getDBConfig();

$inicfg = PHPArcade\Core::getINIConfig();
if ($inicfg['environment']['state'] === "dev") {
    error_reporting(-1);
    ini_set('display_errors', 'On');
}


/* Define site constants */
define('INST_DIR', $_SERVER['DOCUMENT_ROOT'] . '/');
define('IMG_DIR', INST_DIR . 'img/');
define('IMG_DIR_NOSLASH', INST_DIR . 'img');
define('SITE_URL', sprintf('%s://%s/', isset($_SERVER['HTTPS']) &&
$_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME']));
define('ADMIN_THEME_PATH', INST_DIR . 'Zdmin/index.php');
define('ADMIN_SITE_THEME_PATH', INST_DIR . 'Zdmin/index.php');
define('CHARSET', 'UTF-8');
define('EXT_IMG', '.png');
define('GRAVATAR_URL', 'https://www.gravatar.com/avatar/');
define('IMG_URL', SITE_URL . 'img/');
define('SITE_META_DESCRIPTION', $dbconfig['metadesc']);
define('SITE_META_KEYWORDS', $dbconfig['metakey']);
define('SITE_META_TITLE', $dbconfig['sitetitle']);
define('SITE_THEME_URL', SITE_URL . 'plugins/site/themes/' . $dbconfig['theme'] . '/');
define('SITE_THEME_PATH', INST_DIR . 'plugins/site/themes/' . $dbconfig['theme'] . '/index.php');
define('SITE_URL_ADMIN', SITE_URL . 'Zdmin/');
define('SWF_DIR', INST_DIR . 'swf/');
define('SWF_URL', SITE_URL . 'swf/');
define('TOP_SCORE_COUNT', 10);

/* ===== LIBRARIES USED THROUGHOUT THE SITE */

/* CDNJS - v3.3.7 - BOOTSTRAP */
define('CSS_BOOTSTRAP_ADMIN', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css');
define('JS_BOOTSTRAP_ADMIN', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js');

/* CDNJS - v2.2.2 - BOOTSTRAP TOGGLE */
define('CSS_BOOTSTRAP_TOGGLE', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css');
define('CSS_BOOTSTRAP_TOGGLE_SRI', 'sha256-rDWX6XrmRttWyVBePhmrpHnnZ1EPmM6WQRQl6h0h7J8=');

define('JS_BOOTSTRAP_TOGGLE', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js');
define('JS_BOOTSTRAP_TOGGLE_SRI', 'sha256-eZNgBgutLI47rKzpfUji/dD9t6LRs2gI3YqXKdoDOmo=');

/* CDNJS - v4.7.0 - FONT AWESOME */
define('CSS_FONTAWESOME', SITE_URL . 'vendor/fortawesome/font-awesome/css/font-awesome.min.css');

/* CUSTOM - INPUT COLORS */
define('CSS_INPUTCOLORS', SITE_URL . '/plugins/site/themes/admin/assets/css/inputcolors.min.css');

/* GOOGLE RECAPTCHA */
define('JS_GOOGLE_RECAPTCHA', 'https://www.google.com/recaptcha/api.js');

/* CDNJS - v3.2.1 - JQUERY */
define('JS_JQUERY', SITE_URL . 'vendor/components/jquery/jquery.min.js');

/* CDNJS - v1.12.1 - JQUERY UI */
define('JS_JQUERY_UI', SITE_URL . 'vendor/components/jqueryui/jquery-ui.min.js');

/* CDNJS - v2.7.0 - JQUERY METISMENU */
define('CSS_METISMENU', SITE_URL . 'vendor/onokumus/metismenu/dist/metisMenu.min.css');
define('JS_METISMENU', SITE_URL . 'vendor/onokumus/metismenu/dist/metisMenu.min.js');

/* CDNJS - v10.6.0 - VANILLA-LAZYLOAD */
define('JS_LAZYLOAD', 'https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/10.6.0/lazyload.min.js');
define('JS_LAZYLOAD_SRI', 'sha256-l0s3Oq/rsgmMWQx+yA6VOM3YJNNlI0999aEB5HqYADw=');

/* CDNJS - v3.3.7+1 SB ADMIN 2 THEME */
define('CSS_SB_ADMIN_2', 'https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/css/sb-admin-2.min.css');
define('CSS_SB_ADMIN_2_SRI', 'sha256-WeMGw+d+qR+l2h9TzmC+jTME4zy5zYzG8E6FbPikzeM=');

define('JS_SB_ADMIN_2', 'https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/js/sb-admin-2.min.js');
define('JS_SB_ADMIN_2_SRI', 'sha256-Y0Z5pT4qPGaoUSHoxW+J8fIWjQnjc7v03WBEUnt9SQ0=');

/* CDNJS - v2.2.0 - SWFOBJECT */
define('JS_SWFOBJECT', SITE_URL . 'vendor/koala-framework/library-swfobject/swfobject.js');

/* CUSTOM - TABLESORT */
define('JS_TABLESORT', SITE_URL . 'plugins/site/themes/admin/assets/js/tablesort.min.js');

/* CUSTOM - USERFILTER */
define('JS_TABLEFILTER', SITE_URL . 'plugins/site/themes/admin/assets/js/tablefilter.min.js');

/* STANDARD URLS FOR EXTERNAL SITES */
define('URL_FACEBOOK', 'https://www.facebook.com/');
define('URL_GITHUB', 'https://github.com/');
define('URL_GITHUB_PHPARCADE', 'https://github.com/Sageth/phpArcade/');
define('URL_TWITTER', 'https://www.twitter.com/');
/* ====== END CONSTANTS ===== */


/* ******* START INI SETTINGS ******* */

/* Session params - keep session data for AT LEAST 1 hour (60s * 60m)*/
ini_set('session.gc_maxlifetime', 3600);

/* Set Secure cookie if HTTPS */
if (PHPArcade\Administrations::getScheme() === 'https://') {
    ini_set('session.cookie_secure', 1);
}

/* Set cookie to http only */
ini_set('session.cookie_httponly', 1);

/* Set Timezone */
date_default_timezone_set('America/New_York');

/* Enable debug logging in non-prod */



