      var url = 'modules/captcha/captcheck.php?code=';
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
				  document.frm_register.code.value='';
				  document.frm_register.code.focus();
				  return false;
             }
             document.frm_register.submit();
			 //return true;
           }
        }

        function checkcode(thecode) {
			http.open("GET", url + escape(thecode), true);
			http.onreadystatechange = handleHttpResponse;
			http.send(null);
        }
		//==============================================================================================================================

		function checkBangkok()
		{
				if (document.getElementById("bkk1").checked == true)
				{
					f_send.location.href='fetch_dealer.php?dtype=1';
				}
				else if(document.getElementById("bkk2").checked == true)
				{
					f_send.location.href='fetch_dealer.php?dtype=0';
				}
		}

		function checkKnow(ck)
		{
				if(ck == true)
				{
					document.getElementById("str_profile_know_other").disabled = false;
				}
				else
				{
					document.getElementById("str_profile_know_other").value = '';
					document.getElementById("str_profile_know_other").disabled = true;
				}
		}




		var dtCh= "/";
		var minYear=1900;
		var maxYear=3000;

		function checkPersonID(str) {
				var chr,digit,sum;
				if (str.length != 13)
				return false;
				var sum = 0;
				var checkDigit = str.charAt(12) ;
				for (i = 0; i<12; i++)
				{
					sum += str.charAt(i) * (13 - i);
				}
				var calcDigit = 11 - (sum % 11);
				if (calcDigit >= 10)
				calcDigit -= 10;
				return calcDigit == checkDigit;
		}

		function isEmail(str)
		{
				 var supported = 0;
			  if (window.RegExp) {
				var tempStr = "a";
				var tempReg = new RegExp(tempStr);
				if (tempReg.test(tempStr)) supported = 1;
			  }
			  if (!supported)
			  return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
			  var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
			  var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");
			  return (!r1.test(str) && r2.test(str));
		}
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
		function daysInFebruary (year){
			// February has 29 days in any year evenly divisible by four,
			// EXCEPT for centurial years which are not also divisible by 400.
			return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
		}
		function DaysArray(n) {
			for (var i = 1; i <= n; i++) {
				this[i] = 31
				if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
				if (i==2) {this[i] = 29}
		   }
		   return this
		}
		function isDate(dtStr){
			var daysInMonth = DaysArray(12)
			var pos1=dtStr.indexOf(dtCh)
			var pos2=dtStr.indexOf(dtCh,pos1+1)
			var strMonth=dtStr.substring(0,pos1)
			var strDay=dtStr.substring(pos1+1,pos2)
			var strYear=dtStr.substring(pos2+1)
			strYr=strYear
			if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
			if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
			for (var i = 1; i <= 3; i++) {
				if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
			}
			month=parseInt(strMonth)
			day=parseInt(strDay)
			year=parseInt(strYr)
			if (pos1==-1 || pos2==-1){
				return false
			}
			if (strMonth.length<1 || month<1 || month>12){
				return false
			}
			if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
				return false
			}
			if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
				return false
			}
			if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
				return false
			}
		return true
		}

		function checkMaritalStatus()
		{
		   var obj = document.getElementById("str_profile_marital_status3");
		   if(obj.checked == true)
		   {
			 document.getElementById("str_profile_other_marital_status").disabled = false;
		   }else
		   {
				 document.getElementById("str_profile_other_marital_status").value = '';
				 document.getElementById("str_profile_other_marital_status").disabled = true;
		   }
		}

		function checkOccupation()
		{
			 var obj = document.getElementById("str_occupation_id");
			 if(obj.value == '99')
			 {
					document.getElementById("str_profile_other_occupation").disabled = false;
			 }
			 else
			 {
					document.getElementById("str_profile_other_occupation").value = '';
					document.getElementById("str_profile_other_occupation").disabled = true;
			 }
		}

		 //===========================================================
		 // Main Function
		 //===========================================================
		 function checkFrm()
		 {
			with(document.frm_register)
			{
//				if(Trim(username.value) == "")
//				{
//					alert("กรุณาใส่ ชื่อสมาชิก");
//					username.focus();
//					return false;
//				}
				//Email
				if(Trim(email.value) == '')
				{
					alert('กรุณาใส่ email ของท่าน');
					email.focus();
					return false;
				}
				if(isEmail(email.value) == false)
				{
					alert('กรุณาใส่ email ให้ถูกต้อง');
					email.focus();
					return false;
				}
				if(code.value=='') {
				  alert('กรุณาพิมพ์อักขระให้ตรงในภาพ');
				  code.value='';
				  code.focus();
				  return false;
				}

				// Now the Ajax CAPTCHA validation
				checkcode(code.value);

				return false;
		}
	 }
