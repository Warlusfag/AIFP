{$profilo.user=$personal_data.user}
{extends file="generic_page_sidebar.tpl"}
{block "title"}{$user}{/block}

{block name=userside}
{/block}

{block name=mainside}

{if $message != null}
        <script>
            document.getElementById('success').style.display='block';
        </script>
{/if}
{if $error != null}
        <script>
            document.getElementById('alert').style.display='block';
        </script>
{/if}   

{if $file!=null}
    <script>
        show("form3");
    </script>
{/if}
    <section>
        <header>
            <h2>Profilo</h2>
        </header>
        <ul class="style1"> 
            {if $type=="utente"}
                {$status="disabled"}
                {$color="grey"}
            {/if}
            <li><button class="button schede" onclick="show('form','b1')">{$personal_data.user}</button></li>
            <li><button class="button schede" onclick="show('form1')">Modifica Profilo</button></li>
            <li><button class="button schede" onclick="show('form2')"  >Ricerca</button></li>
            <li><button class="button schede" onclick="show('form3')"  >Aggiungi Evento</button></li>
            <form action="{$root}personal_page/file_space.php" method="post">
            <li><button type="submit" name="action" value="show" class="button schede" onclick="show('form4')"  >File Space</button></li>
            </form>
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
                    <img src="{$root}{$personal_data.image}" class="pic"><br>
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
                    <br><hr><br>
                    <ul>
                        <li>Tipologia:<strong> {$type}</strong></li>
                        <li>Punteggio:<strong> {$personal_data.punteggio}</strong></li>
                        <li>Numero post:<strong> {$personal_data.num_post}</strong></li>
                    </ul>
                </section>
            </div>
        </div>
        
       <!-- MODIFICA PROFILO --> 
    <div class="row half" id="form1">
        
        
        <div class="7u" >
          <section>
                    <header>
                            <h3>{$personal_data.user}</h3>
                    </header>
                    
                    <img src="{$root}{$personal_data.image}" class="pic"><br>
                    <hr>
                    Cambia immagine del profilo <br>
                    <form action="{$root}/personal_page/load_image.php">
                    <input type="file" name="image">
                    </form>
            </section>
        </div>
        <div class="5u">
            <form id="update" action="{$root}personal_page/update_profile.php" method="post"> 
                {if $tipo!="associazione"}
                <section>
                    <br><br>
                    <ul>
                        <li>Email: &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" value="{$personal_data.email}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$personal_data.nome}"</li>
                        <li>Cognome &nbsp &nbsp<input type="text" value="{$personal_data.cognome}"</li>
                        <li>Residenza: &nbsp <input type="text" value="{$personal_data.residenza}"</li>
                      
                        <li><label>Regione &nbsp</label>
                            <select class="button option" name="regione" form="update">
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
                            <select class="button option" name="regione" form="update">
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
                    
       <!-- RICERCA DICOTOMICA -->
    <div class="9u skel-cell-importantf" id="form2">
        
          <section>
            <header>
                    <h2>RICERCA DICOTOMICA</h2>
                    <h3>Ricerca fungo per </h3>
            </header>
            <form id="search" action="{$root}personal_page/search_funghi.php" method="post">
                <table class="input">
                    <tr class="input">
                        <td colspan="2" class="input">Genere<input type="text" name="genere"></td>
                        <td colspan="2" class="input">Specie<input type="text" name="specie"></td>
                    </tr>
                    <tr class="input">
                        <th class="input">Sporata</th>
                        <td class="input">
                            <select class="button option" name="sporata" form="search">
                                <option value="leucosporeo">Leucosporeo</option>
                                <option value="ocroscoporeo">Ocroscoporeo</option>
                                <option value="ocroscoporeo">Ocroscoporeo</option>
                                <option value="iantinosporeo">Iantinosporeo</option>
                            </select>
                        </td>
                        <th class="input">Viraggio</th>
                        <td class="input">
                            <select class="button option" name="viraggio" form="search">
                                <option value="assente">Assente</option>
                                <option value="rosso">Rosso</option>
                                <option value="blu">Blu</option>
                                <option value="verde">Verde</option>
                                <option value="giallo">Giallo</option>
                            </select>
                        </td> 
                    </tr>
                    <tr class="input">
                        <th class="input">Commestibilità</th>
                        <td class="input">
                            <select class="button option" name="commestibilie" form="search">
                                <option value="ottimo">Ottimo</option>
                                <option value="buono">Buono</option>
                                <option value="discreto">Discreto</option>
                                <option value="immangiabile">Immangiabile</option>
                            </select>
                        </td>
                        <th class="input">Imenio</th>
                        <td class="input">
                        <select class="button option" name="imenio" form="search">
                            <option value="tuboli">Tuboli</option>
                            <option value="lamelle">Lamelle</option>
                            <option value="pliche">Pliche</option>
                            <option value="aghi">Aghi</option>
                        </select>
                        </td> 
                    </tr>
                    <tr class="input">
                        <th class="input">Volva</th>
                        <td class="input">
                            <select class="button option" name="volva" form="search">
                                <option value="circoncisa">Circoncisa</option>
                                <option value="sacco">Sacco</option>
                                <option value="linguinale">Linguinale</option>
                                <option value="napifor">Napifor</option>
                            </select>
                        </td>
                        <th class="input">Habitat</th>
                        <td class="input">
                            <select class="button option" name="habitat" form="search">
                                <option value="lignicolo">Lignicolo</option>
                                <option value="prato">Prato</option>
                                <option value="saprofita">Saprofita</option>
                                <option value="bosco">Bosco</option>
                            </select>
                        </td> 
                    </tr>
                    <tr class="input">
                        <td class="input" colspan="4" style="text-align:center">
                            <button class="button" type="submit">Cerca</button>
                        </td>
                    </tr>
                </table>
            </form>
          </section>
       
    </div>
        
       <!-- AGGIUNGI EVENTO -->
      
    <div class="6u skel-cell-important" id="form3">
          <section>
                    <header>
                            <h2>AGGIUNGI EVENTO</h2>
                    </header>
           </section>
            <form action="{$root}personal_page/aggiungi_evento.php" method="post">
                <input type="text" placeholder="Nome dell'evento" style="border:none;" name="nome" required>
                <hr>
                Data di inzio <input type="date" name="data_inizio" required>  Data di fine <input type="date" name="data_fine" required>
                <hr>
                Luogo<br><input type="text" placeholder="Indirizzo" name="indirizzo" required>
                <input type="text" placeholder="Provincia" name="provincia" required><br>
                <label>Regione &nbsp</label>
                <select class="button option" name="regione" form="update">
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
                    <br><hr>
                    
                    <button type="submit" class="button">Crea</button>
            </form>
       
    </div>
                   
       <!-- FILE SPACE -->
    <div class="9u skel-cell-important" id="form4">
        <div class="">
          <section>
                    <header>
                            <h2>FILE SPACE</h2>
                    </header>
           </section>
            <form action="{$root}personal_page/file_space.php" method="post">
            <table>
                   <tr>
                       <th><b>File Name</b></th>
                       <th><b>Size</b></th>
                       <th></th>
                       <th></th>
                   </tr>
                   
                   {foreach $files ad $file}
                   <tr>
                     <td>{$file.nome}</td>
                     <td>{$file.size}</td>
                   
                     <td style="width:47px; text-align:center;"><button type="submit" name="action" value="download"><img src="{$root}images/download.png" class="filespace"></button></td>
                     <td style="width:47px; text-align:center;"><button type="submit" name="action" value="delete"><img src="{$root}images/delete.png" class="filespace"></button></td>
                  
                   </tr>
                   {/foreach}
                 </table>
            </form>
        </div>
    </div>
       
       
        
                
           	<!-- /Main -->

{/block}

{block name=buttom_main}

{/block}