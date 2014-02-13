Regina
======

about
-----

Regina provides the ability to calculate images optimized for different display types like high definition or mobile displays. You can set different so called image types to setup different configurations. TinyMCE and standard image including elements work out of the box.

Some features:
* optional server side image cache
* define pixel ratio for hd and mobile devices
* automatic downscale (any image with this type will be processed as high resolution images and will be downscaled for lower pixel ratio)
* output image formats -> jpg, png, gif
* grayscale mode
* fit and cropping options like fit to boundary, crop to width or height or crop for centering image
* add text to the image with multiple settings
* add further images to the image i.e. shadows or watermarks

System requirements
-------------------

Contao dependencies
* tested with Contao 2.11 and up. Older releases should work, but they are not tested.

other dependencies
* jquery: https://contao.org/en/extension-list/view/jquery.html
* MultiColumnWizard: https://contao.org/en/extension-list/view/MultiColumnWizard.html

(optional) ImageMagick
* to handle other source files than jpg, png and gif
* http://www.imagemagick.org/script/index.php

Configuration
-------------
* setup module under "Settings"
* setup individual image types under "Configuration"
* use it with standard image elements like text, image, gallery etc.
* edit your templates by using the attribute data-type=[image type] within the img element, else the images will processed as default image type

Troubleshooting
---------------
visit https://github.com/Haus-E/regina/issues

Forum
-----
visit https://community.contao.org/de/showthread.php?47487-Regina-Bildoptimierung-und-Lazyload-f%FCr-mobile-HD-und-Desktop-Displays
