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
                        <h2>{$genere}</h2>
                    </header>
                    <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                
                    <div class="row">
                        {foreach $piante as $pianta}
                        <div class="4u">
                                <section>
                                    <form action="{$root}funghi/fungo.php" method="get">
                                        
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