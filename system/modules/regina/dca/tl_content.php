<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['gallery'] = str_replace(',numberOfItems', ',numberOfItems,imageSizeType', $GLOBALS['TL_DCA']['tl_content']['palettes']['gallery']);
$GLOBALS['TL_DCA']['tl_content']['palettes']['image'] = str_replace(',caption', ',caption,imageSizeType', $GLOBALS['TL_DCA']['tl_content']['palettes']['image']);
$GLOBALS['TL_DCA']['tl_content']['palettes']['hyperlink'] = str_replace(',useImage', ',useImage,imageSizeType', $GLOBALS['TL_DCA']['tl_content']['palettes']['hyperlink']);

$GLOBALS['TL_DCA']['tl_content']['fields']['imageSizeType'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageSizeType'],
    'inputType' => 'select',
    'options_callback' => array('tl_content_ext', 'loadImageTypes'),
    'exclude' => true,
    'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['text']['eval']['rte'] = 'tinyRegina';

class tl_content_ext extends tl_content
{
    public function loadImageTypes()
    {
        $options = array('default' => "Standard");
        $objEvent = $this->Database->prepare("SELECT title, alias FROM tl_regina order by title")->execute();

        foreach ($objEvent->fetchAllAssoc() as $row) {
            $options[$row['alias']] = $row['title'];
        }
        return $options;
    }
}