{extends file="generic_page.tpl"}
{block "title"}Eventi{/block}


{block name=main}  
    {assign $i 0}
    {assign $count 0}
    <div class="container">
        <section>
                <header> 
                    <h2>EVENTI</h2>
                </header>
            </section>
        <br>
        <hr>
        <div class="row half">
            
           
                    
            <div class="3u">
                <section>
                <header> 
                    <h3>RICERCA EVENTO</h3>
                </header>
            </section>
            </div>
                
            <div class="6u">
                 <form name="s_eventi" method="post" id="search" onsubmit="return testeventi()"action="{$root}eventi/search_eventi.php" > 
                    <label>Cerca per nome</label>&nbsp &nbsp &nbsp
                    <input class="reg" type="text" name="nome">
                    <br><br>
                    <label>Cerca per regione</label>&nbsp &nbsp
                        <select name="regione" form="search">
                          
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
                    <br><br>
                    <label>Cerca per tipo</label>&nbsp &nbsp &nbsp &nbsp &nbsp
                    <select name="tipologia" form="search">
                        <option value="corso">Corso</option>
                        <option value="sagra">Sagra</option>
                        <option value="mostra">Mostra</option>
                    </select>
                    <br><br>
                    <label>Cerca per data </label>&nbsp &nbsp &nbsp &nbsp
                        
                    <input type="date" placeholder="Inserisci Data di Nascita" name="data_inizio">
                 </form>     
            </div>
            <div class="3u">
                
                <button type="submit" class="button" form="search">Cerca</button><br>
            </div>
                
            

        </div>
                    
                    <br>
                    <hr>
                    
                    
         <div class="row half">
                <div class="3u">
                        <section>
                                <header>
                                        <h3>SAGRE</h3>
                                </header>
                                <ul class="default">
                                    {foreach $eventi as $ev}
                                        
                                        {if $ev.tipologia == 'sagra'}
                                        <li><img src="{$root}images/news.ico" width="78" height="78" alt="">
                                            <form action="{$root}eventi/inscr_eventi.php" method="post">
                                                <p><b>{$ev.nome}</b></p>
                                                <span class="posted">Dal <b>{$ev.data_inzio}</b> al <b>{$ev.data_fine}   {$ev.provincia}</b>-<b>{$ev.regione}</b></span><br>
                                                 {if !$profilo}
                                                        <a onclick="document.getElementById('login').style.display='block'" href="#">Accedi per Iscriverti</a>
                                                    {else}
                                                        <button class="button evento" type="submit" value="{$ev[$i].id_evento}">partecipa</button>
                                                    {/if}
                                            </form>
                                        </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                        </section>
                </div>
                <div class="3u">
                        <section>
                                <header>
                                        <h3>CORSI</h3>
                                </header>
                                <ul class="default">
                                    {foreach $eventi as $ev}
                                        {if $ev[3] == 'corso'}
                                        <li><img src="{$root}images/news.ico" width="78" height="78" alt="">
                                            <form action="{$root}eventi/inscr_eventi.php" method="post">
                                                <p><b>{$ev.nome}</b></p>
                                                <span class="posted">Dal <b>{$ev.data_inzio}</b> al <b>{$ev.data_fine}   {$ev.provincia}</b>-<b>{$ev.regione}</b></span><br>
                                                {if !$profilo}
                                                        <a onclick="document.getElementById('login').style.display='block'" href="#">Accedi per Iscriverti</a>
                                                    {else}
                                                        <button class="button evento" type="submit" value="{$ev[$i].id_evento}">partecipa</button>
                                                    {/if}   
                                            </form>
                                        </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                        </section>
                </div>
                <div class="6u">
                        <section>
                                <header>
                                        <h3>MOSTRE </h3>
                                </header>
                                <div class="slideshow-container"> 
                                    {$i=0}
                                    {$count=0}
                                    {while $i < 20}
                                        <form action="{$root}eventi/inscr_eventi.php" method="post">
                                        {if $eventi[$i].tipologia == 'mostra' && $count!=0}
                                        <div class="mySlides fade">
                                                {$count=$count+1}
                                                <div class="numbertext">{$count}/ 3</div>
                                                <a href="#" class="image full"><img src="{$root}images/pics10_1.jpg" alt=""></a>
                                                <p>{$eventi[$i].nome}</p>
                                                <span class="posted">Dal <b>{$eventi[$i].data_inzio}</b> al <b>{$eventi[$i].data_fine}</b></span>
                                                {if !$profilo}
                                                        <a onclick="document.getElementById('login').style.display='block'" href="#">Accedi per Iscriverti</a>
                                                    {else}
                                                        <button class="button evento" type="submit" value="{$eventi[$i].id_evento}">partecipa</button>
                                                    {/if}
                                        </div>
                                        {/if}
                                        
                                        {if $eventi[$i].tipologia=='mostra' && $count==0}
                                            {$count=$count+1}
                                            <div class="mySlides fade" style="display: block;">
                                                    <div class="numbertext">1 / 3</div>
                                                    <a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a>
                                                    <p>{$eventi[$i].nome}</p>
                                                    <span class="posted">Dal <b>{$eventi[$i].data_inzio}</b> al <b>{$eventi[$i].data_fine}</b></span>
                                                    {if !$profilo}
                                                        <a onclick="document.getElementById('login').style.display='block'" href="#">Accedi per Iscriverti</a>
                                                    {else}
                                                        <button class="button evento" type="submit" value="{$eventi[$i].id_evento}">partecipa</button>
                                                    {/if}
                                            </div>
                                        {/if}
                                        
                                        {$i=$i+1}
                                        </form>
                                    {/while}
                                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                                    <a class="next" onclick="plusSlides(1)">❯</a>
                                </div>
                                <br>
                                
                                <div style="text-align:center">
                                    {$i=0}
                                    {while $i < $count}
                                        <span class="dot" onclick="currentSlide({$i})"></span> 
                                        {$i=$i+1}
                                    {/while}
                                    
                                </div>
                        </section>
                </div>
            
                <!-- EVENTO FORM -->
        </div>
</div>

{/block}
