<?php
$config=array(
		"basePath"=>"ckeditor/", //  กำหนด path ของ ckeditor
		"skin"=>"kama", // kama | office2003 | v2
		"language"=>"th", // th / en and more.....
		"extraPlugins"=>"uicolor", // เรียกใช้ plugin ให้สามารถแสดง UIColor Toolbar ได้
		"uiColor"=>"#FFFFFF", // กำหนดสีของ ckeditor
		"extraPlugins"=>"autogrow", // เรียกใช้ plugin ให้สามารถขยายขนาดความสูงตามเนื้อหาข้อมูล
		"autoGrow_maxHeight"=>400, // กำหนดความสูงตามเนื้อหาสูงสุด ถ้าเนื้อหาสูงกว่า จะแสดง scrollbar
		"enterMode"=>2, // กดปุ่ม Enter -- 1=แทรกแท็ก <p> 2=แทรก <br> 3=แทรก <div>
		"shiftEnterMode"=>2, // กดปุ่ม Shift กับ Enter พร้อมกัน 1=แทรกแท็ก <p> 2=แทรก <br> 3=แทรก <div>
		"height"=>200, // กำหนดความสูง
		"width"=>600,  // กำหนดความกว้าง * การกำหนดความกว้างต้องให้เหมาะสมกับจำนวนของ Toolbar
	/*	"fullPage"=>true, // กำหนดให้สามารถแก้ไขแบบเโค้ดเต็ม คือมีแท็กตั้งแต่ <html> ถึง </html>*/

		//ajaxfilemanager
		//"filebrowserBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",
		//"filebrowserImageBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",
		//"filebrowserFlashBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",

		"filebrowserBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=files",
   		"filebrowserImageBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=images",
   		"filebrowserFlashBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=flash",
  		"filebrowserUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=files",
   		"filebrowserImageUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=images",
   		"filebrowserFlashUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=flash",

    	"toolbar"=>array(
            array('Source','-','Save','NewPage','Preview','-','Templates'),
            array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'),
            array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
            /*array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),*/
            array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
            array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
            array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
            array('Link','Unlink','Anchor'),
            array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
            array('Styles','Format','Font','FontSize'),
            array('TextColor','BGColor'),
            array('Maximize', 'ShowBlocks')
        )
);

$configMini=array(
		"basePath"=>"ckeditor/", //  กำหนด path ของ ckeditor
		"skin"=>"kama", // kama | office2003 | v2
		"language"=>"th", // th / en and more.....
		"extraPlugins"=>"uicolor", // เรียกใช้ plugin ให้สามารถแสดง UIColor Toolbar ได้
		"uiColor"=>"#FFFFFF", // กำหนดสีของ ckeditor
		"extraPlugins"=>"autogrow", // เรียกใช้ plugin ให้สามารถขยายขนาดความสูงตามเนื้อหาข้อมูล
		"autoGrow_maxHeight"=>400, // กำหนดความสูงตามเนื้อหาสูงสุด ถ้าเนื้อหาสูงกว่า จะแสดง scrollbar
		"enterMode"=>2, // กดปุ่ม Enter -- 1=แทรกแท็ก <p> 2=แทรก <br> 3=แทรก <div>
		"shiftEnterMode"=>2, // กดปุ่ม Shift กับ Enter พร้อมกัน 1=แทรกแท็ก <p> 2=แทรก <br> 3=แทรก <div>
		"height"=>200, // กำหนดความสูง
		"width"=>600,  // กำหนดความกว้าง * การกำหนดความกว้างต้องให้เหมาะสมกับจำนวนของ Toolbar
	/*	"fullPage"=>true, // กำหนดให้สามารถแก้ไขแบบเโค้ดเต็ม คือมีแท็กตั้งแต่ <html> ถึง </html>*/

		//"filebrowserBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",
		//"filebrowserImageBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",
		//"filebrowserFlashBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",

		"filebrowserBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=files",
   		"filebrowserImageBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=images",
   		"filebrowserFlashBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=flash",
  		"filebrowserUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=files",
   		"filebrowserImageUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=images",
   		"filebrowserFlashUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=flash",

		"toolbar"=>array(
			 array('Source','-','Templates'),
			 array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
			 array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
			 array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
			 //array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','UIColor')
	)
);

$configSafe=array(
		"basePath"=>"ckeditor/", //  กำหนด path ของ ckeditor
		"skin"=>"kama", // kama | office2003 | v2
		"language"=>"th", // th / en and more.....
		"extraPlugins"=>"uicolor", // เรียกใช้ plugin ให้สามารถแสดง UIColor Toolbar ได้
		"uiColor"=>"#FFFFFF", // กำหนดสีของ ckeditor
		"extraPlugins"=>"autogrow", // เรียกใช้ plugin ให้สามารถขยายขนาดความสูงตามเนื้อหาข้อมูล
		"autoGrow_maxHeight"=>400, // กำหนดความสูงตามเนื้อหาสูงสุด ถ้าเนื้อหาสูงกว่า จะแสดง scrollbar
		"enterMode"=>2, // กดปุ่ม Enter -- 1=แทรกแท็ก <p> 2=แทรก <br> 3=แทรก <div>
		"shiftEnterMode"=>2, // กดปุ่ม Shift กับ Enter พร้อมกัน 1=แทรกแท็ก <p> 2=แทรก <br> 3=แทรก <div>
		"height"=>200, // กำหนดความสูง
		"width"=>600,  // กำหนดความกว้าง * การกำหนดความกว้างต้องให้เหมาะสมกับจำนวนของ Toolbar
	/*	"fullPage"=>true, // กำหนดให้สามารถแก้ไขแบบเโค้ดเต็ม คือมีแท็กตั้งแต่ <html> ถึง </html>*/

		//"filebrowserBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",
		//"filebrowserImageBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",
		//"filebrowserFlashBrowseUrl"=>"../../modules/ckeditor/plugins/ajaxfilemanager/ajaxfilemanager.php",

		"filebrowserBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=files",
   		"filebrowserImageBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=images",
   		"filebrowserFlashBrowseUrl"=>"../../modules/ckeditor/plugins/kcfinder/browse.php?type=flash",
  		"filebrowserUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=files",
   		"filebrowserImageUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=images",
   		"filebrowserFlashUploadUrl"=>"../../modules/ckeditor/plugins/kcfinder/upload.php?type=flash",

		 "toolbar"=>array(
				 array('Source')
		)
);
?>
