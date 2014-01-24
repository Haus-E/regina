<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
class ReginaJob extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        if (version_compare(VERSION, '3.0', '>=')) {
            copy(TL_ROOT . '/system/modules/regina/tinyMCEPlugin/tinyRegina3.php', TL_ROOT . '/system/config/tinyRegina.php');
            $this->rcopy(TL_ROOT . '/system/modules/regina/tinyMCEPlugin/advimageRegina', TL_ROOT . '/assets/tinymce/plugins/advimageRegina');
        } else {
            copy(TL_ROOT . '/system/modules/regina/tinyMCEPlugin/tinyRegina2.php', TL_ROOT . '/system/config/tinyRegina.php');
            $this->rcopy(TL_ROOT . '/system/modules/regina/tinyMCEPlugin/advimageRegina', TL_ROOT . '/plugins/tinyMCE/plugins/advimageRegina');
        }
    }

    public function rcopy($src, $dst)
    {
        if (file_exists($dst)) $this->rrmdir($dst);
        if (is_dir($src)) {
            mkdir($dst);
            $files = scandir($src);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rcopy("$src/$file", "$dst/$file");
        } else if (file_exists($src)) copy($src, $dst);
    }

    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
            rmdir($dir);
        } else if (file_exists($dir)) unlink($dir);
    }
}

$objZZReginaJob = new ReginaJob();
$objZZReginaJob->run();
?>