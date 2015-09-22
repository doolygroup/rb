<?php
if(!defined('__KIMS__')) exit;


checkAdmin(0);

$_tmpdfile = $g['dir_module'].'var/var.join.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");

//회원가입
fwrite($fp, "\$d['member']['join_enable'] = \"".$join_enable."\";\n");
fwrite($fp, "\$d['member']['join_mobile'] = \"".$join_mobile."\";\n");
fwrite($fp, "\$d['member']['join_out'] = \"".$join_out."\";\n");
fwrite($fp, "\$d['member']['join_rejoin'] = \"".$join_rejoin."\";\n");
fwrite($fp, "\$d['member']['join_auth'] = \"".$join_auth."\";\n");
fwrite($fp, "\$d['member']['join_level'] = \"".$join_level."\";\n");
fwrite($fp, "\$d['member']['join_group'] = \"".$join_group."\";\n");
fwrite($fp, "\$d['member']['join_point'] = \"".$join_point."\";\n");
fwrite($fp, "\$d['member']['join_pointmsg'] = \"".$join_pointmsg."\";\n");
fwrite($fp, "\$d['member']['join_cutid'] = \"".$join_cutid."\";\n");
fwrite($fp, "\$d['member']['join_cutnic'] = \"".$join_cutnic."\";\n");
fwrite($fp, "\$d['member']['join_email'] = \"".$join_email."\";\n");
fwrite($fp, "\$d['member']['join_email_send'] = \"".$join_email_send."\";\n");

//가입양식
fwrite($fp, "\$d['member']['form_agree'] = \"".$form_agree."\";\n");
fwrite($fp, "\$d['member']['form_jumin'] = \"".$form_jumin."\";\n");
fwrite($fp, "\$d['member']['form_foreign'] = \"".$form_foreign."\";\n");
fwrite($fp, "\$d['member']['form_comp'] = \"".$form_comp."\";\n");
fwrite($fp, "\$d['member']['form_age'] = \"".$form_age."\";\n");
fwrite($fp, "\$d['member']['form_qa'] = \"".$form_qa."\";\n");
fwrite($fp, "\$d['member']['form_home'] = \"".$form_home."\";\n");
fwrite($fp, "\$d['member']['form_tel1'] = \"".$form_tel1."\";\n");
fwrite($fp, "\$d['member']['form_tel2'] = \"".$form_tel2."\";\n");
fwrite($fp, "\$d['member']['form_job'] = \"".$form_job."\";\n");
fwrite($fp, "\$d['member']['form_marr'] = \"".$form_marr."\";\n");
fwrite($fp, "\$d['member']['form_addr'] = \"".$form_addr."\";\n");
fwrite($fp, "\$d['member']['form_qa_p'] = \"".$form_qa_p."\";\n");
fwrite($fp, "\$d['member']['form_home_p'] = \"".$form_home_p."\";\n");
fwrite($fp, "\$d['member']['form_tel1_p'] = \"".$form_tel1_p."\";\n");
fwrite($fp, "\$d['member']['form_tel2_p'] = \"".$form_tel2_p."\";\n");
fwrite($fp, "\$d['member']['form_job_p'] = \"".$form_job_p."\";\n");
fwrite($fp, "\$d['member']['form_marr_p'] = \"".$form_marr_p."\";\n");
fwrite($fp, "\$d['member']['form_addr_p'] = \"".$form_addr_p."\";\n");
fwrite($fp, "\$d['member']['form_nic'] = \"".$form_nic."\";\n");
fwrite($fp, "\$d['member']['form_nic_p'] = \"".$form_nic_p."\";\n");
fwrite($fp, "\$d['member']['form_birth'] = \"".$form_birth."\";\n");
fwrite($fp, "\$d['member']['form_birth_p'] = \"".$form_birth_p."\";\n");
fwrite($fp, "\$d['member']['form_sex'] = \"".$form_sex."\";\n");
fwrite($fp, "\$d['member']['form_sex_p'] = \"".$form_sex_p."\";\n");

//마이페이지
fwrite($fp, "\$d['member']['mytab_post'] = \"".$mytab_post."\";\n");
fwrite($fp, "\$d['member']['mytab_comment'] = \"".$mytab_comment."\";\n");
fwrite($fp, "\$d['member']['mytab_oneline'] = \"".$mytab_oneline."\";\n");
fwrite($fp, "\$d['member']['mytab_simbol'] = \"".$mytab_simbol."\";\n");
fwrite($fp, "\$d['member']['mytab_scrap'] = \"".$mytab_scrap."\";\n");
fwrite($fp, "\$d['member']['mytab_friend'] = \"".$mytab_friend."\";\n");
fwrite($fp, "\$d['member']['mytab_paper'] = \"".$mytab_paper."\";\n");
fwrite($fp, "\$d['member']['mytab_point'] = \"".$mytab_point."\";\n");
fwrite($fp, "\$d['member']['mytab_log'] = \"".$mytab_log."\";\n");
fwrite($fp, "\$d['member']['mytab_info'] = \"".$mytab_info."\";\n");
fwrite($fp, "\$d['member']['mytab_pw'] = \"".$mytab_pw."\";\n");
fwrite($fp, "\$d['member']['mytab_out'] = \"".$mytab_out."\";\n");

