$(document).ready(function(){
    
    hide();
    document.getElementById("form").style.display="block";
})

function show(id, btn){
        hide(id);
        document.getElementById(id).style.display="block";
        document.getElementById(btn).boxShadow= "10px 20px 30px blue";
      
}

function hide(){
    document.getElementById("form").style.display="none";
    document.getElementById("form1").style.display="none";
    document.getElementById("form2").style.display="none";
    document.getElementById("form3").style.display="none";
    document.getElementById("form4").style.display="none";
    document.getElementById("form5").style.display="none";
}