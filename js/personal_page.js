$(document).ready(function(){
    
    hide();
    document.getElementById("form").style.display="block";
})

function show(id){
        hide(id);
        document.getElementById(id).style.display="block";
}

function hide(){
    document.getElementById("form").style.display="none";
    document.getElementById("form1").style.display="none";
    document.getElementById("form2").style.display="none";
    document.getElementById("form3").style.display="none";
    document.getElementById("form4").style.display="none";
}