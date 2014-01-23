<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
$GLOBALS['TL_LANG']['tl_regina_settings']['regina_legend'] = 'Funktionen für Retina-Displays';

$GLOBALS['TL_LANG']['tl_regina_settings']['regina'] = array(
    'useRegina' => array('Regina aktivieren', 'Mit setzen dieser Option werden alle Bilder für HD- / Mobile-Displays optimiert und per LazyLoad nachgeladen.'),
    'noOldIERegina' => array('Alte IEs ohne LazyLoad', 'Mit setzen dieser Option wird LazyLoad für IE Versionen <= 8 deaktiviert.'),
    'prefixRegina' => array('Trigger für RewriteRule', 'Setzen Sie einen eindeutigen Trigger für die RewriteRule z.B. <i>bild</i>'),
    'useCacheRegina' => array('Bilder-Cache aktivieren', 'Wenn diese Option aktiv ist werden die Bilder zwischen gespeichert.'),
    'cacheDirRegina' => array('Bilder-Cache Verzeichnis', 'Geben Sie den Ordner an in den die berechneten Bilder gecached werden sollen. (Es wird versucht den Ordner anzulegen)'),

    'rewriteRuleRegina' => array(
        'title' => 'RewriteRule',
        'desc' => 'RewriteRule ^'.$GLOBALS['TL_CONFIG']['prefixRegina'].'/([\%\]\[A-Za-z0-9\-_]*)/(.*)$ system/modules/regina/img/img.php?plain=true&type=$1&file=$2 [qsa,L]'
    ),

    'hdRatioRegina' => array('Pixelverhältins für HD Geräte', 'Geben sie an wie das Verhältnis der Pixel bei Geräten mit Hochauflösenden Displays sein soll'),
    'mobiRatioRegina' => array('Pixelverhältins für mobile Geräte', 'Geben sie an wie das Verhältnis der Pixel bei mobilen Geräten sein soll'),

    'defaultSettingsRegina' => array(
        'title' => 'Standardwerte',
        'desc' => '<p>Die hier eingetragenen Werte werden genutzt um Bilder dazustellen, denen noch kein andere Bild-Typ zugeordnet wurde.</p>'
    ),
    'widthRegina' => array('Breite des Bildes', 'Standard Breite eines Bildes wo kein Typ angegeben wurde.'),
    'heightRegina' => array('Höhe des Bildes', 'Standard Höhe eines Bildes wo kein Typ angegeben wurde.'),
    'minWidthRegina' => array('mindest Breite des Bildes', 'Wenn das Bild kleiner als diese Angabe ist wird es als transparentes Icon behandelt.'),
    'minHeightRegina' => array('mindest Höhe des Bildes', 'Wenn das Bild kleiner als diese Angabe ist wird es als transparentes Icon behandelt.'),

    'explainRegina' => array(
        'title' => 'Erläuterungen',
        'desc' => 
          "<p>Mit dem setzen dieser Option wird eine Erweiterte Ausgabe für HD und Mobile-Displays aktiviert. Beachten Sie dabei bitte folgende Punkte: </p>"
        . "<ul>"
            . "<li>Geben Sie unten einen Trigger an und speichern Sie die Seite.</li>"
            . "<li>Daraufhin erscheint eine RewriteRule die genau so als <b>eine</b> Zeile in die .htaccess Datei in das [root] Verzeichnis der Contaoinstallation kopiert werden muss.</li>"
            . "<li>Damit Sie mit hochauflösenden Bildern arbeiten können müssen sämtlich Bilder egal ob Layout oder Inhalte in mindestens der doppelten Auflösung auf dem Server gespeichert werden. Das bedeutet: wollen Sie ein Bild in 350x150px anzeigen, sollte die Auflösung des Bildes mindesten 700x300px betragen.</li>"
        . "</ul>"
    )
);
 ?>
 
 
 