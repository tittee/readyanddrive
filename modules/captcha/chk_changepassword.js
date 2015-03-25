        var url = 'captcha/captcheck.php?code=';
        var captchaOK = 2;  // 2 - not yet checked, 1 - correct, 0 - failed

        function getHTTPObject()
        {
			try {
				req = new XMLHttpRequest();
			} catch (err1)
			  {
				try {
					req = new ActiveXObject("Msxml12.XMLHTTP");
				} catch (err2)
				  {
						try {
							req = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (err3)
							{
								req = false;
							}
					}
				}
				return req;
			}

        var http = getHTTPObject(); // We create the HTTP Object

        function handleHttpResponse() {
        if (http.readyState == 4) {
            captchaOK = http.responseText;
			//alert(captchaOK);
            if(captchaOK != 1) {
				  alert('Incorrect visible number, Please try again.');
				  document.formChangePassword.code.value='';
				  document.formChangePassword.code.focus();
				  return false;
             }
             document.formChangePassword.submit();
			 //return true;
           }
        }

        function checkcode(thecode) {
			http.open("GET", url + escape(thecode), true);
			http.onreadystatechange = handleHttpResponse;
			http.send(null);
        }
		//==============================================================================================================================

	function Trim(s)
	{
		 while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
		 {
		   s = s.substring(1,s.length);
		 }
		 while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
		 {
		   s = s.substring(0,s.length-1);
		 }
		 return s;
	}
	function isInteger(s){
		var i;
		for (i = 0; i < s.length; i++){
			// Check that current character is number.
			var c = s.charAt(i);
			if (((c < "0") || (c > "9"))) return false;
		}
		// All characters are numbers.
		return true;
	}
	function stripCharsInBag(s, bag){
		var i;
		var returnString = "";
		// Search through string's characters one by one.
		// If character is not in bag, append to returnString.
		for (i = 0; i < s.length; i++){
			var c = s.charAt(i);
			if (bag.indexOf(c) == -1) returnString += c;
		}
		return returnString;
	}
	 //===========================================================
	 // Main Function
	 //===========================================================
	 function checkFrm()
	 {
	 	with(document.formChangePassword)
		{
			//First Name
			if(Trim(currentpassword.value) == '')
			{
				alert('กรุณาใส่รหัสผ่านปัจจุบัน');
				currentpassword.focus();
				return false;
			}
			//Last Name
			if(Trim(newpassword.value) == '')
			{
				alert('กรุณาใส่รหัสผ่านใหม่');
				newpassword.focus();
				return false;
			}

			if( Trim(newpassword.value) != Trim(confirmpassword.value) ){
				alert("ยืนยันรหัสผ่าน ไม่ตรงกับรหัสผ่านใหม่");
				confirmpassword.focus();
				return false;
			}

			if(code.value=='') {
			  alert('Verify visible number.');
			  code.value='';
			  code.focus();
			  return false;
			}

			// Now the Ajax CAPTCHA validation
			checkcode(code.value);

			return false;
		}
	 }
