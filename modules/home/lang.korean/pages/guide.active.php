<?php
 if(!$confirm_active || !$my['uid']) getLink($g['s'].'/','','','');
?>
<style>
#guidebox {}
#guidebox h1 {font-family:"malgun gothic",dotum;font-size:22px;padding:0 0 10px 0;margin:0 0 30px 0;border-bottom:#dfdfdf solid 1px;}
#guidebox ul {}
#guidebox li {padding:5px 0 5px 0;color:#999;}
#guidebox .back {border-top:#dfdfdf solid 1px;margin:30px 0 0 0;padding:20px 0 30px 0;text-align:right;}
</style>
<div id="guidebox">
	<h1>활성계정 안내</h1>
	<ul>
		<li><?php echo $my[$_HS['nametype']]?> 회원님의 계정이 성공적으로 활성화되었습니다. </li>
		<li>이제 기존의 회원서비스를 모두 사용하실 수 있습니다. </li>
	</ul>
</div>	
