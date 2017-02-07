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
                                    <a href="#" class="image full"><img src="{$gen}" alt=""></a>
                                    <a href="#" class="button">{$gen}</a>
                            </section>
                    </div>
                    {/foreach}
                </div>
                
                 
                
            </section>
        </div>
           
<!-- /Main -->

{/block}  