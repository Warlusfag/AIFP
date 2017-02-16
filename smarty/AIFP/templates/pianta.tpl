{extends file="generic_page_sidebar.tpl"}
{block "title"}Schede Funghi{/block}
{block name=buttom_main}
{/block}	
    

{block name=mainside}

    <section>
         <ul class="style1"> 
             <li><form action="{$root}funghi/schede_piante.php" type="get">
                        <button class="button schede" type="submit" name="genere" value="{$descrizione.genere}"> < {$descrizione.genere} </button>
                     </form></li>
         </ul>
    </section>

{/block}

        
{block name=main}  
{if $error}
<script>
    document.getElementById('alert').style.display='block';
</script>
{/if}
{if $message}
<script>
    document.getElementById('success').style.display='block';
</script>
{/if}
        
<div id="content" class="9u skel-cell-important">
    <section>
        <header>
            <div class="row half">
                <div class="6u"><h2>{$descrizione.tipologia} - {$descrizione.genere} {$descrizione.specie}</h2></div>
               
            </div>
            
            
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
                    <li><b>Specie</b> {$descrizione.specie}</li>
                    <li><b>Fusto</b> {$descrizione.fusto}</li>
                    <li><b>Radici</b> {$descrizione.radici}</li>
                     <li><b>Foglie</b> {$descrizione.foglie}</li>
                   
                </ul>
                    <hr>
            </div>
            <div class="4u">
                <ul>
                   
                    <li><b>Infiorescenze</b> {$descrizione.infiorescenze}</li>
                    <li><b>Margine fogliare</b> {$descrizione.margine_fogliare}</li>
                    <li><b>Numero petali</b> {$descrizione.num_petali}</li>
                    <li><b>Spine</b> {$descrizione.spine}</li>
                    <li><b>Corteccia</b> {$descrizione.corteccia}</li>
                </ul>
            </div>
               
            <div class="11u">
                <hr>
                <ul>
                    <li><b>Descrizione</b> {$descrizione.descrizione}</li>
                </ul>         

            </div>
            </div>
</div>


{/block}