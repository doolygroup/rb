<?php
// 테이블에 저장하기 
function getDormancyInsert($table,$cols,$data)
{
   global $DB_CONNECT;

	 $insertSQL = "insert into ".$table." (".implode(", ",$cols).") VALUES (";
	    
	 foreach($data as $val) 
	 {  
	      $insertSQL .= "'".$val."',";
	  }
	 $insertSQL=substr($insertSQL,0,-1).')'; // 마지막 쉼표 제거 

    db_query($insertSQL,$DB_CONNECT);

}

// 활성계정 전환 처리 함수 
function setActiveAccount($memberuid)
{
    global $g,$table,$DB,$d;
    
    include_once $g['path_module'].'member/_main.php'; 
    include_once $g['path_module'].'member/var/var.join.php';
    
    $inactive_table=$DB['head'].'_'.$d['member']['inactive_table'];
    $inactive_table_cols=getTableColum($inactive_table);    
    $inactive_info = getDbData($inactive_table,'memberuid='.$memberuid,'*');
    $sql_arr=''; 
    foreach ($inactive_table_cols as $col)
    {
          if($col!='memberuid' && $col!='d_regis')  $sql_arr.= $col."='".$inactive_info[$col]."',";
    }
    $sql_arr=substr($sql_arr,0,-1);
    
    getDbUpdate($table['s_mbrdata'],$sql_arr,'memberuid='.$memberuid);
     
    // 휴면계정 회원 auth 를 기존 auth  로 수정  
    getDbUpdate($table['s_mbrdata'],'auth='.$inactive_info['auth'],'memberuid='.$memberuid);
     
    // 복귀회원정보 세팅
    $M = getDbData($table['s_mbrdata'],'memberuid='.$memberuid,'*');

     // 휴면계정 보관 테이블 해당 데이타 삭제 
     getDbDelete($inactive_table,'memberuid='.$memberuid);
                 
     // 이메일 발송
     if($d['member']['active_email_send']&&$M['email'])
     {
    	 $R = getUidData($table['s_mbrid'],$memberuid);
        $join_email=$d['member']['join_email'];
        $send=setSendMail($M,$join_email,$R['id'],'_active');
     }
     return $memberuid;
}
// 회원메일 발송 세팅 함수
function setSendMail($M=array(),$join_email,$id,$doc)
{
    global $g,$_HS;	

   include_once $g['path_core'].'function/email.func.php';

    if($doc=='_active') $title='[공지] \''.$_HS['name'].'\' 활성계정 전환 요청에 따른 활성계정 처리 안내';  
    else if($doc=='_inactive') $title='[공지] \''.$_HS['name'].'\' 장기 미사용 회원 정보 휴면 처리 안내';

    $content = implode('',file($g['path_module'].'member/doc/'.$doc.'.txt'));
    $content = str_replace('{NAME}',$M['name'],$content);
    $content = str_replace('{NICK}',$M['nic'],$content);
    $content = str_replace('{ID}',$id,$content);
    $content = str_replace('{EMAIL}',$M['email'],$content);
    $result=getSendMail($M['email'].'|'.$M['name'], $join_email.'|'.$_HS['name'],$title, $content, 'HTML');

    return $result;
}

?>
