<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php';

if (!$zip1 || !$addr1)
{
	getLink(RW(0),'','','');
}

$mod	= 'front';
$iframe	= 'Y';
if ($g['mobile']&&$_SESSION['pcmode']!='Y') $theme =$d['zipsearch']['skin_mobile']?$d['zipsearch']['skin_mobile']:'_mobile/default';
else $theme =$d['zipsearch']['skin_pc']?$d['zipsearch']['skin_pc']:'_pc/default';
$zipdb	= $g['dir_module'].'/var/zipcode.db';
if (!is_file($zipdb)) include_once $g['dir_module'].'action/a.zipcode_down.php';
$zipfile= file($zipdb);

$g['dir_module_skin'] = $g['dir_module'].'theme/'.$theme.'/';
$g['url_module_skin'] = $g['url_module'].'/theme/'.$theme;
$g['img_module_skin'] = $g['url_module_skin'].'/image';

$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;

$g['main'] = $g['dir_module_mode'].'.php';

?>