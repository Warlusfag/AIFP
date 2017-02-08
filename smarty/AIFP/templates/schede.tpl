{extends file="generic_page_sidebar.tpl"}
	{block "title"}Schede Funghi{/block}
	
	{block name=main}  
	<!-- Main -->
<!-- Main -->
	
        <div id="content" class="9u skel-cell-important">
            <section>
                {if $funghi==null}
                    <header>
                        <h2>SCHEDE FUNGHI</h2>
                    </header>
                    <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                
                    <div class="row">
                        {foreach $foto as $gen}
                            <div class="4u">
                                    <section>
                                        <form action="{$root}funghi/schede_funghi.php" method="get">
                                            <img src="{$gen[1]}" alt="{$gen[1]}" class="image full">
                                            <button class="button" type="submit" value="{$gen[0]}" name="genere">{$gen[0]}</button>
                                            <br>
                                        </form>

                                    </section>
                                            <br>    
                            </div>
                        {/foreach}
                    </div>
                {else}
                    <header>
                        <h2>{$fun[2]}</h2>
                    </header>
                    <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                
                    <div class="row">
                        {foreach $funghi as $fun}
                        <div class="4u">
                                <section>
                                    <form action="{$root}funghi/schede_funghi.php" method="get">
                                        <img src="{$fun[1]}" alt="{$fun[1]}" class="image full">
                                        <button class="button" type="submit">{$fun[0]}</button>
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