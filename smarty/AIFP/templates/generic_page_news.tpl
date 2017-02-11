{extends file="generic_page.tpl"}

{block name=buttom_main}

        <br>
        <div class="container">
        <div class="row half">
                <div class="3u">
                        <section>
                                <header>
                                    <h3><a href={$root}eventi/eventi.php>SAGRE</a></h3>
                                </header>
                                <ul class="default">
                                    {$i=0}
                                    {$count=0}
                                    {while $i < 20 && $count < 3}
                                        {if $news[$i].tipologia=='sagra'}
                                            {$count=$count+1}
                                            <li><img src="{$root}images/news.ico" width="78" height="78" alt="">
                                                <p><b>{$news[$i].nome}</b></p>
                                                <span class="posted">Dal <b>{$news[$i].data_inzio}</b>  al <b>{$news[$i].data_fine}</b><br><b>{$news[$i].provincia}</b>-<b>{$news[$i].regione}</b></span>
                                            </li>
                                        {/if}
                                        {$i=$i+1}
                                    {/while}
                                </ul>
                        </section>
                </div>
                <div class="3u">
                        <section>
                                <header>
                                    <h3><a href={$root}eventi/eventi.php>CORSI</a></h3>
                                </header>
                                <ul class="default">
                                    {$i = 0}
                                    {$count = 0}
                                    {while $i < 20 && $count < 3}
                                        {if $news[$i].tipologia=='corso'}
                                            {$count=$count+1}
                                            <li><img src="{$root}images/news.ico" width="78" height="78" alt="">
                                                <p><b>{$news[$i].nome}</b></p>
                                                <span class="posted">Dal <b>{$news[$i].data_inzio}</b>  al <b>{$news[$i].data_fine}</b><br><b>{$news[$i].provincia}</b>-<b>{$news[$i].regione}</b></span>
                                            </li>
                                        {/if}
                                        {$i=$i+1}
                                    {/while}
                        </section>
                </div>
                <div class="6u">
                        <section>
                                <header>
                                        <h3><a href={$root}eventi/eventi.php>MOSTRE</a></h3>
                                </header>
                                <div class="slideshow-container"> 
                                    {$i=0}
                                    {$count=0}
                                    {while $i < 20 && $count < 3}
                                        {if $news[$i].tipologia=='mostra' && $count!=0}
                                            {$count=$count+1}
                                            <div class="mySlides fade">
                                                <div class="numbertext">{$count} / 3</div>
                                                <a href="#" class="image full"><img src="{$root}images/pics10_{$count-1}.jpg" alt=""></a>
                                                <p><b>{$news[$i].nome}</b></p>
                                                <span class="posted">Dal <b>{$news[$i].data_inzio}</b> al <b>{$news[$i].data_fine}</b><br><b>{$news[$i].provincia}</b>-<b>{$news[$i].regione}</b></span>
                                            </div>
                                        {/if}
                                        {if $news[$i].tipologia=='mostra' && $count==0}
                                            {$count=$count+1}
                                            <div class="mySlides fade" style="display: block;">
                                                <div class="numbertext">1 / 3</div>
                                                <a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a>
                                                <p><b>{$news[$i].nome}</b></p>
                                                <span class="posted">Dal <b>{$news[$i].data_inzio}</b> al <b>{$news[$i].data_fine}</b><br><b>{$news[$i].provincia}</b>-<b>{$news[$i].regione}</b></span>
                                            </div>
                                        {/if}
                                        
                                        {$i=$i+1}
                                    {/while}
                                    
                                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                                    <a class="next" onclick="plusSlides(1)">❯</a>
                                </div>
                                <br>

                                <div style="text-align:center">
                                  <span class="dot" onclick="currentSlide(1)"></span> 
                                  <span class="dot" onclick="currentSlide(2)"></span> 
                                  <span class="dot" onclick="currentSlide(3)"></span> 
                                </div>
                        </section>
                </div>
                
        </div>
    </div>
			<!--block buttom_main closed-->
{/block}
