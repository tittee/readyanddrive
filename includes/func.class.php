<?php
class FU{ //Function Utilities

		//########################  Resize Image #################################
		function resizeAvatar($img, $resize, $display="JSH", $border="0"){
			$size = @getImagesize($img);

			if( $size ){
				if($size[0] > $resize){
					$xx = $resize;
					$yy = $size[1] * $xx / $size[0];
				}else{
					$xx = $size[0];
					$yy = $size[1];
				}
				echo '<img src="',$img,'" width="',$xx, '" height="',$yy,'" alt="',$display,'" border="',$border,'">';
			}
			return;
		}
		//########################  Resize Image #################################


		//########################  Resize Image #################################
		function resizeImg($img, $resize, $class="", $border="0"){
			$size = @getImagesize($img);

			if( $size ){
				if($size[0] > $resize){
					$xx = $resize;
					$yy = $size[1] * $xx / $size[0];
				}else{
					$xx = $size[0];
					$yy = $size[1];
				}
				echo '<img src="',$img,'" width="',$xx, '" height="',$yy,'" class="',$class,'" border="',$border,'">';
			}
			return;
		}
		//########################  Resize Image #################################

		/* Resize Picture on the fly */
		#===================================================================
		function thumbnail_calcsize($w, $h, $square){
			//$k = $square / max($w, $h);
			//return array($w*$k, $h*$k);

			$xx = $square;
			$yy = $h * $xx / $w;
			return array($xx, $yy);
		}

		//don't forget to insert thumbnail_calcsize function (see above)
		function thumbnail_generator($srcfile, &$params){
			// getting source image size
			@list($w, $h) = getimagesize($srcfile);
			if ($w == false) return false;

			// checking params array
			if (!(is_array($params)&&is_array($params[0]))) return false;

			$src = ImageCreateFromJpeg($srcfile);
			list($s1_w, $s1_h) = FU::thumbnail_calcsize($w, $h, $params[0]['size']);

			// Create first thumbnail
			// Remember, first thumbnail should be largest thumbnail
			$img_s1 = imagecreatetruecolor($s1_w, $s1_h);
			imagecopyresampled($img_s1, $src, 0, 0, 0, 0, $s1_w, $s1_h, $w, $h);
			imagedestroy($src); // Destroy source image

			// Other thumbnails are just downscaled copies of the first one
			for($i=1; $i<sizeof($params); $i++)    {
				list($cur_w, $cur_h) = FU::thumbnail_calcsize($w, $h, $params[$i]['size']);
				$img_cur = imagecreatetruecolor($cur_w, $cur_h);
				imagecopyresampled($img_cur, $img_s1, 0, 0, 0, 0, $cur_w, $cur_h, $s1_w, $s1_h);
				imagejpeg($img_cur, $params[$i]['file'], 90);
				imagedestroy($img_cur);
			}

			// Saving first thumbnail
			imagejpeg($img_s1, $params[0]['file'], 90);
			imagedestroy($img_s1);

			return true;
		}

