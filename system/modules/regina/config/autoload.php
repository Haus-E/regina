<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Darkroom
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Regina',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Classes
    'PurgeImageCache' => '/system/modules/regina/PurgeImageCache.php',
    //Modules

    // Models
    'ReginaModel' => 'system/modules/regina/models/ReginaModel.php',
));



/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'be_purge_image' => 'system/modules/regina/templates',
    'explaination' => 'system/modules/regina/templates',
));
