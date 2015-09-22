<?php
if(!defined('__KIMS__')) exit;

$name		= trim($name);
$email		= trim($email);

if (!$name || !$email) getLink('','','정상적인 접근이 아닙니다.','');

include_once $g['dir_module'].'var/var.join.php';

$inactive_table=$DB['head'].'_'.$d['member']['inactive_table'];
if ($d['member']['login_emailid'])
{
	$R = getDbData($table['s_mbrid'],"id='".$email."'",'*');
	if (!$R['uid'])
	{
		getLink('','','입력하신 정보로 일치하는 회원데이터가 없습니다.','');
	}
	// 휴면계정 회원 필터링 추가
    $_tmp = getDbData($table['s_mbrdata'],'memberuid='.$R['uid'],'memberuid,auth');
    if($_tmp['auth']==5) $M = getDbData($inactive_table,'memberuid='.$R['uid'],'*');
    else $M = getDbData($table['s_mbrdata'],'memberuid='.$R['uid'],'*');
}
else {
	$_tmp1 = getDbData($table['s_mbrdata'],"email='".$email."'",'email');
	$_tmp2 = getDbData($inactive_table,"email='".$email."'",'email');

	if (!$_tmp1['email']&&!$_tmp2['email']) 	getLink('','','입력하신 정보로 일치하는 회원데이터가 없습니다.','');
	else if($_tmp1['email'] && !$_tmp2['email']) $M = getDbData($table['s_mbrdata'],"email='".$email."'",'*'); // 활성계정 회원인 경우
    else if(!$_tmp1['email'] && $_tmp2['email']) $M = getDbData($inactive_table,"email='".$email."'",'*'); // 휴면계정 회원인 경우

	$R = getUidData($table['s_mbrid'],$M['memberuid']);
}

if ($M['name'] != $name)
{
	getLink('','','입력하신 정보로 일치하는 회원데이터가 없습니다.','');
}

if ($d['member']['login_emailid'])
{
	getLink('','','회원님의 이메일은 ['.$M['email'].']입니다.','');
}
else {
	getLink('','','회원님의 아이디는 ['.$R['id'].']입니다.','');
}
?>
