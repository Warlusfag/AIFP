
function testeventi(){
    
    var count=0;
    if(document.getElementById(0).value===""){
        document.getElementById(0).disabled = true;
        count++;
    }
    if(document.getElementById(1).value===""){
        document.getElementById(1).disabled = true;
        count++;
    }
    if(document.getElementById(2).value===""){
         document.getElementById(2).disabled = true;
         count++;
    }
    if(document.getElementById(3).value===""){
         document.getElementById(3).disabled = true;
         count++;
    }
    if(count===4){
        for(i=0; i<4; i++){
            document.getElementById(i).disabled = false;
        }
        alert("Inserire almeno un campo di ricerca");
        return false;
    }
   return true;
}


function download(){
     document.getElementById("down").click();
}
