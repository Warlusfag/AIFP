{extends file="generic_page_sidebar.tpl"}
{block "title"}Schede Funghi{/block}
{block name=buttom_main}
{/block}	
{block name=mainside}
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
	<!-- Main -->
<!-- Main -->
	
        <div id="content" class="9u skel-cell-important">
            <section>
                {if !$genere}
                    <header>
                        <h2>schede funghi</h2>
                    </header>
                    
                
                    <div class="row">
                        {foreach $foto as $gen}
                            <div class="4u">
                                    <section>
                                        <form action="{$root}funghi/schede_funghi.php" method="get">
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
                            <a href="{$root}funghi/schede_funghi.php" class="button prec"> < </a>
                            
                        </div>
                    </div>
                    </header>
                   
                    <div class="row">
                        {foreach $funghi as $fun}
                        <div class="4u">
                                <section>
                                    <form action="{$root}funghi/fungo.php" method="get">
                                        {if $fun.commestibile == "mortale"}
                                            {$color = "red"}
                                        {/if}
                                        {if $fun.commestibile == "immangiabile"}
                                                {$color = "grey"}
                                        {/if}
                                        {if $fun.commestibile == "velenoso"}
                                                {$color = "yellow"}
                                        {/if}
                                        <input name="specie" value="{$fun.specie}" style="display:none;">
                                        <button style="background-color:{$color};" class="button" name="genere" type="submit" value="{$fun.genere}">
                                        <img src="{$root}{$fun.foto}" alt="{$fun.specie}" class="image full">
                                        {$fun.genere} {$fun.specie}</button>
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