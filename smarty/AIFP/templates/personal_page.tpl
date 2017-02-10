{extends file="generic_page_sidebar.tpl"}
{block "title"}{$user}{/block}

{block name=userside}
{/block}

{block name=mainside}
    
    <section>
        <header>
            <h2>Profilo</h2>
        </header>
        <img src="{$root}images/img_avatar.png" class="pic">
        <ul class="style1">
            <li><button class="sezione" onclick="show('form1')" >Modifica Profilo</button></li>
            <li><button class="sezione" onclick="show('form2')" >Ricerca</button></li>
            <li><button class="sezione" onclick="show('form3')" >Aggiungi Evento</button></li>
            <li><button class="sezione" onclick="show('form4')" >File Space</button></li>
        </ul>
    </section>

    
    <section>
        
    </section>
{/block}

	{block name=main}  
	<!-- Main -->
        <div class="row half" id="form">
            <div class="7u">
                <section>
                    <header>
                        <h3>{$profilo.user}</h3>
                    </header>
                    <img src="{$root}images/img_avatar.png" class="pic"><br>
                </section>
            </div>
            <div class="5u"> 
                <br><br>
                <ul>
                    <li>Tipologia: {$profilo.type}</li>
                    <li>Punteggio: {$profilo.punteggio}</li>
                    <li>Numero post: {$profilo.num_post}</li>
                </ul>
            </div>
        </div>
        
        
    <div class="row half" id="form1">
        <div class="7u" >
          <section>
                    <header>
                            <h3>{$profilo.user}</h3>
                    </header>
              <img src="{$root}images/img_avatar.png" class="pic"><br>
                    <a href="#" class="button">Modifica Immagine del Profilo</a>
            </section>
        </div>
        <div class="5u">
            <section>
                <header></header><br><br>
                <p> Nome e cognome: {$profilo.nome} {$profilo.cognome} </p><br>
                <p> Residenza {$profilo.residenza} </p><br>
                <p> Data di nascita {$profilo.data}</p><br><br> 
                <a href="#" class="button">Modifica Dati personali</a>
            </section>
        </div>
           
    </div>
                    
    <div class="row half" id="form2">
        <div class="11u" >
          <section>
                    <header>
                            <h2>RICERCA</h2>
                    </header>
                    <input type="text">
           </section>
        </div>
    </div>
                    
    <div class="row half" id="form3">
        <div class="15u" >
          <section>
                    <header>
                            <h2>AGGIUNGI EVENTO</h2>
                    </header>
           </section>
        </div>
    </div>
                    
    <div class="row half" id="form4">
        <div class="15u" >
          <section>
                    <header>
                            <h2>FILE SPACE</h2>
                    </header>
                    
           </section>
        </div>
    </div>
       
       
        
                
           	<!-- /Main -->

{/block}

{block name=buttom_main}

{/block}