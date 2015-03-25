function getUrlParam(strParamName){
  var strReturn = "";
  var strHref = window.location.href;
  if ( strHref.indexOf("?") > -1 ){
    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
    var aQueryString = strQueryString.split("&");
    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
      if (aQueryString[iParam].indexOf(strParamName.toLowerCase() + "=") > -1 ){
        var aParam = aQueryString[iParam].split("=");
        strReturn = aParam[1];
        break;
      }
    }
  }
  return unescape(strReturn);
}

//function below added by logan (cailongqun [at] yahoo [dot] com [dot] cn) from www.phpletter.com
function selectFile(url)
{
  if(url != '' )
  {
      var funcNum = getUrlParam('CKEditorFuncNum');
      window.opener.CKEDITOR.tools.callFunction(funcNum, url ) ;
      window.close() ;
  }else
  {
     alert(noFileSelected);
  }
  return false;
}


function cancelSelectFile()
{
  // close popup window
  window.close() ;
}
