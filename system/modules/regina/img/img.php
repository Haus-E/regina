<?php
/**
 * Contao Open Source CMS
 *
 * @Copyright (c) 2014 Haus E
 * @package Regina
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

define('TL_MODE', 'FE');
require('../../../initialize.php');

class img extends Frontend
{

    private $width = 500;
    private $height = 500;
    private $quality = 95;
    private $imgType = 'jpeg';
    private $visibility = '100';
    private $grayscaleActive = '';
    private $transcolor = '000000';
    private $constraints = 'both';
    private $slice = '';
    private $croping = '';
    private $ratioName = '';
    private $ratio = 1;
    private $resize = false;
    private $scaleImg = false;

    private $textUseActive = 0;
    private $fontSize = 12;
    private $fontColor = "000000";
    private $fontNormal = "";
    private $fontBold = "";
    private $textBoxUse = 0;
    private $textBoxOffset = '-1,7,6,7';
    private $textCase = '';
    private $textPadding = 7;
    private $textBoxHeight = 31;
    private $textAlign = 'c';
    private $textBoxBGColor = "ffffff";
    private $textTransparency = 90;
    private $textFactor = 1;

    private $useExtraImage = '';
    private $addImage = '';

    private $crop = array(); #(top, right, bottom, left)
    private $sizeX = 0;
    private $sizeY = 0;
    private $sizeXSrc = 0;
    private $sizeYSrc = 0;
    private $imgData = array();
    private $imgHandleSrc;
    private $imgHandle;

    private $xd = 0;
    private $yd = 0;
    private $xs = 0;
    private $ys = 0;

    private $cacheUse = false;
    private $cacheDir = '';

    /**
     * Lädt die Defaultewerte und Initialisiert die Datenbankanbildung
     */
    public function __construct()
    {
        $this->import('Database');
        $this->cacheDir = TL_ROOT . '/' . $GLOBALS['TL_CONFIG']['cacheDirRegina'] . '/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir);
            copy(TL_ROOT . '/system/modules/regina/html/imgcache/index.html', $this->cacheDir . '/index.html');
        }
        $this->cacheUse = $GLOBALS['TL_CONFIG']['useCacheRegina'];

        $this->width = $GLOBALS['TL_CONFIG']['widthRegina'];
        $this->height = $GLOBALS['TL_CONFIG']['heightRegina'];
        $this->minWidth = $GLOBALS['TL_CONFIG']['minWidthRegina'];
        $this->minHeight = $GLOBALS['TL_CONFIG']['minHeightRegina'];
    }

    /**
     * Berechnet die Bilddatei und liefert sie Zurück
     */
    public function run()
    {
        $file = TL_ROOT . '/' . $_REQUEST['file'];
        $type = $_REQUEST["type"];

        /*
         * Ermitteln um welchen Gerätetyp es sich handelt. (Wird über jQuery ermittelt und mit übergeben)
         * '-hd' => Hochauslösende (Retina) Displays
         * '-mobi' => Mobile Endgeräte
         */
        $this->ratioName = substr($type, strrpos($type, '-'));
        switch ($this->ratioName) {
            case '-hd':
                $this->ratio = (float)$GLOBALS['TL_CONFIG']['hdRatioRegina'];
                $type = substr($type, 0, -strlen($this->ratioName));
                break;
            case '-mobi':
                $this->ratio = (float)$GLOBALS['TL_CONFIG']['mobiRatioRegina'];
                $type = substr($type, 0, -strlen($this->ratioName));
                break;
            default:
                $this->ratioName = '';
                break;
        }

        /*
         * Bildtyp Daten aus der Datenbank auslesen.
         * Und wenn vom Standardwert abweichend für weitere Verarbeitung speichern.
         */
        $res = $this->Database->prepare("select * from tl_regina where alias = ?")
            ->execute($type);
        $result = $res->fetchAssoc();
        if (is_array($result)) {
            $md5string = $_REQUEST["text"];
            foreach ($result as $key => $value) {
                if ($value !== null && isset($this->$key)) {
                    $this->$key = $value;
                }
                if (isset($this->$key)) {
                    $md5string .= (is_array($value) ? serialize($value) : $value);
                }
            }
        } else {
            $md5string = $this->width . $this->height . $this->scale . $this->minWidth . $this->minHeight . $this->quality . $this->imgType . $this->constraints . $this->slice . $this->croping;
        }

        /*
         * Wenn bestimmter Gerätetyp vorhanden ist dann werden alle Größenangaben entsprechend skaliert.
         */
        if ($this->textUseActive) {
            $ratioArray = array('width', 'height', 'fontSize', 'textPadding', 'textBoxHeight', 'factor');
            $this->textBoxOffset = explode(',', $this->textBoxOffset);
            foreach ($this->textBoxOffset as $key => $value) {
                $this->textBoxOffset[$key] = $value * $this->ratio;
            }
        } else {
            $ratioArray = array('width', 'height');
        }
        foreach ($ratioArray as $key) {
            $this->$key = round($this->$key * $this->ratio);
        }

        /*
         * Hash für späteres Caching der Datei erstellen.
         */
        $filectime = @filectime($file);
        $hash = md5("resize" . $filectime . $_REQUEST["file"] . $_REQUEST["type"] . $md5string); //.serialize($addImage));

        /*
         * ggf. Fehlerausgabe an- und abschalten
         * TODO: wieder abstellen
         */
        if (isset($_REQUEST["e"])) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }

        /*
         * Caching an- und abschalten
         * (kann in den Einstellungen umgestellt werden)
         */
        if ($this->cacheUse && is_file($this->cacheDir . $hash . '.' . $this->imgType)) {
            $this->printImageHeader();
            readfile($this->cacheDir . $hash . '.' . $this->imgType);

            return;
        }

        $this->getImageData($file);
        $ImageOut = 'image' . $this->imgType;

        if ($this->scaleImg) {
            if ($this->imgData[0] < (($this->width / $this->ratio) * $GLOBALS['TL_CONFIG']['hdRatioRegina'])) {
                $this->width = $this->imgData[0] / $GLOBALS['TL_CONFIG']['hdRatioRegina'] * $this->ratio;
            }
            if ($this->imgData[1] < (($this->height / $this->ratio) * $GLOBALS['TL_CONFIG']['hdRatioRegina'])) {
                $this->height = $this->imgData[1] / $GLOBALS['TL_CONFIG']['hdRatioRegina'] * $this->ratio;
            }
        }

        if ($this->croping) {
            // Ermitteln der Prozentualen Cropping Werte
            $this->calcCroping();
        } else {
            // Kein Cropping dann Einpassen des Bildes
            $this->calcConstraints();
        }

        $this->calcSlice();

        $this->imgHandle = imagecreatetruecolor($this->sizeX, $this->sizeY);

        if ($this->imgType == "png") {
            $color = $this->createColor($this->imgHandle, $this->transcolor, 127);
            imagefill($this->imgHandle, 0, 0, $color);
            imagecolortransparent($this->imgHandle, $this->createColor($this->imgHandle, $this->transcolor));
        } else {
            $color = $this->createColor($this->imgHandle, $this->transcolor);
            imagefill($this->imgHandle, 0, 0, $color);
        }

        imagecopyresampled($this->imgHandle, $this->imgHandleSrc, $this->xd, $this->yd, $this->xs, $this->ys, $this->sizeX, $this->sizeY, $this->sizeXSrc, $this->sizeYSrc);
        imageAlphaBlending($this->imgHandle, true);
        imageSaveAlpha($this->imgHandle, true);

        // weitere Bilder in das Bild reinrechnen
        if ($this->useExtraImage && $this->addImage != '') {
            $this->insertImage();
        }

        // Text ins Bild schreiben
        if ($this->textUseActive && $_REQUEST["text"]) {
            $this->createText();
        }

        // Bild eingrauen
        if ($this->grayscaleActive || intval($this->visibility) < 100) {
            $this->calcVisibility();
        }

        // Bild ausgeben
        $this->printImageHeader();
        if ($this->imgType == "jpeg") {
            $ImageOut ($this->imgHandle, $this->cacheDir . $hash . '.' . $this->imgType, $this->quality);
        } else {
            $ImageOut ($this->imgHandle, $this->cacheDir . $hash . '.' . $this->imgType);
        }
        readfile($this->cacheDir . $hash . '.' . $this->imgType);

        if (!$this->cacheUse) {
            unlink($this->cacheDir . $hash . '.' . $this->imgType);
        }
        ImageDestroy($this->imgHandle);
        ImageDestroy($this->imgHandleSrc);

        return;
    }

    /**
     * Daten zum Bild ermitteln (Bildtyp, Größe) und das Handle zur weiteren verarbeitung erzeugen.
     *
     * @param string $file Datei
     */
    public function getImageData($file)
    {
        $this->imgData = getimagesize($file);

        if ($this->imgData[2] == 1) {
            $this->imgHandleSrc = imagecreatefromgif($file);
        } elseif ($this->imgData[2] == 2) {
            $this->imgHandleSrc = imagecreatefromjpeg($file);
        } elseif ($this->imgData[2] == 3) {
            $this->imgHandleSrc = imagecreatefrompng($file);
            imageAlphaBlending($this->imgHandleSrc, true);
            imageSaveAlpha($this->imgHandleSrc, true);
        } elseif ($this->imgData[2] > 3 || $this->imgData === false) {
            // Andere Bildarten mit Hilfe von Imagick in jpeg umwandeln
            $file_new = $this->cacheDir . substr($file, strrpos($file, '/') + 1, (strrpos($file, '.') - strrpos($file, '/') - 1)) . '.' . $this->imgType;

            if (!file_exists($file_new)) {
                if (class_exists('Imagick')) {
                    $img = new Imagick();
                    $img->readImage($file);

                    // Farbraumumwandlung falls nötig
                    if ($img->getImageColorspace() === Imagick::COLORSPACE_CMYK) {
                        $profiles = $img->getImageProfiles('*', false);
                        $has_icc_profile = (array_search('icc', $profiles) !== false);
                        if ($has_icc_profile === false) {
                            $icc_cmyk = file_get_contents('config/USWebUncoated.icc');
                            $img->profileImage('icc', $icc_cmyk);
                            unset($icc_cmyk);
                        }
                        $icc_rgb = file_get_contents('config/ColorMatchRGB.icc');
                        $img->profileImage('icc', $icc_rgb);
                        unset($icc_rgb);
                    }

                    $img->stripImage();

                    if ($this->imgData[2] == 5) {
                        $img->setIteratorIndex(0);
                    }

                    $img->setImageFormat($this->imgType);

                    $img->writeImage($file_new);
                    $img->clear();
                } else {
                    $this->log('Imagick Class not available', __CLASS__ . ' - ' . __FUNCTION__, TL_ERROR);
                    exit;
                }
            }
            $this->getImageData($file_new);
        } else {
            $this->imgHandleSrc = imagecreatetruecolor($this->width, $this->height);
            $white = $this->createColor($this->imgHandleSrc, "ffffff");
            ImageFill($this->imgHandleSrc, 0, 0, $white);
            $this->imgData[0] = $this->width;
            $this->imgData[1] = $this->height;
        }
        // Bilder unter einer bestimmten Auflösung weden als Transparente Icons angesehen
        if ($this->imgData[0] <= $this->minWidth && $this->imgData[1] <= $this->minHeight) {
            $this->imgType = 'png';
        }
    }

    /**
     * Skalierung und beschneidung des Bildes.
     * Aktuell ist nur eine zentrierte Ausgabe umgesetzt.
     */
    public function calcCroping()
    {
        if ($this->croping == 'center_center') {
            if (($this->imgData[1] / $this->height) > ($this->imgData[0] / $this->width)) { // Höher als Breit

                $destHeight = (($this->height / $this->ratio) * $GLOBALS['TL_CONFIG']['hdRatioRegina']);
                $destWidth = (($this->width / $this->ratio) * $GLOBALS['TL_CONFIG']['hdRatioRegina']);
                $rate = ($this->imgData[0] / $destWidth);
                $ratedHeight = $this->imgData[1] / $rate;

                $posRight = $posLeft = 0;
                $posTop = $posBottom = max(0, ((($ratedHeight - $destHeight)) / 2) / $ratedHeight);
            } else { // Breiter als Hoch

                $destHeight = (($this->height / $this->ratio) * $GLOBALS['TL_CONFIG']['hdRatioRegina']);
                $destWidth = (($this->width / $this->ratio) * $GLOBALS['TL_CONFIG']['hdRatioRegina']);
                $rate = ($this->imgData[1] / $destHeight);
                $ratedWidth = $this->imgData[0] / $rate;

                $posRight = $posLeft = max(0, ((($ratedWidth - $destWidth)) / 2) / $ratedWidth);
                $posTop = $posBottom = 0;
            }
            $this->crop = array($posTop, $posRight, $posBottom, $posLeft); // (top, right, bottom, left)
        }
        $this->sizeX = $this->width;
        $this->sizeY = $this->height;

        $this->sizeXSrc = $this->imgData[0];
        $this->sizeYSrc = $this->imgData[1];

        $this->xs = round(($this->crop[3]) * $this->sizeXSrc);
        $this->ys = round(($this->crop[0]) * $this->sizeYSrc);

        $this->sizeYSrc = round((1 - $this->crop[0] - $this->crop[2]) * $this->sizeYSrc);
        $this->sizeXSrc = round((1 - $this->crop[1] - $this->crop[3]) * $this->sizeXSrc);
        if ($this->croping != 'center_center') {
            $this->sizeX = round((1 - $this->crop[3] - $this->crop[1]) * $this->sizeX);
            $this->sizeY = round((1 - $this->crop[2] - $this->crop[0]) * $this->sizeY);
        }
    }

    /**
     * Ermittlung wie das Bild eingepasst werden soll.
     */
    public function calcConstraints()
    {
        if ($this->constraints == "both" && ($this->resize || ($this->imgData[0] > $this->width || $this->imgData[1] > $this->height))) {
            $this->sizeX = $this->width;
            $this->sizeY = $this->imgData[1] * $this->sizeX / $this->imgData[0];

            if ($this->sizeY > $this->height) {
                $this->sizeY = $this->height;
                $this->sizeX = $this->imgData[0] * $this->sizeY / $this->imgData[1];
            }
        } elseif ($this->constraints == "width" && ($this->resize || ($this->imgData[0] > $this->width || $this->imgData[1] > $this->height))) {
            $this->sizeX = $this->width;
            $this->sizeY = $this->imgData[1] * $this->sizeX / $this->imgData[0];
        } elseif ($this->constraints == "height" && ($this->resize || ($this->imgData[0] > $this->width || $this->imgData[1] > $this->height))) {
            $this->sizeY = $this->height;
            $this->sizeX = $this->imgData[0] * $this->sizeY / $this->imgData[1];
        } else {
            $this->sizeX = $this->imgData[0];
            $this->sizeY = $this->imgData[1];
        }
        $this->sizeXSrc = $this->imgData[0];
        $this->sizeYSrc = $this->imgData[1];
    }

    /**
     * Bild beschneiden damit es passt.
     */
    public function calcSlice()
    {
        if ($this->slice == "height") {
            $this->sizeY = $this->height;
            $this->sizeYSrc = $this->sizeXSrc * $this->height / $this->width;
        } elseif ($this->slice == "width") {
            $this->sizeX = $this->width;
            $this->sizeXSrc = $this->sizeYSrc * $this->width / $this->height;
        }
    }

    /**
     * Graustufen in das Bild mit reinrechnen.
     */
    public function calcVisibility()
    {
        for ($i = 0; $i < $this->sizeX; $i++) {
            for ($j = 0; $j < $this->sizeY; $j++) {
                // get the rgb value for current pixel
                $rgb = ImageColorAt($this->imgHandle, $i, $j);

                // extract each value for r, g, b
                $rr = ($rgb >> 16) & 0xFF;
                $gg = ($rgb >> 8) & 0xFF;
                $bb = $rgb & 0xFF;

                // get the Value from the RGB value
                // $g = round(($rr + $gg + $bb) / 3);
                if ($this->grayscaleActive) {
                    $g = round($rr * 0.299, 0) + round($gg * 0.587, 0) + round($bb * 0.114, 0);
                    $g = round((255 - $g) * ((100 - $this->visibility) / 100) + $g);
                    // grayscale values have r=g=b=g
                    $val = imagecolorallocate($this->imgHandle, $g, $g, $g);
                } else {
                    $r = round((255 - $rr) * ((100 - $this->visibility) / 100) + $rr);
                    $g = round((255 - $gg) * ((100 - $this->visibility) / 100) + $gg);
                    $b = round((255 - $bb) * ((100 - $this->visibility) / 100) + $bb);
                    // grayscale values have r=g=b=g
                    $val = imagecolorallocate($this->imgHandle, $r, $g, $b);
                }
                // set the gray value
                imagesetpixel($this->imgHandle, $i, $j, $val);

            }
        }
    }

    /**
     * Ausgabe des Headers für das Bild.
     * Damit der Browser das Bild korrekt anzeigen kann und das Caching der Bilder im Browser richtig funktioniert.
     */
    public function printImageHeader()
    {
        Header("Content-type: image/" . $this->imgType);
        // Diese Header sind notwendig, um die Bilder im Browser-Cache halten zu koennen.
        Header("Last-Modified: " . gmdate("D, d M Y H:i:s", mktime(0, 0, 0, 1, 1, 2010)) . " GMT"); // Date in the past
        Header("Expires: Mon, 26 Jul 2040 05:00:00 GMT"); // In other words... never expire the image
        Header("Cache-Control: max-age=10000000, s-maxage=1000000, proxy-revalidate, must-revalidate");
    }

    /**
     * Eine Farbe nach HTML-Code erzeugen.
     * Optional kann die Alpha-Transparenz mit übergeben werden.
     *
     * @param resource $img  Bildhandle
     * @param string $code Hexadezimal Farbcode
     * @param int $alpha
     *
     * @return int
     */
    public function createColor($img, $code, $alpha = 0)
    {
        return imagecolorallocatealpha($img, hexdec(substr($code, 0, 2)), hexdec(substr($code, 2, 2)), hexdec(substr($code, 4, 2)), $alpha);
    }

    /**
     * Beliebigen Text in das Bild reinrechnen.
     * Es gibt zwei "Haupt"-Optionen mit und ohne Textbox in den der Text eingetragen wird.
     */
    public function createText()
    {
        $rawtext = $_REQUEST["text"];

        $this->fontNormal = TL_ROOT . '/' . $this->fontNormal;
        $this->fontBold = TL_ROOT . '/' . $this->fontBold;

        if (!$this->textBoxUse) {
            $this->textFactor = 1;
        } else {
        }

        switch ($this->textCase) {
            case 'upper':
                $text = $this->fullUpper(html_entity_decode(urldecode($rawtext), ENT_QUOTES));
                break;
            case 'lower':
                $text = $this->fullLower(html_entity_decode(urldecode($rawtext), ENT_QUOTES));
                break;
            default:
                $text = html_entity_decode(urldecode($rawtext), ENT_QUOTES, "ISO8859-1");
                break;
        }

        // Schauen ob der Text geteilt ist und entsprechend Schriften laden
        $textParts = explode("|", $text);

        $textBold = array_shift($textParts);
        $textNormal = implode("|", $textParts);

        $textBoldSize = ($textBold) ? $this->imagettfbox($this->fontSize * $this->textFactor, 0, $this->fontBold, $textBold) : false;
        $textNormalSize = ($textNormal) ? $this->imagettfbox($this->fontSize * $this->textFactor, 0, $this->fontNormal, $textNormal) : false;

        $textMaxSize = $this->imagettfbox($this->fontSize * $this->textFactor, 0, $this->fontBold, "ÄÜÖyjgpQß?|");

        // Bilddatei für Text erzeugen

        // Mapabmaße bestimmen

        if ($this->textBoxOffset) {
            $mapWidthDst = ($this->width - $this->textBoxOffset[1] - $this->textBoxOffset[3]);
            $mapWidth = $mapWidthDst * $this->textFactor;
        } else {
            $mapWidthDst = $this->width;
            $mapWidth = $this->width * $this->textFactor;
        }

        $mapHeight = ($this->textBoxHeight) ? $this->textBoxHeight * $this->textFactor : $textMaxSize['height'];
        $mapHeightDst = ($this->textBoxHeight) ? $this->textBoxHeight : floor($textMaxSize['height'] / $this->textFactor);

        // Textposition anhand Textausrichtung bestimmen

        $textBoldLeft = 0;
        $textNormalLeft = 0;
        $textWidth = $textBoldSize['width'] + $textNormalSize['width'];
        if ($this->textAlign == 'c') {
            $textBoldLeft = floor($mapWidth / 2 - $textWidth / 2);
            $textNormalLeft = $textBoldLeft + $textBoldSize['width'];
        } elseif ($this->textAlign == 'l') {
            $textBoldLeft = $this->textPadding * $this->textFactor;
            $textNormalLeft = $textBoldLeft + $textBoldSize['width'];
        } elseif ($this->textAlign == 'r') {
            $textBoldLeft = $mapWidth - $textWidth - $this->textPadding * $this->textFactor;
            $textNormalLeft = $textBoldLeft + $textBoldSize['width'];
        }

        $textPadding = $mapHeight - $this->textFactor * $this->textPadding;

        if ($this->textBoxUse) {
            // Der eigentliche Text um $factor vergrößert weiß auf Schwarz für Alphaberechnung

            $imgText = imagecreatetruecolor($mapWidth, $mapHeight);

            // set textcolor to black for correct transparency calculation
            $this->fontColor = '000000';

            // Das Ausgabebild welches weiterverarbeitet werden soll
            $imgTextOut = imagecreatetruecolor($mapWidthDst, $mapHeightDst);

            // Die Textbox mit unserer Hintergrundfarbe
            $imgTextBox = imagecreatetruecolor($mapWidthDst, $mapHeightDst);

            $imgTextSized = imagecreatetruecolor($mapWidthDst, $mapHeightDst);

            imagefill($imgText, 0, 0, $this->createColor($imgText, $this->fontColor));

            imagefill($imgTextBox, 0, 0, $this->createColor($imgTextBox, $this->textBoxBGColor));

            imagefill($imgTextOut, 0, 0, $this->createColor($imgText, $this->fontColor, round(127 * ($this->textTransparency / 100))));

            imagefill($imgTextSized, 0, 0, $this->createColor($imgText, $this->fontColor));

            imagettftext($imgText, $this->fontSize * $this->textFactor, 0, $textBoldLeft, $textPadding, $this->createColor($imgText, $this->textBoxBGColor), $this->fontBold, $textBold);
            imagettftext($imgText, $this->fontSize * $this->textFactor, 0, $textNormalLeft, $textPadding, $this->createColor($imgText, $this->textBoxBGColor), $this->fontNormal, $textNormal);

            imagecopyresampled($imgTextSized, $imgText, 0, 0, 0, 0, $mapWidth, $mapHeight, $mapWidth * $this->textFactor, $mapHeight * $this->textFactor);

            imagesavealpha($imgTextOut, true);
            imagealphablending($imgTextOut, true);

            // Transparenzen Pixelweise schreiben
            for ($y = 0; $y < $mapHeightDst; $y++) {
                for ($x = 0; $x < $mapWidthDst; $x++) {
                    $c = imagecolorat($imgTextBox, $x, $y);
                    $r = ($c >> 16) & 0xFF;
                    $g = ($c >> 8) & 0xFF;
                    $b = $c & 0xFF;

                    // TODO: Transparenz berechnung erfolgt über den Grünanteil damit kann es Probleme geben wenn die Sschrift einen Grünanteil hat
                    $c2 = imagecolorat($imgTextSized, $x, $y);
                    $alpha = floor((($c2 >> 8) & 0xFF) / 2);
                    imagesetpixel($imgTextOut, $x, $y, imagecolorallocatealpha($imgTextOut, $r, $g, $b, $alpha)); //$alpha));
                }
            }

            $imText = $imgTextOut;

            imageAlphaBlending($imText, true);
            imageSaveAlpha($imText, true);

            // Position des Textes berechnen
            $offsetLeft = 0;
            $offsetTop = 0;
            if ($this->textBoxOffset) {
                $offsetLeft = $this->textBoxOffset[3];
                if ($this->textBoxOffset[0] >= 0) {
                    $offsetTop = $this->textBoxOffset[0];
                } else {
                    $offsetTop = $this->sizeY - $mapHeightDst - $this->textBoxOffset[2];
                }
            }
            // Text in Bild kopieren
            imagecopy($this->imgHandle, $imText, $offsetLeft, $offsetTop, 0, 0, $mapWidthDst, $mapHeightDst);

            imagedestroy($imgText);
            imagedestroy($imgTextBox);
            imagedestroy($imgTextOut);
            imagedestroy($imgTextSized);
        } else {
            if ($this->textBoxOffset[0] < 0) {
                $offsetTop = $this->height - $this->textPadding - $this->textBoxOffset[2];
            } else {
                $offsetTop = $textBoldSize['height'] + $this->textPadding + $this->textBoxOffset[0];
            }
            imagettftext($this->imgHandle, $this->fontSize, 0, $textBoldLeft, $offsetTop, $this->createColor($this->imgHandle, $this->fontColor), $this->fontBold, $textBold);
            imagettftext($this->imgHandle, $this->fontSize, 0, $textNormalLeft, $offsetTop, $this->createColor($this->imgHandle, $this->fontColor), $this->fontNormal, $textNormal);
        }
    }

    /**
     * Hier wird die Größe der Textbox und der Schrift berechnet
     *
     * @param $size
     * @param $angle
     * @param $font
     * @param $text
     *
     * @return array
     */
    public function imagettfbox($size, $angle, $font, $text)
    {
        $box = imagettfbbox($size, $angle, $font, $text);
        $min_x = min(array($box[0], $box[2], $box[4], $box[6]));
        $max_x = max(array($box[0], $box[2], $box[4], $box[6]));
        $min_y = min(array($box[1], $box[3], $box[5], $box[7]));
        $max_y = max(array($box[1], $box[3], $box[5], $box[7]));

        return array(
            'left' => ($min_x >= -1) ? -abs($min_x + 1) : abs($min_x + 2),
            'top' => abs($min_y) - 1,
            'width' => $max_x - $min_x,
            'height' => $max_y - $min_y - 1,
            'box' => $box
        );
    }

    /**
     * Texttransformation zu uppercase
     *
     * @param string $str
     *
     * @return string
     */
    public function fullUpper($str)
    {
        // convert to entities
        $subject = htmlentities($str, ENT_QUOTES);
        $pattern = '/&([a-z])(uml|acute|circ';
        $pattern .= '|tilde|ring|elig|grave|slash|horn|cedil|th);/e';
        $replace = "'&'.strtoupper('\\1').'\\2'.';'";
        $result = preg_replace($pattern, $replace, $subject);
        // convert from entities back to characters
        $htmltable = get_html_translation_table(HTML_ENTITIES);
        foreach ($htmltable as $key => $value) {
            $result = str_replace(addslashes($value), $key, $result);
        }

        $result = strtoupper($result);
        $result = str_replace("?", "SS", $result);

        return $result;
    }

    /**
     * Texttransformation zu lowercase
     *
     * @param string $str
     *
     * @return string
     */
    public function fullLower($str)
    {
        // convert to entities
        $subject = htmlentities($str, ENT_QUOTES);
        $pattern = '/&([A-Z])(uml|acute|circ';
        $pattern .= '|tilde|ring|elig|grave|slash|horn|cedil|th);/e';
        $replace = "'&'.strtolower('\\1').'\\2'.';'";
        $result = preg_replace($pattern, $replace, $subject);
        // convert from entities back to characters
        $htmltable = get_html_translation_table(HTML_ENTITIES);
        foreach ($htmltable as $key => $value) {
            $result = str_replace(addslashes($value), $key, $result);
        }

        return (strtolower($result));
    }

    /**
     * Hier werden zusätzliche Bildelemenet (etwa Wasserzeichen) in das eigentliche Bild reingerechnet.
     */
    public function insertImage()
    {
        $imageArray = unserialize($this->addImage);
        if (is_array($imageArray)) {
            foreach ($imageArray as $image) {
                $img = ((substr($image['addImageFile'], 0, 1) == '/') ? $image['addImageFile'] : '/' . $image['addImageFile']);
                $img = ((substr($img, -1, 1) == '/') ? substr($img, 0, -1) : $img);
                $file = TL_ROOT . $img;
                if ($this->ratioName) {
                    $file = substr($file, 0, strrpos($file, '.')) . $this->ratioName . substr($file, strrpos($file, '.'));
                }
                if (file_exists($file) && is_file($file)) {
                    $img = getimagesize($file);

                    if ($img[2] == 1) {
                        $im = imagecreatefromgif($file);
                    } elseif ($img[2] == 2) {
                        $im = imagecreatefromjpeg($file);
                    } elseif ($img[2] == 3) {
                        $im = imagecreatefrompng($file);
                        #echo "huhu";
                        imageAlphaBlending($im, false);
                        imageSaveAlpha($im, true);
                        imagecolortransparent($this->imgHandle, $this->createColor($this->imgHandle, $this->transcolor));
                    } else {
                        $im = imagecreatetruecolor($this->width, $this->width);
                        $white = $this->createColor($im, ($this->transcolor) ? $this->transcolor : "ffffff");

                        ImageFill($im, 0, 0, $white);

                        $img[0] = $this->width;
                        $img[1] = $this->width;
                    }

                    $offset = explode(',', $image['addImageOffset']);
                    if ($offset[0] < 0) {
                        $top = $this->height - $offset[2] - $img[1];
                    } else {
                        $top = $offset[0];
                    }
                    if ($offset[3] < 0) {
                        $left = $this->width - $offset[1] - $img[0];
                    } else {
                        $left = $offset[3];
                    }

                    imagecopyresampled($this->imgHandle, $im, intval($left), intval($top), 0, 0, $img[0], $img[1], $img[0], $img[1]);
                    imageAlphaBlending($this->imgHandle, true);
                    imageSaveAlpha($this->imgHandle, true);
                }
            }
        }
    }
}

$img = new img();
$img->run();
