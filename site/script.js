var errorLog = "";

function validate() {
  errorLog = "";
	var success = true;

  if (document.forms["userRegistration"]["firstName"].value == "" || document.forms["userRegistration"]["lastName"].value == "") {
    errorLog += ("Please ensure both names are provided." + "<br>");
    success = false;
  }

  if (!document.forms["userRegistration"]["email"].value.includes("@")) {
    errorLog += ("Please provide a valid Email address." + "<br>");
    success = false;
  }

  if (document.forms["userRegistration"].password.value == "") {
    errorLog += ("Please provide a password." + "<br>");
    success = false;
  } else {
    if (document.forms["userRegistration"].password.value != document.forms["userRegistration"].passwordConfirm.value){
      errorLog += ("Please ensure your password confirmation matches the above password." + "<br>");
      success = false;
    }
  }

  if (!document.forms["userRegistration"].tos.checked) {
    errorLog += ("Please accept the terms and conditions." + "<br>");
    success = false;
  }
  
  document.getElementById("validation-errors").innerHTML = errorLog;

	return success;
}
