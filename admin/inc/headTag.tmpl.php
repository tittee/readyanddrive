<div id="Bofhead">
    <h1 id="site-heading">
        <a title="<?php echo $_Config_sitename?>'s Backoffice" href="<?php echo $_Config_live_site; ?>/admin/index.php">
            <span id="site-title"><?php echo $_Config_sitename?>'s Backoffice</span>
        </a>
    </h1>
    <div id="Bofhead-info">
		<div id="user_info">
        <p>Username : <span><strong><?php echo $_SESSION['_LOGIN']?></strong></span> | <a title="Log Out" href="<?php echo $_Config_live_site; ?>/admin/_execlogout.php">Log Out</a></p>
        </div>
    </div>
</div>
<script language="JavaScript" type="text/JavaScript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function popupM() {
// set properties for the editace window
var w = 300
var h = 395
var lp = (screen.width) ? (screen.width-w)/2 : 0;
var tp = (screen.height) ? (screen.height-h)/2 : 0;
attrs = 'height=395,width=300,top=' + tp + ',left=' + lp + ', resizable=yes, toolbar=no';
window.open("/webtext/popup/popup.htm", "popupM", attrs)
}
function changeto(highlightcolor){
source=event.srcElement
if (source.tagName=="TR"||source.tagName=="TABLE")
return
while(source.tagName!="TD")
source=source.parentElement
if (source.style.backgroundColor!=highlightcolor&&source.id!="ignore")
source.style.backgroundColor=highlightcolor
}
function changeback(originalcolor){
if (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="ignore")
return
if (event.toElement!=source)
source.style.backgroundColor=originalcolor
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
