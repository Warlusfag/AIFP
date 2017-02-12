 // Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function testlogin(){
    var nome = document.forms["login"]["email"].value;

    g = new String(nome.toString());
    var atpos = g.indexOf("@");
    var dotpos = g.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=g.length){
        document.getElementById('mailus').name = 'user';        
    }else{
      document.getElementById('mailus').name = 'email';
    }
    return true;
  
}