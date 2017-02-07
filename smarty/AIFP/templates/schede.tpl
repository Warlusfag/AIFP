{extends file="generic_page_sidebar.tpl"}
	{block "title"}Schede Funghi{/block}
	
	{block name=main}  
	<!-- Main -->
<!-- Main -->
	
        <div id="content" class="9u skel-cell-important">
            <section>
                <header>
                    <h2>SCHEDE FUNGHI</h2>
                </header>
                <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                
                <div class="row">
                    {if $funghi==null}
                        
                        {foreach $genere as $gen}
                        <div class="4u">
                                <section>
                                    <form action="{$root}funghi/schede_funghi.php" method="get">
                                        <img src="{$root}{$gen[1]}">
                                        <button class="button" type="submit">{$gen[0]}</button>
                                    </form>
                                </section>
                        </div>
                                    
                        {/foreach}
                    {else}
                        {foreach $funghi as $fun}
                            <div class="4u">
                                <section>
                                    <header>
                                        <h4>{$fun[0]}</h4>
                                    </header>
                                    <form action="{root}funghi/fungo.php" method="get">
                                        <img src="{root}{$fun[2]}">
                                        <button class="button" type="submit">{$fun[1]}</button>
                                    </form>
                                </section>
                            </div>
                        {/foreach}
                        
                    {/if}
                </div>
                
                 
                
            </section>
        </div>
           
<!-- /Main -->

{/block}