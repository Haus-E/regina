<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');
$GLOBALS['TL_DCA']['tl_regina_settings'] = array
(
    // Config
    'config' => array
    (
        'dataContainer' => 'File',
        'enableVersioning' => true,
        'closed' => true
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (),
        'global_operations' => array
        (
            'all' => array
            ()
        ),

        'label' => array
        (),
        'operations' => array
        ()
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array('useRegina'),
        'default' => 'useRegina'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        'useRegina' => '{regina_legend},noOldIERegina,explainRegina,prefixRegina,rewriteRuleRegina,useCacheRegina,cacheDirRegina,hdRatioRegina,mobiRatioRegina,defaultSettingsRegina,widthRegina,heightRegina,minWidthRegina,minHeightRegina'
    ),

    // Fields
    'fields' => array
    (
        'useRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['useRegina'],
            'inputType' => 'checkbox',
            'eval' => array('submitOnChange' => true, 'tl_class' => 'w50')
        ),
        'noOldIERegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['noOldIERegina'],
            'inputType' => 'checkbox',
            'eval' => array('tl_class' => 'w50')
        ),

        'prefixRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['prefixRegina'],
            'default' => 'bild',
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'useCacheRegina' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['useCacheRegina'],
            'inputType' => 'checkbox',
            'exclude' => true,
            'eval' => array('tl_class' => 'w50 m12')
        ),
        'cacheDirRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['cacheDirRegina'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('tl_class' => 'w50'),
            'save_callback' => array(array('regina_options', 'cacheDir'))
        ),
        'rewriteRuleRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['rewriteRuleRegina'],
            'input_field_callback' => array('regina_options', 'explaination')
        ),

        'hdRatioRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['hdRatioRegina'],
            'inputType' => 'text',
            'default' => '2',
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),

        'mobiRatioRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['mobiRatioRegina'],
            'inputType' => 'text',
            'default' => '1.5',
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),

        'explainRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['useRegina'],
            'input_field_callback' => array('regina_options', 'explaination')
        ),
        'defaultSettingsRegina' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['useRegina'],
            'input_field_callback' => array('regina_options', 'explaination')
        ),
        'widthRegina' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['widthRegina'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),
        'heightRegina' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['heightRegina'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),

        'minWidthRegina' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['minWidthRegina'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),
        'minHeightRegina' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina_settings']['regina']['minHeightRegina'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        )
    )
);


class regina_options extends Backend
{
    public function explaination($var)
    {
        $this->Template = new BackendTemplate("explaination");
        $this->Template->title = $GLOBALS['TL_LANG']['tl_regina_settings']['regina'][$var->__get('field')]['title'];
        $this->Template->desc = $GLOBALS['TL_LANG']['tl_regina_settings']['regina'][$var->__get('field')]['desc'];

        return $this->Template->parse();
    }

    public function cacheDir($var)
    {
        mkdir(TL_ROOT . '/' . $var . '/');
        copy(TL_ROOT . '/system/modules/regina/html/imgcache/index.html', TL_ROOT . '/' . $var . '/index.html');
        return $var;
    }
}

?>