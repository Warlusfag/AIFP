{$profilo.user=$profilo.user}
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
        show("form4");
    </script>
{/if}

{if $ass!=null}
    <script>
        show("form5");
    </script>
{/if}
    <section>
        <header>
            <h2>Profilo</h2>
        </header>
        <ul class="style1"> 
            {if $type=="utente"}
                {$status_ric="disabled"}
                {$color_ric="grey"}
                {$status_fs="disabled"}
                {$color_fs="grey"}
                {$status_add="disabled"}
                {$color_add="grey"}
                {$status_up="disabled"}
                {$color_up="grey"}
            {/if}
            {if $type=="botanico" || $type=="micologo" || $type=="inscritto"}
                {$status_add="disabled"}
                {$color_add="grey"}
                {$status_up="disabled"}
                {$color_up="grey"}
            {/if}
            {if $type=="admin"}
                {$status_fs="disabled"}
                {$color_fs="grey"}
            {/if}
            <li><button class="button schede" onclick="show('form','b1')">{$profilo.user}</button></li>
            <li><button class="button schede" onclick="show('form1')">Modifica Profilo</button></li>
            <li><button class="button schede" style="background-color:{$color_ric}" onclick="show('form2')" {$status_ric} >Ricerca</button></li>
            
            <li><form action="{$root}personal_page/file_space.php" method="post">
                <button type="submit" name="action" value="show" style="background-color:{$color_fs}" class="button schede" onclick="show('form4')" {$status_fs}>File Space</button>
                </form>
            </li>
            
            <li><button class="button schede" style="background-color:{$color_add}" onclick="show('form3')" {$status_add}>Aggiungi Evento</button></li>
            <li><button class="button schede" style="background-color:{$color_up}" onclick="show('form6')" {$status_up}>Promuovi Utente</button></li>
    
            {if $type=="admin"}
            <li>
                <form action="{$root}personal_page/request_ass.php" method="post">
                    <button type="submit" name="" value="" class="button schede" onclick="show('form5')" >Verifica Associazione</button>
                </form>
            </li>
            {/if}
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
                        <h3>{$profilo.user}</h3>
                    </header>
                    <img src="{$root}{$profilo.image}" class="pic"><br>
                </section>
            </div>
            <div class="7u">
                <section>
                    <br><br>
                    <ul>
                        <li>Email: <strong> {$profilo.email}</strong></li>
                        <li>Nome e Cognome:<strong> {$profilo.nome} {$profilo.cognome}</strong></li>
                        <li>Residenza: <strong>{$profilo.residenza}</strong></li>
                    </ul>
                    <br><hr><br>
                    <ul>
                        <li>Tipologia:<strong> {$type}</strong></li>
                        <li>Punteggio:<strong> {$profilo.punteggio}</strong></li>
                        <li>Numero post:<strong> {$profilo.num_post}</strong></li>
                    </ul>
                </section>
            </div>
        </div>
        
       <!-- MODIFICA PROFILO --> 
    <div class="row half" id="form1">
        
        
        <div class="7u" >
          <section>
                    <header>
                            <h3>{$profilo.user}</h3>
                    </header>
                    
                    <img src="{$root}{$profilo.image}" class="pic"><br>
                    <hr>
                    Cambia immagine del profilo <br>
                    <form action="{$root}/personal_page/load_image.php">
                    <input type="file" name="image">
                    </form>
            </section>
        </div>
        <div class="5u">
            <form id="update" action="{$root}personal_page/update_profile.php" method="post"> 
                {if $type!="associazione"}
                <section>
                    <br><br>
                    <ul>
                        <li>Email: &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" value="{$profilo.email}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$profilo.nome}"</li>
                        <li>Cognome &nbsp &nbsp<input type="text" value="{$profilo.cognome}"</li>
                        <li>Residenza: &nbsp <input type="text" value="{$profilo.residenza}"</li>
                      
                        <li><label>Regione &nbsp</label>
                            <select class="button option" name="regione" form="update">
                                <option value="{$profilo.regione}">{$profilo.regione}</option>
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
                        <li>Email &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" value="{$profilo.email}"</li>
                        <li>User &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$profilo.user}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" value="{$profilo.nome}"</li>
                        <li>Provincia &nbsp &nbsp<input type="text" value="{$profilo.provincia}"</li>
                        <li>Residenza: &nbsp <input type="text" value="{$profilo.residenza}"</li>
                        <li><br></li>
                        <li><label>Inserisci regione &nbsp</label>
                            <select class="button option" name="regione" form="update">
                                <option value="{$profilo.regione}">{$profilo.regione}</option>
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
                        <li>CAP &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" name="CAP" value="{$profilo.CAP}"></li>
                        <li>Sito Web &nbsp &nbsp<input type="text" name="sito_web" value="{$profilo.sito_web}"></li>
                        <li>Componenti &nbsp<input type="text" name="componenti" value="{$profilo.componenti}"></li>
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
                                <option value="iantinosporeo">Iantinosporeo</option>
                                <option value="rodosporeo">Rodosporeo</option>
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
                            <select class="button option" name="commestibile" form="search">
                                <option value="ottimo">Ottimo</option>
                                <option value="buono">Buono</option>
                                <option value="discreto">Discreto</option>
                                <option value="immangiabile">Immangiabile</option>
                                <option value="tossico">Tossico</option>
                                <option value="velenoso">Velenoso</option>
                                <option value="mortale">Mortale</option>
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
                                <option value="napiforme">Napiforme</option>
                                <option value="perlata">Napiforme</option>
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
                        <th colspan="2" class="input"> <button class="button" type="submit">Cerca</button></th>
                        <td colspan="2" class="input"> <button class="button" name="reset" value="1" type="submit">Reset</button></td>
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
                <label>Tipologia &nbsp </label>
                <select class="button option" name="tipologia" form="update">
                    <option value="sagra">Sagra</option>
                    <option value="corso">Corso</option>
                    <option value="mostra">Mostra</option>
                </select>
                <hr>
                Luogo
                <input type="text" placeholder="Provincia" name="provincia" required><br>
                <label>Regione &nbsp</label>
                <select class="button option" name="regione" form="update">
                    <option value="{$profilo.regione}">{$profilo.regione}</option>
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
       
       <!-- REQUEST ASS -->
       
       <div class="9u skel-cell-important" id="form5">
        <div class="">
          <section>
                    <header>
                            <h2>Verifica Associazione</h2>
                    </header>
           </section>
            <form action="{$root}personal_page/request_ass.php" method="post">
            <table>
                   <tr>
                       <th><b>Associazione</b></th>
                       <th><b>Size</b></th>
                       <th></th>
                   </tr>
                   
                   {foreach $ass ad $a}
                   <tr>
                     <td>{$a.nome}</td>
                     <td>{$file.size}</td>
                   
                     <td style="width:47px; text-align:center;"><button type="submit" name="action" value="download"><img src="{$root}images/checked.png" class="filespace"></button></td>
                  
                   </tr>
                   {/foreach}
                 </table>
            </form>
        </div>
    </div>
                
    <!-- UPGRADE USER -->
     <div class="9u skel-cell-important" id="form6">
        <div class="">
          <section>
                    <header>
                            <h2>Promuovi Utente</h2>
                    </header>
           </section>
            <form action="{$root}personal_page/#.php" method="post">
                <p>Inserisci l'email dell'utente da promuovere</p>
                <input type="email" name="email">
                <button type="submit" class="button schede">Promuovi</button>
            </form>
        </div>
    </div>
    

{/block}

{block name=buttom_main}

{/block}