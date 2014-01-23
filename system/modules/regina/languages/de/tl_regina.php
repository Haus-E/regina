<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
$GLOBALS['TL_LANG']['tl_regina']['imageData'] = 'Bilddaten';
$GLOBALS['TL_LANG']['tl_regina']['textData'] = 'Textdaten';
$GLOBALS['TL_LANG']['tl_regina']['extraImage'] = 'weitere Bilddaten';

$GLOBALS['TL_LANG']['tl_regina']['title'] = array('Titel', 'Titel des Bildtyps');
$GLOBALS['TL_LANG']['tl_regina']['alias'] = array('Alias', 'Alias des Bildtyps das in der URL übermittelt wird.');
$GLOBALS['TL_LANG']['tl_regina']['width'] = array('Breite', 'Breite des Zielbildes.');
$GLOBALS['TL_LANG']['tl_regina']['height'] = array('Höhe', 'Höhe des Zielbildes');
$GLOBALS['TL_LANG']['tl_regina']['resize'] = array('Einpassen (Upscale)', 'Soll das Bild ggf. vergrößert werden?');
$GLOBALS['TL_LANG']['tl_regina']['scaleImg'] = array('Anpassen (Downscale)', 'Soll das Bild ggf. verkleinert werden?');
$GLOBALS['TL_LANG']['tl_regina']['quality'] = array('Qualität in %', 'Qualität des Bildes in % (für JPEG Format)');
$GLOBALS['TL_LANG']['tl_regina']['position'] = array('Positionierung', 'Sollen die Bilder mittig zentriert werden?');
$GLOBALS['TL_LANG']['tl_regina']['grayscale'] = array('Graustufe in %', 'Graustufe des Bildes in %');
$GLOBALS['TL_LANG']['tl_regina']['transcolor'] = array('Transparenz Farbe', 'Farbe die als Transparente Farbe interpretiert wird. (für PNG  Format)');
$GLOBALS['TL_LANG']['tl_regina']['imgType'] = array('Bildformat', 'Format in dem das Bild ausgegeben wird.');
$GLOBALS['TL_LANG']['tl_regina']['constraints'] = array('Einpassen ohne abschneiden des Bildes', 'Geben sie an welche Ausdehnung eines Bildes eingepasst werden soll. (Bild wird nicht beschnitten)');
$GLOBALS['TL_LANG']['tl_regina']['slice'] = array('Einpassen mit abschneiden des Bildes', 'Geben sie an welche Ausdehnung eines Bildes eingepasst werden soll. (Bild wird beschnitten)');
$GLOBALS['TL_LANG']['tl_regina']['croping'] = array('Bild beschneiden', 'Standard Croping Funktion.');

$GLOBALS['TL_LANG']['tl_regina']['textUseActive'] = array('Text einrechnen', 'Diese Option aktivieren wenn Text in das Bild reingeschrieben werden soll.');
$GLOBALS['TL_LANG']['tl_regina']['fontSize'] = array('Schriftgröße', 'Größe des Textes in Pixeln');
$GLOBALS['TL_LANG']['tl_regina']['fontColor'] = array('Schriftfarbe', 'Schrift farbe in Hexadezimaler angabe');
$GLOBALS['TL_LANG']['tl_regina']['fontNormal'] = array('Schirftart normaler Text', 'Schriftart für normalen Text auswählen.');
$GLOBALS['TL_LANG']['tl_regina']['fontBold'] = array('Schrfitart fetter Text', 'Schriftart für fetten Text auswählen');
$GLOBALS['TL_LANG']['tl_regina']['textBoxOffset'] = array('Position der Textes', 'Positionierung des Textes im Bild. (Oben, Rechts, Unten, Links - "-1" wird ignoriert)');
$GLOBALS['TL_LANG']['tl_regina']['textAlign'] = array('Textausrichtung', 'Ausrichtung des Textes');
$GLOBALS['TL_LANG']['tl_regina']['textCase'] = array('Texttransformation', 'Transforationen die auf den Text angewendet werden sollen.');

$GLOBALS['TL_LANG']['tl_regina']['textBoxUse'] = array('Textbox verwenden', 'Soll der Text in einer Box erscheinen');
$GLOBALS['TL_LANG']['tl_regina']['textPadding'] = array('Textabstand', 'Abstand des Textes zum Rand der Box.');
$GLOBALS['TL_LANG']['tl_regina']['textBoxBGColor'] = array('Hintergrundfarbe der Textbox', 'Hexadezimaler Farbcode mit dem die Textbox gefüllt wird.');
$GLOBALS['TL_LANG']['tl_regina']['textBoxHeight'] = array('Höhe der Textbox', 'Höhe für die Textbox in der der Text eingepasst wird');
$GLOBALS['TL_LANG']['tl_regina']['textTransparency'] = array('Texttransparenz in %', 'Prozentuale Angabe wie Stark der Text die Textbox durchbrechen soll.');
$GLOBALS['TL_LANG']['tl_regina']['textFactor'] = array('Vergrößerungsfaktor', 'Wenn Texttransparenz verwendet wird können unschöne Kanten entstehen. Der Textfaktor versucht deshalb über eine Vergrößerung des Textes Antialising zu simulieren.');

$GLOBALS['TL_LANG']['tl_regina']['useExtraImage'] = array('Weitere Bilder einrechnen', 'Wählen sie diese Option wenn sie weitere Bilder in die Ausgabe einrechnen lassen wollen. (etwa ein Wasserzeichen)');
$GLOBALS['TL_LANG']['tl_regina']['addImage'] = array(' ', 'Wählen sie hier die Bilder und ihre Positionierung aus.');
$GLOBALS['TL_LANG']['tl_regina']['addImageFile'] = array('Bilddatei', 'Wählen sie die Bilddatei die reingerechnet werden soll. (Der komplette Pfad ab dem Contaoverzeichnis muss angegeben werden)');
$GLOBALS['TL_LANG']['tl_regina']['addImageOffset'] = array('Positionierung', 'Geben sie hier die Positionierrung an. (Oben, Rechts, Unten, Links - "-1" wird ignoriert)');

$GLOBALS['TL_LANG']['tl_regina']['options_labels'] = array(
    '' => '-- Auswahl --',
    'width' => 'Breite',
    'height' => 'Höhe',
    'both' => 'Beide',
    'jpeg' => 'JPEG',
    'png' => 'PNG',
    'gif' => 'GIF',
    'center_center' => "zentriert",
    'left' => "links",
    'center' => "mittig",
    'right' => "rechts",
    'noTransform' => "keine Umwandlung",
    'uppercase' => "alles groß",
    'lowercase' => "alles klein",
);

$GLOBALS['TL_LANG']['tl_regina']['new'] = array('Neues Format','Ein neues Bildformat anlegen');
$GLOBALS['TL_LANG']['tl_regina']['show'] = array('show', 'show');
$GLOBALS['TL_LANG']['tl_regina']['delete'] = array('delete', 'delete');
$GLOBALS['TL_LANG']['tl_regina']['copy'] = array('copy', 'copy');
$GLOBALS['TL_LANG']['tl_regina']['edit'] = array('edit', 'edit');


?>
