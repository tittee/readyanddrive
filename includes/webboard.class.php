<?php

class WB{

		function bad_word($msg, $banfile)
		{
			$word = array() ;
			$file = file( $banfile ) ;  //เปิดไฟล์ขึ้นมาเพื่อนำคำหยาบออกมาตรวจหา
			$explo = explode(",",$file[0]) ; // อยู่บรรทัดเดียวกันหมดแต่มี "," คั่น
			for($b=0;$b<count($explo);$b++) {
			  $word[$b] = $explo[$b] ; // เก็บคำหยาบลง array word() ;
			}
			//echo "Cnt : ".sizeof($word);
			for($i=0;$i<sizeof($word);$i++){
				$msg = eregi_replace($word[$i],"*",$msg);
				//echo "<br>In function : $msg";
			} // for กรองคำหยาบ

			return $msg;
		}

		###   ตรวจสอบคำโฆษณาจาก Textfile   ####
		function bad_adv( $msg, $banfile ){

			$word = array() ;
			$ban_adv_file = file($banfile) ;
			$ban_adv = explode(",",$ban_adv_file[0]) ;
			for($b=0;$b<count($ban_adv);$b++) {
			  $word[$b] = $ban_adv[$b] ; // เก็บคำหยาบลง array word() ;
			}

			// วนลูปดักคำโฆษณา
			for($z=0;$z<count($word);$z++) {
			  $msg = eregi_replace($word[$z],"***",$msg);
			} // for

			return $msg;
		}

		//########################  HTML Util #################################3

}//End Class
?>
