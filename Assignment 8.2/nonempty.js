function validateFormSignup() {
  var empt = document.forms["signup"]["name"].value;
  if (empt === "") {
    alert("Please input your Name");
    return false;
  }
  var empt = document.forms["signup"]["email"].value;
  if (empt === "") {
    alert("Email must be filled out");
    return false;
  }
  var empt = document.forms["signup"]["pwd"].value;
  if (empt === "") {
    alert("Password must be filled out");
    return false;
  }
  var empt = document.forms["signup"]["pwdrepeat"].value;
  if (empt === "") {
    alert("Please repeat your password");
    return false;
  }
  var empt = document.forms["signup"]["pwdrepeat"].value;
  if (empt !== document.forms["signup"]["pwd"].value) {
    alert("Passwords do not match");
    return false;
  } else {
    alert("Account Created");
    return true;
  }
}
function validateFormLogin() {
  var empt = document.forms["login"]["email"].value;
  if (empt === "") {
    alert("Please input your Email");
    return false;
  }
  var empt = document.forms["login"]["pwd"].value;
  if (empt === "") {
    alert("Password must be filled out");
    return false;
  } else {
    return true;
  }
}
requi;
