var validation = {
	
	isNumber: function(str) {
        var pattern = /^\d+$/;
		var formStr = document.getElementById(str).value;
		
		if (!pattern.test(formStr)) {
			alert("Quantity can only be a positive numeric value.");
        	return false;
		}
		
		return true;
    },
	isEmail: function() {
		var x = document.forms["info_form"]["email"].value;
		
		if (x == null || x == "") {
			alert("Email must be filled out");
			return false;
		}
		
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		if (!re.test(x)) {
			alert("Not a valid email!");
			return false;
		}
		return true;
	}
	
}