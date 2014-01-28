<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
class reginaClass extends Frontend
{
    public function replaceImageTags($strContent, $strTemplate)
    {
        $this->import('Database');
        if ($GLOBALS['TL_CONFIG']['useRegina']) { //} && ($GLOBALS['TL_CONFIG']['noOldIERegina']) && (($this->Environment->agent->browser == 'ie') && ($this->Environment->agent->version < 9))) {
            preg_match_all("/<img(.*?)>/s", $strContent, $matches);
            $attrFilter = array('width', 'height');
            foreach ($matches[1] as $key_img => $val) {
                $replace_string = '';
                if (preg_match("/ (.*?)=\"(.*?)\"/", $val) > 0) {
                    preg_match_all("/(.*?)=\"(.*?)\"/", $val, $attrArr);
                    $attrArray = array();
                    foreach ($attrArr[0] as $key => $value) {
                        $attr = trim($attrArr[1][$key]);
                        $attrValue = trim($attrArr[2][$key]);

                        if ($attr == "src" && strpos(strtolower(trim($attrValue)), 'http') === false) {
                            if (strpos($attrValue, $GLOBALS['TL_CONFIG']['prefixRegina']) === false) {
                                $attrValue = array('/' . $GLOBALS['TL_CONFIG']['prefixRegina'] . '/', (substr($attrValue, 0, 1) != '/' ? '/' : '') . $attrValue);
                                if ($attrArray['data-type'] == '') {
                                    $attrArray['data-type'] = 'default ';
                                }
                            }
                            $attrArray[$attr] = 'system/modules/regina/html/img/dummy.gif';
                            $attrArray['data-source'] = $attrValue;
                        } else {
                            if ($attr == 'data-type') {
                                $attrArray[$attr] = $attrValue;
                            } else {
                                $attrArray[$attr] .= $attrValue . ' ';
                            }
                        }
                    }

                    $res = $this->Database->prepare("select position, lazyLoad from tl_regina where alias = ?")->execute(trim($attrArray['data-type']));
                    $result = $res->fetchAssoc();
                    if ($result['position'] == 1) {
                        $attrArray['class'] .= 'lazyImgPosition ';
                    }

                    if ($result['lazyLoad'] != 1 && strpos(strtolower(trim($attrArray['src'])), 'http') === false || $GLOBALS['TL_CONFIG']['noOldIERegina'] && (($this->Environment->agent->browser == 'ie') && ($this->Environment->agent->version < 9))) {
                        $attrArray['src'] = $attrArray['data-source'];
                    } else {
                        $attrArray['class'] .= 'lazyimg ';
                    }

                    $replace_string = '<img ';
                    foreach ($attrArray as $attr => $attrValue) {
                        if (!in_array($attr, $attrFilter) || trim($attrArray['data-type']) === 'default') {
                            if (is_array($attrValue)) {
                                $attrValue = $attrValue[0] . trim($attrArray['data-type']) . $attrValue[1];
                            }
                            $replace_string .= trim($attr) . '="' . trim($attrValue) . '" ';
                        }
                    }
                    $replace_string .= '>';
                }
                $strContent = str_replace($matches[0][$key_img], $replace_string, $strContent);
            }
        }
        return $strContent;
    }
}