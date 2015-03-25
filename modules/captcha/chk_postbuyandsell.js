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

				  document.FormPost.code.value='';

				  document.FormPost.code.focus();

				  return false;

             }

             document.FormPost.submit();

			 //return true;

           }

        }



        function checkcode(thecode) {

			http.open("GET", url + escape(thecode), true);

			http.onreadystatechange = handleHttpResponse;

			http.send(null);

        }

		//==============================================================================================================================


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


		 //===========================================================

		 // Main Function

		 //===========================================================

		 function validator()

		 {

			with(document.FormPost)

			{

				if(qcheck[0].checked == false && qcheck[1].checked == false ){
					alert('กรุณาเลือก สถานะผู้ประกาศ');
					qcheck[0].checked.focus();
					return false;
				}
				if(qcheck[0].checked== true && Trim(name.value) =="" && qcheck[1].checked == false ){
					alert('กรุณาใส่ชื่อของท่านด้วย');
					name.focus();
					return false;
				}
				if(qcheck[1].checked== true && Trim(username.value) =="" && qcheck[0].checked == false ){
					alert('กรุณาใส่ Username');
					username.focus();
					return false;
				}
				if(qcheck[1].checked== true && Trim(password.value) =="" && qcheck[0].checked == false ){
					alert('กรุณาใส่ Password');
					password.focus();
					return false;
				}
				if(Trim(pw_guest.value) == ''){
					alert('กรุณาใส่ รหัสผ่านเพื่อเอาไว้แก้ไขหรือลบประกาศ');
					pw_guest.focus();
					return false;

				}
				if(Trim(province_id.value) == ''){
					alert('กรุณาเลือกจังหวัด');
					province_id.focus();
					return false;
				}
				if(Trim(email.value) == ''){
					alert('กรุณาใส่ email ของท่าน');
					email.focus();
					return false;
				}

				if(isEmail(email.value) == false){
					alert('กรุณาใส่ email ให้ถูกต้อง');
					email.focus();
					return false;
				}
				if(Trim(plazaCate_id.value) == ''){
					alert('กรุณาเลือกหมวดหลัก');
					plazaCate_id.focus();
					return false;
				}
				/*if(Trim(plazaSubCate_id.value) == ''){
					alert('กรุณาเลือกหมวดย่อย');
					plazaSubCate_id.focus();
					return false;
				}
				if(Trim(plazaSubLv2Cate_id.value) == ''){
					alert('กรุณาเลือกหมวดย่อยสุดท้าย');
					plazaSubLv2Cate_id.focus();
					return false;
				}*/
				if(Trim(post_type.value) == ''){
					alert('กรุณาเลือกความต้องการของท่าน');
					post_type.focus();
					return false;
				}
				if(Trim(topic.value) == ''){
					alert('กรุณาใส่หัวข้อ');
					topic.focus();
					return false;
				}
				if(product_status[0].checked == false && product_status[1].checked == false ){
					alert('กรุณาเลือกสภาพของสินค้า');
					product_status[0].checked.focus();
					return false;
				}
				if(product_status[1].checked== true && percent.value==""){
					alert('กรุณาเลือกสภาพของสินค้า');
					percent.focus();
					return false;
				}
				if(Trim(price.value) == ''){
					alert('กรุณาระบุราคา');
					price.focus();
					return false;
				}
				if(Trim(detail.value) == ''){
					alert('กรุณาระบุรายละเอียด');
					detail.focus();
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
