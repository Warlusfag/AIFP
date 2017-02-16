{extends file="generic_page_sidebar.tpl"}
	{block "title"}Schede Funghi{/block}
{block name=buttom_main}
{/block}

{block name=mainside}
     {if $genere}
    <section>
         <ul class="style1"> 
             <li> <a href="{$root}piante/schede_piante.php" class="button schede" style="color:black;"> < Schede Piante</a></li>
         </ul>
    </section>
    {/if}
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
                {if !$tipologia}
                    <header>
                        <h2>SCHEDE PIANTE</h2>
                    </header>
                    
                
                    <div class="row">
                        {foreach $foto as $gen}
                            <div class="4u">
                                    <section>
                                        <form action="{$root}piante/schede_piante.php" method="get">
                                            <button class="button" type="submit" value="{$gen[0]}" name="tipologia">
                                                <img src="{$gen[1]}"class="image full">
                                                {$gen[0]}
                                            </button>
                                            <br>
                                        </form>

                                    </section>
                                            <br>    
                            </div>
                        {/foreach}
                    </div>
                {else}
                    <header>
                    <div class="row half">
                        <div class="6u"><h2>{$tipologia}</h2></div>
                        <div class="4u" style="float:right;">
                            <a href="{$root}piante/schede_piante.php" class="button prec"> < </a>
                            
                        </div>
                    </div>
                    </header>
                
                
                    <div class="row">
                        {foreach $piante as $pianta}
                        <div class="4u">
                                <section>
                                    <form action="{$root}piante/pianta.php" method="get">
                                        <input name="tipologia" value="{$tipologia}" style="display:none;">
                                        <input name="specie" value="{$pianta.specie}" style="display:none;">
                                        <button class="button" type="submit" name="genere" value="{$pianta.genere}">
                                        <img src="{$root}{$pianta.foto}" alt="{$pianta.specie}" class="image full">
                                        {$pianta.genere} {$pianta.specie}</button>
                                        <br>
                                    </form>
                                        
                                </section>
                            <br>    
                        </div>
                    {/foreach}
                        
                    {/if}
                </div>
                
                 
                
            </section>
        </div>
           
<!-- /Main -->

{/block}