{extends file="generic_page.tpl"}
{block "title"}Eventi{/block}


{block name=main}  
    {assign $i 0}
    {assign $count 0}
    <div class="container">
 
        
        
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
                                                        <button class="button evento" type="submit" value="{$eventi[$i].id_evento}">partecipa</button>
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
                                                        <button class="button evento" type="submit" value="{$eventi[$i].id_evento}">partecipa</button>
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
