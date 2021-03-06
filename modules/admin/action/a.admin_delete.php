<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

foreach ($mbrmembers as $val)
{
	if ($my['uid'] == $val) continue;
	$M1 = getDbData($table['s_mbrdata'],'memberuid='.$val,'*');
	$M2 = getUidData($table['s_mbrid'],$val);
	if($auth)
	{
		if ($auth == 'D')
		{
			getDbDelete($table['s_mbrid'],'uid='.$M1['memberuid']);
			getDbDelete($table['s_mbrdata'],'memberuid='.$M1['memberuid']);
			getDbDelete($table['s_mbrcomp'],'memberuid='.$M1['memberuid']);
			getDbDelete($table['s_paper'],'my_mbruid='.$M1['memberuid']);
			getDbDelete($table['s_point'],'my_mbruid='.$M1['memberuid']);
			getDbDelete($table['s_scrap'],'mbruid='.$M1['memberuid']);
			getDbDelete($table['s_simbol'],'mbruid='.$M1['memberuid']);
			getDbDelete($table['s_friend'],'my_mbruid='.$M1['memberuid'].' or by_mbruid='.$M1['memberuid']);
			getDbUpdate($table['s_mbrlevel'],'num=num-1','uid='.$M1['level']);
			getDbUpdate($table['s_mbrgroup'],'num=num-1','uid='.$M1['mygroup']);
			getDbDelete($table['s_mbrsns'],'memberuid='.$M1['memberuid']);

			if (is_file($g['path_var'].'avatar/'.$M1['photo']))
			{
				unlink($g['path_var'].'avatar/'.$M1['photo']);
			}
			if (is_file($g['path_var'].'avatar/180.'.$M1['photo']))
			{
				unlink($g['path_var'].'avatar/180.'.$M1['photo']);
			}
			$fp = fopen($g['path_tmp'].'out/'.$M2['id'].'.txt','w');
			fwrite($fp,$date['totime']);
			fclose($fp);
			@chmod($g['path_tmp'].'out/'.$M2['id'].'.txt',0707);
		}
		else if ($auth == 'A')
		{
			getDbUpdate($table['s_mbrdata'],"admin=1,adm_view='[admin]'",'memberuid='.$M2['uid']);
		}
		else {
			getDbUpdate($table['s_mbrdata'],"auth='$auth'",'memberuid='.$M2['uid']);
		}
	}
	else {
		getDbUpdate($table['s_mbrdata'],"admin=0,adm_view=''",'memberuid='.$M2['uid']);
	}
}

getLink('reload','parent.','','');
?>
