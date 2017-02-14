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
    var a = document.forms["s_funghi"]["genere"].value;
    var b = document.forms["s_funghi"]["specie"].value;
    var c = document.forms["s_funghi"]["cappello"].value;
    var d = document.forms["s_funghi"]["sporata"].value;
    var e = document.forms["s_funghi"]["anello"].value;
    var f = document.forms["s_funghi"]["commestibile"].value;
    var g = document.forms["s_funghi"]["viraggio"].value;
    var h = document.forms["s_funghi"]["imenio"].value;
    var i = document.forms["s_funghi"]["stagione"].value;
    var l = document.forms["s_funghi"]["habitat"].value;
    var m = document.forms["s_funghi"]["volva"].value;

    if (a === "" && b === "" && c === "" && d === "" && e === "" && f === ""&& g === ""&& h === ""&& i === ""&& l === ""&& m === "") {
        alert("Inserire almeno un campo di ricerca");
        document.forms["s_eventi"]["genere"].focus();
        document.forms["s_eventi"]["genere"].select();
        return false;
    }
    else{
    return true;  	
    }
}