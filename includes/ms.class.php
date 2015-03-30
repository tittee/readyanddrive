<?php

	class MS{

		var $_db = null;


		//Constructor
		function MS($db)
		{
			$this->_db = $db;
		}

		function showTable($tbl_pkid=""){
			$qry = "show tables";
			$rs = $this->_db->Execute($qry);
			while( $dataPlan = $rs->FetchRow()){
				$sel = ($tbl_pkid == $dataPlan[0])? "selected" : "";
				printf("<option value=\"%s\" %s>%s</option>\n",
					$dataPlan[0], $sel, $dataPlan[0]);
			}

		}

		##============= html selection ===================================
		function selectOptionNoTag($tbl_name, $field_id, $field_name, $tbl_pkid=0)
		{
			$qry = "select $field_id, $field_name from $tbl_name order by $field_id";
			 //echo $qry;
			$rs = $this->_db->Execute($qry);
			while( $dataPlan = $rs->FetchRow()){
				$sel = ($tbl_pkid == $dataPlan[0])? "selected" : "";
				printf("<option value=\"%s\" %s>%s</option>\n",
					$dataPlan[0], $sel, $dataPlan[1]);
			}
		}

		function selectOptionByNameNoTag($tbl_name, $field_id, $field_name, $tbl_pkid=0)
		{
			$qry = "select $field_id, $field_name from $tbl_name order by binary $field_name";
			$rs = $this->_db->execQuery($qry);
			while( $dataPlan = $this->_db->fetchObject($rs)){
				$sel = ($tbl_pkid == $dataPlan->{$field_id})? "selected" : "";
				printf("<option value=\"%s\" %s>%s</option>\n",
					$dataPlan->{$field_id}, $sel, substr($dataPlan->{$field_name}, 0, 50));
			}
			$this->_db->freeresult($rs);
		}

		function selectOptionProvince($tbl_name, $tbl_pkid=0)
		{
			$qry = "select province_id, province_name from $tbl_name order by province_id";
			$rs = $this->_db->Execute($qry);
			while( $dataPlan = $rs->FetchRow()){
				$sel = ($tbl_pkid == $dataPlan[0])? "selected" : "";
				printf("<option value=\"%s\" %s>%s</option>\n",
					$dataPlan[0], $sel, $dataPlan[1]);
			}
		}

		function selectOptionProvince_en($tbl_name, $tbl_pkid=0)
		{
			$qry = "select province_id, province_name_en from $tbl_name order by province_id";
			$rs = $this->_db->Execute($qry);
			while( $dataPlan = $rs->FetchRow()){
				$sel = ($tbl_pkid == $dataPlan[0])? "selected" : "";
				printf("<option value=\"%s\" %s>%s</option>\n",
					$dataPlan[0], $sel, $dataPlan[1]);
			}
		}


		function selectReadyColor($sel=0, $sel_value){
			$strOption = "";
            $selected = ( $sel == $sel_value)? " selected" : "";
			$strOption = "<option value=\"0\"$selected>--เลือก/select--</option>\r\n";
			$strOption .= "<option value=\"1\"$selected>สีเขียว</option>\r\n";
			$strOption .= "<option value=\"2\"$selected>สีน้ำเงิน</option>\r\n";
			$strOption .= "<option value=\"3\"$selected>สีแดง</option>\r\n";
			$strOption .= "<option value=\"4\"$selected>สีเหลือง</option>\r\n";
			$strOption .= "<option value=\"5\"$selected>ธนาคารทหารไทย</option>\r\n";
			return $strOption;
		}

        /* รสชาติ */
        function getReadyColor($id){
            switch($id):
                case '1':
                    echo 'สีเขียว';
                    break;
                case '2':
                    echo 'สีน้ำเงิน';
                    break;
                case '3':
                    echo 'สีแดง';
                    break;
                case '4':
                    echo 'สีเหลือง';
                    break;
                case '5':
                    echo 'สีม่วง';
                    break;
                default:
                    echo 'ไม่ได้เลือกรสชาติ';
            endswitch;
        }

        /* เพศ */
        function selectGender($sel=0, $sel_value){
            $strOption = "";
            $selected = ( $sel == $sel_value)? " selected" : "";
            $strOption = "<option value=\"\"$selected>--เลือก/select--</option>\r\n";
            $strOption .= "<option value=\"0\"$selected>ชาย</option>\r\n";
            $strOption .= "<option value=\"1\"$selected>หญิง</option>\r\n";
            return $strOption;
        }

        function getGender($id){
            switch($id):
                case '0':
                    echo 'ชาย';
                    break;
                case '1':
                    echo 'หญิง';
                    break;
                default:
                    echo 'ไม่ได้เลือกเพศ';
            endswitch;
        }

<<<<<<< HEAD
        function sesssionColor( $sess_id ){
            $qry = " select sess_id, play_ready_color from usercolor where sess_id = '$sess_id' ";
            //echo $qry;
            $rs = $this->_db->Execute($qry);
            $result = $rs->FetchRow();
            return $result;
        }


=======
>>>>>>> Clone In Cipher
		##============= end html selection ===================================

		##============= Get function ===================================
		//Get Name of related table of nn_books
		function getName($id, $tbl, $fieldid, $fieldname){
			//$this->_db->SetFetchMode(ADODB_FETCH_NUM);

			$qry = "select $fieldname from $tbl where $fieldid = $id";
			//echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			return $result[0];
		}


        function getFullname($id, $tbl, $fieldid, $fieldname1, $fieldname2){
            //$this->_db->SetFetchMode(ADODB_FETCH_NUM);

            $qry = "select concat($fieldname1, ', ', $fieldname2) as fullname from $tbl where $fieldid = $id";
            //echo $qry;
            $rs = $this->_db->Execute($qry);
            $result = $rs->FetchRow();

            return $result[0];
        }

		function getStaffName($staffID)
		{
			$qry = "select int_adm_username from rtbl_admin_user where int_adm_id='$staffID'";
			//echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			return $result[0];
		}

		function getID($id, $tbl, $fieldid ,$fieldidsel){
			//$this->_db->SetFetchMode(ADODB_FETCH_NUM);

			$qry = "select $fieldid from $tbl where $fieldidsel = $id";
			//echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			return $result[0];
		}

		function showWebLogo($table, $tbl_id, $tbl_name){
			GLOBAL $_Config_live_site;

			$qryDetail = "select * from $table where $tbl_id = '1'";
			$rsDetail = $this->_db->Execute($qryDetail );

			if( $rsDetail->RecordCount() > 0){

				$detail = $rsDetail->FetchRow($rsDetail);

				//echo "--->".$detail[$tbl_name];
				if( !empty($detail[$tbl_name])){
					//list($width,$height)=getimagesize("$_Config_live_site/uploads/$detail[$tbl_name]");
					echo '<img border="0" src="'.$_Config_live_site.'/uploads/'.$detail[$tbl_name].'" width='.$width.'  height='.$height.' >';
				}else{
					echo '<img border="0" src="'.$_Config_live_site.'/uploads/logo_luckymusic.png">';
				}
			}else{

				echo '<img border="0" src="'.$_Config_live_site.'/uploads/logo_luckymusic.png">';
			}
		}

		function StartEvent()
		{
			$qryStartEvent = "select stie_start_event from site where site_id = '1'";
			$rsStartEvent = $this->_db->Execute($qryStartEvent);
			$rowStartEvent= $rsStartEvent->FetchRow();
			if($rowStartEvent["stie_start_event"] != "" && $rowStartEvent["stie_start_event"] != "0000-00-00"){
				return "1";
			}else{
				return "0";
			}
		}

		function EventStartDay()
		{
			$qryStartEvent = "select stie_start_event from site where site_id = '1'";
			$rsStartEvent = $this->_db->Execute($qryStartEvent);
			$rowStartEvent= $rsStartEvent->FetchRow();
			if($rowStartEvent["stie_start_event"] != "" && $rowStartEvent["stie_start_event"] != "0000-00-00"){

				$arrDOB = explode("-", $rowStartEvent['stie_start_event']);
				$rowStartEvent["day"] = date('j', mktime(0,0,0, $arrDOB[1], $arrDOB[2], $arrDOB[0]));

				return $rowStartEvent["day"];
			}
		}

		function EventStartMonth()
		{
			$qryStartEvent = "select stie_start_event from site where site_id = '1'";
			$rsStartEvent = $this->_db->Execute($qryStartEvent);
			$rowStartEvent= $rsStartEvent->FetchRow();
			if($rowStartEvent["stie_start_event"] != "" && $rowStartEvent["stie_start_event"] != "0000-00-00"){

				$arrDOB = explode("-", $rowStartEvent['stie_start_event']);
				$rowStartEvent["month"]= date('m', mktime(0,0,0, $arrDOB[1], $arrDOB[2], $arrDOB[0]));
				return $rowStartEvent["month"];

			}
		}

		function EventStartYear()
		{
			$qryStartEvent = "select stie_start_event from site where site_id = '1'";
			$rsStartEvent = $this->_db->Execute($qryStartEvent);
			$rowStartEvent= $rsStartEvent->FetchRow();
			if($rowStartEvent["stie_start_event"] != "" && $rowStartEvent["stie_start_event"] != "0000-00-00"){

				$arrDOB = explode("-", $rowStartEvent['stie_start_event']);
				$rowStartEvent["year"] = date('Y', mktime(0,0,0, $arrDOB[1], $arrDOB[2], $arrDOB[0]));
				return $rowStartEvent["year"];

			}
		}

		function getXMLGallery(){
			$qryGallery = "select * from picfrontpage where publish = '1' order by front_order asc limit 0,3 ";
			$rsGallery = $this->_db->Execute($qryGallery);

			if( $rsGallery->RecordCount() > 0 ){

				$pathXMLFile = "../xml/banner.xml";
				$file= fopen($pathXMLFile , "w+");	//fopen -- Opens file or URL

				$_xml ="<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\" ?> \n\n";
				$_xml .="<mcchall>\n";


				if ($rsGallery->RecordCount() >= "3"){
					while ($gallery = $rsGallery->FetchRow()) { //mysql_fetch_array --  Fetch a result row as an associative array, a numeric array, or both.
						$_xml .="<node>\n";
						$_xml .="<subject1></subject1>\n";
						$_xml .="<subject2></subject2>\n";
						$_xml .="<detail></detail>\n";
						$_xml .="<link></link>\n";
						$_xml .="<pic>uploads/homepage/". $gallery["front_pic"] ."</pic>\n";
						$_xml .="</node>\n\n";
					}
				}
				if ($rsGallery->RecordCount() == "2"){
					while ($gallery = $rsGallery->FetchRow()) { //mysql_fetch_array --  Fetch a result row as an associative array, a numeric array, or both.
						$_xml .="<node>\n";
						$_xml .="<subject1></subject1>\n";
						$_xml .="<subject2></subject2>\n";
						$_xml .="<detail></detail>\n";
						$_xml .="<link></link>\n";
						$_xml .="<pic>uploads/homepage/". $gallery["front_pic"] ."</pic>\n";
						$_xml .="</node>\n\n";
					}
					$_xml .="<node>\n";
					$_xml .="<subject1></subject1>\n";
					$_xml .="<subject2></subject2>\n";
					$_xml .="<detail></detail>\n";
					$_xml .="<link></link>\n";
					$_xml .="<pic>uploads/homepage/pic-3.jpg</pic>\n";
					$_xml .="</node>\n";
				}
				if ($rsGallery->RecordCount() == "1"){
					while ($gallery = $rsGallery->FetchRow()) { //mysql_fetch_array --  Fetch a result row as an associative array, a numeric array, or both.
						$_xml .="<node>\n";
						$_xml .="<subject1></subject1>\n";
						$_xml .="<subject2></subject2>\n";
						$_xml .="<detail></detail>\n";
						$_xml .="<link></link>\n";
						$_xml .="<pic>uploads/homepage/". $gallery["front_pic"] ."</pic>\n";
						$_xml .="</node>\n\n";
					}
					$_xml .="<node>\n";
					$_xml .="<subject1></subject1>\n";
					$_xml .="<subject2></subject2>\n";
					$_xml .="<detail></detail>\n";
					$_xml .="<link></link>\n";
					$_xml .="<pic>uploads/homepage/pic-2.jpg</pic>\n";
					$_xml .="</node>\n";
					$_xml .="<node>\n";
					$_xml .="<subject1></subject1>\n";
					$_xml .="<subject2></subject2>\n";
					$_xml .="<detail></detail>\n";
					$_xml .="<link></link>\n";
					$_xml .="<pic>uploads/homepage/pic-3.jpg</pic>\n";
					$_xml .="</node>\n";
				}
				$_xml .="</mcchall> ";


				fwrite($file, $_xml); //fwrite -- Binary-safe file write
				fclose($file); //fclose -- Closes an open file pointer
			}

			else {
				$pathXMLFile = "../xml/banner.xml";
				$file= fopen($pathXMLFile , "w+");	//fopen -- Opens file or URL

				$_xml ="<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\" ?> \n\n";
				$_xml .="<mcchall>\n";
				$_xml .="<node>\n";
				$_xml .="<subject1></subject1>\n";
				$_xml .="<subject2></subject2>\n";
				$_xml .="<detail></detail>\n";
				$_xml .="<link></link>\n";
				$_xml .="<pic>uploads/homepage/pic-1.jpg</pic>\n";
				$_xml .="</node>\n";
				$_xml .="<node>\n";
				$_xml .="<subject1></subject1>\n";
				$_xml .="<subject2></subject2>\n";
				$_xml .="<detail></detail>\n";
				$_xml .="<link></link>\n";
				$_xml .="<pic>uploads/homepage/pic-2.jpg</pic>\n";
				$_xml .="</node>\n";
				$_xml .="<node>\n";
				$_xml .="<subject1></subject1>\n";
				$_xml .="<subject2></subject2>\n";
				$_xml .="<detail></detail>\n";
				$_xml .="<link></link>\n";
				$_xml .="<pic>uploads/homepage/pic-3.jpg</pic>\n";
				$_xml .="</node>\n";
				$_xml .="</mcchall>\n";

				fwrite($file, $_xml); //fwrite -- Binary-safe file write
				fclose($file); //fclose -- Closes an open file pointer
			}
			return;
		}

		function DefaultCSS(){
			$pathXMLFile = "../uploads/css/change_css.css";
			$file= fopen($pathXMLFile , "w+");	//fopen -- Opens file or URL
			$css="";
			$css.="@charset \"utf-8\";\n";
			$css.="/* CSS Document */\n";
			$css.="#header_content {\n";
			$css.="	background-image: url(../../images/bg_header_center.jpg);\n";
			$css.="	background-repeat: no-repeat;\n";
			$css.="	background-position: center 0px;	\n";
			$css.="}\n";
			$css.="body {\n";
			$css.="	background-image: url(../../images/bg.jpg);\n";
			$css.="	background-repeat: repeat;\n";
			$css.="	\n";
			$css.="}\n";
			$css.="#header {	\n";
			$css.="	border-bottom-color: #FFF;\n";
			$css.="	background-color: #000;\n";
			$css.="}\n";
			fwrite($file, $css); //fwrite -- Binary-safe file write
			fclose($file); //fclose -- Closes an open file pointer
		}

		function GenCSSs($color1, $color2){

			$qryCSS = "select * from site where site_id ='1'";
			$rsCSS = $this->_db->Execute($qryCSS);
			$CSS = $rsCSS->FetchRow();

			$pathXMLFile = "../uploads/css/change_css.css";
			$file= fopen($pathXMLFile , "w+");	//fopen -- Opens file or URL
			$css="";
			$css.="@charset \"utf-8\";\n";
			$css.="/* CSS Document */\n";
			$css.="#header_content {\n";

			if($CSS["css_pic1"] != ""){
				$css.="	background-image: url(".$CSS["css_pic1"].");\n";
			}else{
				$css.="	background-image: url(../../images/bg_header_center.jpg);\n";
			}

			$css.="	background-repeat: no-repeat;\n";
			$css.="	background-position: center 0px;	\n";
			$css.="}\n";
			$css.="body {\n";

			if($CSS["css_pic2"] != ""){
				$css.="	background-image: url(".$CSS["css_pic2"].");\n";
			}else{
				$css.="	background-image: url(../../images/bg.jpg);\n";
			}

			$css.="	background-repeat: repeat;\n";
			$css.="	\n";
			$css.="}\n";
			$css.="#header {	\n";
			$css.="	border-bottom-color: ".$color2.";\n";
			$css.="	background-color: ".$color1.";\n";
			$css.="}\n";
			fwrite($file, $css); //fwrite -- Binary-safe file write
			fclose($file); //fclose -- Closes an open file pointer
		}

		function GenCSS($color1, $ImgBG,$repeat){

			$pathXMLFile = "../../uploads/css/css.css";
			$file= fopen($pathXMLFile , "w+");	//fopen -- Opens file or URL
			$css="";

			$css.="@charset \"utf-8\";\n";
			$css.="/* CSS Document */\n";
			$css.="body{\n";
			$css.="	background-color:".$color1.";\n";
			if ($ImgBG!=""){
			$css.="	background-image: url(../".$ImgBG.")!important;\n";
			}
			$css.="	background-repeat: ".$repeat.";\n";
			$css.="	background-position: bottom center;\n";
			$css.="}\n";

			fwrite($file, $css); //fwrite -- Binary-safe file write
			fclose($file); //fclose -- Closes an open file pointer
		}

		/********************************
		 * Get Title and Meta Tag
		********************************/
		/*function TitleAndMeta()
		{
			GLOBAL $_Config_live_site;
			$qryWeb = "select site_title, site_keywords, site_description from site where site_id = '1' ";
			$rsWeb = $this->_db->Execute($qryWeb);
			$Web = $rsWeb->FetchRow();

			return "<title>$Web[site_title]</title><meta name=\"keywords\" content=\"$Web[site_keywords]\" /><meta name=\"description\" content=\"$Web[site_description]\" />";
		}*/
		//************ Mate keyword Start**///////////////
		/*function getVarMain(){//ดึงค่าหลักประจำเว็บ เช่น รูป bg,รูป header , keyword ต่างๆ

			$qry = "select * from site where site_id = '1'";
			#echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			return $result;
		}*/

		function getMetaTag(){
			$qry = "select site_title, site_des, site_key from site where site_id = '1'";
			#echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			$metatag = "<title>$result[site_title]</title>\n";
			$metatag .= "<meta name=\"keywords\" content=\"$result[site_key]\" />\n";
			$metatag .= "<meta name=\"description\" content=\"$result[site_des]\" />\n";
			return $metatag;
		}

        function getGoogleAnalyticCode(){
            $qry = "select GoogleAnalyticCode from site where site_id = '1'";
            #echo $qry;
            $rs = $this->_db->Execute($qry);
            $result = $rs->FetchRow();
            return $result['GoogleAnalyticCode'];
        }

		function getMetaTagInside($tb_database, $param_id, $param_value, $param_name, $param_abstract, $param_meta){
			//tb_databse = ชื่อตาราง
			//param_id = รหัสตาราง
			//param_value = ค่าที่ได้รับ หรือ Parameter
			//param_name = ชื่อข้อมูลในตาราง  ||  //param_abstract = คำโปรยข้อมูลในตาราง  ||  //param_meta = เมตาข้อมูลในตาราง

			$qry = "select $param_id, $param_name, $param_abstract, $param_meta from $tb_database where $param_id = '$param_value'";
			#echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			$metatag = "<title>$result[$param_name]</title>\n";
			$metatag .= "<meta name=\"keywords\" content=\"$result[$param_meta]\" />\n";
			$metatag .= "<meta name=\"description\" content=\"$result[$param_abstract]\" />\n";
			return $metatag;
		}

		function getUser($member_id){//ดึงค่าหลักประจำเว็บ เช่น รูป bg,รูป header , keyword ต่างๆ

			$qry = "select * from member where member_id = '$member_id'";
			echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			return $result;
		}

		function getStatusUser($member_id){//ดึงค่าหลักประจำเว็บ เช่น รูป bg,รูป header , keyword ต่างๆ

			$qry = "select member_id,group_id from member where member_id = '$member_id'";
			#echo $qry;
			$rs = $this->_db->Execute($qry);
			$result = $rs->FetchRow();

			if( $result['group_id'] == '1'){
				echo 'Administrator';
			}else if ( $result['group_id'] == '2'){
				echo 'Staff';
			}else if ( $result['group_id'] == '3'){
				echo 'User';
			}else if ( $result['group_id'] == '88'){
				echo '8webs Support';
			}else{
				echo 'Robots';
			}
			//return $result;
		}

//		function getAllPost($member_id){//ดึงค่าการโพสต์ของ member
//
//			$qry1 = "select * from webboard_post where member_id = '$member_id'";
//			$rs1 = $this->_db->Execute($qry1);
//			$num_post = $rs1->RecordCount();
//
//			$qry2 = "select * from webboard_answer where member_id = '$member_id'";
//			$rs2 = $this->_db->Execute($qry2);
//			$num_ans = $rs2->RecordCount();
//
//			$qry3 = "select * from classified_post where member_id = '$member_id'";
//			$rs1 = $this->_db->Execute($qry1);
//			$cls_post = $rs1->RecordCount();
//
//			$qry4 = "select * from classified_answer where member_id = '$member_id'";
//			$rs2 = $this->_db->Execute($qry2);
//			$cls_ans = $rs2->RecordCount();
//
//			$allPost = $num_post + $num_ans + $cls_post + $cls_ans;
//			return $allPost;
//		}

		function num_cart(){
			$qry_list = "SELECT * FROM cart where sess_id = '$_SESSION[SESS_ID]'";
			//echo $qry_list;
			$rs_list = $this->_db->Execute($qry_list);
			$num_cart = $rs_list->RecordCount();
			return $num_cart;
		}
		function cart_totalPrice(){
			  $qry_show = "SELECT * FROM cart where sess_id = '$_SESSION[SESS_ID]'";
				// echo $qry_show;
				$rs_show =  $this->_db->Execute($qry_show);
				$total = 0;
				while ($row_show = $rs_show->FetchRow() ){
				  $total += $row_show["subtotal"];
			 }
			 return $total;

		}

        function getProductSort( $field_id, $field_name, $tbl_name, $field_where, $field_where_val, $field_order, $linkurl, $query_name ){ //$field_name_arr

            $qry = "Select $field_id, $field_name ";
//            if( is_array($field_name_arr) ) {
//                //$arrname = $field_name_arr[];
//                foreach($field_name_arr as $val => $arrname){
//                    echo "$n\n";
//                    $qry .= " $arrname, ";
//                }
//            }
            //unset($field_name_arr);
            if( !empty($field_where) ){
                $qry .= " ,$field_where ";
            }
            $qry .= " from $tbl_name ";

            if( !empty($field_where) ){
                $qry .= " where $field_where = $field_where_val ";
            }
            $qry .= " order by $field_order";
            //$qry = "select $field_name from $tbl_name where site_id = '1'";
            //echo $qry;
            $rs = $this->_db->Execute($qry);
            $text_html = "<ul> ";

            while ($result = $rs->FetchRow()){
            $text_html .= "<li class=\"current\">";
            $text_html .= "<a href=\"$linkurl?$query_name=$result[$field_id]\">$result[$field_name]</a>";
            $text_html .= "</li>";
            }
                $text_html .= "</ul>";

            return $text_html;

        }

        function getNewProductSort( $urlpagesort, $type ){ //ต้องแก้

            $text_html = "<ul> ";


                $text_html .= "<li class=\"current\">";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Pillow</a>";
                $text_html .= "</li>";
            $text_html .= "<li>";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Brackrest</a>";
            $text_html .= "</li>";
            $text_html .= "<li>";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Neckrest</a>";
            $text_html .= "</li>";
            $text_html .= "<li>";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Seat Cushion</a>";
            $text_html .= "</li>";
            $text_html .= "<li>";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Mattress</a>";
            $text_html .= "</li>";
            $text_html .= "<li>";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Premium Product &amp; Accessories</a>";
            $text_html .= "</li>";
            $text_html .= "<li>";
            $text_html .= "<a href=\"$urlpagesort?typesort=$type\">Sangkhapan Healthcare</a>";
            $text_html .= "</li>";
            $text_html .= "</ul>";

            return $text_html;

        }



	////////////////////////////////////////////////////////// End Class
	}
?>
