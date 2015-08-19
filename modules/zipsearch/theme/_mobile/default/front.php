<?php $zipkey = trim($zipkey)?>
<?php $_zipkey = stripslashes(htmlspecialchars($zipkey))?>

<div id="zipbox">
	<div class="title"></div>
	<div class="ment">
		ㆍ찾고자하는 주소의 동(읍/면/리)을 입력하세요.<br />
		예) 서초동, 오창읍, 비암리<br />
	</div>

	<div class="searchform">

		<form name="frmsearch" action="<?php echo $g['s']?>/" method="post">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="action" value="search" />
		<input type="hidden" name="zip1" value="<?php echo $zip1?>" />
		<input type="hidden" name="addr1" value="<?php echo $addr1?>" />
		<input type="hidden" name="focusfield" value="<?php echo $focusfield?>" />

		<span>지역명 :</span> 
		<input type="text" value="<?php echo $_zipkey?>" name="zipkey" class="input" />
		<input type="submit" value=" 검색 " class="btnblue btn" />

		</form>

	</div>
	<div class="resultbox">
	<?php if($action == 'search' && $zipkey):?>

		<table>
			<?php
			foreach($zipfile as $data)
			{
				if(strstr($data,$zipkey))
				{
					$zip_1 = substr($data,0,3);
					$zip_2 = substr($data,4,3);

					$add_array = explode(' ', substr($data,8));
					if (substr($add_array[sizeof($add_array)-1],0,1) == '(' || intval(substr($add_array[count($add_array)-1],0,1))) 
					{
						$add = trim(str_replace($add_array[count($add_array)-1], '', substr($data,8)));	
					}
					else 
					{
						$add = trim(substr($data,8));
					}

					echo '<tr>';
					echo '<td class="td1">'.$zip_1.'-'.$zip_2.'</td>';
					echo '<td class="td2">';
					if ($zip1)
					{
						echo '<a href="javascript:zip_copy(\''.$zip_1.'\',\''.$zip_2.'\',\''.$add.'\');">'.substr($data,8).'</a>';
					}
					else {
						echo substr($data,8);
					}
					echo '</td>';
					echo '</tr>';

					$see = 1;
				}
			}

			if(!$see) {
				echo '<tr>';
				echo '<td class="none">찾으시는 지역이 검색되지 않았습니다.</td>';
				echo '</tr>';
			}
			?>
		</table>

	<?php endif?>

	</div>

	<div class="bottom">
		<input type="button" value=" 창닫기 " class="btngray" onclick="top.close();" />
	</div>

</div>








<script type="text/javascript">
//<![CDATA[
function zip_copy(zip1,zip2,addr)
{
	<?php if($focusfield):?>
	opener.document.getElementById('<?php echo $zip1?>').value = zip1 + zip2;
	opener.document.getElementById('<?php echo $addr1?>').value = addr;
	opener.document.getElementById('<?php echo $focusfield?>').focus();
	<?php endif?>
	top.close();
}
top.resizeTo(440,450);
document.title = "우편번호검색";
document.frmsearch.zipkey.focus();
//]]>
</script>
