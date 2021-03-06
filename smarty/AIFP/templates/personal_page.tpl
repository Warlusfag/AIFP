{$profilo.user=$profilo.user}
{extends file="generic_page_sidebar.tpl"}
{block "title"}{$user}{/block}

{block name=userside}
{/block}

{block name=mainside}
    {if $message}
            <script>
                document.getElementById('success').style.display='block';
            </script>
    {/if}
    {if $error}
            <script>
                document.getElementById('alert').style.display='block';
            </script>
    {/if}   

    <section>
        <header>
            <h2>Profilo</h2>
        </header>
    <ul class="style1"> 
        {if $profilo.type=="utente"}
            {$status_ric="disabled"}
            {$color_ric="grey"}
            {$status_fs="disabled"}
            {$color_fs="grey"}
            {$status_add="disabled"}
            {$color_add="grey"}
            {$status_up="disabled"}
            {$color_up="grey"}
        {/if}
        {if $profilo.type=="botanico" || $profilo.type=="micologo" || $profilo.type=="inscritto"}
            {$status_add="disabled"}
            {$color_add="grey"}
            {$status_up="disabled"}
            {$color_up="grey"}
        {/if}
        {if $profilo.type=="admin"}
            {$status_add="disabled"}
            {$color_add="grey"}
            {$status_fs="disabled"}
            {$color_fs="grey"}
        {/if}
        <li><button class="button schede" onclick="show('form')">{$profilo.user}</button></li>
        <li><button class="button schede" onclick="show('form1')">Modifica Profilo</button></li>
        <li><button class="button schede" style="background-color:{$color_ric}" onclick="show('form2')" {$status_ric} >Ricerca Funghi</button></li>
        <li>
            <form action="{$root}personal_page/file_space.php" method="post">
                <button type="submit" name="action" value="show" style="background-color:{$color_fs}" class="button schede" onclick="show('form4')" {$status_fs}>File Space</button>
            </form>
        </li>

        <li><button id="btn3" class="button schede" style="background-color:{$color_add}" onclick="show('form3')" {$status_add}>Aggiungi Evento</button></li>
        <li><button id="btn6" class="button schede" style="background-color:{$color_up}" onclick="show('form6')" {$status_up}>Promuovi Utente</button></li>
    
        {if $profilo.type=="admin"}
        <li>
            <form action="{$root}personal_page/request_ass.php" method="post">
                <button type="submit" id="btn5" name="" value="" class="button schede">Verifica Associazione</button>
            </form>
        </li>
        {/if}
        </ul>
    </section>
{/block}

