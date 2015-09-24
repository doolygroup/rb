<?php
if(!defined('__KIMS__')) exit;

if ($my['uid'])
{
	getDbUpdate($table['s_mbrdata'],'now_log=0','memberuid='.$my['uid']);
	$_SESSION['mbr_uid'] = '';
	$_SESSION['mbr_logout'] = '1';
	setAccessToken($my['uid'],'logout'); // 토큰 데이타 삭제 및 쿠키 초기화
}

getLink($referer ? urldecode($referer) : $_SERVER['HTTP_REFERER'],'','','');
?>
