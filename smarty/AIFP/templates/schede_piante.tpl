{extends file="generic_page_sidebar.tpl"}
	{block "title"}Schede Funghi{/block}
{block name=buttom_main}
{/block}
	
	{block name=main}  
	<!-- Main -->
<!-- Main -->
	
        <div id="content" class="9u skel-cell-important">
            <section>
                {if !$genere}
                    <header>
                        <h2>SCHEDE PIANTE</h2>
                    </header>
                    
                
                    <div class="row">
                        {foreach $foto as $gen}
                            <div class="4u">
                                    <section>
                                        <form action="{$root}piante/schede_piante.php" method="get">
                                            <button class="button" type="submit" value="{$gen[0]}" name="genere">
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
                        <div class="6u"><h2>{$genere}</h2></div>
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
                                        
                                        <button class="button" type="submit" value="{$pianta.specie}">
                                        <img src="{$root}funghi/foto_generi/amanita.jpeg" alt="{$pianta.specie}" class="image full">
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