		function thumb_cropresize($source,$dest,$size) {

			$thumb_size = $size;

			$size = getimagesize($source);
			$width = $size[0];
			$height = $size[1];

			if($width> $height) {
			$x = ceil(($width - $height) / 2 );
			$width = $height;
			} elseif($height> $width) {
			$y = ceil(($height - $width) / 2);
			$height = $width;
			}

			$new_im = ImageCreatetruecolor($thumb_size,$thumb_size);
			$im = imagecreatefromjpeg($source);
			imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size,$thumb_size,$width,$height);
			imagejpeg($new_im,$dest,100);

		}

		function cropImage($nw, $nh, $source, $stype, $dest) {

		    $size = getimagesize($source);
		    $w = $size[0];
		    $h = $size[1];

		    switch($stype) {
		        case 'gif':
		        $simg = imagecreatefromgif($source);
		        break;
		        case 'jpg':
		        case 'jpeg':
		        $simg = imagecreatefromjpeg($source);
		        break;
		        case 'png':
		        $simg = imagecreatefrompng($source);
		        break;
		    }

		    $dimg = imagecreatetruecolor($nw, $nh);

		    $wm = $w/$nw;
		    $hm = $h/$nh;

		    $h_height = $nh/2;
		    $w_height = $nw/2;

		    if($wm > $hm) {

		        $adjusted_width = $w / $hm;
		        $half_width = $adjusted_width / 2;
		        $int_width = $half_width - $w_height;

		        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);

		    } elseif(($wm <$hm) || ($wm == $hm)) {

		        $adjusted_height = $h / $wm;
		        $half_height = $adjusted_height / 2;
		        $int_height = $half_height - $h_height;

		        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);

		    } else {
		        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
		    }

		    imagejpeg($dimg,$dest,100);
		}
		#=================================================================


		//########################  HTML Util ##################################
		function HL($text, $keyword){
			$replace = "<span style=background-color:pink>$keyword</span>";
			$text = str_replace($keyword, $replace, $text);
			return $text;
		}

		//Link Url
		function LinkUrl($msg){

			$msg = eregi_replace('([[:space:]]|^)(www)', '\\1http://\\2', $msg);
			$prefix = '(http|https)://';
			$pureUrl = '([[:alnum:]/\n+-=%&:_.~?]+[#[:alnum:]+]*)';
			$msg = eregi_replace($prefix . $pureUrl, '<a href="redirect.php?url=\\1://\\2" target="_blank">\\1://\\2</a>', $msg);

			return( $msg );
		}

		function prefix_zerofill ($num,$zerofill) {
			while (strlen($num)<$zerofill) {
				$num = "0".$num;
			}
			return $num;
		}

		function post_zerofill ($num,$zerofill) {
			while (strlen($num)<$zerofill) {
				$num = $num."0";
			}
			return $num;
		}


		function SmartUrlEncode($url){
			if (strpos($url, '=') === false):
				return $url;
			else:
				$startpos = strpos($url, "?");
				$tmpurl=substr($url, 0 , $startpos+1) ;
				$qryStr=substr($url, $startpos+1 ) ;
				 $qryvalues=explode("&", $qryStr);
				  foreach($qryvalues as $value):
					  $buffer=explode("=", $value);
					$buffer[1]=urlencode($buffer[1]);
				   endforeach;
				  //$finalqrystr=implode("&amp;", &$qryvalues);
				$finalURL=$tmpurl . $finalqrystr;
				return $finalURL;
			endif;
		}

		//########################  HTML Util ##################################


		//########################  Network Util ################################
		function GetIP()
		{
		   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
				   $ip = getenv("HTTP_CLIENT_IP");
			   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
				   $ip = getenv("HTTP_X_FORWARDED_FOR");
			   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				   $ip = getenv("REMOTE_ADDR");
			   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
				   $ip = $_SERVER['REMOTE_ADDR'];
			   else
				   $ip = "unknown";
		   return($ip);
		}/*-------GetIP()-------*/

		function getSubdomain($maindomain){
			return preg_replace("/(\.)?(".$maindomain.")$/", "", $_SERVER["HTTP_HOST"]);
		}

		function checkValidSubdomain($sub, $domainname){
			if( $sub && $sub != "www") {
			//$url = $dbObj->getFriendSkinName($subdomain);
			}
			else {//Main
				//redirect home
				mosRedirect("http://www.".$domainname);
			}
		}
		//########################  Network Util ################################


		///////////////////////////////////////// Java Script /////////////////////////////////////////////////
		##### ¿Ñ§¡ìªÑè¹¡ÃÍ§¤ÓËÂÒº áÅÐ¤Óâ¦É³Ò  #####
		function alert_mesg($message) {
			echo "<script language='javascript'>" ;
			echo "alert('$message')" ;
			echo "</script>" ;
		} // alert

		/* function goto($message,$link) {
		   echo "<input type='button' value='$message' onclick=\"location='$link'\">" ;
		} */

		function makeRandom() {
			$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
			$len = strlen($salt);
			$makepass="";
			mt_srand(10000000*(double)microtime());
			for ($i = 0; $i < 4; $i++)
			$makepass .= $salt[mt_rand(0,$len - 1)];
			return $makepass;
		}

		function makeRandomCustom($num) {
			$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
			$len = strlen($salt);
			$makepass="";
			mt_srand(10000000*(double)microtime());
			for ($i = 0; $i < $num; $i++)
			$makepass .= $salt[mt_rand(0,$len - 1)];
			return $makepass;
		}
		///////////////////////////////////////// Java Script /////////////////////////////////////////////////



		//########################  About Picture #################################3
		function unlinkImage($abspath, $filename)
		{
			if( !empty($filename)){
				if (file_exists($abspath.$filename))
					@unlink( $abspath.$filename );
			}
		}

		function RemoveExtension( $fileName )
		{
			return substr( $fileName, 0, strrpos( $fileName, '.' ) ) ;
		}

		function upload_WithRename_SmallOption( $FVARS, $sServerDir, $type="New"){		//äÁèàªç¤ÍÐäÃ·Ñé§¹Ñé¹ á¤è¶éÒª×èÍ«éÓ¡Ñ¹ ¡ç rename (number)
			$sFileName = "";

			$oFile = $FVARS ;
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;
				//echo $sFileName;

				//File Allowed
				$sOriginalFileName = $sFileName ;
				$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
				$sExtension = strtolower( $sExtension ) ;

				//Upload Member Picture
				// Initializes the counter used to rename the file, if another one with the same name already exists.
				$iCounter = 0 ;

				while ( true )
				{
					// Compose the file path.
					$sFilePath = $sServerDir . $sFileName ;

					// If a file with that name already exists.
					if ( is_file( $sFilePath ) )
					{
						$iCounter++ ;
						$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
					}
					else
					{
						move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;
						if ( is_file( $sFilePath ) )
						{
							$oldumask = umask(0) ;
							chmod( $sFilePath, 0777 ) ;
							umask( $oldumask ) ;
						}

						break ;
					}
				}

			}//if( !empty( $_FILES['name'] ) )
			return $sFileName;
		}

		function unlinkImageTag($abspath, $text)
		{
			preg_match_all ( '#(?:<img )([^>]*?)(?:/?>)#is', $text, $imgtags, PREG_PATTERN_ORDER );

			$imgcontents = array();

			foreach ( (array) $imgtags[1] as $img )
			{
			preg_match_all ( '#([a-zA-Z]*?)=[\'"]([^"\']*)["\']#i', $img, $attributes, PREG_PATTERN_ORDER );
			$attrs = array();
			foreach ( (array) $attributes[1] as $key => $attr )
			{
			$attrs[$attributes[1][$key]] = $attributes[2][$key];
			}
			$imgcontents[] = $attrs;
			}

			//print_r($imgcontents);
			$num = count($imgcontents);
			for( $i = 0; $i < $num; $i++){

				if( !empty($imgcontents[$i]["src"]) ){
					echo "<br>".$abspath.$imgcontents[$i]["src"];

					if (file_exists($abspath.$imgcontents[$i]["src"]))
						unlink( $abspath.$imgcontents[$i]["src"] );
				}
			}
		}

		///////// Upload Picture /////////////////
		function upload_cropresize($FVARS, $sServerDir, $arAllowed, $arDenied, $crop2size){
			$sFileName = "";
			$resultReturn = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) )
			{
				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File Allowed
				$sOriginalFileName = $sFileName ;
				$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
				$sExtension = strtolower( $sExtension ) ;

				// Check if it is an allowed extension.
				if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){

					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "File type not permit.";
					//FU::alert_mesg($resultReturn["Msg"]);

				}else{

					$resultReturn["Flag"] = 0;
					$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

					$size = getimagesize($oFile['tmp_name']);

					if( $size[0] > $crop2size ){
						#100x100
						//====================================================================================
						$thumbnailFile = FU::RemoveExtension( $sFileName ).'-2p.'.$sExtension;

						$resultReturn["sCropImage"] = $thumbnailFile;
						@FU::thumb_cropresize($oFile['tmp_name'], $sServerDir.$thumbnailFile, $crop2size);
						if ( is_file( $sServerDir.$thumbnailFile ) )
						{
							$oldumask = umask(0) ;
							chmod( $sServerDir.$thumbnailFile, 0777 ) ;
							umask( $oldumask ) ;
						}
						//====================================================================================
					}else{
						$thumbnailFile = FU::RemoveExtension( $sFileName ).'-1p.'.$sExtension;
						$sFilePath = $sServerDir . $thumbnailFile ;
						move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;
						if ( is_file( $sFilePath ) )
						{
							$oldumask = umask(0) ;
							chmod( $sFilePath, 0777 ) ;
							umask( $oldumask ) ;
						}
						$resultReturn["sCropImage"] = $thumbnailFile;
					}
				}
			}
			else{
				$resultReturn["Flag"] = 1;
				$resultReturn["Msg"] = "No file uploaded.";
			}
			return $resultReturn;
		}

		function uploadAvatar_cropresize($FVARS, $sServerDir, $arAllowed, $arDenied){
			$sFileName = "";
			$resultReturn = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) )
			{
				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File Allowed
				$sOriginalFileName = $sFileName ;
				$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
				$sExtension = strtolower( $sExtension ) ;

				// Check if it is an allowed extension.
				if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){

					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "File type not permit.";
					//FU::alert_mesg($resultReturn["Msg"]);

				}else{

					$resultReturn["Flag"] = 0;

					$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

					$size320 = 320;
					$size100 = 100;

					$size = getimagesize($oFile['tmp_name']);

					if( $size[0] > $size320 ){

							// Setting params array for thumbnail_generator
							//====================================================================================
							$thumbnailFile320 = FU::RemoveExtension( $sFileName ).'-1p.'.$sExtension;
							$params320 = array( array( 'size' => '320', 'file' => $sServerDir.$thumbnailFile320) );

							$resultReturn["sThumbnail320"] = $thumbnailFile320;
							if (FU::thumbnail_generator($oFile['tmp_name'], $params320) == false) die("Error processing uploaded thumb file {$u_filename}");
							if ( is_file( $sServerDir.$thumbnailFile320 ) )
							{
								$oldumask = umask(0) ;
								chmod( $sServerDir.$thumbnailFile320, 0777 ) ;
								umask( $oldumask ) ;
							}
							//=====================================================================================

							#100x100
							//====================================================================================
							$thumbnailFile100 = FU::RemoveExtension( $sFileName ).'-2p.'.$sExtension;

							$resultReturn["sThumbnail100"] = $thumbnailFile100;
							@FU::thumb_cropresize($oFile['tmp_name'], $sServerDir.$thumbnailFile100, '100');
							if ( is_file( $sServerDir.$thumbnailFile100 ) )
							{
								$oldumask = umask(0) ;
								chmod( $sServerDir.$thumbnailFile100, 0777 ) ;
								umask( $oldumask ) ;
							}
							//====================================================================================
					}
					else if( $size[0] <= $size320 && $size[0] >= $size100 ){

							//echo "<br> < 320 --------------------   > 100";
							#100x100
							//====================================================================================
							$thumbnailFile100 = FU::RemoveExtension( $sFileName ).'-2p.'.$sExtension;
							$resultReturn["sThumbnail100"] = $thumbnailFile100;
							@FU::thumb_cropresize($oFile['tmp_name'], $sServerDir.$thumbnailFile100, '100');
							if ( is_file( $sServerDir.$thumbnailFile100 ) )
							{
								$oldumask = umask(0) ;
								chmod( $sServerDir.$thumbnailFile100, 0777 ) ;
								umask( $oldumask ) ;
							}
							//====================================================================================

							$file320 = FU::RemoveExtension( $sFileName ).'-1p.'.$sExtension;
							$sFilePath320 = $sServerDir . $file320 ;
							move_uploaded_file( $oFile['tmp_name'], $sFilePath320 ) ;
							if ( is_file( $sFilePath320 ) )
							{
								$oldumask = umask(0) ;
								chmod( $sFilePath320, 0777 ) ;
								umask( $oldumask ) ;
							}
							$resultReturn["sThumbnail320"] = $file320;

					}
					else if( $size[0] < $size100 ){

							//echo "<br> <  100";

							$thumbnailFile320 = FU::RemoveExtension( $sFileName ).'-1p.'.$sExtension;
							$sFilePath = $sServerDir . $thumbnailFile320 ;
							move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;
							if ( is_file( $sFilePath ) )
							{
								$oldumask = umask(0) ;
								chmod( $sFilePath, 0777 ) ;
								umask( $oldumask ) ;
							}
							$resultReturn["sThumbnail320"] = $thumbnailFile320;
							$resultReturn["sThumbnail100"] = $thumbnailFile320;
					}
				}
			}
			else{
				$resultReturn["Flag"] = 1;

			}
			return $resultReturn;
		}

		#//Upload New Image
		function uploadNewImage( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $rename="1"){
			$sFileName = "";
			$resultReturn = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ($sFileName) มีขนาดใหญ่เกินที่กำหนดไว้";
				}else{
					$resultReturn["Flag"] = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"] = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ($sFileName)  ไม่ได้รับอนุญาตครับ";
					}else{
							$resultReturn["Flag"] = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);
							if($size[0] > $maxWidth) {
								$resultReturn["Flag"] = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ($sFileName)  มีความกว้างเกินที่กำหนดไว้";
							}else{
								$resultReturn["Flag"] = 0;

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}
										break ;
									}
								}
							}

					}
				}
				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = "";
				else
					$resultReturn["sFileName"] = $sFileName;

			}//if( !empty( $_FILES['file1'] ) )


			return $resultReturn;
		}


		///////////////////

		#//Upload New Image With New name
		function uploadNewImageWithNewname( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $newname){
			$sFileName = "";
			$resultReturn = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ($sFileName) มีขนาดใหญ่เกินที่กำหนดไว้";
				}else{
					$resultReturn["Flag"] = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"] = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ($sFileName)  ไม่ได้รับอนุญาตครับ";
					}else{
							$resultReturn["Flag"] = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);
							if($size[0] > $maxWidth) {
								$resultReturn["Flag"] = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ($sFileName)  มีความกว้างเกินที่กำหนดไว้";
							}else{
								$resultReturn["Flag"] = 0;

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									$sFileName = $newname.".".$sExtension;

									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}
										break ;
									}
								}
							}

					}
				}
				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = "";
				else
					$resultReturn["sFileName"] = $sFileName;

			}//if( !empty( $_FILES['file1'] ) )


			return $resultReturn;
		}
		//////////////////


		#//Upload Edit Image With New Name
		function uploadEditImageWithNewname( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $OldPicture, $newname){
			$sFileName = "";
			$oFile = $FVARS ;

			//Upload and delete old files, Get the posted file.
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo "File1 ". $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"]  = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"]  = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo "File1 ". $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"]  = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);

							if($size[0] > $maxWidth) {  //ถ้าความกว้างมากกว่า 80 pixels (แก้ไขได้ที่ config)
								$resultReturn["Flag"]  = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีความกว้างเกินที่กำหนดไว้";
								//echo "File1 ". $resultReturn["Msg"];
							}else{
								$resultReturn["Flag"]  = 0;

								//echo "Here Step 3";

								//Delete Old Picture
								if (file_exists($sServerDir.$OldPicture)){
									unlink($sServerDir.$OldPicture );
								}

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									$sFileName = $newname.".".$sExtension;
									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										break ;
									}
								}
							}
					}
				}

				if( $resultReturn["Flag"] == 1 )
					$resultReturn["sFileName"] = $OldPicture;
				else
					$resultReturn["sFileName"] = $sFileName;

			}//if( !empty( $_FILES['file1'] ) )
			else{
				//$resultReturn["Flag"] = 0;
				$resultReturn["sFileName"] = $OldPicture;
			}

			return $resultReturn;
		}

		#Upload New Image & Crop
		function uploadNewImage_cropXY( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $reduceW, $reduceH, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
				}else{
					$resultReturn["Flag"] = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"] = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
					}else{
							$resultReturn["Flag"] = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);
							if($size[0] > $maxWidth) {
								$resultReturn["Flag"] = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีความกว้างเกินที่กำหนดไว้";
							}else{
								$resultReturn["Flag"] = 0;

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										// Setting params array for thumbnail_generator
										$thumbnailFile = FU::RemoveExtension( $sFileName ).'-'.$reduceW.'p.'.$sExtension;
										$resultReturn["sThumbnail"] = $thumbnailFile;
										FU::cropImage($reduceW, $reduceH, $sServerDir.$sFileName, $sExtension, $sServerDir.$thumbnailFile);
										break ;
									}
								}//while
							}

					}
				}
				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = "";
				else
					$resultReturn["sFileName"] = $sFileName;

			}//if( !empty( $_FILES['file1'] ) )


			return $resultReturn;
		}

		#//Upload New Image and Reduce picture size on the fly
		function uploadNewImage_reducesize( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $reducesize, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
				}else{
					$resultReturn["Flag"] = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"] = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
					}else{
							$resultReturn["Flag"] = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);
							if($size[0] > $maxWidth) {
								$resultReturn["Flag"] = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีความกว้างเกินที่กำหนดไว้";
							}else{
								$resultReturn["Flag"] = 0;

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										// Setting params array for thumbnail_generator
										$thumbnailFile = FU::RemoveExtension( $sFileName ).'-'.$reducesize.'p.'.$sExtension;
										$params = array(array('size' => $reducesize, 'file' => $sServerDir.$thumbnailFile));

										$resultReturn["sThumbnail"] = $thumbnailFile;

										if (FU::thumbnail_generator($sServerDir.$sFileName, $params) == false) die("Error processing uploaded thumb file {$u_filename}");

										break ;
									}
								}//while
							}

					}
				}
				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = "";
				else
					$resultReturn["sFileName"] = $sFileName;

			}//if( !empty( $_FILES['file1'] ) )


			return $resultReturn;
		}
		#======================================================================================================================

		#//Upload Edit Image
		function uploadEditImage( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $OldPicture, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			//Upload and delete old files, Get the posted file.
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo "File1 ". $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"]  = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"]  = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo "File1 ". $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"]  = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);

							if($size[0] > $maxWidth) {  //ถ้าความกว้างมากกว่า 80 pixels (แก้ไขได้ที่ config)
								$resultReturn["Flag"]  = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีความกว้างเกินที่กำหนดไว้";
								//echo "File1 ". $resultReturn["Msg"];
							}else{
								$resultReturn["Flag"]  = 0;

								//echo "Here Step 3";

								//Delete Old Picture
								if (file_exists($sServerDir.$OldPicture)){
									unlink($sServerDir.$OldPicture );
								}

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;
									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										break ;
									}
								}
							}
					}
				}

				if( $resultReturn["Flag"] == 1 )
					$resultReturn["sFileName"] = $OldPicture;
				else
					$resultReturn["sFileName"] = $sFileName;

			}//if( !empty( $_FILES['file1'] ) )
			else{
				//$resultReturn["Flag"] = 0;
				$resultReturn["sFileName"] = $OldPicture;
			}

			return $resultReturn;
		}

		#//Upload Edit Image and reduce size on the fly
		function uploadEditImage_reducesize( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $OldThumb, $OldPicture, $reducesize, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			//Upload and delete old files, Get the posted file.
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo "File1 ". $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"]  = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"]  = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo "File1 ". $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"]  = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);

							if($size[0] > $maxWidth) {  //ถ้าความกว้างมากกว่า 80 pixels (แก้ไขได้ที่ config)
								$resultReturn["Flag"]  = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีความกว้างเกินที่กำหนดไว้";
								//echo "File1 ". $resultReturn["Msg"];
							}else{
								$resultReturn["Flag"]  = 0;

								//echo "Here Step 3";

								//Delete Old Picture
								if (file_exists($sServerDir.$OldPicture)){
									@unlink($sServerDir.$OldPicture );
								}

								if (file_exists($sServerDir.$OldThumb)){
									@unlink($sServerDir.$OldThumb );
								}

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										// Setting params array for thumbnail_generator
										$thumbnailFile = FU::RemoveExtension( $sFileName ).'-'.$reducesize.'p.'.$sExtension;
										$params = array(array('size' => $reducesize, 'file' => $sServerDir.$thumbnailFile));

										$resultReturn["sThumbnail"] = $thumbnailFile;

										if (FU::thumbnail_generator($sServerDir.$sFileName, $params) == false) die("Error processing uploaded thumb file {$u_filename}");

										break ;
									}
								}//while
							}
					}
				}

				$resultReturn["sFileName"] = $sFileName;

				if( $resultReturn["Flag"]  == 1 ){
					$resultReturn["sFileName"] = $OldPicture;
					$resultReturn["sThumbnail"] = $OldThumb;
				}

			}//if( !empty( $_FILES['file1'] ) )
			else{
				$resultReturn["sFileName"] = $OldPicture;
				$resultReturn["sThumbnail"] = $OldThumb;
			}

			return $resultReturn;
		}

		#//Upload Edit Image and reduce size on the fly
		function uploadEditImage_cropXY( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $maxWidth, $reduceW, $reduceH, $OldThumb, $OldPicture, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			//Upload and delete old files, Get the posted file.
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo "File1 ". $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"]  = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"]  = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo "File1 ". $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"]  = 0;

							//Check width pixel
							$size = getimagesize($oFile['tmp_name']);

							if($size[0] > $maxWidth) {  //ถ้าความกว้างมากกว่า 80 pixels (แก้ไขได้ที่ config)
								$resultReturn["Flag"]  = 1;
								$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีความกว้างเกินที่กำหนดไว้";
								//echo "File1 ". $resultReturn["Msg"];
							}else{
								$resultReturn["Flag"]  = 0;

								//echo "Here Step 3";

								//Delete Old Picture
								if (file_exists($sServerDir.$OldPicture)){
									@unlink($sServerDir.$OldPicture );
								}

								if (file_exists($sServerDir.$OldThumb)){
									@unlink($sServerDir.$OldThumb );
								}

								// Initializes the counter used to rename the file, if another one with the same name already exists.
								$iCounter = 0 ;

								while ( true )
								{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;

									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										// Setting params array for thumbnail_generator
										$thumbnailFile = FU::RemoveExtension( $sFileName ).'-'.$reduceW.'p.'.$sExtension;
										$resultReturn["sThumbnail"] = $thumbnailFile;
										FU::cropImage($reduceW, $reduceH, $sServerDir.$sFileName, $sExtension, $sServerDir.$thumbnailFile);
										break ;
									}
								}//while
							}
					}
				}

				$resultReturn["sFileName"] = $sFileName;

				if( $resultReturn["Flag"]  == 1 ){
					$resultReturn["sFileName"] = $OldPicture;
					$resultReturn["sThumbnail"] = $OldThumb;
				}

			}//if( !empty( $_FILES['file1'] ) )
			else{
				$resultReturn["sFileName"] = $OldPicture;
				$resultReturn["sThumbnail"] = $OldThumb;
			}

			return $resultReturn;
		}
		#=======================================================================================================================



		#//Upload New File
		function uploadNewFile( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"] = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"] = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"] = 0;

							// Initializes the counter used to rename the file, if another one with the same name already exists.
							$iCounter = 0 ;

							while ( true )
							{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;
									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}
										break ;
									}
							}
					}
				}
				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = "";
			}//if( !empty( $_FILES['file1'] ) )
			$resultReturn["sFileName"] = $sFileName;

			return $resultReturn;
		}
		#======================================================================================================================

		#//Upload Edit Image
		function uploadEditFile( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $OldFile, $rename=1){
			$sFileName = "";
			$oFile = $FVARS ;

			//Upload and delete old files, Get the posted file.
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo "File1 ". $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"]  = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"]  = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo "File1 ". $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"]  = 0;

							//echo "Here Step 3";

							//Delete Old Picture
							//echo $sServerDir.$OldFile;
							//echo "<br>";
							if (file_exists($sServerDir.$OldFile)){
								//echo "exists";
								//echo $sServerDir.$OldFile;
								@unlink($sServerDir.$OldFile );
							}else{
								//echo "Not exists";
							}
							//exit;

							// Initializes the counter used to rename the file, if another one with the same name already exists.
							$iCounter = 0 ;

							while ( true )
							{
									// Compose the file path.
									if( $rename == 1 )
										$sFileName = date('YmdHis').FU::makeRandom().".".$sExtension;
									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										break ;
									}
							}
					}
				}

				$resultReturn["sFileName"] = $sFileName;

				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = $OldFile;

			}//if( !empty( $_FILES['file1'] ) )
			else{
				$resultReturn["sFileName"] = $OldFile;
			}

			return $resultReturn;
		}

		#===================================================================================



		#//Upload New File with New name
		function uploadNewFileWithNewName( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $newname){
			$sFileName = "";
			$oFile = $FVARS ;

			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"] = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"] = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"] = 0;

							// Initializes the counter used to rename the file, if another one with the same name already exists.
							$iCounter = 0 ;

							while ( true )
							{
									// Compose the file path.
									$sFileName = $newname.".".$sExtension;
									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}
										break ;
									}
							}
					}
				}
				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = "";
			}//if( !empty( $_FILES['file1'] ) )
			$resultReturn["sFileName"] = $sFileName;

			return $resultReturn;
		}

		#//Upload Edit File with newname
		function uploadEditFileWithNewName( $FVARS, $sServerDir, $arAllowed, $arDenied, $maxSize, $OldFile, $newname){
			$sFileName = "";
			$oFile = $FVARS ;

			//Upload and delete old files, Get the posted file.
			if( !empty( $oFile['name'] ) ){

				// Get the uploaded file name and extension.
				$sFileName = $oFile['name'] ;

				//File size
				if( $oFile['size'] > $maxSize ){
					$resultReturn["Flag"] = 1;
					$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload มีขนาดใหญ่เกินที่กำหนดไว้";
					//echo "File1 ". $resultReturn["Msg"];
				}else{
					$resultReturn["Flag"]  = 0;

					//File Allowed
					$sOriginalFileName = $sFileName ;
					$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
					$sExtension = strtolower( $sExtension ) ;

					// Check if it is an allowed extension.
					if ( ( count($arAllowed) > 0 && !in_array( $sExtension, $arAllowed ) ) || ( count($arDenied) > 0 && in_array( $sExtension, $arDenied ) ) ){
						$resultReturn["Flag"]  = 1;
						$resultReturn["Msg"] = "ไฟล์รูปสมาชิกที่ท่าน Upload ไม่ได้รับอนุญาตครับ";
						//echo "File1 ". $resultReturn["Msg"];
					}else{
							$resultReturn["Flag"]  = 0;

							//echo "Here Step 3";

							//Delete Old Picture
							//echo $sServerDir.$OldFile;
							//echo "<br>";
							if (file_exists($sServerDir.$OldFile)){
								//echo "exists";
								//echo $sServerDir.$OldFile;
								@unlink($sServerDir.$OldFile );
							}else{
								//echo "Not exists";
							}
							//exit;

							// Initializes the counter used to rename the file, if another one with the same name already exists.
							$iCounter = 0 ;

							while ( true )
							{
									// Compose the file path.
									$sFileName = $newname.".".$sExtension;
									$sFilePath = $sServerDir . $sFileName ;

									// If a file with that name already exists.
									if ( is_file( $sFilePath ) )
									{
										$iCounter++ ;
										$sFileName = FU::RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
									}
									else
									{
										move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

										if ( is_file( $sFilePath ) )
										{
											$oldumask = umask(0) ;
											chmod( $sFilePath, 0777 ) ;
											umask( $oldumask ) ;
										}

										break ;
									}
							}
					}
				}

				$resultReturn["sFileName"] = $sFileName;

				if( $resultReturn["Flag"]  == 1 )
					$resultReturn["sFileName"] = $OldFile;

			}//if( !empty( $_FILES['file1'] ) )
			else{
				$resultReturn["sFileName"] = $OldFile;
			}

			return $resultReturn;
		}














		//Move Directory ( Delete )
		function recursive_remove_directory($directory, $empty=FALSE)
		 {
			 // if the path has a slash at the end we remove it here
			 if(substr($directory,-1) == '/')
			 {
				 $directory = substr($directory,0,-1);
			 }

			 // if the path is not valid or is not a directory ...
			 if(!file_exists($directory) || !is_dir($directory))
			 {
				 // ... we return false and exit the function
				 return FALSE;

			 // ... if the path is not readable
			 }elseif(!is_readable($directory))
			 {
				 // ... we return false and exit the function
				 return FALSE;

			 // ... else if the path is readable
			 }else{

				// we open the directory
				 $handle = opendir($directory);

				 // and scan through the items inside
				 while (FALSE !== ($item = readdir($handle)))
				 {
					// if the filepointer is not the current directory
					 // or the parent directory
					 if($item != '.' && $item != '..')
					 {
						 // we build the new path to delete
						 $path = $directory.'/'.$item;

						 // if the new path is a directory
						 if(is_dir($path))
						 {
							 // we call this function with the new path
							 recursive_remove_directory($path);

						 // if the new path is a file
						 }else{
							 // we remove the file
							 unlink($path);
						 }
					 }
				 }
				 // close the directory
				 closedir($handle);

				 // if the option to empty is not set to true
				 if($empty == FALSE)
				 {
					 // try to delete the now empty directory
					 if(!rmdir($directory))
					 {
						 // return false if not possible
						 return FALSE;
					 }
				 }
				 // return success
				 return TRUE;
			 }
		 }

		function copydirr($fromDir,$toDir,$chmod=0757,$verbose=false)
		/*
		   copies everything from directory $fromDir to directory $toDir
		   and sets up files mode $chmod
		*/
		{
			//* Check for some errors
			$errors=array();
			$messages=array();
			if (!is_writable($toDir))
			   $errors[]='target '.$toDir.' is not writable';
			if (!is_dir($toDir))
			   $errors[]='target '.$toDir.' is not a directory';
			if (!is_dir($fromDir))
			   $errors[]='source '.$fromDir.' is not a directory';
			if (!empty($errors))
			{
			   if ($verbose)
				   foreach($errors as $err)
					   echo '<strong>Error</strong>: '.$err.'<br />';
			   return false;
			}
			//*/
			$exceptions=array('.','..');
			//* Processing
			$handle=opendir($fromDir);
			while (false!==($item=readdir($handle)))
			   if (!in_array($item,$exceptions))
				   {
				   //* cleanup for trailing slashes in directories destinations
				   $from=str_replace('//','/',$fromDir.'/'.$item);
				   $to=str_replace('//','/',$toDir.'/'.$item);
				   //*/
				   if (is_file($from))
					   {
					   if (@copy($from,$to))
						   {
						   chmod($to,$chmod);
						   touch($to,filemtime($from)); // to track last modified time
						   $messages[]='File copied from '.$from.' to '.$to;
						   }
					   else
						   $errors[]='cannot copy file from '.$from.' to '.$to;
					   }
						if (is_dir($from))
					   {
						   if (@mkdir($to))
							   {
							   chmod($to,$chmod);
							   $messages[]='Directory created: '.$to;
							   }
						   else
							   $errors[]='cannot create directory '.$to;
							   copydirr($from,$to,$chmod,$verbose);
					   }
				   }
			closedir($handle);
			//*/
			//* Output
			if ($verbose)
			   {
			   foreach($errors as $err)
				   echo '<strong>Error</strong>: '.$err.'<br />';
			   foreach($messages as $msg)
				   echo $msg.'<br />';
			   }
			//*/
			return true;
		}
		//########################  Upload Picture #################################

		#=============================================================================
		# Send Mail
		#=============================================================================
		function send_mail($subject,$msg,$to_name,$to_email,$from_name,$from_email, $isSMTP=0) {

			$mail = new PHPMailer();

			if( $isSMTP == "1" ){
				$mail->IsSMTP();
				$mail->SMTPDebug = 0;
				$mail->SMTPAuth = true;
				$mail->Host = "mail.winter9.com";
				$mail->Port = 25;
				$mail->Username = "noreply@winter9.com";
				$mail->Password = "1HP5Hzqt";
			}

			$email = $to_email;
			$name = $to_name;
			$mail->Priority = 3;
			$mail->Encoding = "8bit";
			$mail->CharSet = "utf-8";
			$mail->From = $from_email;
			$mail->FromName = $from_name;
			$mail->WordWrap = 50;                              // set word wrap
			$mail->IsHTML(true);									// send as HTML
			$mail->Subject = $subject;
			$mail->Body =  $msg;

			$mail->AltBody  =  "This is the text-only body";

			$mail->AddAddress($email, $name);

			/*
			$bcc_Email = "chaiyut_p@hotmail.com,chaiyut_p@eighteggs.com";
			$cc_Email = "support@8webs.com,sales@8webs.com";
		  	if( $bcc_Email != '' ) {
		    	$indiBCC = explode(",", $bcc_Email);
		    	foreach ($indiBCC as $key => $value) {
		    	  $mail->AddBCC($value);
		    	}
		  	}

		  	if ( $cc_Email != '' ) {
		    	$indiCC = explode(",", $cc_Email);
		    	foreach ($indiCC as $key => $value) {
		      		$mail->AddCC($value);
		    	}
		  	}
			*/
			//if( $cc_sender == "y" )
			//$mail->AddBCC('chaiyut_p@8webs.com', 'Chaiyut 8webs');

			if(!$mail->Send())
			{
				//echo "<br><font color=red>Message was not sent <p>";
				//echo "Mailer Error: " . $mail->ErrorInfo;
				//echo "There has been a mail error sending to ". $email."</font><br>";
				$sendFlag = 0;
			}else{
				// Write $somecontent to our opened file.
				//$content = "Success send mail to ".$email." ". date("l dS of F Y h:i:s A") ."\n";
				//echo $content;
				$sendFlag = 1;
			}

			// Clear all addresses and attachments for next loop
			$mail->ClearAddresses();
			$mail->ClearAttachments();
			$mail->ClearCCs();

			unset($mail);
			$msg = "";
			unset($msg);

			return $sendFlag;

		} // end sendmail function



		// ==== I don't guarantee this is faster than the PHP 6 before needle, ====
		// ====  but it works for PHP below 6 atleast. ====
		// ==== IT ALSO HAS INCLUDE NEEDLE BOOLEAN.. ====
		function strstrbi($haystack,$needle,$before_needle,$include_needle,$case_sensitive)
		{
		  $strstr = ($case_sensitive) ? 'strstr' : 'stristr';
		  if($before_needle!=true && $before_needle!=false && isset($before_needle)){
			  die('PHP: Error in function '.chr(39).'$strstrbi'. chr(39).' :  parameter '. chr(39).'$before_needle'.chr(39).' is not a supplied as a boolean.');
		  } // END BOOLEAN CHECK '$before_needle'

		  if($include_needle!=true && $include_needle!=false && isset($include_needle)){
			die('PHP: Error in function '.chr(39).'$strstrbi'. chr(39).' : parameter '. chr(39).'$include_needle'.chr(39). ' is not a supplied as a boolean.');
		  } // END BOOLEAN CHECK '$include_needle'

		  if($case_sensitive!=true && $case_sensitive!=false && isset($case_sensitive)){
			die('PHP: Error in function '.chr(39).'$strstrbi' .chr(39).' : parameter '. chr(39).'$case_sensitive'.chr(39).' is not a supplied as a boolean.');
		  } // END BOOLEAN CHECK '$case_sensitive'

		  if(!isset($before_needle)){
			$before_needle=false;
		  }

		  if(!isset($include_needle)){
			$include_needle=true;
		  }

		  if(!isset($case_sensitive)){
			$case_sensitive=false;
		  }

		  switch($before_needle){
			case true:
			  switch($include_needle){
				case true:
				  $temp=strrev($haystack);
				  $ret=strrev(substr($strstr($temp,$needle),0));
				  break;
				// END case true : $include_needle
				case false:
				  $temp=strrev($haystack);
				  $ret=strrev(substr($strstr($temp,$needle),1));
				  break;
				// END case false : $include_needle
			  }
			  break;
			// END case true : $before_needle
			case false:
			  switch($include_needle){
				case true:
				  $ret=$strstr($haystack,$needle);
				  break;
				// END case true: $include_needle
				case false:
				  $ret=substr($strstr($haystack,$needle),1);
				  break;
				// END case false: $include_needle
			}
			break;
			// END case false : $before_needle
		  }

		  if(!empty($ret)){
			return $ret;
		  }else{
			return false;
		  }
		}

		#Copy DIR and FILE In DIR
		function smartCopy($source, $dest, $options=array('folderPermission'=>0777,'filePermission'=>0777))
		{
			$result=false;

			if (is_file($source)) {
				if ($dest[strlen($dest)-1]=='/') {
					if (!file_exists($dest)) {
						cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
					}
					$__dest=$dest."/".basename($source);
				} else {
					$__dest=$dest;
				}
				$result=copy($source, $__dest);
				chmod($__dest,$options['filePermission']);

			} elseif(is_dir($source)) {
				if ($dest[strlen($dest)-1]=='/') {
					if ($source[strlen($source)-1]=='/') {
						//Copy only contents
					} else {
						//Change parent itself and its contents
						$dest=$dest.basename($source);
						@mkdir($dest);
						chmod($dest,$options['filePermission']);
					}
				} else {
					if ($source[strlen($source)-1]=='/') {
						//Copy parent directory with new name and all its content
						@mkdir($dest,$options['folderPermission']);
						chmod($dest,$options['filePermission']);
					} else {
						//Copy parent directory with new name and all its content
						@mkdir($dest,$options['folderPermission']);
						chmod($dest,$options['filePermission']);
					}
				}

				$dirHandle=opendir($source);
				while($file=readdir($dirHandle))
				{
					if($file!="." && $file!="..")
					{
						 if(!is_dir($source."/".$file)) {
							$__dest=$dest."/".$file;
						} else {
							$__dest=$dest."/".$file;
						}
						//echo "$source/$file ||| $__dest<br />";
						$result=FU::smartCopy($source."/".$file, $__dest, $options);
					}
				}
				closedir($dirHandle);

			} else {
				$result=false;
			}
			return $result;
		}


		#Del DIR
		function deleteDirectory($dir) {
			if (!file_exists($dir)) return true;
			if (!is_dir($dir) || is_link($dir)) return unlink($dir);
				foreach (scandir($dir) as $item) {
					if ($item == '.' || $item == '..') continue;
					if (!deleteDirectory($dir . "/" . $item)) {
						chmod($dir . "/" . $item, 0777);
						if (!deleteDirectory($dir . "/" . $item)) return false;
					};
				}
				return rmdir($dir);
		}

		#geturl
		function curPageURL() {
			$pageURL = 'http';
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
				$pageURL .= "://";
				if ($_SERVER["SERVER_PORT"] != "80") {
					$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
				} else {
					$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				}
		 	return $pageURL;
		}

		function curPageName() {
			 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		}

		function formatBytes($bytes, $precision = 2) {
			$units = array('B', 'KB', 'MB', 'GB', 'TB');

			$bytes = max($bytes, 0);
			$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
			$pow = min($pow, count($units) - 1);

			$bytes /= pow(1024, $pow);

			return round($bytes, $precision) . ' ' . $units[$pow];
		}

		/////////////////////////////////////////////// End Function ///////////////////////////////////////////
}
?>
