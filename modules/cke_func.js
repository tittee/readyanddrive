// JavaScript Document
function InsertHTML(htmlValue,editorObj){// ฟังก์ขันสำหรับไว้แทรก HTML Code
	if(editorObj.mode=='wysiwyg'){
		editorObj.insertHtml(htmlValue);
	}else{
		alert( 'You must be on WYSIWYG mode!');
	}
}
function SetContents(htmlValue,editorObj){ // ฟังก์ชันสำหรับแทนที่ข้อความทั้งหมด
	editorObj.setData(htmlValue);
}
function GetContents(editorObj){// ฟังก์ชันสำหรับดึงค่ามาใช้งาน
	return editorObj.getData();
}
function ExecuteCommand(commandName,editorObj){// ฟังก์ชันสำหรับเรียกใช้ คำสั่งใน CKEditor
	if(editorObj.mode=='wysiwyg'){
		editorObj.execCommand(commandName);
	}else{
		alert( 'You must be on WYSIWYG mode!');
	}
}

/*
<script type="text/javascript" src="modules/cke_func.js"></script>
<?php
include_once("modules/ckeditor/ckeditor.php");
include_once("modules/cke_config.php");
$initialValue = '<p>This is some <strong>sample text</strong>.</p>'; // ค่าเริ่มต้น กรณีดึงข้อมูลมาแก้ไข
$CKEditor = new CKEditor();
// คืนค่าสำหรับใช้งานร่วมกับ javascript
$events['instanceReady'] = 'function (evt) {
		return editorObj=evt.editor;
}';

$CKEditor->editor("editor1", $initialValue,$config,$events);
?>

<br />
<button onclick="InsertHTML('<p>แทรก  HTML</p>',editorObj);">แทรก  HTML</button>
<button onclick="SetContents('<p>แทนที่ข้อความทั้งหมด</p>',editorObj);">แทนที่ข้อความทั้งหมด</button>
<button onclick="alert(GetContents(editorObj));">แสดงข้อมูลใน CKEditor</button>
*/
