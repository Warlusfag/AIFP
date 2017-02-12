{extends file="generic_page_sidebar.tpl"}
{block "title"}Schede Funghi{/block}
{block name=buttom_main}
{/block}	
{block name=mainside}
    {if $error != null}
        <script>
            document.getElementById('alert').style.display='block';
        </script>
    {/if} 
     <section>
        <header>
            <h2>Overview</h2>
        </header>
        <ul class="style1"> 
            <li><a href="{$root}funghi/storia.php">Storia del fungo</a></li>
            <li><a href="{$root}funghi/schede_funghi.php">Schede Funghi</a></li>
            <li><a href="{$root}prodotti/libri.php">Libri e Guide</a></button></li>
            <li><a href="{$root}funghi/regolamento.php">Regolamenti</a></button></li>
        </ul>
    </section>
{/block}        
        
        
{block name=main}  
	
<div id="content" class="9u skel-cell-important">
    <section>
        <header>
            <h2>{$descrizione.genere} {$descrizione.specie}</h2>
        </header>
    </section>
        <div class="row half">
            <div class="6u">
                        <section>
                                <div class="slideshow-container">
                                    {$max = count($foto)}
                                    {$count=0}
                                    {foreach $foto as $f}
                                        {if $count!=0}
                                            {$count=$count+1}
                                            <div class="mySlides fade">
                                                <div class="numbertext">{$count} / {$max}</div>
                                                <a class="image full"><img src="{$root}{$f}" alt=""></a>
                                            </div>
                                        {/if}
                                        {if $count==0}
                                            {$count=$count+1}
                                            <div class="mySlides fade" style="display: block;">
                                                <div class="numbertext">1 / {$max}</div>
                                                <a class="image full"><img src="{$root}{$f}" alt=""></a>
                                            </div>
                                        {/if}
                                        
                                    {/foreach}
                                    
                                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                                    <a class="next" onclick="plusSlides(1)">❯</a>
                                </div>
                                <br>
                                
                                {$i=0}
                                
                                <div style="text-align:center">
                                    {while $i < $max}
                                         <span class="dot" onclick="currentSlide({$i})"></span> 
                                         {$i=$i+1}
                                    {/while}
                                </div>
                                
                        </section>
                </div>
            <div class="4u">
                <ul>
                    <li><b>Commestibile</b> {$descrizione.commestiblie}</li>
                    <li><b>Sporata</b> {$descrizione.sporata}</li>
                    <li><b>Viraggio</b> {$descrizione.viraggio}</li>
                   
                </ul>
                    <hr>
            </div>
            <div class="4u">
                <ul>
                    <li><b>Imenio</b> {$descrizione.imenio}</li>
                    <li><b>Anello</b> {$descrizione.anello}</li>
                    <li><b>Volva</b> {$descrizione.volva}</li>
                    <li><b>Habitat</b> {$descrizione.habitat}</li>
                    <li><b>Stagione</b> {$descrizione.stagione}</li>
                </ul>
            </div>
               
            <div class="11u">
                <hr>
                <ul>
                    <li><b>Cappello</b> {$descrizione.cappello}</li>
                    <li><b>Colore</b> {$descrizione.colore}</li>
                    <li><b>Gambo</b> {$descrizione.gambo}</li>
                    <li><b>Pianta</b> {$descrizione.pianta}</li>
                    <li><b>Descrizione</b> {$descrizione.descrizione}</li>
                </ul>         

            </div>
            </div>
</div>


{/block}