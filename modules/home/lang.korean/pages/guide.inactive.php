<style>
#pages_inactive {}
#pages_inactive h2 {font-family:"malgun gothic",dotum;font-size:20px;padding:0 0 10px 0;margin:0;border-bottom:#999999 solid 3px;}
#pages_inactive .msg {color:#1C5B8C;font-family:dotum;line-height:150%;padding:30px 0 30px 0;}
#pages_inactive .msg a {color:#999999;font-size:11px;font-family:dotum;}
#pages_inactive .tab {height:28px;}
#pages_inactive .tab ul {position:relative;top:1px;padding:0;margin:0;}
#pages_inactive .tab li {float:left;width:125px;text-align:center;list-style-type:none;border-top:#dfdfdf solid 1px;border-right:#dfdfdf solid 1px;border-bottom:#dfdfdf solid 1px;padding:7px 7px 7px 7px;background:#efefef;cursor:pointer;color:#666666;}
#pages_inactive .tab .selected {background:#ffffff;color:#000000;border-top:#dfdfdf solid 1px;border-right:#dfdfdf solid 1px;border-bottom:#ffffff solid 1px;}
#pages_inactive .tab .lside {border-left:#dfdfdf solid 1px;}
#pages_inactive .agreebox {border:#dfdfdf solid 1px;padding:30px 30px 30px 30px;}
#pages_inactive .agreebox .tblbox {padding:15px;background:#efefef;}
#pages_inactive .agreebox table {width:100%;}
#pages_inactive .agreebox .key {width:75px;padding:10px 10px 10px 0;color:#666666;letter-spacing:-1px;text-align:right;}
#pages_inactive .agreebox .xfont {color:#999999;}
#pages_inactive .agreebox .input {width:200px;}
#pages_inactive .agreebox .submitbox {padding:20px 0 0 108px;}
#pages_inactive .agreebox .submitbox .btngray {height:25px;}
#pages_inactive .agreebox .submitbox .btnblue {width:100px;height:25px;}
#pages_inactive .inactive-text {color:#cc3467;font-weight: bold}
#pages_inactive .show-privacy {margin-left: 10px;}
#pages_inactive .show-privacy a {text-decoration: underline;color:#0099ff;}
</style>
<?php 
include_once $g['path_module'].'member/var/var.join.php';
$dormant_table=$DB['head'].'_'.$d['member']['inactive_table'];
$M=getDbData($dormant_table,'memberuid='.$mbruid,'*');
$g['use_social'] = is_file($g['path_module'].'social/var/var.php');
if ($g['use_social']) include $g['path_module'].'social/var/var.php';
?>
<div id="pages_inactive">
	<h2>휴면계정 안내</h2>
	<div class="msg">
		회원님의 계정은 현재 <span class="inactive-text">휴면</span> 상태이기 때문에 회원서비스가 제공되지 않습니다.<br />
		기존의 회원서비스를 다시 사용하시기 위해서는 다시 한번 로그인을 통해 계정 '활성화' 처리 해주시기 바랍니다. </a>
	</div>
	<div class="agreebox">
		<form name="loginform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return loginCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="login" />
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>" />
		<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>" />
		<input type="hidden" name="want_account_active" value="1"> 
		<div class="tblbox">
		<table>
			<tr>
			<td class="key"><?php echo $d['member']['login_emailid']?'이메일':'아이디'?></td>
			<td>
				<input type="text" name="id" class="input xinput" title="<?php echo $d['member']['login_emailid']?'이메일':'아이디'?>" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" />
			</td>
			</tr>
			<tr>
			<td class="key">비밀번호</td>
			<td>
				<input type="password" name="pw" class="input xinput"  title="패스워드" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" />
			</td>
			</tr>
			<tr>
			<td class="key"></td>
			<td class="xfont">
				<input type="checkbox" name="idpwsave" value="checked" onclick="remember_idpw(this)"<?php if($_COOKIE['svshop']):?> checked="checked"<?php endif?> /><?php echo $d['member']['login_emailid']?'이메일':'아이디'?>/비밀번호 기억
				<?php if($d['member']['login_ssl']):?>
				<input type="checkbox" name="ssl" value="checked" />보안로그인(SSL)
				<?php endif?>
				<input type="checkbox" name="agreecheckbox" /><span class="b">'개인정보 취급방침'</span>에 동의  <span class="show-privacy"><a href="##" onclick="showPopup('private')" >전문보기</a></span>
			</td>
			</tr>
		</table>
		</div>
		<div class="submitbox">
			<input type="button" value="취소" class="btngray" onclick="goHref('<?php echo RW(0)?>');" />
			<input type="submit" value="활성계정으로 전환 요청" class="btnblue"  style="width:180px;"/>
		</div>
		</form>
		<form name="SSLLoginForm" action="https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="login" />
		<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="pw" value="" />
		<input type="hidden" name="idpwsave" value="" />
		</form>
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
// 페이지 팝업창 열기 
function showPopup(page)
{
   window.open(rooturl+'/?mod='+page+'&iframe=Y','','left=0,top=0,width=670,height=600,scrollbars=yes,status=yes');    
}
function loginCheck(f)
{
	var f = document.loginform;
	if (f.agreecheckbox.checked == false)
	{
		alert('활성계정 전환을 원하실 경우 [개인정보취급방침]에 동의하셔야 합니다.');
		return false;
	}

	if (f.id.value == '')
	{
		alert('<?php echo $d['member']['login_emailid']?'이메일을':'아이디를'?> 입력해 주세요.');
		f.id.focus();
		return false;
	}
	if (f.pw.value == '')
	{
		alert('비밀번호를 입력해 주세요.');
		f.pw.focus();
		return false;
	}
	if (f.usessl.value == '1')
	{
		if (f.ssl.checked == true)
		{
			var fs = document.SSLLoginForm;
			fs.id.value = f.id.value;
			fs.pw.value = f.pw.value;
			if(f.idpwsave.checked == true) fs.idpwsave.value
			fs.submit();
			return false;
		}
	}	
}
function remember_idpw(ths)
{
	if (ths.checked == true)
	{
		if (!confirm('\n\n패스워드정보를 저장할 경우 다음접속시 \n\n패스워드를 입력하지 않으셔도 됩니다.\n\n그러나, 개인PC가 아닐 경우 타인이 로그인할 수 있습니다.     \n\nPC를 여러사람이 사용하는 공공장소에서는 체크하지 마세요.\n\n정말로 패스워드를 기억시키겠습니까?\n\n'))
		{
			ths.checked = false;
		}
	}
}
function snsCheck(key,use)
{
	if (use == '')
	{
		alert('선택하신 SNS는 서비스 현재 서비스중이 아닙니다.  ');
		return false;
	}
	var w;
	var h;
	switch(key) 
	{
		case 't':
			w = 810;
			h = 550;
			break;
		case 'f':
			w = 1024;
			h = 680;
			break;
		case 'm':
			w = 900;
			h = 500;
			break;
		case 'y':
			w = 450;
			h = 450;
			break;
	}
	var url = rooturl+'/?r='+raccount+'&m=social&a=snscall_direct&type='+key;
	window.open(url,'','width='+w+'px,height='+h+'px,statusbar=no,scrollbars=yes,toolbar=no');
}
//]]>
</script>
