{extends file="generic_page_sidebar.tpl"}
	{block "title"}Schede Piante{/block}
        
        {block name="main"}
        <div id="content" class="9u skel-cell-important">
            <section>
                <header>
                    <h2>SCHEDE PIANTE</h2>
                </header>
                <a href="#" class="image full"><img src="../images/pics12.jpg" alt=""></a>
                
                <div class="row">
                   {foreach $genere as $gen}
                    <div class="4u">
                            <section>
                                <form action="{$root}funghi/schede_piante.php" method="POST">
                                    <img src="{$root}{$gen[1]}" alt=""></a>
                                    <button class="button" type="submit">{$gen[0]}</button>
                                </form>
                            </section>
                    </div>
                    {/foreach}
                </div>
                
                 
                
            </section>
        </div>
           
<!-- /Main -->

{/block}  