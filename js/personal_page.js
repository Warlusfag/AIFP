$(document).ready(function(){
    
    hide();
    document.getElementById("form").style.display="block";

})

function show(id, btn){
        hide(id);
        document.getElementById(id).style.display="block";
 
       
}

function hide(){
    document.getElementById("form").style.display="none";
    document.getElementById("form1").style.display="none";
    document.getElementById("form2").style.display="none";
    document.getElementById("form3").style.display="none";
    document.getElementById("form4").style.display="none";
    document.getElementById("form5").style.display="none";
    document.getElementById("form6").style.display="none";
}


function searchtest(){
    var count=0;
    
    for(i=0; i<=10; i++){
        if(document.getElementById(i).value===""){
            count++;
            document.getElementById(i).disabled = true;
        }
    }

    if(count===11){
        for(i=0; i<=10; i++){
            document.getElementById(i).disabled = false;
        }
        alert("Selezionare almeno un elemento di ricerca");
        return false;
    }
   return true;
}

function testmode(){
    
    alert();
}

