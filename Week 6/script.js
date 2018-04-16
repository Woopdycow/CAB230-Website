function validate() {
	alert("Submitted!");
	
	var success = true;
	if (!checkName){
		success = false;
	}
	
	return success;
	
	// if (checkName(form){
		// if (checkPassword(form){
			// return true;
		// } else {
			// return false;
		// }
	// } else {
		// if (checkPassword(form){
			// return false;
		// } else {
			// return false;
		// }	
	// }
}

function checkName(form){
	if (form.surname.value == "") {
		document.getElementById("surnameMissing").style.visibility = "visible";
		return false;
	} else {
		return true;
	}
}

function checkPassword(form){
	if (form.password.value == form.confirmPassword.value){
		return true;
	} else {
		return false;
	}
}

function hideError(){
	document.getElementById("surnameMissing").style.visibility = "hidden";
}