//로그인
fwrite($fp, "\$d['member']['login_point'] = \"".$login_point."\";\n");
fwrite($fp, "\$d['member']['login_emailid'] = \"".$login_emailid."\";\n");
fwrite($fp, "\$d['member']['login_openid'] = \"".$login_openid."\";\n");
fwrite($fp, "\$d['member']['login_ssl'] = \"".$login_ssl."\";\n");

fwrite($fp, "\$d['member']['layout_join'] = \"".$layout_join."\";\n");
fwrite($fp, "\$d['member']['layout_login'] = \"".$layout_login."\";\n");
fwrite($fp, "\$d['member']['layout_mypage'] = \"".$layout_mypage."\";\n");

fwrite($fp, "\$d['member']['sosokmenu'] = \"".$sosokmenu."\";\n");

//개인정보보호
fwrite($fp, "\$d['member']['inactive_table'] = \"".$inactive_table."\";\n");
fwrite($fp, "\$d['member']['inactive_email_send'] = \"".$inactive_email_send."\";\n");
fwrite($fp, "\$d['member']['active_email_send'] = \"".$active_email_send."\";\n");

fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);


if ($_join_menu == 2)
{
	$mfile = $g['path_module'].$m.'/var/job.txt';
	$fp = fopen($mfile,'w');
	fwrite($fp,trim(stripslashes($job)));
	fclose($fp);
	@chmod($mfile,0707);

	$mfile = $g['path_module'].$m.'/var/pw_question.txt';
	$fp = fopen($mfile,'w');
	fwrite($fp,trim(stripslashes($pw_question)));
	fclose($fp);
	@chmod($mfile,0707);

}
if ($_join_menu == 3)
{
	$mfile = $g['dir_module'].'var/add_field.txt';
	if(!is_array($addFieldMembers))
	{
		$addFieldMembers = array();
	}

	$fp = fopen($mfile,'w');
	foreach($addFieldMembers as $val)
	{
		fwrite($fp,$val.'|'.${'add_name_'.$val}.'|'.${'add_type_'.$val}.'|'.${'add_value_'.$val}.'|'.${'add_size_'.$val}.'|'.${'add_pilsu_'.$val}.'|'.${'add_hidden_'.$val}."\n");
	}
	if ($add_name)
	{
		fwrite($fp,$date['totime'].'|'.$add_name.'|'.$add_type.'|'.$add_value.'|'.$add_size.'|'.$add_pilsu.'|'.$add_hidden."\n");
	}
	fclose($fp);
	@chmod($mfile,0707);
}
// 휴면계정 테이블 생성 프로세스 추가
if(!$is_inactive_table)
{
    //회원기본데이터
	$_tmp = db_query( "select count(*) from ".$DB['head']."_".$inactive_table, $DB_CONNECT );
	if ( !$_tmp ) {
	$_tmp = ("

	CREATE TABLE ".$DB['head']."_".$inactive_table." (
	uid	  INT		PRIMARY KEY		NOT NULL AUTO_INCREMENT,
	memberuid 	INT				DEFAULT '0' 	NOT NULL,
	auth 	TINYINT			DEFAULT '0'		NOT NULL,
	email		VARCHAR(50)	 	DEFAULT ''		NOT NULL,
	name		VARCHAR(30)	 	DEFAULT ''		NOT NULL,
	nic			VARCHAR(50)		DEFAULT ''		NOT NULL,
	photo		VARCHAR(200)	DEFAULT ''		NOT NULL,
	home		VARCHAR(100)	DEFAULT ''		NOT NULL,
	sex			TINYINT			DEFAULT '0'		NOT NULL,
	birth1		SMALLINT		DEFAULT '0'		NOT NULL,
	birth2		SMALLINT(4)		UNSIGNED ZEROFILL DEFAULT '0000' NOT NULL,
	birthtype	TINYINT			DEFAULT '0'		NOT NULL,
	tel1		VARCHAR(14)		DEFAULT ''		NOT NULL,
	tel2		VARCHAR(14)		DEFAULT ''		NOT NULL,
	zip			VARCHAR(6)		DEFAULT ''		NOT NULL,
	addr0		VARCHAR(6)		DEFAULT ''		NOT NULL,
	addr1		VARCHAR(200)	DEFAULT ''		NOT NULL,
	addr2		VARCHAR(100)	DEFAULT ''		NOT NULL,
	job			VARCHAR(30)		DEFAULT ''		NOT NULL,
	marr1		SMALLINT		DEFAULT '0'		NOT NULL,
	marr2		SMALLINT(4)		UNSIGNED ZEROFILL DEFAULT '0000' NOT NULL,
	sms			TINYINT			DEFAULT '0'		NOT NULL,
    mailing		TINYINT			DEFAULT '0'		NOT NULL,
    sns			TEXT			NOT NULL,
	addfield	TEXT			NOT NULL,
	d_regis VARCHAR(14)		DEFAULT ''		NOT NULL,
	KEY memberuid(memberuid),
	KEY email(email),
	KEY name(name),
	KEY nic(nic),
	KEY sex(sex),
	KEY birth1(birth1),
	KEY birth2(birth2),
	KEY birthtype(birthtype),
	KEY addr0(addr0),
	KEY job(job),
	KEY marr1(marr1),
	KEY marr2(marr2),
	KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
	db_query($_tmp, $DB_CONNECT);
	db_query("OPTIMIZE TABLE ".$DB['head']."_".$inactive_table,$DB_CONNECT); 
	}
}

$_SESSION['_join_menu'] = $_join_menu;

getLink('reload','parent.','','');
?>
