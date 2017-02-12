
function testeventi(){
  var nome = document.forms["s_eventi"]["nome"].value;
  var regione = document.forms["s_eventi"]["regione"].value;
  var tipo = document.forms["s_eventi"]["tipologia"].value;
  var data_inizio = document.forms["s_eventi"]["data_inizio"].value;

  if (nome === "" && regione === "" && tipo === "" && data_inizio === "") {
  
    alert("Inserire almeno un campo di ricerca");
    
    document.forms["s_eventi"]["regione"].focus();

    document.forms["s_eventi"]["tipologia"].focus();
    
    document.forms["s_eventi"]["data_inizio"].focus();
    document.forms["s_eventi"]["nome"].focus();
    document.forms["s_eventi"]["nome"].select();
    return false;
  }
  
return true;  	
  
}

