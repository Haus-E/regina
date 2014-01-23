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
            rename(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/tinyRegina3.php', TL_ROOT.'/system/config/tinyRegina.php');
            rename(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/advimageRegina', TL_ROOT.'/assets/tinymce/plugins/advimageRegina');
            unlink(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/tinyRegina2.php');
        } else {
            rename(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/tinyRegina2.php', TL_ROOT.'/system/config/tinyRegina.php');
            rename(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/advimageRegina', TL_ROOT.'/plugins/tinyMCE/plugins/advimageRegina');
            unlink(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/tinyRegina3.php');
        }
        rmdir(TL_ROOT.'/system/modules/regina/tinyMCEPlugin');
    }
}
$objZZReginaJob = new ReginaJob();
$objZZReginaJob->run();
?>