<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
if (TL_MODE == 'FE') {
    $GLOBALS['TL_JAVASCRIPT'][] = "/system/modules/regina/html/js/regina.js";
    $GLOBALS['TL_CSS'][] = "/system/modules/regina/html/css/regina.css";
}
// Backend module definition
array_insert($GLOBALS['BE_MOD'], 2, array
(   'regina' => array(
    'regina_config' => array
    (
        'tables' => array('tl_regina'),
        'icon' => 'system/modules/regina/html/img/display.png'
    ),
    'regina_settings' => array
    (
        'tables' => array('tl_regina_settings'),
        'icon' => 'system/themes/default/images/settings.gif'
    )
    )
));

// Eintrag in die Systemwartung
array_insert($GLOBALS['TL_MAINTENANCE'],1,'PurgeImageCache');

$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('reginaClass', 'replaceImageTags');

// Default Werte
$GLOBALS['TL_CONFIG']['prefixRegina'] = 'bild';
$GLOBALS['TL_CONFIG']['hdRatioRegina'] = '2';
$GLOBALS['TL_CONFIG']['mobiRatioRegina'] = '1.5';
$GLOBALS['TL_CONFIG']['widthRegina'] = '500';
$GLOBALS['TL_CONFIG']['heightRegina'] = '500';
$GLOBALS['TL_CONFIG']['minWidthRegina'] = '500';
$GLOBALS['TL_CONFIG']['minHeightRegina'] = '500';
$GLOBALS['TL_CONFIG']['noOldIERegina'] = true;
$GLOBALS['TL_CONFIG']['useCacheRegina'] = true;
$GLOBALS['TL_CONFIG']['cacheDirRegina'] = 'cache';
