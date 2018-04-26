function validate(){
  var form = document.forms["form1"];
  var valid = true;

  valid = checkName(form["surname"].value);
  valid = checkAddress(form["address"].value);
  valid = checkPassword(form["password"].value);
  valid = checkMatch(form["password"].value, form["confirmPassword"].value);

  window.alert(valid);
  return valid;
}

function checkName(input){
  if (input == "") {
    document.getElementById("surnameMissing").style.visibility = "visible";
    return false;
  }
}

function checkAddress(input){
  if (input == "") {
    return false;
  }
}

function checkPassword(input){
  if (input == "") {
    return false;
  }
}

function checkMatch(pword, confirm){
  if (pword != confirm){
    return false;
  }
}

function hideError(){
  document.getElementById("surnameMissing").style.visibility = "hidden";
}