{block name=main} 
    {if $ass==1}
        <a onclick="show('form5')" style="display:none;" href="#" id="load" >form5</a>
    {/if}
            
    {if $feventi==1}
        <a onclick="show('form3')" style="display:none;" href="#" id="load" >form3</a>
    {/if}

    {if $fspace==1}
        {if $path!=null}
        <a id="load" style="display:none;" href="{$root}{$path}" download>download</a>
        {/if}
        <a onclick="show('form4')" style="display:none;" href="#" id="load" >form5</a>
    {/if}            

    {if $fsearch==1}
        <a onclick="show('form2')" style="display:none;" href="#" id="load" >form5</a>
        {if $descrizione}
            <script>
                document.getElementById('descr').style.display='block';
            </script>
        {/if}
    {/if}
    <!-- FORM MAIN -->       
    <div class="9u skel-cell-importantf" id="form">
        <div class="row">
        <div class="5u">
            <section>
                <header>
                    <h3>{$profilo.user}</h3>
                </header>
                    <img src="{$root}{$profilo.image}" class="pic" style="width:200px;height:200px;"><br>
            </section>
        </div>
        <div class="7u">
            {if $profilo.type!="associazione"}
            <section>
                <br><br>
                <ul>
                    <li>Email: <strong> {$profilo.email}</strong></li>
                    <li>Nome e Cognome:<strong> {$profilo.nome} {$profilo.cognome}</strong></li>
                    <li>Residenza: <strong>{$profilo.residenza}</strong></li>
                    <li>Regione: <strong>{$profilo.regione}</strong></li>
                    <li>Data di Nascita <strong> {$profilo.data} </strong></li>
                </ul>
                <br><hr><br>
                <ul>
                    <li>Tipologia:<strong> {$profilo.type}</strong></li>
                    <li>Punteggio:<strong> {$profilo.punteggio}</strong></li>
                    <li>Numero post:<strong> {$profilo.num_post}</strong></li>
                </ul>
            </section>
            {else}
                <section>
                <br><br>
                <ul>
                    <li>Email: <strong> {$profilo.email}</strong></li>
                    <li>Nome <strong> {$profilo.nome}</strong></li>
                    <li>Indirizzo: <strong>{$profilo.indirizzo}</strong></li>
                    <li>CAP: <strong>{$profilo.CAP}</strong></li>
                    <li>Provincia <strong> {$profilo.provincia} </strong></li>
                    <li>Regione: <strong>{$profilo.regione}</strong></li>
                    <li>Sito Web: <strong>{$profilo.sito_web}</strong></li>
                </ul>
                <br><hr><br>
                <ul>
                    <li>Tipologia:<strong> {$profilo.type}</strong></li>
                    <li>Punteggio:<strong> {$profilo.punteggio}</strong></li>
                    <li>Numero post:<strong> {$profilo.num_post}</strong></li>
                </ul>
            </section>
            {/if}

        </div>
        </div>
    </div>
    <!-- END FORM MAIN -->
    
    <!-- MODIFICA PROFILO --> 
    <div class="row half" id="form1">
        <div class="7u" >
          <section>
            <header>
                    <h3>{$profilo.user}</h3>
            </header>
                    
            <img src="{$root}{$profilo.image}"  style="width:200px;height:200px;" class="pic"><br>
            <hr>
            Cambia immagine del profilo <br>
            <form action="{$root}/personal_page/load_image.php" method="post" enctype="multipart/form-data">
                <input type="file" name="image">
                    <button class="button personal" type="submit" value="upload">Cambia</button>
            </form>
        </section>
        </div>
        <div class="5u">
                {if $profilo.type!="associazione"}
                <form id="update" name="up_date" action="{$root}personal_page/update_profile.php" method="post"> 
                <section>
                    <br><br>
                    <ul>
                        <li>Email: &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" name="email" value="{$profilo.email}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input name="nome" type="text" value="{$profilo.nome}"</li>
                        <li>Username &nbsp &nbsp &nbsp &nbsp<input name="user" type="text" value="{$profilo.user}"</li>
                        <li>Cognome &nbsp &nbsp<input name="cognome" type="text" value="{$profilo.cognome}"</li>
                        <li>Residenza: &nbsp <input name="residenza" type="text" value="{$profilo.residenza}"</li>
                      
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
                        <li>Data di nascita &nbsp &nbsp<input type="date" name="data" value="{$profilo.data}"></li>
                    </ul>
                    <button class="button personal" onclick="return testmode()" type="submit">Salva</button>
                    <br><br>
                    <input name="email2" value="{$profilo.email}" style="display:none" disabled>
                    <input name="nome2" value="{$profilo.nome}" style="display:none" disabled>
                    <input name="cognome2" value="{$profilo.cognome}" style="display:none" disabled>
                    <input name="residenza2" value="{$profilo.residenza}" style="display:none" disabled>
                    <input name="regione2" value="{$profilo.regione}" style="display:none" disabled>
                    <input name="data2" value="{$profilo.data}" style="display:none" disabled>
                    <input name="user2" value="{$profilo.user}" style="display:none" disabled>
                </section>
                </form>
                {else}
                    <form id="update" name="up_date" action="{$root}personal_page/update_profile.php" method="post"> 
                    <section>
                    <br><br>
                    <ul>
                        <li>Email &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" name="email" value="{$profilo.email}"</li>
                        <li>User &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" name="user" value="{$profilo.user}"</li>
                        <li>Nome &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" name="nome" value="{$profilo.nome}"</li>
                        <li>Indirizzo: &nbsp <input type="text" name="indirizzo" value="{$profilo.indirizzo}"</li>
                        <li>Provincia &nbsp &nbsp<input type="text" name="provincia" value="{$profilo.provincia}"</li>
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
                    <button class="button personal" onclick="return testmode2()" type="submit">Salva</button>
                    <br><br>
                    <input name="email2" value="{$profilo.email}" style="display:none" disabled>
                    <input name="nome2" value="{$profilo.nome}" style="display:none" disabled>
                    <input name="indirizzo2" value="{$profilo.indirizzo}" style="display:none" disabled>
                    <input name="provincia2" value="{$profilo.provincia}" style="display:none" disabled>
                    <input name="regione2" value="{$profilo.regione}" style="display:none" disabled>
                    <input name="CAP2" value="{$profilo.CAP}" style="display:none" disabled>
                    <input name="user2" value="{$profilo.user}" style="display:none" disabled>
                    <input name="sito_web2" value="{$profilo.sito_web}" style="display:none" disabled>
                    <input name="componenti2" value="{$profilo.componenti}" style="display:none" disabled>
                </section>
                </form>
                {/if}
            
        </div>
           
    </div>
    <!-- END MODIFICA PROFILO -->
    
    <!-- RICERCA DICOTOMICA -->
    <div class="8u skel-cell-importantf" id="form2">
        <section>
            <header>
                <h2>RICERCA DICOTOMICA</h2>
                <hr><br>
                <h3>Ricerca fungo per </h3>
            </header>
        <form id="search" name="s_funghi"   action="{$root}personal_page/search_funghi.php" method="post">
            <table class="input">
                <tr class="input">
                    <td colspan="3" class="input center"><input type="text" id="0" placeholder="Genere" name="genere"></td>
                        
                </tr>
                <tr class="input">
                    <td colspan="3" class="input center"><input type="text" id="1" placeholder="Specie" name="specie"></td>
                </tr>
                <tr class="input">
                    <th class="input">
                        <select class="button option" name="cappello" id="2" form="search">
                            <option value="">Cappello</option>
                            <option value="nessuno">Nessuno</option>
                            <option value="umbonato">Umbonato</option>
                            <option value="campanulato">Campanulato</option>
                            <option value="convesso">Convesso</option>
                            <option value="appianato">Appianato</option>
                        </select>
                    </th>
                    <td class="input center">
                        <select class="button option" name="sporata" id="3" form="search">
                            <option value="">Sporata</option>
                            <option value="leucosporeo">Leucosporeo</option>
                            <option value="ocroscoporeo">Ocroscoporeo</option>
                            <option value="iantinosporeo">Iantinosporeo</option>
                            <option value="rodosporeo">Rodosporeo</option>
                        </select>
                    </td>
                    <td class="input">
                        <select class="button option" name="anello" id="4" form="search">
                            <option value="">Anello</option>
                            <option value="assente">Assente</option>
                            <option value="semplice">Semplice</option>
                            <option value="doppio">Doppio</option>
                            <option value="doppio-mobile">Doppio-mobile</option>
                        </select>
                    </td>

                </tr>
                <tr class="input">

                    <th class="input">
                        <select class="button option" name="commestibile" id="5" form="search">
                            <option value="">Commestibilità</option>
                            <option value="ottimo">Ottimo</option>
                            <option value="buono">Buono</option>
                            <option value="discreto">Discreto</option>
                            <option value="immangiabile">Immangiabile</option>
                            <option value="tossico">Tossico</option>
                            <option value="velenoso">Velenoso</option>
                            <option value="mortale">Mortale</option>
                        </select>
                    </th>
                    <td class="input center">
                        <select class="button option" name="viraggio" id="6" form="search">
                            <option value="">Viraggio</option>
                            <option value="assente">Assente</option>
                            <option value="rosso">Rosso</option>
                            <option value="blu">Blu</option>
                            <option value="verde">Verde</option>
                            <option value="giallo">Giallo</option>
                        </select>
                    </td> 

                    <td class="input">
                    <select class="button option" name="imenio" id="7" form="search">
                        <option value="">Imenio</option>
                        <option value="tuboli">Tuboli</option>
                        <option value="lamelle">Lamelle</option>
                        <option value="pliche">Pliche</option>
                        <option value="aghi">Aghi</option>
                    </select>
                    </td> 
                </tr>
                <tr class="input">
                    <th class="input">
                        <select class="button option" name="stagione" id="8" form="search">
                            <option value="">Stagione</option>
                            <option value="inverno">Inverno</option>
                            <option value="primavera">Primavera</option>
                            <option value="autunno">Autunno</option>
                            <option value="estate">Estate</option>
                        </select></th>
                    <td class="input center">
                        <select class="button option" name="habitat" id="9" form="search">
                            <option value="">Habitat</option>
                            <option value="lignicolo">Lignicolo</option>
                            <option value="prato">Prato</option>
                            <option value="saprofita">Saprofita</option>
                            <option value="bosco">Bosco</option>
                        </select></td>
                    <td class="input">
                        <select class="button option" name="volva" id="10" form="search">
                            <option value="">Volva</option>
                            <option value="circoncisa">Circoncisa</option>
                            <option value="sacco">Sacco</option>
                            <option value="linguinale">Linguinale</option>
                            <option value="napiforme">Napiforme</option>
                            <option value="perlata">Napiforme</option>
                        </select>
                    </td>

                </tr>
                <tr class="input">
                    <th class="input"> <button class="button" onclick="return searchtest()" type="submit">Cerca</button></th>
                    <th class="input"></th>
                    <td class="input"> <button class="button" name="reset" value="1" type="">Reset</button></td>
                </tr>
            </table>
        </form>
            
            <br><hr>
            {if $funghi}
                <h3>Risultati ricerca </h3>
            {/if}
            <br>
        <ul class="default">
            {$count=-1}
                {foreach $funghi as $f}
                    <form action="{$root}personal_page/search_funghi.php" method="post">
                        {$count=$count+1}

                        <button class="sezione" name="index" value="{$count}" type="submit">
                        <li>
                            <div class="row half">
                                <div class="7u">
                                    <br>
                                    <span style="font-size:20px;"><strong>{$f.genere} {$f.specie}</strong></span>
                                    <br>
                                </div>
                                <div class="3u" style="float:right; border-left: solid 1px #ddd">
                                    <h3>Clicca per saperne di più</h3>
                                </div>
                            </div>
                        </li>
                        </button>
                    </form>
            {/foreach}
                
        </ul>
        </section>
    </div>
    <!-- END RICERCA -->        
      
    <!-- AGGIUNGI EVENTO -->
    <div class="9u skel-cell-important" id="form3">
        <section>
            <header>
                <h2>AGGIUNGI EVENTO</h2>
            </header>
        </section>
            <form action="{$root}personal_page/aggiungi_evento.php" id="add" method="post">
                <input type="text" placeholder="Nome dell'evento" style="border:none;" name="nome" required>
                <hr>
                Data di inzio <input type="date" name="data_inizio" required>  Data di fine <input type="date" name="data_fine" required>
                <hr>
                <label>Tipologia &nbsp </label>
                <select class="button option" name="tipologia" form="add">
                    <option value="sagra">Sagra</option>
                    <option value="corso">Corso</option>
                    <option value="mostra">Mostra</option>
                </select>
                <hr>
                Luogo
                <input type="text" placeholder="Provincia" name="provincia" required><br>
                <label>Regione &nbsp</label>
                <select class="button option" name="regione" form="add">
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
    <!-- END AGGIUNGI EVENTO -->
    
    <!-- FILE SPACE -->
    <div class="9u skel-cell-important" id="form4">
        <div class="">
          <section>
            <header>
                <h2>FILE SPACE</h2>
            </header>
           </section>
            <table>
                <tr>
                    <th><b>File Name</b></th>
                    <th><b>Size</b></th>
                    <th></th>
                    <th></th>
                </tr>

                {foreach $files as $file}

                <tr>
                 <form action="{$root}personal_page/file_space.php" method="post">
                  <td>{$file.nome}</td>
                  <td>{$file.size}</td>
                  <input name="filename" value="{$file.nome}" style="display:none;">
                  <td style="width:47px; text-align:center;"><button type="submit" name="action" value="download"><img src="{$root}images/download.png" class="filespace"></button></td>
                  <td style="width:47px; text-align:center;"><button type="submit" name="action" value="delete"><img src="{$root}images/delete.png" class="filespace"></button></td>
                 </form>
                </tr>


                {/foreach}
             </table>
            <form action="{$root}personal_page/file_space.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileass">
                    <button type="submit" name="action" value="upload">Upload file</button>
            </form>
        </div>
    </div>
    <!-- END FILE SPACE -->
     
    <!-- REQUEST ASS -->
    <div class="9u skel-cell-important" id="form5">
        <div class="">
        <section>
            <header>
                    <h2>Verifica Associazione</h2>
            </header>
        </section>
        <form action="{$root}personal_page/validate.php" method="post">            
            <table>
                <tr>
                    <th colspan="3"><b>Associazione</b></th>
                    <th></th>
                </tr>
                {$count=-1}
                {foreach $reqass as $a}
                    {$count = $count +1}
                <tr>
                  <td>{$a.nome}</td>
                  <td>{$a.regione}</td>
                  <td>{$a.email}</td>
                  <td style="width:47px; text-align:center;"><button type="submit" name="id_ass" value="{$count}"><img src="{$root}images/checked.png" class="filespace"></button></td>

                </tr>
                {/foreach}

            </table>
        </form>
        </div>
    </div>
    <!-- END REQUEST ASS -->           
    
    <!-- UPGRADE USER -->
     <div class="9u skel-cell-important" id="form6">
        <div class="">
        <section>
            <header>
                    <h2>Promuovi Utente</h2>
            </header>
        </section>
            <form action="{$root}personal_page/upgrade_user.php" method="post">
                <p>Inserisci l'email dell'utente da promuovere</p>
                
                <input type="email" name="email"><br>
                <input type="radio" name="type" value="iscritto">Iscritto
                <input type="radio" name="type" value="micologo">Micologo
                <input type="radio" name="type" value="botanico">Botanico<br>
                <button type="submit" class="button">Promuovi</button>
            </form>
        </div>
    </div>
    <!-- END UPGRADE USER -->
            
    
   
{/block}

{block name=buttom_main}
{/block}