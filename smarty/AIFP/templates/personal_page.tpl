{$profilo.user=$personal_data.user}
{extends file="generic_page_sidebar.tpl"}
{block "title"}{$user}{/block}

{block name=userside}
{/block}

{block name=mainside}
    
    <section>
        <header>
            <h2>Profilo</h2>
        </header>
        <ul class="style1"> 
            <li><button class="sezione" onclick="show('form')">{$personal_data.user}</button></li>
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
            <div class="5u">
                <section>
                    <header>
                        <h3>{$personal_data.user}</h3>
                    </header>
                    <img src="{$root}images/img_avatar.png" class="pic"><br>
                </section>
            </div>
            <div class="7u">
                <section>
                    <br><br>
                    <ul>
                        <li>Email: <strong> {$personal_data.email}</strong></li>
                        <li>Nome e Cognome:<strong> {$personal_data.nome} {$personal_data.cognome}</strong></li>
                        <li>Residenza: <strong>{$personal_data.residenza}</strong></li>
                    </ul>
                    <br><br>
                    <ul>
                        <li>Tipologia:<strong> {$personal_data.type}</strong></li>
                        <li>Punteggio:<strong> {$personal_data.punteggio}</strong></li>
                        <li>Numero post:<strong> {$personal_data.num_post}</strong></li>
                    </ul>
                </section>
            </div>
        </div>
        
        
    <div class="row half" id="form1">
        <div class="5u" >
          <section>
                    <header>
                            <h3>{$personal_data.user}</h3>
                    </header>
                    
                    <img src="{$root}images/img_avatar.png" class="pic"><br>
                    
            </section>
        </div>
        <div class="7u">
                <section>
                    <br><br>
                    <ul>
                        <li>Email: <input type="email" value="{$personal_data.email}"</li>
                        <li>Nome <input type="text" value="{$personal_data.nome}"</li>
                        <li>Cognome <input type="text" value="{$personal_data.cognome}"</li>
                        <li>Residenza: <input type="text" value="{$personal_data.residenza}"</li>
                    </ul>
                    <button class="button" type="submit">Salva</button>
                    <br><br>
                    <ul>
                        <li>Tipologia:<strong> {$personal_data.type}</strong></li>
                        <li>Punteggio:<strong> {$personal_data.punteggio}</strong></li>
                        <li>Numero post:<strong> {$personal_data.num_post}</strong></li>
                    </ul>
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