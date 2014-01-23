<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
class ReginaJob extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function run()
    {
        rename(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/tinyRegina.php', TL_ROOT.'/system/config/tinyRegina.php');
        rename(TL_ROOT.'/system/modules/regina/tinyMCEPlugin/advimageRegina', TL_ROOT.'/plugins/tinyMCE/plugins/advimageRegina');
        rmdir(TL_ROOT.'/system/modules/regina/tinyMCEPlugin');
    }
}
$objZZReginaJob = new ReginaJob();
$objZZReginaJob->run();
?>