var errorLog = "";

function loginValidate(){
  errorLog = "";
	var success = true;

  if (document.forms["userLogin"].password.value == "") {
    errorLog = ("Please enter password." + "<br>");
    success = false;
  }

  if (!document.forms["userLogin"]["email"].value.includes("@") || !document.forms["userLogin"]["email"].value.includes(".") ) {
    errorLog = ("Invalid Email." + "<br>");
    success = false;
  }

  document.getElementById("validation-errors").innerHTML = errorLog;

	return success;
}

function registrationValidate() {
  errorLog = "";
	var success = true;

  if (!document.forms["userRegistration"]["tos"].checked) {
    errorLog = ("Please accept the terms and conditions." + "<br>");
    success = false;
  }

  var day = document.forms["userRegistration"]["day"].value;
  var month = document.forms["userRegistration"]["month"].value;
  var year = document.forms["userRegistration"]["year"].value;
  var days = new Array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

  if (year > 2017 || year < 1900) {
    errorLog = ("Please provide valid a year of birth." + "<br>");
    success = false;
  } else if (month > 12 || month < 1) {
    errorLog = ("Please provide valid a month of birth." + "<br>");
    success = false;
  } else if (day > days[month - 1] || day < 1) {
    errorLog = ("Please provide valid a day of birth." + "<br>");
    success = false;
  } else if (day == "" || month == "" || year == "") {
    errorLog = ("Please provide a full date of birth." + "<br>");
    success = false;
  }

  if (document.forms["userRegistration"].password.value == "") {
    errorLog = ("Please provide a password." + "<br>");
    success = false;
  } else {
    if (document.forms["userRegistration"].password.value != document.forms["userRegistration"].passwordConfirm.value){
      errorLog = ("Please ensure your password confirmation matches the above password." + "<br>");
      success = false;
    }
  }

  if (!document.forms["userRegistration"]["email"].value.includes("@")) {
    errorLog = ("Please provide a valid Email address." + "<br>");
    success = false;
  }

  if (document.forms["userRegistration"]["firstName"].value == "" || document.forms["userRegistration"]["lastName"].value == "") {
    errorLog = ("Please ensure both names are provided." + "<br>");
    success = false;
  }
  document.getElementById("validation-errors").innerHTML = errorLog;

	return success;
}

function reviewValidate() {
  errorLog = "";
	var success = true;

  if ((document.forms["reviewForm"]["text"].value).len > 255) {
    errorLog = ("Review is too long." + "<br/>");
    success = false;
  }

  if (document.forms["reviewForm"]["rating"].value == "" || document.forms["reviewForm"]["rating"].value == "") {
    errorLog = ("Please provide a rating before submitting." + "<br/>");
    success = false;
  }

  document.getElementById("validation-errors").innerHTML = errorLog;

	return success;
}

if (typeof(Number.prototype.toRad) === "undefined") {
	Number.prototype.toRad = function() {
		return this * Math.PI / 180;
	}
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    window.location.assign("results.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude);
}
