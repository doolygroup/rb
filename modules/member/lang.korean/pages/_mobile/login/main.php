
<div id="m_loginbox">

<form name="loginform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return loginCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login" />
<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>" />
<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>" />

<div class="xdiv"><input type="text" name="id" class="input xinput" value="" /></div>
<div class="xdiv"><input type="password" name="pw" class="input xinput" value="" /></div>
<div class="xdiv">
	<div class="xl xfont">
		<?php if($d['member']['use_login_cookie']):?>
		<input type="checkbox" name="idpwsave" value="checked" />로그인 유지
		<?php endif?>
		<?php if($d['member']['login_ssl']):?>
		<br /><input type="checkbox" name="ssl" value="checked" />보안로그인(SSL)
		<?php endif?>
	</div>
	<div class="xr">
		<input type="button" value="비번찾기" class="btngray xsubmit1" onclick="goHref('<?php echo $g['url_reset']?>&page=idpwsearch');" />
		<input type="submit" value="로그인" class="btnblue xsubmit2" />
	</div>
	<div class="clear"></div>
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
//]]>
</script>
