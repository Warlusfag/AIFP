$(document).ready(function(){
    
    hide();
   document.getElementById("form").style.display="block";

})

function show(id){
        hide();
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
    
    if(document.forms["up_date"]["email"].value===document.forms["up_date"]["email2"].value){
        document.forms["up_date"]["email"].disabled = true;
    }
      if(document.forms["up_date"]["nome"].value===document.forms["up_date"]["nome2"].value){
        document.forms["up_date"]["nome"].disabled = true;
    }
     if(document.forms["up_date"]["residenza"].value===document.forms["up_date"]["residenza2"].value){
        document.forms["up_date"]["residenza"].disabled = true;
    }
      if(document.forms["up_date"]["cognome"].value===document.forms["up_date"]["cognome2"].value){
        document.forms["up_date"]["cognome"].disabled = true;
    }
      if(document.forms["up_date"]["regione"].value===document.forms["up_date"]["regione2"].value){
        document.forms["up_date"]["regione"].disabled = true;
    }
      if(document.forms["up_date"]["data"].value===document.forms["up_date"]["data2"].value){
        document.forms["up_date"]["data"].disabled = true;
    }
     if(document.forms["up_date"]["user"].value===document.forms["up_date"]["user2"].value){
        document.forms["up_date"]["user"].disabled = true;
    }
}

function testmode2(){
    
    if(document.forms["up_date"]["email"].value===document.forms["up_date"]["email2"].value){
        document.forms["up_date"]["email"].disabled = true;
    }
      if(document.forms["up_date"]["nome"].value===document.forms["up_date"]["nome2"].value){
        document.forms["up_date"]["nome"].disabled = true;
    }
      if(document.forms["up_date"]["regione"].value===document.forms["up_date"]["regione2"].value){
        document.forms["up_date"]["regione"].disabled = true;
    }
    
     if(document.forms["up_date"]["user"].value===document.forms["up_date"]["user2"].value){
         
        document.forms["up_date"]["user"].disabled = true;
    }
    if(document.forms["up_date"]["indirizzo"].value===document.forms["up_date"]["indirizzo2"].value){
        document.forms["up_date"]["indirizzo"].disabled = true;
    }
    if(document.forms["up_date"]["provincia"].value===document.forms["up_date"]["provincia2"].value){
        document.forms["up_date"]["provincia"].disabled = true;
    }
    if(document.forms["up_date"]["CAP"].value===document.forms["up_date"]["CAP2"].value){
        document.forms["up_date"]["CAP"].disabled = true;
    }
     if(document.forms["up_date"]["sito_web"].value===document.forms["up_date"]["sito_web2"].value){
        document.forms["up_date"]["sito_web"].disabled = true;
        
    }
     if(document.forms["up_date"]["componenti"].value===document.forms["up_date"]["componenti2"].value){
        document.forms["up_date"]["componenti"].disabled = true;
    }
    return true;
}
