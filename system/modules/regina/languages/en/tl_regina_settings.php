<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['tl_regina_settings']['regina_legend'] = 'Funktionen für Retina-Displays';

$GLOBALS['TL_LANG']['tl_regina_settings']['regina'] = array(
    'useRegina' => array('Activate Regina', 'Enable image optimizations for HD and mobile displays.'),
    'noOldIERegina' => array('disable lazy load for older IEs', 'Deactive lazy load for Internet Explorer versions <= 8.'),
    'prefixRegina' => array('Trigger for RewriteRule', 'Set a unique trigger for RewriteRule z.B. <i>image</i>'),
    'useCacheRegina' => array('Activate image cache', 'Cache images on server side.'),
    'cacheDirRegina' => array('image cache directory', 'Geben Sie den Ordner an in den die berechneten Bilder gecached werden sollen. (Es wird versucht den Ordner anzulegen)'),
    'cacheDirRegina' => array('image cache directory', 'Set a folder for all calculatet images. Regina tries to create the folder.'),

    'rewriteRuleRegina' => array(
        'title' => 'RewriteRule',
        'desc' => 'RewriteRule ^'.$GLOBALS['TL_CONFIG']['prefixRegina'].'/([\%\]\[A-Za-z0-9\-_]*)/(.*)$ system/modules/regina/img/img.php?plain=true&type=$1&file=$2 [qsa,L]'
    ),

    'hdRatioRegina' => array('Pixel ratio for HD devices', 'Set the pixel ratio for high-resolution displays, i.e. iPad Retina'),
    'mobiRatioRegina' => array('Pixel ratio for mobile devices', 'Set the pixel ratio for mobile displays'),

    'defaultSettingsRegina' => array(
        'title' => 'Default values',
        'desc' => '<p>Set default values for images without a given type.</p>'
    ),
    'widthRegina' => array('Width', 'Default width for images without a given type.'),
    'heightRegina' => array('Height', 'Default height for images without a given type.'),
    'minWidthRegina' => array('Minimal width', 'If the image is smaller than this specification, it is treated as a transparent icon.'),
    'minHeightRegina' => array('Minimal height', 'If the image is smaller than this specification, it is treated as a transparent icon.'),

    'explainRegina' => array(
        'title' => 'Explanations',
        'desc' =>
            "<p>Please note the following:</p>"
            . "<ul>"
            . "<li>Set a trigger below and <b>save</b> the page.</li>"
            . "<li>Copy the the hole line exactly as it is into the <b>.htaccess</b> file in the <b>[root]</b> directory. </li>"
            . "<li>RewriteRules <b>must</b> be activated. The server <b>must</b> support mod_rewrite.</li>"
            . "<li>To use high quality images, each image have to be saved in double resolution on the server. This means: If you want to show an image at 350*150 pixel, the image should have a resolution of 700*300 pixel at least.</li>"
            . "</ul>"
    )
);
 ?>
 
 
 