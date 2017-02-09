
function testpass(){
  var x = document.forms["regu"]["password"].value;
  var y = document.forms["regu"]["psw-repeat"].value;
  if (x != y ) {
    alert("La password inserita non coincide con la prima!");
    document.forms["regu"]["password"].focus();
    document.forms["regu"]["password"].select();
    return false;
  }
  return true;
}

