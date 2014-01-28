<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');
/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
class PurgeImageCache extends Backend implements executable
{
    /**
     * Return true if the module is active
     * @return boolean
     */
    public function isActive()
    {
        return ($this->Input->post('FORM_SUBMIT') == 'tl_purge_image');
    }


    /**
     * Generate the module
     * @return string
     */
    public function run()
    {
        $arrCacheTables = array();
        $objTemplate = new BackendTemplate('be_purge_image');
        $objTemplate->isActive = $this->isActive();

        // Confirmation message
        if ($_SESSION['CLEAR_CACHE_CONFIRM'] != '')
        {
            $objTemplate->cacheMessage = sprintf('<p class="tl_confirm">%s</p>' . "\n", $_SESSION['CLEAR_CACHE_CONFIRM']);
            $_SESSION['CLEAR_CACHE_CONFIRM'] = '';
        }

        // Add potential error messages
        if (is_array($_SESSION['TL_ERROR']) && !empty($_SESSION['TL_ERROR']))
        {
            foreach ($_SESSION['TL_ERROR'] as $message)
            {
                $objTemplate->cacheMessage .= sprintf('<p class="tl_error">%s</p>' . "\n", $message);
            }

            $_SESSION['TL_ERROR'] = array();
        }

        // Purge the resources
        if ($this->Input->post('FORM_SUBMIT') == 'tl_purge_image')
        {
            $tables = deserialize($this->Input->post('tables'));

            if (!is_array($tables))
            {
                $this->reload();
            }

            foreach ($tables as $table)
            {
                // imagecache folder
                if ($table == 'image_folder')
                {
                    $arrScripts = scan(TL_ROOT . '/'.$GLOBALS['TL_CONFIG']['cacheDirRegina'], true);

                    // Remove files
                    if (is_array($arrScripts))
                    {
                        foreach ($arrScripts as $strFile)
                        {
                            if ($strFile != 'index.html' && !is_dir(TL_ROOT . '/'.$GLOBALS['TL_CONFIG']['cacheDirRegina'].'/' . $strFile))
                            {
                                unlink(TL_ROOT . '/'.$GLOBALS['TL_CONFIG']['cacheDirRegina'].'/' . $strFile);
                            }
                        }
                    }

                    // Add log entry
                    $this->log('Purged the image directory', 'PurgeImageCache', TL_CRON);
                }
            }

            $_SESSION['CLEAR_CACHE_CONFIRM'] = $GLOBALS['TL_LANG']['tl_maintenance']['cacheCleared'];
            $this->reload();
        }

        $objTemplate->action = ampersand($this->Environment->request);
        $objTemplate->cacheHeadline = $GLOBALS['TL_LANG']['tl_maintenance']['clearCache'];
        $objTemplate->cacheLabel = $GLOBALS['TL_LANG']['tl_maintenance']['cacheTables'][0];
        $objTemplate->cacheImage = $GLOBALS['TL_LANG']['tl_maintenance']['clearImage'];
        $objTemplate->cacheImageEntries = sprintf($GLOBALS['TL_LANG']['MSC']['entries'], (count(scan(TL_ROOT . '/'.$GLOBALS['TL_CONFIG']['cacheDirRegina'].'/')) - 1));
        $objTemplate->cacheHelp = ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_maintenance']['cacheTables'][1])) ? $GLOBALS['TL_LANG']['tl_maintenance']['cacheTables'][1] : '';
        $objTemplate->cacheSubmit = specialchars($GLOBALS['TL_LANG']['tl_maintenance']['clearCache']);

        return $objTemplate->parse();
    }
}

?>