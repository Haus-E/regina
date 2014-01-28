<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['tl_regina']['imageData'] = 'Image configuration';
$GLOBALS['TL_LANG']['tl_regina']['textData'] = 'Text configuration';
$GLOBALS['TL_LANG']['tl_regina']['extraImage'] = 'Additional Images';

$GLOBALS['TL_LANG']['tl_regina']['title'] = array('Title', 'Image type title');
$GLOBALS['TL_LANG']['tl_regina']['alias'] = array('Alias', 'Image type alias. Transmitted selector in URL');
$GLOBALS['TL_LANG']['tl_regina']['width'] = array('Width', 'Width of destination image.');
$GLOBALS['TL_LANG']['tl_regina']['height'] = array('Height', 'Height of destination image.');
$GLOBALS['TL_LANG']['tl_regina']['resize'] = array('Zoom image (Upscale)', 'Scale up image, if both width and height are lower than destination values.');
$GLOBALS['TL_LANG']['tl_regina']['scaleImg'] = array('Automatic Downscale', 'All images must be kept in high quality. Regina scales it down by the given pixel ratio within the boundary of width and height.');
$GLOBALS['TL_LANG']['tl_regina']['quality'] = array('Quality in percent', 'Quality of compressions for JPEG Files.');
$GLOBALS['TL_LANG']['tl_regina']['lazyLoad'] = array('Activate Lazy Load', 'The Images starts to load after the webpage is ready. (JS function)');
$GLOBALS['TL_LANG']['tl_regina']['position'] = array('Center position', 'Positions the image horizontally and vertically centered in the parent DOM element. (JS function)');
$GLOBALS['TL_LANG']['tl_regina']['visibility'] = array('Visibility', '100% visible -> 0% invisible.');
$GLOBALS['TL_LANG']['tl_regina']['grayscaleActive'] = array('Activate grayscale', 'Images are displayed in grayscale.');
$GLOBALS['TL_LANG']['tl_regina']['transcolor'] = array('Transparent color', 'Only for PNG source images. When converting to i.e. JPEG transparent areas of the PNG image are represented with this color');
$GLOBALS['TL_LANG']['tl_regina']['imgType'] = array('Image format', 'Output image file type.');
$GLOBALS['TL_LANG']['tl_regina']['constraints'] = array('Fit image without cropping', 'Fits the images to the width and/or height of the destination image');
$GLOBALS['TL_LANG']['tl_regina']['slice'] = array('Fit image with cropping', 'The image will be cropped to the width or height of the destination image.');
$GLOBALS['TL_LANG']['tl_regina']['croping'] = array('Image cropping', 'The image will be auto cropped by the given value to fit into the destination image.');

$GLOBALS['TL_LANG']['tl_regina']['textUseActive'] = array('Add Text', 'Turn this option on to add Text into the image.');
$GLOBALS['TL_LANG']['tl_regina']['fontSize'] = array('Font size', 'Font size in point.');
$GLOBALS['TL_LANG']['tl_regina']['fontColor'] = array('Font color', 'Font color in hexadecimal notation');
$GLOBALS['TL_LANG']['tl_regina']['fontNormal'] = array('Font type - normal text', 'Choose a font for normal text.');
$GLOBALS['TL_LANG']['tl_regina']['fontBold'] = array('Font type - bold text', 'Choose a font for bold text.');
$GLOBALS['TL_LANG']['tl_regina']['textBoxOffset'] = array('Text position', 'Positioning of the text in the image. [top, right, bottom, left] in pixel - "-1" = ignore direction)');
$GLOBALS['TL_LANG']['tl_regina']['textAlign'] = array('Text align', 'Choose a alignment of the text');
$GLOBALS['TL_LANG']['tl_regina']['textCase'] = array('Text transform', 'Choose a text transformation');

$GLOBALS['TL_LANG']['tl_regina']['textBoxUse'] = array('Text box', 'Generate a visible box around the text.');
$GLOBALS['TL_LANG']['tl_regina']['textPadding'] = array('Text padding', 'Spacing of the text to the edge of the box.');
$GLOBALS['TL_LANG']['tl_regina']['textBoxBGColor'] = array('Background color', 'Box background color in hexadecimal notation');
$GLOBALS['TL_LANG']['tl_regina']['textBoxHeight'] = array('Text box height', 'Text box height in Pixel');
$GLOBALS['TL_LANG']['tl_regina']['textTransparency'] = array('Text transparency in percent', 'Percentage value of how strong the text is to break through the text box.');
$GLOBALS['TL_LANG']['tl_regina']['textFactor'] = array('Anti aliasing factor', 'On using text transparency, ugly edges may occur. This factor tries to simulate an anti aliasing effect by zooming the image. .');

$GLOBALS['TL_LANG']['tl_regina']['useExtraImage'] = array('Add further images', 'Choose this option if you want to calculate additional pictures into the source image. (i.e. watermarks or shadow)');
$GLOBALS['TL_LANG']['tl_regina']['addImage'] = array(' ', 'Type the path to your picture(s) and set the position. Relative path from <b>root</b>, i.e. /tl_files/images/image.png. Position (top, right, bottom, left).');
$GLOBALS['TL_LANG']['tl_regina']['addImageFile'] = array('Image', 'Choose the image (complete path from contao root directory)');
$GLOBALS['TL_LANG']['tl_regina']['addImageOffset'] = array('Position', 'Set the position of the image. (top, right, bottom, left - "-1" ignore direction)');

$GLOBALS['TL_LANG']['tl_regina']['options_labels'] = array(
    '' => '-- Auswahl --',
    'width' => 'Width',
    'height' => 'Height',
    'both' => 'Both',
    'jpeg' => 'JPEG',
    'png' => 'PNG',
    'gif' => 'GIF',
    'center_center' => "center",
    'left' => "left",
    'center' => "center",
    'right' => "right",
    'noTransform' => "no Transformation",
    'uppercase' => "Upper case",
    'lowercase' => "Lower case",
);

$GLOBALS['TL_LANG']['tl_regina']['new'] = array('New Type','Add a new image type');
$GLOBALS['TL_LANG']['tl_regina']['show'] = array('show', 'Show item');
$GLOBALS['TL_LANG']['tl_regina']['delete'] = array('delete', 'Delete item');
$GLOBALS['TL_LANG']['tl_regina']['copy'] = array('copy', 'Copy item');
$GLOBALS['TL_LANG']['tl_regina']['edit'] = array('edit', 'Edit item');


?>
