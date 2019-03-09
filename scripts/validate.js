function validateCode() {
	var code = document.getElementById("code").value;
	if (code.length < 50) {
		alert("Code must be at least 50 characters in length");
		return false;
	} else {
		return true;
	}
}

function validateRoll() {
	var roll = document.getElementById("roll").value;
	if (isNaN(roll) || (+roll)==0) {
		alert("Roll must be valid");
		return false;
	} else {
		return true;
	}
}