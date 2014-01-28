<?php

/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
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
    'reginaClass' => '/system/modules/regina/reginaClass.php',
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

    'ce_accordion' => 'system/modules/regina/templates',
    'ce_hyperlink_image' => 'system/modules/regina/templates',
    'ce_image' => 'system/modules/regina/templates',
    'ce_text' => 'system/modules/regina/templates',
    'gallery_default' => 'system/modules/regina/templates',
    'mod_random_image' => 'system/modules/regina/templates',
));
