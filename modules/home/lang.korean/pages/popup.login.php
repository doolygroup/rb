<?php include_once $g['path_module'].'member/var/var.join.php';?>

<div id="loginbox">


<form name="loginform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return loginCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login" />
<input type="hidden" name="drop" value="Y" />
<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>" />
<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>" />

<div class="xdiv"><input type="text" name="id" class="input xinput" title="<?php echo $d['member']['login_emailid']?'이메일':'아이디'?>" value="" /></div>
<div class="xdiv"><input type="password" name="pw" class="input xinput"  title="패스워드" value="" /></div>
<div class="submitbtn"><input type="submit" value=" 로그인 " class="btnblue xsubmit" /></div>
<div class="shift xfont">
<?php if($d['member']['use_login_cookie']):?>	
<input type="checkbox" name="idpwsave" value="checked" onclick="remember_idpw(this)" />로그인 유지
<?php endif?>
<?php if($d['member']['login_ssl']):?>
<br /><input type="checkbox" name="ssl" value="checked" />보안로그인(SSL)
<?php endif?>
</div>


</form>


<form name="SSLLoginForm" action="https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>" method="post" target="_action_frame_<?php echo $m?>">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login" />
<input type="hidden" name="drop" value="Y" />
<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="pw" value="" />
<input type="hidden" name="idpwsave" value="" />
</form>



</div>

<script type="text/javascript">
//<![CDATA[
function loginCheck(f)
{
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
		if (!confirm('\n\n\'로그이 유지\' 기능을 사용하면 관리자가 정한 기간동안\n\n별도로 로그인하지 않아도 자동 접속이 가능합니다. \n\n개인PC가 아닐 경우 타인이 로그인할 수 있습니다.   \n\nPC를 여러사람이 사용하는 공공장소에서는 체크하지 마세요.\n\n정말로 로그인 유지를 하시겠습니까??\n\n'))
		{
			ths.checked = false;
		}
	}
}
window.onload = function()
{
	document.title = '로그인';
	var ofs = getOfs(getId('loginbox')); 
	top.resizeTo(ofs.width+10,ofs.height+70);
	document.loginform.id.focus();
}
//]]>
</script>




