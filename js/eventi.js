
function testeventi(){
    
    var count=0;
    for(i=0; i<4; i++){
        if(document.getElementById(i).value===""){
            count++;
            document.getElementById(i).disabled = true;
        }
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
