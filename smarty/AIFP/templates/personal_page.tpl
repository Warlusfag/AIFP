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
            <div id="b1"><li><button class="sezione" onclick="show('form','b1')">{$personal_data.user}</button></li></div>
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
                    
                    <img src="{$root}{$personal_data.image}" class="pic"><br>
                    <button class="button personal">Cambia immagine del profilo</button>
            </section>
        </div>
        <div class="7u">
            <form action="{$root}personal_page/update_profile.php" method="post"> 
                {if $tipo!="associazione"}
                <section>
                    <br><br>
                    <ul>
                        <li>Email: &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" value="{$personal_data.email}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$personal_data.nome}"</li>
                        <li>Cognome &nbsp &nbsp<input type="text" value="{$personal_data.cognome}"</li>
                        <li>Residenza: &nbsp <input type="text" value="{$personal_data.residenza}"</li>
                        <li><br></li>
                        <li><label>Inserisci regione &nbsp</label>
                            <select name="regione" form="regform">
                                <option value="{$personal_data.regione}">{$personal_data.regione}</option>
                                <option value="abruzzo">Abruzzo</option>
                                <option value="basilicata">Basilicata</option>
                                <option value="calabria">Calabria</option>
                                <option value="campania">Campania</option>
                                <option value="emiliaromagna">Emilia Romagna</option>
                                <option value="friuliveneziagiulia">Friuli Venezia Giulia</option>
                                <option value="lazio">Lazio</option>
                                <option value="liguria">Liguria</option>
                                <option value="lombardia">Lombardia</option>
                                <option value="marche">Marche</option>
                                <option value="molise">Molise</option>
                                <option value="piemonte">Piemonte</option>
                                <option value="puglia">Puglia</option>
                                <option value="sardegna">Sardegna</option>
                                <option value="sicilia">Sicilia</option>
                                <option value="toscana">Toscana</option>
                                <option value="trentinoaltoadige">Trentino Alto Adige</option>
                                <option value="umbria">Umbria</option>
                                <option value="valledaosta">Valle d’Aosta</option>
                                <option value="veneto">Veneto</option>
                            </select>
                        </li>
                        <li><br></li>
                        <li>Data di nascita &nbsp &nbsp<input type="date" name="data"></li>
                    </ul>
                    <button class="button personal" type="submit">Salva</button>
                    <br><br>
                </section>
                {else}
                    <section>
                    <br><br>
                    <ul>
                        <li>Email &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" value="{$personal_data.email}"</li>
                        <li>User &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$personal_data.user}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$personal_data.nome}"</li>
                        <li>Provincia &nbsp &nbsp<input type="text" value="{$personal_data.provincia}"</li>
                        <li>Residenza: &nbsp <input type="text" value="{$personal_data.residenza}"</li>
                        <li><br></li>
                        <li><label>Inserisci regione &nbsp</label>
                            <select name="regione" form="regform">
                                <option value="{$personal_data.regione}">{$personal_data.regione}</option>
                                <option value="abruzzo">Abruzzo</option>
                                <option value="basilicata">Basilicata</option>
                                <option value="calabria">Calabria</option>
                                <option value="campania">Campania</option>
                                <option value="emiliaromagna">Emilia Romagna</option>
                                <option value="friuliveneziagiulia">Friuli Venezia Giulia</option>
                                <option value="lazio">Lazio</option>
                                <option value="liguria">Liguria</option>
                                <option value="lombardia">Lombardia</option>
                                <option value="marche">Marche</option>
                                <option value="molise">Molise</option>
                                <option value="piemonte">Piemonte</option>
                                <option value="puglia">Puglia</option>
                                <option value="sardegna">Sardegna</option>
                                <option value="sicilia">Sicilia</option>
                                <option value="toscana">Toscana</option>
                                <option value="trentinoaltoadige">Trentino Alto Adige</option>
                                <option value="umbria">Umbria</option>
                                <option value="valledaosta">Valle d’Aosta</option>
                                <option value="veneto">Veneto</option>
                            </select>
                        </li>
                        <li><br></li>
                        <li>CAP &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" name="CAP" value="{$personal_data.CAP}"></li>
                        <li>Sito Web &nbsp &nbsp<input type="text" name="sito_web" value="{$personal_data.sito_web}"></li>
                        <li>Componenti &nbsp<input type="text" name="componenti" value="{$personal_data.componenti}"></li>
                    </ul>
                    <button class="button personal" type="submit">Salva</button>
                    <br><br>
                </section>
                {/if}
            </form>
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