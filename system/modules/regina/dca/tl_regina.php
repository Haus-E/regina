<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
$GLOBALS['TL_DCA']['tl_regina'] = array
(
    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => false,
        //'ctable'                      => array('tl_regina'),
        'switchToEdit' => true
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 1,
            'fields' => array('title'),
            'flag' => 1,
            'panelLayout' => 'filter;search,limit',

        ),
        'label' => array
        (
            'fields' => array('title', 'alias'),
            'format' => '%s => %s',
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_regina']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'copy' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_regina']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_regina']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_regina']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_regina']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array('textUseActive', 'textBoxUse', 'useExtraImage'),
        'default' => '{imageData},title,alias,width,height,resize,scaleImg,quality,imgType,position,grayscaleActive,visibility,transcolor,constraints,slice,croping;{textData:hide},textUseActive,textBoxUse;{extraImage:hide},useExtraImage',
    ),

    // Subpalettes
    'subpalettes' => array
    (
        'textUseActive' => 'fontNormal,fontBold,fontSize,fontColor,textBoxOffset,textAlign,textCase',
        'textBoxUse' => 'textBoxBGColor,textBoxHeight,textPadding,textTransparency,textFactor',
        'useExtraImage' => 'addImage',
    ),

    // Fields
    'fields' => array
    (
        'title' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['title'],
            'inputType' => 'text',
            'exclude' => true,
            'filter' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50', 'doNotCopy' => true)
        ),
        'alias' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['alias'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('rgxp' => 'alnum', 'doNotCopy' => true, 'spaceToUnderscore' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'save_callback' => array
            (
                array('tl_regina', 'generateAlias')
            )
        ),
        'width' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['width'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),
        'height' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['height'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
        ),
        'resize' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['resize'],
            'inputType' => 'checkbox',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50 m12')
        ),
        'scaleImg' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['scaleImg'],
            'inputType' => 'checkbox',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50 m12')
        ),
        'position' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['position'],
            'inputType' => 'checkbox',
            'exclude' => true,
            'eval' => array('tl_class' => 'w50 m12')
        ),
        'grayscaleActive' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['grayscaleActive'],
            'inputType' => 'checkbox',
            'exclude' => true,
            'eval' => array('tl_class' => 'w50 clr')
        ),
        'quality' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['quality'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'imgType' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['imgType'],
            'inputType' => 'select',
            'options' => array('jpeg', 'png', 'gif'),
            'reference' => &$GLOBALS['TL_LANG']['tl_regina']['options_labels'],
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'visibility' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['visibility'],
            'inputType' => 'text',
            'exclude' => true,
            'default' => 100,
            'eval' => array('maxlength' => 6, 'tl_class' => 'w50')
        ),
        'transcolor' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['transcolor'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 6, 'tl_class' => 'w50')
        ),
        'constraints' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['constraints'],
            'inputType' => 'select',
            'options' => array('both', 'width', 'height'),
            'reference' => &$GLOBALS['TL_LANG']['tl_regina']['options_labels'],
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50', 'includeBlankOption' => true)
        ),
        'slice' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['slice'],
            'inputType' => 'select',
            'options' => array('height', 'width'),
            'reference' => &$GLOBALS['TL_LANG']['tl_regina']['options_labels'],
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50', 'includeBlankOption' => true)
        ),
        'croping' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['croping'],
            'inputType' => 'select',
            'options' => array('center_center'),
            'reference' => &$GLOBALS['TL_LANG']['tl_regina']['options_labels'],
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50', 'includeBlankOption' => true)
        ),

        'textUseActive' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textUseActive'],
            'inputType' => 'checkbox',
            'eval' => array('submitOnChange' => true, 'tl_class' => 'clr')
        ),
        'fontSize' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['fontSize'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'fontNormal' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['fontNormal'],
            'inputType' => 'fileTree',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'files' => true, 'filesOnly' => true, 'fieldType' => 'radio', 'extensions' => 'ttf,otf', 'path' => 'tl_files', 'maxlength' => 255, 'tl_class' => '')
        ),
        'fontBold' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['fontBold'],
            'inputType' => 'fileTree',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'files' => true, 'filesOnly' => true, 'fieldType' => 'radio', 'extensions' => 'ttf,otf', 'path' => 'tl_files', 'maxlength' => 255, 'tl_class' => '')
        ),
        'fontColor' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['fontColor'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'textBoxUse' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textBoxUse'],
            'inputType' => 'checkbox',
            'eval' => array('submitOnChange' => true, 'tl_class' => 'clr')
        ),
        'textBoxOffset' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textBoxOffset'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
//        'textBoxBGColor' => array
//        (
//            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textBoxBGColor'],
//            'inputType' => 'text',
//            'exclude' => true,
//            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
//        ),
        'textBoxHeight' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textBoxHeight'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'textPadding' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textPadding'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'textAlign' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textAlign'],
            'inputType' => 'select',
            'options' => array('l' => 'left', 'c' => 'center', 'r' => 'right'),
            'reference' => &$GLOBALS['TL_LANG']['tl_regina']['options_labels'],
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'textCase' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textCase'],
            'inputType' => 'select',
            'options' => array('' => 'noTransform', 'upper' => 'uppercase', 'lower' => 'lowercase'),
            'reference' => &$GLOBALS['TL_LANG']['tl_regina']['options_labels'],
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'textTransparency' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textTransparency'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'textFactor' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['textFactor'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('maxlength' => 255, 'tl_class' => 'w50')
        ),
        'useExtraImage' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['useExtraImage'],
            'inputType' => 'checkbox',
            'eval' => array('submitOnChange' => true, 'tl_class' => 'clr')
        ),
        'addImage' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_regina']['addImage'],
            'inputType' => 'multiColumnWizard',
            'exclude' => true,
            'eval' => array(
                'columnFields' => array(
                    'addImageFile' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_regina']['addImageFile'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array('style' => 'width:314px; margin-right:19px;')
                    ),
                    'addImageOffset' => array(
                        'label' => &$GLOBALS['TL_LANG']['tl_regina']['addImageOffset'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array('style' => 'width:250px')
                    )
                )
            )
        ),
    )
);

class tl_regina extends Backend
{
    public function generateAlias($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '') {
            $autoAlias = true;
            $varValue = standardize('img' . $this->restoreBasicEntities($dc->activeRecord->title));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_regina WHERE id=? OR alias=?")
            ->execute($dc->id, $varValue);

        // Check whether the page alias exists
        if ($objAlias->numRows > 1) {
            if (!$autoAlias) {
                throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
            }

            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }
}