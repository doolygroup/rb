<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
include_once $g['dir_module'].'_main.php'; // 공통함수 파일
include_once $g['dir_module'].'var/var.join.php';
$inactive_table=$DB['head'].'_'.$d['member']['inactive_table'];
$inactive_table_cols=getTableColum($inactive_table); // 휴면계정 보관 테이블 컬럼 배열
$save_data=array(); // 개인정보 데이타 배열 
$suc_num=0; // 처리 수량 

// 휴면계정 보관용 테이블이 존재하는지 먼저 체크 
$is_table = db_query( "select count(*) from ".$inactive_table, $DB_CONNECT );

if($is_table)
{ 
		if($act=='dormant_account') 
		{
		   foreach ($mbrmembers as $memberuid)
		   {
					$M = getDbData($table['s_mbrdata'],'memberuid='.$memberuid,'*');
				
			      // 휴면계정 테이블 해당회원 데이타가 있는지 체크 
				   $is_inactive=getDbRows($inactive_table,'memberuid='.$memberuid);

				   if(!$is_inactive)
				   {
		             // 개인정보 데이타 배열 세팅
					    foreach ($inactive_table_cols as $col)
				       {   
				    	   if($col=='d_regis') $save_data[$col]=$date['totime']; // 휴면계정 등록일 
				         else $save_data[$col]=$M[$col]; // 나머지는 기존 회원 데이타값 
				       }
		            
		             // 개인정보 휴면계정 보관용 테이블로 이관
					    getDormancyInsert($inactive_table,$inactive_table_cols,$save_data);
			      
			          // 휴면계정 대상 회원정보 데이타중 개인정보 데이타를 '휴면계정' 으로 수정 (값이 있는 것만) 
			          $sql_arr=''; 
			          foreach ($inactive_table_cols as $col)
			          {
			               if($col!='memberuid' && $col!='auth' && $col!='d_regis' && $M[$col]!='')  $sql_arr.= $col."='휴면계정',";
			          }
			          $sql_arr=substr($sql_arr,0,-1);
			          getDbUpdate($table['s_mbrdata'],$sql_arr,'memberuid='.$memberuid);
			        
			          // 휴면계정 회원 auth 를 5 로 수정  
			          getDbUpdate($table['s_mbrdata'],'auth=5','memberuid='.$memberuid);

                     // 휴면계정 회원정보 세팅
                      $M1=getDbData($inactive_table,'memberuid='.$memberuid,'memberuid,email');

			          // 이메일 발송
			           if($d['member']['inactive_email_send']&&$M1['memberuid'])
			           {
			           	   $R = getUidData($table['s_mbrid'],$memberuid);
			           	   $join_email=$d['member']['join_email'];
			           	    setSendMail($M,$join_email,$R['id'],'_inactive');
			            }
				       $suc_num++;
				   }

		  
		    }	
		    $msg='총 '.$suc_num.' 명의 회원이 휴면계정으로 전환되었습니다. ';

		}else if($act=='active_account'){
		     
		   foreach ($mbrmembers as $memberuid)
		   {
		   	       // 휴면계정 테이블 해당 회원이 있는지 체크 
				   $is_inactive=getDbRows($inactive_table,'memberuid='.$memberuid);

				   if($is_inactive)
				   {
		                $setActive=setActiveAccount($memberuid);
                        if($setActive==$memberuid) $suc_num++;
				   }

		     }	
		    $msg='총 '.$suc_num.' 명의 회원이 활성계정으로 전환되었습니다. ';

		} // if act=='active_account'	

		getLink('reload','parent.',$msg,'');

}else{

    $link=$g['s'].'/?m=admin&module='.$m.'&front=dormancy';
    getLink($link,'parent.','휴면계정 보관용 테이블을 먼저 생성해주세요','');
 
 }		

?>
